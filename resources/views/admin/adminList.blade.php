@extends('admin.adminBase')

@section('adminList')
    <div id="list">
        <div class="container">

            <h2> {{$title}}</h2>

            <table class="table table-hover">
                @if(isset($new))
                    <a href="{{$new}}" class="btn btn-primary" role="button">
                        {{trans('app.add_new')}}</a>
                    <hr/>
                @endif
                @if(sizeof($list)>0)
                    <thead>
                    <tr>
                        @foreach($list[0] as $key => $value)
                            <th>{{$key}}</th>
                        @endforeach

                    </tr>

                    </thead>
                    <tbody>
                    @foreach ($list as $key => $record)

                        <tr id="{{$record['id']}}">

                            @foreach ($record as $key => $value)

                                <td>

                                    @if($key == 'is_active')
                                        @if($value == 1)

                                            <a onclick="toggleActive('{{route($call_to_action, $record['id'])}}',1)"
                                               class="btn btn-success btn-sm"
                                               style="display :none;">{{trans('app.activate')}}</a>

                                            <a onclick="toggleActive('{{route($call_to_action, $record['id'])}}',0)"
                                               class="btn btn-danger btn-sm">{{trans('app.deactivate')}}</a>

                                        @else

                                            <a onclick="toggleActive('{{route($call_to_action, $record['id'])}}',1)"
                                               class="btn btn-success btn-sm">{{trans('app.activate')}}</a>

                                            <a onclick="toggleActive('{{route($call_to_action, $record['id'])}}',0)"
                                               class="btn btn-danger btn-sm"
                                               style="display :none;">{{trans('app.deactivate')}}</a>

                                        @endif
                                    @elseif($key == 'translation')
                                        @if(isset($value['name']))

                                            {{$value['name']. ' '.$value['language_code'] }}
                                        @else
                                            {{$value['title']. ' '.$value['language_code'] }}
                                        @endif

                                    @elseif($key == 'cover')
                                        @if(isset($value['path']))

                                        <img src="{{asset($value['path'])}}" class="img-rounded" width="200">

                                        @else
                                           {{"No path!"}}
                                        @endif

                                    @else

                                        {{$value}}

                                    @endif
                                </td>
                            @endforeach

                            @if(isset($edit))

                                <td><a href="{{route($edit, [$record['id'], app()->getLocale()])}}"
                                       class="btn btn-default btn-sm">{{trans('app.edit_record')}}</a>
                                </td>
                            @endif
                            @if(isset($showDelete))

                                <td><a onclick="deleteItem('{{route($showDelete, $record['id'])}}')"
                                       class="btn btn-info btn-sm">{{trans('app.delete')}}</a>
                                </td>
                            @endif

                        </tr>

                    @endforeach

                    </tbody>
                @else
                    {{trans('app.no_items')}}
                @endif
            </table>
        </div>
    </div>
@endsection

@section('scripts')

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function deleteItem(route) {
            $.ajax({
                url: route,
                dataType: 'json',
                type: 'DELETE',
                success: function () {
                    alert('DELETED');
                    location.reload();
                },
                error: function () {
                    alert('ERROR');
                }
            });
        }

        function toggleActive(url, value) {
//         console.log(url, value)
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    is_active: value
                },

                success: function (responce) {

//                    console.log(responce.is_active)
//                    console.log( $('#'+ responce.id))
//                    $('#'+responce.id)
//                    $('#'+ responce.id).css({
//                        opacity:0.5,
//                        backgroundColor:"red"
//                    })
//                    $('#'+ responce.id).addClass()
//                    $('#'+ responce.id).removeClass()
//                    $('#'+ responce.id).addClass().removeClass().attr()
//                    console.log($('#'+ responce.id).find('a'))
                    var $danger = $('#' + responce.id).find('.btn-danger')
                    var $success = $('#' + responce.id).find('.btn-success')

                    if (responce.is_active === '1') {
                        $danger.show()
                        $success.hide()
                    }
                    else {
                        $danger.hide();
                        $success.show()
                    }
                },
                error: function () {
                    alert('ERROR');
                }
            });
        }

    </script>

@endsection
