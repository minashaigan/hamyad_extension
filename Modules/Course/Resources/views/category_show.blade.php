@extends('course::layouts.master')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
        .clickable-row {
            cursor: pointer;
        }
    </style>

    @if(!empty($errors->first()))
        <h3>{{ $errors->first() }}</h3>
    @else
        <h1>Hello World</h1>

        <p>
            This view is loaded from module: {!! config('course.name') !!}
        </p>

        <table>
            <tr>
                <th>Name</th>
                <th>Icon</th>
            </tr>

            <tr>
                <td>{{$category['data']['name']}}</td>
                <td>{{$category['data']['icon']}}</td>
            </tr>

        </table>

    @endif

@stop
