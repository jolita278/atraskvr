@extends('admin.adminBase')

@section('adminForm')
    <div class="container">

        <h2>{{$title_name}}{{$title}}</h2>

        {!! Form::open(['url' => $url]) !!}

        @foreach ($fields as $field)
            @if ($field['type'] == 'drop_down')
                {{Form::label($field['key'], $field['label'])}}
                <br>

                @if(isset($data[$field['key']]))

                    @if($field['key'] == 'language_code')
                        {{Form::select($field['key'], $field['options'], $data[$field['key']], ['class' => 'form-control'])}}
                    @else
                        {{Form::select($field['key'], $field['options'], $data[$field['key']], ['class' => 'form-control', 'placeholder' => 'Please Select'])}}
                    @endif

                @else

                    @if($field['key'] == 'language_code')
                        {{Form::select($field['key'], $field['options'], null, ['class' => 'form-control'])}}
                    @else
                        {{Form::select($field['key'], $field['options'], null, ['class' => 'form-control', 'placeholder' => 'Please Select'])}}
                    @endif
                @endif

                <br><br>


            @elseif($field['type'] == 'single_line')
                {{Form::label($field['key'], $field['label'])}}
                <br>
                @if(isset($data[$field['key']]))

                    {{Form::text($field['key'],$data[$field['key']],['class' => 'form-control'])}}
                    <br><br>
                @else
                    {{Form::text($field['key'],null,['class' => 'form-control'])}}
                @endif

            @elseif($field['type'] == 'check_box')

                @if(isset($field['key']))
                    {{Form::label($field['key'], $field['label'])}}
                    <br>
                @endif
                @foreach($field['options'] as $option)
                    <br>
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


@section('scripts')
    <script>

        $('#language_code').bind('change', function () {
            window.location.href = "?language_code=" + $('#language_code').val();
        });
    </script>
@endsection
