<?php

namespace App\Http\Controllers;

use App\Models\Changelog;
use App\Models\Changelog_type;
use DB;
use Auth;
use Validator;
use Illuminate\Http\Request;

class ChangelogController extends Controller
{
  const SEGMENT = 30;

  public function index()
  {
    $interval   = 0;
    $total_logs = self:: SEGMENT;
    $skip       = $interval*$total_logs;
    $take       = ($interval+1)*$total_logs;

    $changelogs = $this->pullChangelogs($skip,$take);

    if(isset($changelogs)&&!empty($changelogs))
        $changelog_items = $this->sortByTime($changelogs);

    else
      $changelog_items = array();

      $next_interval = Changelog::NextInterval($interval,$total_logs);

    return view('news.changelog')->with([
                                          'changelog_items'  => $changelog_items,
                                          'next_interval'    => $next_interval
                                        ]);
  }

  public function loadMoreChangelog(Request $request)
  {
    $validator = Validator::make($request->all(), [
        'interval'  => 'required|integer',
      ]);

    if ($validator->fails())
        return ['error'  =>$validator->errors()->all()];

      $interval   = $request->post('interval');
      $total_logs = self:: SEGMENT;
      $skip       = $interval*$total_logs;
      $take       = $total_logs;

      $changelogs = $this->pullChangelogs($skip,$take);

      if(isset($changelogs)&&!empty($changelogs))
          $changelog_items = $this->sortByTime($changelogs);

      else
        $changelog_items = array();

        $next_interval = Changelog::NextInterval($interval,$total_logs);


        foreach ($changelog_items as $key1 => $changelog) {
          foreach ($changelog as $key2 => $changes) {
            foreach ($changes as $key3 => $change) {

              $changelog_items[$key1][$key2][$key3]['time'] = date(" H:i:s", $change['time']);

            }
          }
        }

    $morelogs = json_encode([
                  'changelog_items'  => $changelog_items,
                  'next_interval'    => $next_interval
                ]);
    return $morelogs;
  }


  public function sortByTime($changelog_items)
  {
    $new_array = array();

    foreach ($changelog_items as $item) {
        // If we dont got the time yet add it to the new array
        if (!array_key_exists(date("Y/m/d", $item['time']), $new_array)) {
            //Assign an array to that key
            $new_array[date("Y/m/d", $item['time'])] = array();
        }

        // Do the same but then for the typeName
        if (!array_key_exists($item['typeName'], $new_array[date("Y/m/d", $item['time'])])) {
            //Assign an array to that key
            $new_array[date("Y/m/d", $item['time'])][$item['typeName']] = array();
        }
        array_push($new_array[date("Y/m/d", $item['time'])][$item['typeName']], $item);
    }

  return $new_array;
  }
  private function pullChangelogs($skip,$take)
  {
    try {
      $changelogs = DB::table('changelogs')
                ->leftJoin('changelog_types', 'changelogs.type', '=', 'changelog_types.id')
                ->where('changelogs.is_ptr',0)
                ->select('changelogs.*', 'changelog_types.*')
                ->orderBy('changelogs.time', 'desc')
                ->skip($skip)
                ->take($take)
                ->get()
                ->map(function ($item, $key) {
                  return (array) $item;
                  })
                  ->all();
                }catch(\Illuminate\Database\QueryException $ex){
                    $changelog_items = array();
                  }
    return $changelogs;
  }

  public function manage(Request $request)
  {
    if(!Auth::user()->canModerateChangelogs())
        return redirect()->back();

    $types = Changelog_type::all();
    return view('ucp.pages.changelog.index')->with(['changelog_types'  => $types]);

  }

  public function addCatagory(Request $request)
  {
    $validator = Validator::make($request->all(), [
        'catagory_name'  => 'required|min:4|unique:changelog_types,TypeName',
      ]);

    if(!Auth::user()->canModerateChangelogs())
        return redirect()->back();

    if ($validator->fails())
        return redirect()->back()->withInput()->withErrors(['error'  =>$validator->errors()->all()[0]]);

    $changelog_type = new Changelog_type();
    $changelog_type->typeName = $request->post('catagory_name');
    $changelog_type->save();

    return redirect()->back()->with(['success'=> "successfully updated"]);
  }
  public function addChangelog(Request $request)
  {
    $validator = Validator::make($request->all(), [
        'catagory'         => 'required|exists:changelog_types,id',
        'changelog'        => 'required|min:6|',
      ]);

    if(!Auth::user()->canModerateChangelogs())
        return redirect()->back();

    if ($validator->fails())
        return redirect()->back()->withInput()->withErrors(['error'  =>$validator->errors()->all()[0]]);

      $changelog = new Changelog();
      $changelog->changelog = $request->post('changelog');
      $changelog->user_id = Auth::user()->id;
      $changelog->type = $request->post('catagory');
      $changelog->time = time();
      $changelog->is_ptr = 0;
      $changelog->save();

      return redirect()->back()->with(['success'=> "successfully updated"]);
  }

  public function getChangelog(Request $request)
  {
    if(!Auth::user()->canModerateChangelogs())
        return redirect()->back();

    $changelogs   = Changelog::all()->sortByDesc("change_id");
    $totalData     = $changelogs->count();
    $totalFiltered = $totalData;
    $data = array();
    $i=0;
    foreach ($changelogs as $log ) {
      $edit   =  route('changelog.edit',$log->change_id);
      $view   =  route('changelog.display',$log->change_id);
      $delete =  route('changelog.delete',$log->change_id);

      $nestedData[0]    = '<div style="width: 100%;overflow: hidden;text-overflow: ellipsis;height: 16px;">' .$log->changelog . '</div>';
      $nestedData[1]    = $log->Change_type->typeName;
      $nestedData[2]    = $log->User->username .'('.Auth::user()->getAccessLevelDisplayString($log->User->access_level).')';
      $nestedData[3]    = (new \Carbon\Carbon(date("Y-m-d H:i:s", $log->time)))->diffForHumans();
      $nestedData[4]    = "&emsp;<a href='{$view}' title='VIEW' ><i class='material-icons'>visibility</i></a>|<a href='{$edit}' title='EDIT' ><i class='material-icons'>edit</i></a>|<a t-link='{$delete}' title='Delete' ><i class='material-icons'>delete</i></a>";


      $data[] = $nestedData;
      $i++;
    }
    $json_data = array(
             "draw"            => intval($request->input('draw')),
             "recordsTotal"    => intval($totalData),
             "recordsFiltered" => intval($totalFiltered),
             "data"            => $data
             );
  echo json_encode($json_data);

  }

  public function editChangelogView(Request $request,$id)
  {
    $changelog = Changelog::find($id);

    if ($changelog == null ||!Auth::user()->canModerateChangelogs())
        return redirect()->back()->withErrors(['error'  =>"Unable to find changelog"]);

    return redirect()->back()->with(['edit_info'=>$changelog]);
  }

  public function saveChangelog(Request $request)
  {
    $validator = Validator::make($request->all(), [
        'change_id'        => 'required|exists:changelogs,change_id',
        'catagory'         => 'required|exists:changelog_types,id',
        'changelog'        => 'required|min:6|',
      ]);

    if(!Auth::user()->canModerateChangelogs())
        return redirect()->back();

    if ($validator->fails())
        return redirect()->back()->withInput()->withErrors(['error'  =>$validator->errors()->all()[0]]);

      $changelog = Changelog::find($request->post('change_id'));
      $changelog->changelog = $request->post('changelog');
      $changelog->type = $request->post('catagory');
      $changelog->save();

      return redirect()->back()->with(['success'=> "successfully updated"]);
  }

  public function displayChangelog(Request $request,$id)
  {
    $changelog = Changelog::find($id);

    if ($changelog == null || !Auth::user()->canModerateChangelogs())
        return redirect()->back()->withErrors(['error'  =>"Unable to find changelog"]);

    return redirect()->back()->with(['show_info'=>$changelog]);
  }
  public function deleteChangelog(Request $request,$id)
  {
    $changelog = Changelog::find($id);
    if ($changelog == null || !Auth::user()->canModerateChangelogs())
        return redirect()->back()->withErrors(['error'  =>"Unable to Delete changelog"]);

    $changelog->delete();
        return redirect()->back()->with(['success'=> "successfully deleted"]);

  }


}
