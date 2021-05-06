@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           
                

               <div class="container">
            <h3 class="tittle con"></h3>
                 <div class="lcontact span_1_of_contact">
                    <form method="POST" action="{{ route('search') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right"></label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control" name="query" value="" placeholder=" Name or Email or file" required  autofocus>

                            </div>
                        </div>
                        <input name="submit" class="form-control" type="submit" id="submit" value="Submit"> 
                    </form>
                </div>
            </div>
        </div>
     
        </div>
    </div>
</div>

@endsection
