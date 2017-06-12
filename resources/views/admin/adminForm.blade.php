@extends('admin.adminBase')

@section('adminForm')
    <div class="container">

        <h2>{{trans('app.new_record')}}{{$title}}</h2>

        {!! Form::open(['url' => $url]) !!}

        @foreach ($fields as $field)
            @if ($field['type'] == 'drop_down')
                {{Form::label($field['key'], $field['label'])}}
                <br>
                {{Form::select($field['key'],$field['options'])}}
                <br><br>

            @elseif($field['type'] == 'single_line')
                {{Form::label($field['key'], $field['label'])}}
                <br>
                {{Form::text($field['key'])}}
                <br><br>
            @endif

        @endforeach
        {{ Form::submit(trans('app.submit')) }}
        {!! Form::close() !!}
    </div>
@endsection