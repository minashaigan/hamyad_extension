@extends('course::layouts.master')

@section('content')
    {{ $exception->getMessage() }}
@stop