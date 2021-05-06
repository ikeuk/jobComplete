@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('success'))
               <div class="alert alert-success" role="alert">
                  <button aria-hidden="true" data-dismiss="alert" class="close" type="button"> × </button>
                   {{ session('success') }}
   </div>
        
@endif
     <div class="checkout-section">
   <div>
       <form action="{{ route('post.store') }}" method="POST" id="payment-form" enctype="multipart/form-data">
           {{ csrf_field() }}
           <h2>Create Contact</h2>

           <div class="form-group">
               <label for="name"> Name</label>
               <input type="text" class="form-control" id="name" name="name" value="" required>
           </div>
           <div class="form-group">
               <label for="address">Email</label>
               <input type="email" class="form-control" id="address" name="email" value="" required>
           </div>

          <div class="half-form">
         
              
             <div class="form-group">
                   <label for="phone">File</label>
                 <input type="file" name="_file">
               </div>
           </div> <!-- end half-form -->

           <div class="spacer"></div>

           <button type="submit" id="complete-order" class="button-primary full-width">Create</button>
              <a href="/home" class="btn btn-default">Go Back</a>
       </form> 
 <!--   </div>  -->

 

<!--   </div>  --><!-- end checkout-section --> 
</div>

@endsection