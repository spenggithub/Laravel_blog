@extends('layouts.default')
@section('content')
    @if (Auth::check())
        <div class="row">
            <div class="col-md-8">
                <section class="status_form">
                    @include('shared.status_form')
                </section>
                <h3>博客列表</h3>

                @include('shared.feed')
            </div>
            <aside class="col-md-4">
                <section class="user_info">
                    @include('shared.user_info', ['user' => Auth::user()])
                </section>
                <section class="stats">
                    @include('shared.stats', ['user' => Auth::user()])
                </section>
            </aside>
            <aside class="col-md-4">
                <section class="user-remcom">
                    <ul class="user-recom-content">
                        <li class="user-recom-title"><h3>推荐关注</h3></li>
                        <hr>
                        <li class="user-recom-list">
                            <img src="{{ $user_remcom->gravatar() }}" alt="{{ $user_remcom->name }}" class="gravatar"/>
                            <a href="{{ route('users.show', $user_remcom->id )}}" class="username">{{ $user_remcom->name }}</a>
                        </li>
                        <li class="user-recom-list">
                            <img src="{{ $user_remcom2->gravatar() }}" alt="{{ $user_remcom2->name }}" class="gravatar"/>
                            <a href="{{ route('users.show', $user_remcom2->id )}}" class="username">{{ $user_remcom2->name }}</a>
                        </li>
                        <li class="user-recom-list">
                            <img src="{{ $user_remcom3->gravatar() }}" alt="{{ $user_remcom3->name }}" class="gravatar"/>
                            <a href="{{ route('users.show', $user_remcom3->id )}}" class="username">{{ $user_remcom3->name }}</a>
                        </li>
                    </ul>
                </section>
            </aside>
        </div>
    @else
        <div class="jumbotron">
            <h1>Laravel</h1>
            <p class="lead">
                你现在所看到的是我使用PHP Laravel框架开发的博客系统的项目主页。
            </p>
            <p>
                一切，将从这里开始。
            </p>
            <p>
                <a class="btn btn-lg btn-success" href="{{ route('signup') }}" role="button">现在注册</a>
            </p>
        </div>
    @endif

@stop