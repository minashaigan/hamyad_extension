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

    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('course.name') !!}
    </p>

    <table>
        <tr>
            <th>Name</th>
            <th>Image</th>
            <th>Category</th>
            <th>Teacher</th>
            <th>Price</th>
            <th>Time</th>
            <th>Rate</th>
            <th>Skills</th>

        </tr>
        @foreach($courses['data'] as $course)
            <tr class='clickable-row' data-url="{{$course['id']}}">
                <td>{{$course['name']}}     </td>
                <td>{{$course['image']}}    </td>
                <td>{{$course['category']}} </td>
                <td>{{$course['teacher']}}  </td>
                <td>{{$course['price']}}    </td>
                <td>{{$course['time']}}     </td>
                <td>{{$course['rate']}}     </td>
                <td>{{$course['skills']}}   </td>

            </tr>
        @endforeach
    </table>

    <script>
        $(document).ready(function(){
            $(".clickable-row").click(function() {
                window.location = $(this).data('url');
            });
        });
    </script>

@stop
