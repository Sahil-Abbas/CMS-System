
@extends('welcome')

@section("content")
    <div class="container">
        <ul class="list-group list-group-flush">
            
        @foreach($categories as $category)
            <li class="list-group-item"><a class="link" href="{{route('category.edit',$category->id)}}">{{ $category->name }}</a></li>
        @endforeach
        </ul>
    </div>
@endsection()