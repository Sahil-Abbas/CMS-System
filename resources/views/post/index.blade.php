@extends("welcome")

@section("content")
    <div class="container">
        @foreach($blogs as $blog)
            <div class="jumbotron my-2">
                <a href="{{ route('post.show',$blog->id) }}"><h1>{{ $blog->title }}</h1></a>
                <p>{{ strlen($blog->title) > 150 ? substr($blog->title,0,30).'...' : $blog->title }}</p>
                <a href="{{ route('user.blogs',[$blog->user->name,$blog->user->id])}}"><small class="float-right">{{$blog->user->name}}</small></a>
            </div>    
        @endforeach
    </div>
@endsection()