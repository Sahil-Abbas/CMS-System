@extends("welcome")

@section("content")
    <div class="container">
        @foreach($blog as $blog)
            <div class="jumbotron my-2">
            <div>
            
            @if($blog->user->id == $user->id || $user->role_id==1 || $user->role_id==2)
                <a href="{{ route('post.edit',$blog->id) }}"><button class="mx-1 float-right btn btn-primary">Edit</button></a>
            @endif

            @if($user->role_id==1)
                <a href="{{ route('post.delete',$blog->id) }}"><button class="mx-1 float-right btn btn-danger">Delete</button></a>
            @endif
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