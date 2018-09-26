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

    <h3>Popular Course</h3>
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
        @foreach($popular_courses['data'] as $popular_course)
            <tr class='clickable-row' data-url="course/{{$popular_course['id']}}">
                <td>{{$popular_course['name']}}     </td>
                <td>{{$popular_course['image']}}    </td>
                <td>{{$popular_course['category']}} </td>
                <td>{{$popular_course['teacher']}}  </td>
                <td>{{$popular_course['price']}}    </td>
                <td>{{$popular_course['time']}}     </td>
                <td>{{$popular_course['rate']}}     </td>
                <td>{{$popular_course['skills']}}   </td>

            </tr>
        @endforeach
    </table>

    <h3>New Course</h3>
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
        @foreach($new_courses['data'] as $new_course)
            <tr class='clickable-row' data-url="course/{{$new_course['id']}}">
                <td>{{$new_course['name']}}     </td>
                <td>{{$new_course['image']}}    </td>
                <td>{{$new_course['category']}} </td>
                <td>{{$new_course['teacher']}}  </td>
                <td>{{$new_course['price']}}    </td>
                <td>{{$new_course['time']}}     </td>
                <td>{{$new_course['rate']}}     </td>
                <td>{{$new_course['skills']}}   </td>

            </tr>
        @endforeach
    </table>

    <h3>Coming Soon Course</h3>
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
        @foreach($soon_courses['data'] as $soon_course)
            <tr class='clickable-row' data-url="course/{{$soon_course['id']}}">
                <td>{{$soon_course['name']}}     </td>
                <td>{{$soon_course['image']}}    </td>
                <td>{{$soon_course['category']}} </td>
                <td>{{$soon_course['teacher']}}  </td>
                <td>{{$soon_course['price']}}    </td>
                <td>{{$soon_course['time']}}     </td>
                <td>{{$soon_course['rate']}}     </td>
                <td>{{$soon_course['skills']}}   </td>

            </tr>
        @endforeach
    </table>

    <h3>Categories</h3>
    <table>
        <tr>
            <th>Name</th>
            <th>Icon</th>

        </tr>
        @foreach($categories['data'] as $category)
            <tr class='clickable-row' data-url="category/{{$category['id']}}">
                <td>{{$category['name']}}   </td>
                <td>{{$category['icon']}}   </td>
            </tr>
        @endforeach
    </table>

    <h3>Organizations</h3>
    @foreach($organizations as $organization)
        <p>{{$organization->logo}}</p>
    @endforeach

    <script>
        $(document).ready(function(){
            $(".clickable-row").click(function() {
                window.location = $(this).data('url');
            });
        });
    </script>
    @endif
@stop
