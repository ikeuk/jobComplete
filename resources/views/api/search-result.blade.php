@extends('layouts.app')

@section('content')

    <div class="container">
        @if (session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif

        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>



    <div class="search-results-container container">
        <h1>Search Results</h1> <br />
       
        @if ($products->total() > 0)
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>File</th>
                  
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <th><a href="#">{{ $product->name }}</a></th>
                        <td>{{ $product->email }}</td>
                        <td class="thumb-image"> <img src="{{ asset('uploads/' .$product->_file)}}" data-imagezoom="true" class="img-responsive" height="50vh" alt=""/> </td>
                       
                      
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$products->links() }}
    
        @endif
    </div> <!-- end search-results-container -->
 
@endsection
<style>
    .paint{
        background-color: #fff;
    }
</style>