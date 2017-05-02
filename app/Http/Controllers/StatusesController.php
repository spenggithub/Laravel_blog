<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Status;
class StatusesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'only' => ['store', 'destroy']
        ]);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required',
            'title' =>'required|max:20'
        ]);
        //创建微博使用关联模型$user->statuses()->create()
        //创建微博的用户肯定是当前登录的用户，因此可以使用Auth::user()获取当前登入的用户

        Auth::user()->statuses()->create([
            'content' => $request->content,
            'title' => $request->title,
        ]);
        return redirect()->back();
    }

    public function destroy($id)
    {
        $status = Status::findOrFail($id);
        $this->authorize('destroy', $status);
        $status->delete();
        session()->flash('success', '此条博客已被成功删除！');
        return redirect()->back();
    }

    public function blog($id){
        $blog = Status::findOrFail($id);
        return view('statuses.blog',compact('blog'));
    }
}
