@extends("welcome")

@section("content")
    <div class="container">

        @foreach($blogs as $blog)
        <div class="bg-light border my-2">
            <a href="{{ route('post.show',$blog->id) }}"><h1>{{ $blog->title }}</h1></a>
            <a href="{{ route('user.blogs',[$blog->user->name,$blog->user->id])}}">
            <small>{{$blog->user->name}}</small></a>
            @foreach ($blog->category as $category)
            <b>#{{$category['name']}}</b>
            @endforeach
            <strong class="text-danger">{{$blog->status}}</strong>
        </div>
        <div>
            <a href="{{ route('post.publish.admin',$blog->id) }}" class="btn btn-primary">Publish</a>
            <a href="{{ route('post.draft.admin',$blog->id) }}" class="btn btn-warning">Draft</a>
            @if($user['role_id']==1)
            <a href="{{ route('post.delete.admin',$blog->id) }}" class="btn btn-danger">Delete</a>
            @endif
        </div>    
        @endforeach
    </div>
@endsection()