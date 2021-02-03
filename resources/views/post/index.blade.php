@extends("welcome")

@section("content")
    <div class="container">
    

        @foreach($blogs as $blog)
            <div class="jumbotron my-2">
                <a href="{{ route('post.show',$blog->id) }}"><h1>{{ $blog->title }}</h1></a>
                <p>{{ strlen($blog->body) > 150 ? substr($blog->body,0,30).'...' : $blog->body }}</p>
                
                <small class="disabled">{{$blog->created_at}}</small>
                
                <a href="{{ route('user.blogs',[$blog->user->name,$blog->user->id])}}">
                <small class="float-right">{{$blog->user->name}}</small></a>
                @foreach ($blog->category as $category)
                <b>#{{$category['name']}}</b>
                @endforeach
            </div>    
        @endforeach
    </div>
@endsection()