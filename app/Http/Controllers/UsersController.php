<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    //构造器方法，类对象被创建之前就会被调用
    public function __construct()
    {
        //middleware方法接受两个参数，第一个是中间件的名称，第二个是过滤的动作
        //auth是只有登录的用户才能访问
        $this->middleware('auth',[
           'only' => ['edit','update','destroy']
        ]);
        //只有未登录用户才能访问注册页面
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    //用户注册get页面
    public function create(){
        return view('users.create');
    }
    //获取用户信息get
    public function show($id){
        $user = User::findOrFail($id);
        //取出用户发的微博
        //orderBy()按照发布时间排序，desc是倒序排列，后发的排在前面。
        //paginate(15)每一页显示15条
        $statuses = $user->statuses()
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('users.show', compact('user', 'statuses'));
    }

    //对用户提交的表单验证 post
    //Request $request接收到用户提交的数据
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed',
            'captcha' => 'required|captcha'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        Auth::login($user);
        session()->flash('success', '恭喜你，注册成功！');
        return redirect()->route('users.show',[$user]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    public function update($id,Request $request)
    {
        //对用户提交的数据校验
        $this->validate($request,[
           'name' => 'required|max:50',
            'password' => 'confirmed|min:6'
        ]);

        //更新数据
        $user = User::findOrFail($id);
        $this->authorize('update', $user);
        $data = [];
        $data['name'] = $request->name;
        //如果未输入密码则不更新密码
        if($request->password){
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);

        session()->flash('success','个人资料修改成功');
        return redirect()->route('users.show',$id);
    }

    public function index(){
        //每页取出15条记录。
        $users = User::paginate(15);
        return view('users.index',compact('users'));
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        //只有被授权了destroy动作的管理员执行这个方法
        $this->authorize('destroy', $user);
        $user->delete();
        session()->flash('success', '成功删除用户！');
        return back();
    }

    protected function sendEmailConfirmationTo($user)
    {
        $view = 'emails.confirm';
        $data = compact('user');
        $name = '孙鹏';
        $to = $user->email;
        $subject = "感谢注册 Sample 应用！请确认你的邮箱。";

        Mail::send($view, $data, function ($message) use ( $name, $to, $subject) {
            $message->to($to)->subject($subject);
        });
    }

    public function confirmEmail($token)
    {
        $user = User::where('activation_token', $token)->firstOrFail();

        $user->activated = true;
        $user->activation_token = null;
        $user->save();

        Auth::login($user);
        session()->flash('success', '恭喜你，激活成功！');
        return redirect()->route('users.show', [$user]);
    }

    public function followings($id)
    {
        $user = User::findOrFail($id);
        $users = $user->followings()->paginate(15);
        $title = '关注的人';
        return view('users.show_follow', compact('users', 'title'));
    }

    public function followers($id)
    {
        $user = User::findOrFail($id);
        $users = $user->followers()->paginate(15);
        $title = '粉丝';
        return view('users.show_follow', compact('users', 'title'));
    }

}
