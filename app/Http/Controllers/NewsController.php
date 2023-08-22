<?php

namespace App\Http\Controllers;

use Validator;
use Auth;
use App\Models\News;
use App\Models\News_comment;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ucp.pages.news.index');
    }

    public function createNews(Request $request, $id)
    {
        if (!Auth::user()->canModerateNews() && !Auth::user()->canAddNews())
            return redirect()->back();

        return view('ucp.pages.news.edit', ["news" => array(), "page_name" => "Add News"]);
    }

    public function edit(Request $request, $id)
    {

        if (!Auth::user()->canModerateNews() && !Auth::user()->canAddNews())
            return redirect()->back();

        $news = News::findOrFail($id);
        return view('ucp.pages.news.edit', ["news" => $news, "page_name" => "Edit News"]);
    }

    public function article()
    {
        return view('news.article');
    }

    public function board(Request $request)
    {
        $q = $request->get('q');
        if (!$q) {
            $top_news = News::where('is_active', 1)->orderBy('id', 'desc')->take(5)->get();
            $count = News::where('is_active', 1)->orderBy('id', 'desc')->count();
            $news = array();
            if ($count > 5) {
                $limit = $count - 5;
                $news = News::where('is_active', 1)->orderBy('id', 'desc')->skip(5)->take($limit)->get();
            }
            $is_searched = false;
        } else {
            $top_news = array();
            $news = News::where('is_active', 1)->where('title', 'like', '%' . $q . '%')->orWhere('description', 'like', '%' . $q . '%')->orderBy('id', 'desc')->get();
            $is_searched = true;
        }
        $data = [
            'top_news' => $top_news,
            'sub_articles' => $news,
            'is_searched' => $is_searched,
            'q' => $q
        ];
        return view('news.board')->with($data);
    }

    public function newsSearch(Request $request)
    {
        if ($request->get('q')) {
            $items = News::where([
                ['title', 'like', '%' . $request->get('q') . '%'],
            ])->where('is_active', 1)->get();
        } else {
            $items = News::where('is_active', 1)->get();
        }

        $itemFound = count($items);
        $itemNameList = [];
        if ($itemFound) {
            foreach ($items as $item) {
                $itemNameList[] = '<a href="/detail/' . $item->id . '"><img src="' . $item->image . '" width="80">' . $item->title . '</a>';
            }
            return json_encode($itemNameList);
        } else {
            return json_encode($itemNameList);
        }
    }

    public function displayNews(Request $request, $id)
    {
        $news = News::where('is_active', 1)->findOrFail($id);
        $comments = News_comment::where('news_id', $id)->orderBy('id', 'desc');
        $total_comments = $comments->count();
        $comments_info = $comments->paginate(10);
        $tags = explode(',', $news->tags);
        return view('news.article', ['news' => $news, 'tags' => $tags,'comments'=> $comments_info,'total'=> $total_comments]);
    }

    public function respondToNews(Request $request, $id)
    {
        $validator = Validator::make($request->all(), ['response' => 'required|min:5']);
        if ($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator);

        $news = News::find($id);
        if ($news == null)
            return redirect()->back()->withInput();
        if(Auth::user()->isNotPlayer() && $news->is_locked == 1) {
            return redirect()->back();
        }
        $response = new News_comment();
        $response->news_id = $id;
        $response->user_id = Auth::user()->id;
        $response->comment = $request->post('response');
        $response->is_active = 1;
        $response->save();
        return redirect()->back();
    }

    public function likeComment(Request $request) {
        $type = $request->post('utype');
        $news = News_comment::find($request->post('uid'));
        $unum = 1;
        if($type == 0) {
            $unum = -1;
        }
        $userId = Auth::user()->id;
        $news->likes_num = $news->likes_num + $unum;
        if($unum == 1)
            $news->like_users = $news->like_users == '' ? $userId : $news->like_users . '::' . $userId;
        else {
            $like_users = explode('::', $news->like_users);
            $news->like_users = implode('::', array_diff($like_users, [$userId]));
        }
        $news->save();
        return json_encode(["status" => 200, "data" => 'success']);
    }

    public function changelog()
    {
        return view('news.changelog');
    }

    public function get_news_list(Request $request)
    {

        if (!Auth::user()->canModerateNews() && !Auth::user()->canAddNews())
            return redirect()->back();

        $filtedval = $request->search['value'];
        $data = News::get_news_data($filtedval);
        $result = array();
        if ($data) {
            foreach ($data as $row) {
                $uitem = array();
                if (Auth::user()->canModerateNews()) {
                    $toggle_status = $row->is_active == 1 ? '| <i class="material-icons delbtn" title="Delete News" onclick="delNews(\'' . $row->id . '\')">delete</i> | <i class="material-icons delbtn" title="Reject News" onclick="rejectNews(\'' . $row->id . '\')">close</i>' : '| <i class="material-icons delbtn" title="Delete News" onclick="delNews(\'' . $row->id . '\')">delete</i> | <i class="material-icons editbtn" onclick="acceptNews(\'' . $row->id . '\')" title="Active News">check</i>';
                    $toggle_status .= $row->is_locked == 1 ? '| <i class="material-icons unlockbtn" title="Unlock Comment Writing" onclick="toggleLockNews(\'' . $row->id . '\')">lock_open</i>' : '| <i class="material-icons lockbtn" title="Lock Comment Writing" onclick="toggleLockNews(\'' . $row->id . '\')">lock</i>';
                }
                else
                    $toggle_status = '';

                $uitem[] = '<img src="' . $row->image . '" style="width: 50px; height: 50px;" />';
                $uitem[] = '<a href="/detail/' . $row->id . '"><div style="width: 100%;overflow: hidden;text-overflow: ellipsis;height: 16px;">' . $row->title . '</div></a>';
                $uitem[] = (new \Carbon\Carbon($row->created_at))->diffForHumans();
                $uitem[] = $row->is_active == 1 ? 'Live' : 'Pending';
                $uitem[] = '<i class="material-icons editbtn" onclick="editNewsContent(\'' . $row->id . '\')" title="Edit News">create</i>' . $toggle_status;
                $result[] = $uitem;
            }
        }
        return json_encode(["status" => 200, "data" => $result, "recordsFiltered" => count($data), "recordsTotal" => count($data)]);
    }

    public function save_news(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'image_url' => 'required|max:2083',
            'title' => 'required|min:6',
            'contents' => 'required|min:6',
            'eid' => 'required',
        ]);

        if ($validator->fails())
            return json_encode($validator->errors());

        if (!Auth::user()->canModerateNews() && !Auth::user()->canAddNews())
            return redirect()->back();

        $newsmodel = $request->post('eid') != 'add' ? News::findOrFail($request->post('eid')) : new News();

        $newsmodel->image = $request->post('image_url');
        $newsmodel->title = $request->post('title');
        $newsmodel->tags = $request->post('tags');
        $newsmodel->description = $request->post('contents');
        $newsmodel->user_id = Auth::user()->id;
        $newsmodel->is_active = $request->post('eid') != 'add' ? $newsmodel->is_active : 0;;
        $newsmodel->save();

        exit(json_encode(["stauts" => 200, "message" => "success"]));

    }

    public function del_news(Request $request)
    {

        if (!Auth::user()->canModerateNews())
            return redirect()->back();

        News::find($request->id)->delete();
        exit(json_encode(["status" => 200, "message" => "success"]));
    }

    public function toggleLock(Request $request) {
        if (!Auth::user()->canModerateNews())
            return redirect()->back();

        $row = News::find($request->id);
        $row->is_locked = $row->is_locked == 1 ? 0 : 1;
        $row->save();

        exit(json_encode(["status" => 200, "message" => "success"]));
    }

    public function active_news(Request $request)
    {

        if (!Auth::user()->canModerateNews())
            return redirect()->back();

        $row = News::find($request->id);
        $row->is_active = 1;
        $row->save();

        exit(json_encode(["status" => 200, "message" => "success"]));
    }

    public function rejected_news(Request $request)
    {

        if (!Auth::user()->canModerateNews())
            return redirect()->back();

        $row = News::find($request->id);
        $row->is_active = 2;
        $row->save();

        exit(json_encode(["status" => 200, "message" => "success"]));
    }
}
