@extends("welcome")

@section("content")
    <div class="container">
        <form action="{{ route('post.store') }}" method="post">
            @csrf
    
            <div class="form-group">
                <label for="title">Post Title</label>
                <input type="text" name="title" class="form-control">
            </div>
            <div class="form-group">
                <label for="body">Post body</label>
                <textarea class="form-control" name="body" id="body" cols="30" rows="10" ></textarea>
            </div>
            <button class="btn btn-primary float-right" type="submit">Submit</button>
        </form>
    </div>

@endsection