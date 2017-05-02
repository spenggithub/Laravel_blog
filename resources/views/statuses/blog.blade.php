@extends('layouts.default')
@section('title', '所有用户')
@section('content')
    <h1 style="margin: 50px 0 70px 0">{{ $blog->title }}</h1>
    <?php
    echo $blog->content;
    ?>
@stop