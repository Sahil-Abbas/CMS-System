@extends("welcome")

@section("content")
    <div class="container">

        <form action="{{ route('post.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="title">Post Title</label>
                    
                    @if($errors->blogs->has('title'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        @foreach($errors->blogs->get('title') as $titleE)
                        <strong> {{$titleE}} </strong>
                        @endforeach
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    @endif
                
                <input type="text" name="title" value="{{old('title')}}" class="form-control">
            </div>

            <div class="form-group">
                <label for="body">Post body</label>
                
                @if($errors->blogs->first('body'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        @foreach($errors->blogs->get('body') as $bodyE)
                        <strong> {{$bodyE}} </strong>
                        @endforeach
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                @endif
                
                <textarea class="form-control" name="body" id="body" cols="30" rows="10" >{{old('body')}}</textarea>
            </div>
            @foreach ($categories as $category)
            <input type="checkbox" id="{{$category->name}}" name="categories[]" value="{{$category->id}}" >
            <label for="{{$category->name}}">{{$category->name}}</label>
            @endforeach
            <button class="btn btn-primary float-right" type="submit">Submit</button>
        </form>
    </div>

@endsection