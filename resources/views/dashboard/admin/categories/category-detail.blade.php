@extends('layouts.dashboard-layout')
@section('dashboard-content')
    <h2 class="intro-y text-lg font-medium mt-10">
        {{ $category->name }}
    </h2>

    <p class="intro-y text-justify font-medium mt-5">
        {!! $category->description !!}
    </p>
      <p class="intro-y text-justify font-medium mt-3">Number of products: {{ $category->products->count() }}</p> 
    


   
@endsection
