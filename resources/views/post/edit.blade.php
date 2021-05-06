@extends('layouts.app')
@section('content')
<div class="container">
             @if (session('success'))
                        <div class="alert alert-success" role="alert">
                           <button aria-hidden="true" data-dismiss="alert" class="close" type="button"> × </button>
                            {{ session('success') }}
            </div>
                 
       @endif
       @if (Auth::user())
      <div class="checkout-section">
            <div>
                <form action="{{ route('post.update')}}" method="POST" id="payment-form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <h2>Update Contact</h2>
  <input type="hidden" class="form-control" id="name" name="id" value="{{$posts->id}}" required>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$posts->name}}" required>
                    </div>
                   
 
            
                     <div class="form-group">
                            <label for="phone">File</label>
                          <input type="file" name="_file">
                        </div>

                    <div class="spacer"></div>

                    <button type="submit" id="complete-order" class="button-primary full-width">Update</button>&nbsp;
                     <a href="/post/index" class="btn btn-default">Go Back</a>
                </form>
<a href="/post/delete/{{$posts->id}}" class="btn btn-default" onclick="return confirm('Are you sure you want to delete this item')">Delete</a>
            </div>

            @endif

        </div> <!-- end checkout-section -->
</div>
@endsection
