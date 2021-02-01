@extends("welcome")

@section("content")
    <div class="container">
        <form action="{{ route('category.store') }}" method="post">
            @csrf
    
            <div class="form-group">
                <label for="title">Category Title</label>
                <input type="text" name="title" class="form-control">
            </div>

            <button class="btn btn-primary float-right" type="submit">Create</button>
        </form>
    </div>

@endsection