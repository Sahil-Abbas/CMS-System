@extends("welcome")

@section("content")
    <div class="container">
        @if($errors->any)
            @foreach ($errors->all as $error)
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{$error}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
            @endforeach
        @endif
        <form action="{{ route('post.update',$blog['id']) }}" method="post">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="title">Post Title</label>
                <input type="text" name="title" value="{{$blog['title']}}" class="form-control">
            </div>
            <div class="form-group">
                <label for="body">Post body</label>
                <textarea class="form-control" name="body" id="body" cols="30" rows="10" >{{$blog['body']}}</textarea>
            </div>
            <button class="btn btn-primary float-right" type="submit">Submit</button>
        </form>
    </div>

@endsection