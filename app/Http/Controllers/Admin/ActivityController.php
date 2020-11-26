<?php

namespace App\Http\Controllers\Admin;

use App\Models\Activity;
use App\Http\Controllers\Controller;
use App\Models\User_Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.activity.activity');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request['comment_status'] = $request['comment_status']==null?'closed':'open';
        $request['post_author'] = 1;
        $request['post_excerpt'] = '';
        $request['post_status'] = 'draft';
        $request['ping_status'] = 'open';
        $request['post_name'] = strval(time());
        $request['post_content'] .= '<br><br><br><br><br><br><br>'.'<h3>ลิงก์ที่เกี่ยวข้อง</h3><br>'.$request['link'];
        $request['post_password'] = '';
        $request['to_ping'] = '';
        $request['pinged'] = '';
        $request['post_content_filtered'] = '';
        $request['post_parent'] = 0;
        $request['guid'] = '';
        $request['menu_order'] = 0;
        $request['post_type'] = 'post';
        $request['post_mime_type'] = '';
        $request['post_date']=now();
        $request['post_date_gmt'] = $request['post_modified']=$request['post_modified_gmt']= now();

        Activity::create($request->all());
        $activ = Activity::selectRaw('max(ID) as id')->get()->first();
        // dd($activ);
        // dd($id["id"]);
        $activity['user_id'] = Auth::user()->id;
        $activity['post_id'] = $activ['id'];

        User_Post::create($activity);
        // dd($request->all());
        return Redirect::back()->with('result','โพสต์กิจกรรมสำเร็จ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $activity = Activity::join('user_post', 'user_post.post_id', '=', 'wp_posts.id')
        ->where('user_post.user_id', Auth::user()->id)->where('post_id',$id)->get();
       if(count($activity)>0){
        return view('admin.activity.edit',['activity'=>Activity::findOrFail($id)]);
       }else{
        return redirect()->route('activity.index')->with('error_publish','คุณไม่มีสิทธิ์แก้ไขกิจกรรมนี้');
       }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        Activity::findOrFail($id)->update($request->all());

        return Redirect::route('activity.index')->with('edit','แก้ไขสำเร็จ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {

        $activity = Activity::join('user_post', 'user_post.post_id', '=', 'wp_posts.id')
        ->where('user_post.user_id', Auth::user()->id)->where('post_id',$request->to_delete)->get();

       if(count($activity)>0){
           if(Activity::findOrFail($request->to_delete)->destroy($request->to_delete)){
            return redirect()->back()->with('publish','ลบกิจกรรมสำเร็จแล้ว');
           }
       }else{
        return redirect()->route('activity.index')->with('error_publish','คุณไม่มีสิทธิ์แก้ไขกิจกรรมนี้');
       }

    }
}
