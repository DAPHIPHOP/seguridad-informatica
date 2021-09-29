@extends('layouts.main')

@section('content')

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Bienvenido {{auth()->user()->name}}</h1>

@endsection
