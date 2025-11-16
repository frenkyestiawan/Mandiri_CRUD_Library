@props(['header' => null])

@extends('layouts.app')

@if (!empty($header))
    @section('header')
        {{ $header }}
    @endsection
@endif

@section('content')
    {{ $slot }}
@endsection
