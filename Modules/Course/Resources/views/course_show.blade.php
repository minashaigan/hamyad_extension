@extends('course::layouts.master')

@section('content')

    <h3>course</h3>
    <ul>
        <li>{{$course['data']['id'      ]}}</li>
        <li>{{$course['data']['name'    ]}}</li>
        <li>{{$course['data']['image'   ]}}</li>
        <li>{{$course['data']['category']}}</li>
        <li>{{$course['data']['teacher' ]}}</li>
        <li>{{$course['data']['time'    ]}}</li>
        <li>rate: {{$course['data']['rate'    ]}}</li>
        <li>{{$course['data']['skills'  ]}}</li>
        <li>{{$course['data']['price'   ]}}</li>
        <li>{{$course['data']['salable' ]}}</li>
    </ul>

    <h3>course info</h3>
    <ul>
        <li>{{$course['data']['about']['data']['users'           ]}}</li>
        <li>{{$course['data']['about']['data']['videos'          ]}}</li>
        <li>{{$course['data']['about']['data']['description'     ]}}</li>
        <li>{{$course['data']['about']['data']['file'            ]}}</li>
        <li>{{$course['data']['about']['data']['useful_resources']}}</li>
        <li>{{$course['data']['about']['data']['intro_video'     ]}}</li>

    </ul>

    <h3>teacher courses</h3>
    @foreach($teacher_courses['data'] as $teacher_course)
        <ul>
            <li>{{$teacher_course['name']}}     </li>
            <li>{{$teacher_course['image']}}    </li>
            <li>{{$teacher_course['category']}} </li>
            <li>{{$teacher_course['teacher']}}  </li>
            <li>{{$teacher_course['price']}}    </li>
            <li>{{$teacher_course['time']}}     </li>
            <li>{{$teacher_course['rate']}}     </li>
            <li>{{$teacher_course['skills']}}   </li>

        </ul>
    @endforeach

    <h3>about teacher</h3>
    <ul>
        <li>{{$course['data']['aboutTeacher']['data']['id'           ]}}</li>
        <li>{{$course['data']['aboutTeacher']['data']['description'  ]}}</li>
    </ul>

    <h3>section groups</h3>
    @foreach($course['data']['sectionGroups']['data'] as $group)
        <ul>
            <li>{{$group['name']}}</li>
            <li>{{$group['time']}}</li>
            sections
            <li>
                @foreach($course['data']['sections']['data'] as $section)
                    @if($group['id'] == $section['section_group_id'])
                        <h3>{{$section['name']}}</h3>
                        <ul>
                            <li></li>
                            <li>{{$section['link'       ]}}</li>
                            <li>{{$section['description']}}</li>
                            <li>{{$section['file'       ]}}</li>
                            <li>{{$section['cover'      ]}}</li>
                            <li>{{$section['time'       ]}}</li>
                        </ul>
                    @endif
                @endforeach
            </li>

        </ul>
    @endforeach

    <h3>similar courses</h3>
    @foreach($similar_courses['data'] as $similar_course)
        <ul>
            <li>{{$similar_course['name']}}     </li>
            <li>{{$similar_course['image']}}    </li>
            <li>{{$similar_course['category']}} </li>
            <li>{{$similar_course['teacher']}}  </li>
            <li>{{$similar_course['price']}}    </li>
            <li>{{$similar_course['time']}}     </li>
            <li>{{$similar_course['rate']}}     </li>
            <li>{{$similar_course['skills']}}   </li>

        </ul>
    @endforeach
@stop
