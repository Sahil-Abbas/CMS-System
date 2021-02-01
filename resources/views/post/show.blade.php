@extends("welcome")

@section("content")
    <div class="container">
        @foreach($blog as $blog)
            <div class="jumbotron my-2">
                <h1>{{$blog->title}}</h1>
                <p>{{$blog->body}}</p>
                <small>{{$blog->user->name}}</small>
            </div>    
        @endforeach
    </div>
@endsection