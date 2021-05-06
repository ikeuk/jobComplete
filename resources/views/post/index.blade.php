@extends('layouts.app')
@section('content')
<div class="container">
    @if(count($posts) > 0)
    <div class="col-lg-12">
        @foreach($posts as $post)
        <!-- Card -->
        <div class="card">
          
            <div class="card-body">
               
                <ul class="list-unstyled li-space-lg">
                    <li class="media">
                        <i class="fas fa-square"></i>
                        <div class="media-body">Name: {{$post->name}}</div>
                    </li>
                    
                </ul>
                <p class="price"><span>Email {{$post->email}}</span></p>
            </div>

            <div class="thumb-image"> <img src="{{ asset('uploads/' .$post->_file)}}" data-imagezoom="true" class="img-responsive" alt=""/> </div>
            <a href="/post/{{ $post->id}}/edit" class="btn btn-default">Edit</a>
        </div>
        <!-- end of card -->
        @endforeach
    </div> <!-- end of col -->
    @endif
</div>
@endsection