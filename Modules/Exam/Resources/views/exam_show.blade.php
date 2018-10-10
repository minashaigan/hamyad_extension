@extends('exam::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('exam.name') !!}
    </p>

    @if(!empty($errors->first()))
        <h3>{{ $errors->first() }}</h3>
    @else

        <h3>exam</h3>
        <p>{{$exam['data']['name']}}</p>
        <p>{{$exam['data']['category']}}</p>
        <p>{{config('exam.type.'.$exam['data']['type'])}}</p>
        <p>{{$exam['data']['type']}}</p>
        <p>{{$exam['data']['question_number']}}</p>

    @endif
@stop
