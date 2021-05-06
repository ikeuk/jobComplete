@extends('layouts.app')

@section('content')
@foreach($data as $item)

    <li>{{$item['title']}}</li>
    <img src="{{ $item['images']['original']['url'] }}"  />
   

@endforeach

@endsection
