<?php

namespace App\Http\Controllers;
use App\Models\Bugtracker_report;
use App\Models\Bugtracker_categories;
use App\Models\Bugtracker_users_vote;
use App\Models\Realm;
use Auth;
use Validator;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Http\Request;

class BugtrackerController extends Controller
{
    const COMMUNITY_LABEL_SUBCATEGORY = [
          7, 16, 9
      ];

      const BALANCE_TEAM_CATEGORY = [
          1, 3, 4
      ];

      const AI_TEAM = [
          'categories'  => [3, 1, 4],
          'subcategory' => [6, 5, 15, 3, 2, 7, 1],
          'area' => [3, 7, 11, 1, 5, 9],
      ];

    public function index()
    {
      $realms = Realm::where('is_active', Realm::REALM_STATUS_ACTIVE)->get();
      $categories = Bugtracker_categories::all();

      $data = [
          'realms' => $realms,
          'categories' => $categories
        ];
      return view('bugtracker.index')->with($data);
    }
    public function create(Request $request)
    {
      $data = [

              'master_tags' => $this->getMasterTags(),
              'priorities'   => $this->getPriorityArray(),
              'realms'       => \App\Models\Realm::all(),
              'categories'   => \App\Models\Bugtracker_categories::all(),
              'subcategories'  => \App\Models\Bugtracker_subcategory::all(),
              'expansions'  => \App\Models\Bugtracker_expansion::all(),
              'areas'  => \App\Models\Bugtracker_area::all(),
              'zones'  => \App\Models\Bugtracker_zone::all(),

          ];

      return view('bugtracker.create')->with($data);
    }
    public function userReportRating(Request $request)
    {
      $validator = Validator::make($request->all(), [
          'bug_report_id'   => 'required|exists:bugtracker_reports,id',
          'vote'            => 'required|gte:-1|lte:1'
        ]);
      if ($validator->fails())
          return "corruption";

      $vote = $request->post('vote');
      $id   = $request->post('bug_report_id');

      $is_vote_exist =  Bugtracker_users_vote::where('bugtracker_report_id',$id)->where('user_id',Auth::user()->id)->get();

      if($is_vote_exist->count()){
        $update_vote  = Bugtracker_users_vote::find($is_vote_exist[0]->id);
        $update_vote->vote = $vote;
        $update_vote->save();
      }else{
        $user_vote = new Bugtracker_users_vote();
        $user_vote->user_id = Auth::user()->id;
        $user_vote->bugtracker_report_id = $id;
        $user_vote->vote = $vote;
        $user_vote->save();
      }
      $rating   = $this->get_rating($id);

      $bug_report = Bugtracker_report::find($id);
      $bug_report->rating = $rating["positive"]-$rating["negative"];
      $bug_report->save();

      $data = [
              'like'  => $rating['positive'],
              'dislike'  => $rating['negative'],
              'state' => (int)$vote
          ];
      return json_encode($data);
    }

    public function save(Request $request)
    {
      $validator = Validator::make($request->all(), [
          'category'       => 'required|exists:bugtracker_categories,id',
          'realm'          => 'required|exists:realms,id',
          'title'          => 'required|min:6|max:256',
          'description'    => 'required|min:6',
          'master_tag'     => 'required|gte:0|lte:2',
          'priority'       => 'required|gte:0|lte:3',
          'private'        => 'required|gte:0|lte:1',
        ]);

        if ($validator->fails())
            return redirect()->back();

        $valid_images   = $this->getValidImages($request->post());
        $new_bug_report = $this->getFormatedData($valid_images);
        $bug_id         = $this->createNewReportAndReturnId($new_bug_report);

        $message        = $this->getMessageForDiscord($new_bug_report, $bug_id);
        $this->publishMessageToDiscordChannel($message);

        $dataToAdd = $this->getDataToAddToGithubIssue($new_bug_report, $bug_id);
        $labels    = $this->getLabelsForIssue($new_bug_report);
        $issue_id  = $this->publishNewIssueAndGetId($new_bug_report,$dataToAdd,$labels);

        $inserted_report = Bugtracker_report::find($bug_id);
        $inserted_report->github_issue_id  = $issue_id;
        $inserted_report->save();


        return redirect()->route('bugtracker.index');
    }

    private function createNewReportAndReturnId($report)
    {
      $new_bug_report = new Bugtracker_report();

      $new_bug_report->title = $report['title'];
      $new_bug_report->bugtracker_category_id = $report['category'];
      $new_bug_report->realm = $report['realm'];
      $new_bug_report->status = 0;
      $new_bug_report->description = $report['description'];
      $new_bug_report->img = isset($report['img']) && $report['img'] ? $report['img'] : null;
      $new_bug_report->link = isset($report['link']) ? $report['link'] : null;
      $new_bug_report->user_id = Auth::user()->id;
      $new_bug_report->server = Bugtracker_report::LIVE_SERVER_ID;
      $new_bug_report->priority  = $report['priority'];
      $new_bug_report->private  = $report['private'];
      $new_bug_report->master_tag  = $report['master_tag'];
      $new_bug_report->expansion_id  = isset($report['expansion']) && $report['expansion'] != 0 ? $report['expansion'] : null;
      $new_bug_report->area_id    =  isset($report['area']) && isset($report['expansion']) && $report['expansion'] != 0 ? $report['area'] : null;
      $new_bug_report->zone_id    = isset($report['zone']) && isset($report['expansion']) && $report['expansion'] != 0 ? $report['zone'] : null;
      $new_bug_report->subcategory_id  = isset($report['subcategory']) ? $report['subcategory'] : null;
      $new_bug_report->save();

      return $new_bug_report->id;
    }
    private function updateReportAndReturnIssueId($report)
    {
      $new_bug_report =  Bugtracker_report::find($report['bug_id']);

      $new_bug_report->title = $report['title'];
      $new_bug_report->bugtracker_category_id = $report['category'];
      $new_bug_report->realm = $report['realm'];
      $new_bug_report->status = $report['status'];;
      $new_bug_report->description = $report['description'];
      $new_bug_report->img = isset($report['img']) && $report['img'] ? $report['img'] : null;
      $new_bug_report->link = isset($report['link']) ? $report['link'] : null;
      $new_bug_report->user_id = Auth::user()->id;
      $new_bug_report->server = Bugtracker_report::LIVE_SERVER_ID;
      $new_bug_report->priority  = $report['priority'];
      $new_bug_report->private  = $report['private'];
      $new_bug_report->master_tag  = $report['master_tag'];
      $new_bug_report->expansion_id  = isset($report['expansion']) && $report['expansion'] != 0 ? $report['expansion'] : null;
      $new_bug_report->area_id    =  isset($report['area']) && isset($report['expansion']) && $report['expansion'] != 0 ? $report['area'] : null;
      $new_bug_report->zone_id    = isset($report['zone']) && isset($report['expansion']) && $report['expansion'] != 0 ? $report['zone'] : null;
      $new_bug_report->subcategory_id  = isset($report['subcategory']) ? $report['subcategory'] : null;
      $new_bug_report->save();

      return $new_bug_report->github_issue_id;
    }
    private function getDataToAddToGithubIssue(array $data, int $reportId): array
    {
        $imagesToAppend = '';
        if (!empty($data['img'])) {
            $imagesArray = explode(',', $data['img']);
            foreach ($imagesArray as $image) {
                $imagesToAppend .= $image . PHP_EOL;
            }
        }
        $linksToAppend = '';
        if (!empty($data['link'])) {
            $linksArray = explode(',', $data['link']);
            foreach ($linksArray as $link) {
                $linksToAppend .= $link . PHP_EOL;
            }
        }
        $display   = route('bugtracker.display',$reportId);
        return [
            'prepend' => 'Creator: [' . Auth::user()->id . '] ' . Auth::user()->username . PHP_EOL,
            'append' => PHP_EOL . 'Image: ' . $imagesToAppend . PHP_EOL . 'Link: ' . $linksToAppend . PHP_EOL . 'Link on website: ' .$display,
        ];
    }

    private function getMessageForDiscord(array $data, int $reportId): string
    {
        $display   = route('bugtracker.display',$reportId);
        return "```Markdown\n#" . $reportId . ": " . $data['title'] . "```\n**Short description**:\n" . substr($data['description'], 0, 200) . "...\n" .$display. "\n";
    }
    public function display(Request $request, $id)
    {
      $bug_report = Bugtracker_report::where('server',Bugtracker_report::LIVE_SERVER_ID)->find($id);

      if ($bug_report == null)
          return redirect()->back();

        $user        = \App\Models\User::find($bug_report->user_id);
        $report_user = $user == NULL ? "" : $user->username;
        $comments    = \App\Models\Bugtracker_reports_comment::whereReport($bug_report->id)->orderBy('created_at','DESC')->paginate(5);
        $data = [
                'report'      => $bug_report,
                'master_tags' => $this->getMasterTags()[$bug_report->master_tag],
                'priority'    => $this->getPriorityArray()[$bug_report->priority],
                'title'       => $bug_report['rating'] > 0 ? 'Rating: +' . $bug_report['rating'] : 'Rating: ' . $bug_report['rating'] . ', Created by: ' . $report_user,
                'comments'    => $comments,
                'links'       => ($bug_report->link != null ? explode(",",$bug_report->link) : array()),
                'imges'       => ($bug_report->img != null ? explode(",",$bug_report->img) : array())
            ];
      return view('bugtracker.display')->with($data);
    }
    public function edit(Request $request, $id)
    {
      $bug_report = Bugtracker_report::where('server',Bugtracker_report::LIVE_SERVER_ID)->find($id);

      if ($bug_report == null)
          return redirect()->back();

      if (!Auth::user()->canModerateBugtrackers() && $bug_report->user_id != Auth::user()->id)
          return redirect()->back();

        $user        = \App\Models\User::find($bug_report->user_id);
        $report_user = $user == NULL ? "" : $user->username;

        $data = [

                'master_tags' => $this->getMasterTags(),
                'priorities'   => $this->getPriorityArray(),
                'realms'       => \App\Models\Realm::all(),
                'categories'   => \App\Models\Bugtracker_categories::all(),
                'subcategories'  => \App\Models\Bugtracker_subcategory::all(),
                'expansions'  => \App\Models\Bugtracker_expansion::all(),
                'areas'  => \App\Models\Bugtracker_area::all(),
                'zones'  => \App\Models\Bugtracker_zone::all(),
                'bug_report' => $bug_report,
                'imges'        =>($bug_report->img != null ? explode(",",$bug_report->img) : array()),
                'links'        =>($bug_report->link != null ? explode(",",$bug_report->link) : array()),
                'heading'      => $bug_report['rating'] > 0 ? 'Rating: +' . $bug_report['rating'] : 'Rating: ' . $bug_report['rating'] . ', Created by: ' . $report_user,
                'admin_apply'  => ($bug_report->user_id != Auth::user()->id ? "disabled" : "")
            ];

        return view('bugtracker.edit')->with($data);
    }
    public function update(Request $request)
    {
      $validator = Validator::make($request->all(), [
          'bug_id'         => 'required|exists:bugtracker_reports,id',
          'category'       => 'required|exists:bugtracker_categories,id',
          'realm'          => 'required|exists:realms,id',
          'title'          => 'required|min:6|max:256',
          'description'    => 'required|min:6',
          'master_tag'     => 'required|gte:0|lte:2',
          'priority'       => 'required|gte:0|lte:3',
          'private'        => 'required|gte:0|lte:1',
          'status'        => 'required|gte:0|lte:1',
        ]);

      if ($validator->fails())
          return redirect()->back();

      $bug_report = Bugtracker_report::find($request->post('bug_id'));
      if (!Auth::user()->canModerateBugtrackers() && $bug_report->user_id != Auth::user()->id)
          return redirect()->back();

      $labels = array();
      $dataToAdd =array();
      $new_bug_report = array();
      $new_issue_id = 0;

      if($bug_report->user_id == Auth::user()->id) // check owner of this report
      {
        $valid_images   = $this->getValidImages($request->post());
        $new_bug_report = $this->getFormatedData($valid_images);
        $issue_id       = $this->updateReportAndReturnIssueId($new_bug_report);
        $dataToAdd = $this->getDataToAddToGithubIssue($new_bug_report, $bug_report->id);
        $labels    = $this->getLabelsForIssue($new_bug_report,$bug_report->private);

        if($this->shouldSwitchRepo($bug_report->bugtracker_category_id,$request->post('category'))) {
            $new_issue_id  = $this->publishNewIssueAndGetId($new_bug_report,$dataToAdd,$labels);
            $new_bug_report['status'] = 1; //closed status, to close current issue on prev repo
          }

      }

      $this_report = Bugtracker_report::find($request->post('bug_id'));
      if($new_issue_id)
          $this_report->github_issue_id  = $new_issue_id;

      $this_report->status = $request->post('status');
      $this_report->updated  = time();
      $this_report->save();
      $status = $this->shouldSwitchRepo($bug_report->bugtracker_category_id,$request->post('category')) ? '1' : $request->post('status');

      $this->publishIssueUpdate(
            $new_bug_report,
            $dataToAdd,
            $bug_report->github_issue_id,
            $bug_report->user_id == Auth::user()->id,
            $labels,
            $bug_report->bugtracker_category_id,
            $status
        );


      return redirect()->route('bugtracker.display',$bug_report->id);
    }

    public function requestReport(Request $request)
    {
      $reports = Bugtracker_report::where('server',Bugtracker_report::LIVE_SERVER_ID);

      if($request->search['value']){
          $filtedval = $request->search['value'];
          $reports   = $reports->where('id', 'like', '%' . $filtedval . '%')
                                ->orWhere('title', 'like', '%' . $filtedval . '%');
        }
      if($request->post('my_report'))
          $reports = $reports->where('user_id',Auth::user()->id);

      if($request->post('realm_id'))
          $reports = $reports->where('realm','=',$request->post('realm_id'));

      if($request->post('category_id'))
          $reports = $reports->where('bugtracker_category_id','=',$request->post('category_id'));

      if($request->post('status') != NULL)
          $reports = $reports->where('status','=',$request->post('status'));

      if($request->post('priority') != NULL)
          $reports = $reports->where('priority','=',$request->post('priority'));

      $totalData     = $reports->count();
      $totalFiltered = $totalData;

      $reports       = $reports->orderBy('status','ASC')
                              ->orderBy('created_at','DESC')
                              ->skip(intval($request->input('start')))
                              ->take(intval($request->input('length')))
                              ->get();

      $toReturn = array();
      foreach ($reports as $key => $report) {
          if($report->private == 0 || $report->user_id == Auth::user()->id || Auth::user()->canModerateBugtrackers())
          {
            $display       = route('bugtracker.display',$report->id);
            $rating        = $this->get_rating($report->id);
            $t_up          = $rating['user_vote'] == 1 ? " l-checked":"";
            $t_down        = $rating['user_vote'] == -1 ? " l-checked":"";
            $localArray[0] = $report->private ? $report->id."(Private)" : $report->id;
            $localArray[1] = "<a href='{$display}'><div style='width: 100%;overflow: hidden;text-overflow: ellipsis;height: 20px'>" .$report->title . "</div></a>";
            $localArray[2] = $report->Category->name;
            $localArray[3] = $report->status == 0 ? 'Open' : 'Closed';
            $localArray[4] = date('F d', strtotime($report->created_at));
            $localArray[5] = $this->getPriorityArray()[$report['priority']];
            $localArray[6] = '<div track="'.$report->id.'">
                                <span class="like">'.($rating["positive"]-$rating["negative"]).'</span>
                                <i class="material-icons mr-1 l-like'.$t_up.'">
                                thumb_up
                                </i>
                                <i class="material-icons ml-1 l-dislike'.$t_down.'">
                                thumb_down
                                </i>';

              $toReturn[] = $localArray;
          }
        }
        $json_data = array(
                 "draw"            => intval($request->input('draw')),
                 "recordsTotal"    => intval($totalData),
                 "recordsFiltered" => intval($totalFiltered),
                 "data"            => $toReturn
                 );
      echo json_encode($json_data);
    }

    private function get_rating($report_id)
    {
      $user_vote = Bugtracker_users_vote::where('bugtracker_report_id',$report_id)->where('user_id',Auth::user()->id)->get();
      $data = [
          'negative'  => Bugtracker_users_vote::where('bugtracker_report_id',$report_id)->where('vote',-1)->count(),
          'positive'  => Bugtracker_users_vote::where('bugtracker_report_id',$report_id)->where('vote',1)->count(),
          'user_vote' => ($user_vote->count() > 0 ? $user_vote[0]->vote : 0)
        ];
        return $data;
    }

    public function getPriorityArray(): array
    {
        return [
            'Low',
            'Medium',
            'High',
            'Game breaking'
        ];
    }
    public function getMasterTags(): array
    {
        return [
            'Bug',
            'Suggestion',
            'Tuning',
        ];
    }

    private function getFormatedData(array $data): array
    {
        if (empty($data['link']) && empty($data['img'])) {
            return $data;
        }
        $toReturn = $data;
        if (!empty($data['link'])) {
            $linksArray = $this->getNotEmpty($data['link']);
            $linkAsString = implode(',', $linksArray);
            if (strlen($linkAsString) > 254) {
                array_pop($linksArray);
                $linkAsString = implode(',', $linksArray);
                if (strlen($linkAsString) > 254) {
                    die('too many links');
                }
            }
            $toReturn['link'] = $linkAsString;
        }

        if (!empty($data['img'])) {
            $imgsArray = $this->getNotEmpty($data['img']);
            $imageAsString = implode(',', $imgsArray);
            if (strlen($imageAsString) > 254) {
                array_pop($imgsArray);
                $imageAsString = implode(',', $imgsArray);
                if (strlen($imageAsString) > 254) {
                    die('too many images');
                }
            }
            $toReturn['img'] = $imageAsString;
        }

        if ((int)$toReturn['master_tag'] === 1 || (int)$toReturn['master_tag'] === 2) {
            $toReturn['private'] = 1;
        }

        return $toReturn;
    }

    private function getNotEmpty(array $array): array
    {
       $toReturn = [];
       foreach ($array as $value) {
           if (!empty($value)) {
               $toReturn[] = $value;
           }
       }

      return $toReturn;
    }
    private function getValidImages(array $data): array
    {
        if (empty($data['img']) || $data['img'][0] === '') {
            $data['img'] = '';
            return $data;
        }
        $toReturn = $data;
        $toReturn['img'] = [];
        foreach ($data['img'] as $img) {
            if (strpos($img, 'https://i.imgur.com/') === 0) {
                if (strpos($img, '.jpg') || strpos($img, '.png')) {
                    $toReturn['img'][] = $img;
                }
            }
        }
        return $toReturn;
    }

    private function getLabelsForIssue(array $data, int $reportIsPrivate = 0): array
    {
        $toReturn = [
            $this->getPriorityArray()[$data['priority']],
            $this->getMasterTags()[$data['master_tag']],
        ];

        if ((isset($data['private']) && (int)$data['private'] === 1) || $reportIsPrivate === 1) {
            $toReturn[] = 'PRIVATE';
//            $toReturn[] = 'SENSITIVE';
        }

        if (isset($data['expansion']) && $data['expansion'] !== '0') {
            $toReturn[] = \App\Models\Bugtracker_expansion::find($data['expansion'])->name;

        }
        if (isset($data['zone'])) {
            $toReturn[] = \App\Models\Bugtracker_zone::find($data['zone'])->name;
        }
        if (isset($data['subcategory'])) {
            $toReturn[] = \App\Models\Bugtracker_subcategory::find($data['subcategory'])->name;
        }
        if (isset($data['realm'])) {
            $toReturn[] = \App\Models\Realm::find($data['realm'])->realm_name;
        }
        if (isset($data['category']) && in_array($data['category'], self::BALANCE_TEAM_CATEGORY)) {
            $toReturn[] = 'Balance team: ' .\App\Models\Bugtracker_categories::find($data['category'])->name;
        } else if (isset($data['category'])) {
            $toReturn[] = \App\Models\Bugtracker_categories::find($data['category'])->name;
        }

        if (isset($data['subcategory']) && in_array($data['subcategory'], self::COMMUNITY_LABEL_SUBCATEGORY)) {
            $toReturn[] = 'Community - ' .\App\Models\Bugtracker_subcategory::find($data['subcategory'])->name;
        }
        if (isset($data['category']) && in_array($data['category'], self::AI_TEAM['categories'])) {
            $toReturn[] = 'AI - Category - ' .\App\Models\Bugtracker_categories::find($data['category'])->name;
        }

        if (isset($data['subcategory']) && in_array($data['subcategory'], self::AI_TEAM['subcategory'])) {
            $toReturn[] = 'AI - Category - ' .\App\Models\Bugtracker_subcategory::find($data['subcategory'])->name;
        }

        if (isset($data['area']) && in_array($data['area'], self::AI_TEAM['area'])) {
            $toReturn[] = 'AI - Category - ' .\App\Models\Bugtracker_area::find($data['area'])->name;
        } else if (isset($data['area'])) {
            $toReturn[] = \App\Models\Bugtracker_area::find($data['area'])->name;
        }
        return $toReturn;
    }

    public function publishMessageToDiscordChannel($message)
    {
        try {
            $url = urlencode(env('DISCORD_URL'));
            $data = array("content" => $message, "username" => env('DISCORD_USERNAME'));
            $curl = curl_init(urldecode($url));
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_exec($curl);
        } catch (\Exception $e) {
        }
    }

    public function publishNewIssueAndGetId(array $data, array $dataToAdd, array $labels)
    {
        try {

            $response  = GitHub::issues()->create(config('github.bug_tracker.username'),config('github.bug_tracker.repository')[$data['category']], [
                'title'   => $data['title'],
                'body'    => $dataToAdd['prepend'] . 'Description: ' . $data['description'] . $dataToAdd['append'],
                'labels'  => $labels
            ]);
        } catch (\Exception $e) {
//            die($e->getMessage());
            return 0;
        }
        return (int)$response['number'];
    }

    public function publishIssueUpdate(array $data, array $dataToAdd, int $issueId, bool $userIsOwner, array $labels, int $category, int $status)
    {
      try {
            if ($userIsOwner) {
                GitHub::issues()->update(
                    config('github.bug_tracker.username'),
                    config('github.bug_tracker.repository')[$category],
                    $issueId,
                    [
                        'state' => config('github.bug_tracker.statuses')[$data['status']],
                        'title' => $data['title'],
                        'body' => $dataToAdd['prepend'] . 'Description: ' . $data['description'] . $dataToAdd['append'],
                        'labels' => $labels
                    ]
                );

                return;
            }

            GitHub::issues()->update(
                config('github.bug_tracker.username'),
                config('github.bug_tracker.repository')[$category],
                $issueId,
                ['state' => config('github.bug_tracker.statuses')[$status]]
            );
        } catch (\Exception $e) {
//            die($e->getMessage());
        }

    }

    public function publishNewCommentAndGetId(int $issueId, int $repoId, string $toPrepend, string $comment): int
    {
        try {
            $response  = GitHub::issues()->comments()->create(
              config('github.bug_tracker.username'),
              config('github.bug_tracker.repository')[$repoId],
              $issueId,
              [
                'body' => $toPrepend . $comment,
              ]);
        } catch (\Exception $e) {
            return 0;
        }
        return (int)$response['id'];
    }
    public function publishCommentUpdate(int $repoId, int $commentId, string $stringToPrepend, string $comment)
    {
      try {
          $response  = GitHub::issues()->comments()->update(
            config('github.bug_tracker.username'),
            config('github.bug_tracker.repository')[$repoId],
            $commentId,
            [
              'body' => $stringToPrepend . $comment,
            ]);
      } catch (\Exception $e) {
        //do nothing
      }
    }

    public function saveComment(Request $request)
    {
      $validator = Validator::make($request->all(), [
          'bug_report_id'   => 'required|exists:bugtracker_reports,id',
          'response'        => 'required|min:6'
        ]);
      if ($validator->fails())
          return redirect()->back()->withInput()->withErrors($validator);

        $bug_report = Bugtracker_report::find($request->post('bug_report_id'));
        $dataToAppendToComment = $this->getDataToPrependForComment();
        $commentIdOnGithub = $this->publishNewCommentAndGetId($bug_report->github_issue_id,
                                                              $bug_report->bugtracker_category_id,
                                                              $dataToAppendToComment,
                                                              $request->post('response')
                                                            );

        $comment = new \App\Models\Bugtracker_reports_comment();
        $comment->report = $bug_report->id;
        $comment->user = Auth::user()->id;
        $comment->comment = $request->post('response');
        $comment->comment_github = $commentIdOnGithub;
        $comment->created_at = \Carbon\Carbon::now();
        $comment->save();
        return redirect()->route('bugtracker.display',$bug_report->id);
    }
    public function updateComment(Request $request)
    {
      $validator = Validator::make($request->all(), [
          'comment_id'   => 'required|exists:bugtracker_reports_comments,id',
          'comment'        => 'required|min:6'
        ]);
      $status = 'success';
      if ($validator->fails())
          return json_encode("Error");

      $comment_details = \App\Models\Bugtracker_reports_comment::find($request->post('comment_id'));

      if($comment_details->user != Auth::user()->id)
          return json_encode("Error");

      $comment_details->comment = $request->post('comment');
      $comment_details->updated_at = date('Y-m-d H:i:s');
      $comment_details->save();

      $stringToPrepend = $this->getDataToPrependForComment($comment_details->created_at,$comment_details->updated_at);

      $this->publishCommentUpdate(
            $comment_details->Report->bugtracker_category_id,
            $comment_details->comment_github,
            $stringToPrepend,
            $request->post('comment')
        );

        return json_encode([
              'status'=> "success",
              'date'  => '*Edited* ' . (new \Carbon\Carbon($comment_details->updated_at))->diffForHumans(),
          ]);

    }

    private function getDataToPrependForComment( $created = 0, $updated = 0): string
    {
        if ($created && $updated) {
            return 'Creator: [' . Auth::user()->id . '] ' . Auth::user()->username . PHP_EOL . 'Created on: ' .
                $created . PHP_EOL . 'Updated on: ' . $updated. PHP_EOL;
        }

        return 'Creator: [' . Auth::user()->id . '] ' . Auth::user()->username . PHP_EOL . 'Created on: ' .
            date('F d, Y h:i:s') . PHP_EOL;
    }
    private function shouldSwitchRepo($currentCategory,$newCategory)
    {
      if(config('github.bug_tracker.repository')[$currentCategory] == config('github.bug_tracker.repository')[$newCategory])
          return false;
      else
          return true;

    }

}
