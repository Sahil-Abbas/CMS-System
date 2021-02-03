@extends("welcome")

@section("content")
    <div class="container">
        @foreach($blog as $blog)
            <div class="jumbotron my-2">
            <div>
                <a href="{{ route('post.edit',$blog->id) }}"><button class="mx-1 float-right btn btn-primary">Edit</button></a>
                <a href="{{ route('post.delete',$blog->id) }}"><button class="mx-1 float-right btn btn-danger">Delete</button></a>
            </div>
                <h1>{{$blog->title}}</h1>
                <p>{{$blog->body}}</p>
                <small>{{$blog->user->name}}</small>
                @foreach ($blog->category as $category)
                <b>#{{$category['name']}}</b>
                @endforeach
            </div>    
        @endforeach
    </div>
@endsection