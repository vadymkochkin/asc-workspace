<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Faq_Category;
use Validator;
use Auth;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ucp.pages.faq.index');
    }

    public function createFaq(Request $request, $id)
    {
        if (!Auth::user()->canModerateFaq() && !Auth::user()->canAddFaq())
            return redirect()->back();

        $faq_category = Faq_Category::get_faq_category_data();

        return view('ucp.pages.faq.edit', ["faq" => array(), "categories" => $faq_category, "page_name" => "Add FAQ"]);
    }

    public function edit(Request $request, $id)
    {

        if (!Auth::user()->canModerateFaq() && !Auth::user()->canAddFaq())
            return redirect()->back();

        $faq = Faq::findOrFail($id);

        $faq_category = Faq_Category::get_faq_category_data();

        return view('ucp.pages.faq.edit', ["faq" => $faq, "categories" => $faq_category, "page_name" => "Edit Faq"]);
    }

    public function board(Request $request)
    {
        $q = $request->get('q');
        if (!$q) {
            $is_searched = false;
        } else {
            $is_searched = true;
        }
        $faq_category = Faq_Category::get_faq_category_data();
        $faq_data_by_category = Faq::get_faqdata_by_category($faq_category, $q);

        $data = [
            'faqs' => $faq_data_by_category,
            'is_searched' => $is_searched,
            'q' => $q,
            'faq_category' => $faq_category
        ];
        return view('faq.board')->with($data);
    }

    public function get_faq_list(Request $request)
    {

        if (!Auth::user()->canModerateFaq() && !Auth::user()->canAddFaq())
            return redirect()->back();

        $filtedval = $request->search['value'];
        $data = Faq::get_faq_data($filtedval);
        $result = array();
//        print_r($data);exit;
        if ($data) {
            foreach ($data as $row) {
                $uitem = array();
                if (Auth::user()->canModerateFaq())
                    $toggle_status = $row->is_active == 1 ? '| <i class="material-icons delbtn" title="Delete" onclick="delFaq(\'' . $row->id . '\')">delete</i> | <i class="material-icons delbtn" title="Reject" onclick="rejectFaq(\'' . $row->id . '\')">close</i>' : '| <i class="material-icons delbtn" title="Delete" onclick="delFaq(\'' . $row->id . '\')">delete</i> | <i class="material-icons editbtn" onclick="acceptFaq(\'' . $row->id . '\')" title="Active">check</i>';
                else
                    $toggle_status = '';

                $uitem['content'] = '<div style="width: 100%;overflow: hidden;text-overflow: ellipsis;height: 16px;">' . $row->content . '</div>';
                $uitem['created'] = (new \Carbon\Carbon($row->created_at))->diffForHumans();
                $uitem['category'] = $row->category_name;
                $uitem['status'] = $row->is_active == 1 ? 'Live' : 'Pending';
                $uitem['action'] = '<i class="material-icons editbtn" onclick="editContent(\'' . $row->id . '\')" title="Edit">create</i>' . $toggle_status;
                $uitem['answer'] = '<div style="width: 100%;overflow: hidden;text-overflow: ellipsis;height: 16px;">' . $row->answer . '</div>';
                $result[] = $uitem;
            }
        }
        return json_encode(["status" => 200, "data" => $result, "recordsFiltered" => count($data), "recordsTotal" => count($data)]);
    }

    public function save_faq(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'content' => 'required|min:2',
            'answer' => 'required|min:2',
            'eid' => 'required',
        ]);

        if ($validator->fails())
            return json_encode($validator->errors());

        if (!Auth::user()->canModerateFaq() && !Auth::user()->canAddFaq())
            return redirect()->back();

        $faqmodel = $request->post('eid') != 'add' ? Faq::findOrFail($request->post('eid')) : new Faq();

        $faqmodel->timestamps = false;
        $faqmodel->content = $request->post('content');
        $faqmodel->answer = $request->post('answer');
        $faqmodel->user_id = Auth::user()->id;
        $faqmodel->cat_id = $request->post('cat_id');
        $faqmodel->created_at = date('Y-m-d H:i:s');
        $faqmodel->is_active = $request->post('eid') != 'add' ? $faqmodel->is_active : 0;
        $faqmodel->save();

        exit(json_encode(["stauts" => 200, "message" => "success"]));
    }

    public function save_category(Request $request) {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|min:2'
        ]);

        if ($validator->fails())
            return json_encode($validator->errors());

        if (!Auth::user()->canModerateFaq() && !Auth::user()->canAddFaq())
            return redirect()->back();

        $faqcatmodel = $request->post('eid') != 'add' ? Faq_Category::findOrFail($request->post('eid')) : new Faq_Category();

        $faqcatmodel->category_name = $request->post('category_name');

        if($request->post('order_id'))
            $faqcatmodel->order_id = $request->post('order_id');

        $faqcatmodel->save();

        exit(json_encode(["stauts" => 200, "message" => "success"]));
    }

    public function get_category(Request $request) {
        if (!Auth::user()->canModerateFaq() && !Auth::user()->canAddFaq())
            return redirect()->back();

        $filtedval = $request->search['value'];
        $data = Faq_Category::get_faq_category_data($filtedval);

        $result = array();
        if ($data) {
            foreach ($data as $row) {
                $uitem = array();

                $uitem[] = $row->category_name;
                $uitem[] = '<span class="table-up" uid="' . $row->id . '"><a href="#!" class="indigo-text"><i class="fas fa-long-arrow-alt-up"
                                                                         aria-hidden="true"></i></a></span>
                                    <span class="table-down" uid="' . $row->id . '"><a href="#!" class="indigo-text"><i class="fas fa-long-arrow-alt-down"
                                                                                                 aria-hidden="true"></i></a></span>';
                $uitem[] = '<button type="button" class="btn action_btn btn-rounded btn-sm edit_action" uid="' . $row->id . '"><i class="fa fa-edit"></i></button>
                            <button type="button" class="btn action_btn btn-rounded btn-sm del_action" uid="' . $row->id . '"><i class="fa fa-trash"></i></button>';
                $result[] = $uitem;
            }
        }
        return json_encode(["status" => 200, "data" => $result, "recordsFiltered" => count($data), "recordsTotal" => count($data)]);
    }

    public function reorder_category(Request $request) {
        $uid = request('uid');
        $utype = request('utype');

        $row = Faq_Category::find($uid);
        $currentorder = $row->order_id;

        if($utype == 0) {
            $downrow = Faq_Category::where('order_id', $currentorder * 1 - 1)->get()->first();
            $downrow->order_id = $currentorder;
            $downrow->save();

            $row->order_id = $currentorder * 1 - 1;
        } else {
            $downrow = Faq_Category::where('order_id', $currentorder * 1 + 1)->get()->first();
            $downrow->order_id = $currentorder;
            $downrow->save();
            $row->order_id = $currentorder * 1 + 1;
        }
        $row->save();

        exit(json_encode(["status" => 200, "message" => "success"]));
    }

    public function del_faq_category(Request $request)
    {
        if (!Auth::user()->canModerateFaq())
            return redirect()->back();

        Faq_Category::find($request->cid)->delete();
        exit(json_encode(["status" => 200, "message" => "success"]));
    }

    public function del_faq(Request $request)
    {

        if (!Auth::user()->canModerateFaq())
            return redirect()->back();

        Faq::find($request->id)->delete();
        exit(json_encode(["status" => 200, "message" => "success"]));
    }

    public function active_faq(Request $request)
    {

        if (!Auth::user()->canModerateFaq())
            return redirect()->back();

        $row = Faq::find($request->id);
        $row->is_active = 1;
        $row->save();

        exit(json_encode(["status" => 200, "message" => "success"]));
    }

    public function rejected_faq(Request $request)
    {

        if (!Auth::user()->canModerateFaq())
            return redirect()->back();

        $row = Faq::find($request->id);
        $row->is_active = 2;
        $row->save();

        exit(json_encode(["status" => 200, "message" => "success"]));
    }
}
