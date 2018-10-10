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
        <h1>Organizations</h1>

        <p>
            This view is loaded from module: {!! config('course.name') !!}
        </p>

        <table>
            <tr>
                <th>Icon</th>

            </tr>
            @foreach($organizations as $organization)
                <tr class='clickable-row' data-url="organization/{{$organization['id']}}">
                    <td>{{$organization['logo']}}</td>

                </tr>
            @endforeach
        </table>

    @endif

    <script>
        $(document).ready(function(){
            $(".clickable-row").click(function() {
                window.location = $(this).data('url');
            });
        });
    </script>

@stop
