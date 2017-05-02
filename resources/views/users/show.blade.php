@extends('layouts.default')
@section('title', $user->name)
@section('content')
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="col-md-12">
                <div class="col-md-offset-2 col-md-8">
                    <section class="user_info">
                        @include('shared.user_info', ['user' => $user])
                    </section>
                    <section class="stats">
                        @include('shared.stats', ['user' => $user])
                    </section>
                </div>
            </div>
            <div class="col-md-12">
                @if (Auth::check())
                    @include('users._follow_form')
                @endif
                @if (count($statuses) > 0)
                    <h3 class="report-blog text-center">有什么新的知识和所见所闻？<a href="{{ route('home') }}">记录一下吧</a></h3>
                    <ol class="statuses">
                        @foreach ($statuses as $status)
                            @include('statuses._status')
                        @endforeach
                    </ol>
                    {!! $statuses->render() !!}
                    @else
                    <h3 class="report-blog text-center">您还没有发过博客<a href="{{ route('home') }}">点此发表</a></h3>
                @endif
            </div>
        </div>
    </div>
@stop