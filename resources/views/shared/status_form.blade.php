<form action="{{ route('statuses.store') }}" method="POST">
    @include('shared.errors')
    {{ csrf_field() }}
    <lable for="blog-title">请输入标题：</lable>
    <input type="text" name="title" class="form-control">
    <textarea id="textarea1" name="content" class="form-control" style="height:300px;" placeholder="请在此输入博客内容..." value="{{ old('password') }}"></textarea>
    <button type="submit" class="btn btn-primary pull-right">发布</button>
</form>