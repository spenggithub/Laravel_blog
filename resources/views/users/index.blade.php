@extends('layouts.default')
@section('title', '所有用户')
@section('content')
<div class="col-md-offset-2 col-md-8">
    <h1>所有用户</h1>
    <ul class="users">
        @foreach ($users as $user)
            {{--用户列表使用局部视图显示--}}
            @include('users._user')
        @endforeach
    </ul>
    {!! $users->render() !!}
</div>

    @stop