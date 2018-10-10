@extends('exam::layouts.master')

@section('content')
<h1>Hello World</h1>

<p>
    This view is loaded from module: {!! config('exam.name') !!}
</p>

    @if(!empty($errors->first()))
        <h3>{{ $errors->first() }}</h3>
    @else

        <h3>questions</h3>
        <ul>
            @foreach($questions['data'] as $question)
                @if(in_array($question['id'],$user_questions))
                    <li><b>+</b></li>
                @else
                    <li>-</li>
                @endif
                <li>{{$question['description']}}</li>
                <li>{{$question['type']}}</li>
                <li>{{$question['link']}}</li>
                <li>{{$question['file']}}</li>
                <li>{{$question['image']}}</li>
                <li>{{$question['exam_name']}}</li>
                <li>{{$question['exam_time_limitation']}}</li>
                <li>{{$question['exam_time']}}</li>

            @endforeach
        </ul>

    @endif
@stop
