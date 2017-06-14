@extends('admin.adminBase')

@section('adminForm')
    <div class="container">

        <h2>{{$title_name}}{{$title}}</h2>

        {!! Form::open(['url' => $url]) !!}

        @foreach ($fields as $field)
            @if ($field['type'] == 'drop_down')
                {{Form::label($field['key'], $field['label'])}}
                <br>
                {{Form::select($field['key'],$field['options']/*,$data['translation']['language_code']*/)}}
                <br><br>

            @elseif($field['type'] == 'single_line')
                {{Form::label($field['key'], $field['label'])}}
                <br>
                {{Form::text($field['key']/*,$data['translation']['name']*/)}}
                <br><br>
            @elseif($field['type'] == 'check_box')
                @if(isset($field['key']))
                    {{Form::label($field['key'], $field['label'])}}
                    <br>
                @endif
                @foreach($field['options'] as $option)
                    {{ Form::checkbox($option['name'], $option['value'])}}{{$option['title']}}
                    <br/><br>
                @endforeach
            @endif

        @endforeach
        {{ Form::submit(trans('app.submit'), array("class" => 'btn')) }}
        <a href="{{$back_to_list}}" class="btn btn-primary" role="button">{{trans('app.back_to_list')}}</a>
        {!! Form::close() !!}


    </div>
@endsection