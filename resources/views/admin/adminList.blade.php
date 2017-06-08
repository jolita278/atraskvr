@extends('admin.adminBase')

@section('adminList')
    <div id="list">
    <div class="container">

        <h2> {{$listName}}</h2>
        {{--<div>@include('error-notification')</div>--}}
        <table class="table table-hover">
            @if(isset($url))
                <a href="{{$url}}" class="btn btn-primary" role="button">
                    Add new</a>
                <hr/>
            @endif
            @if($list)
                <thead>
                <tr>
                    @foreach($list[0] as $key => $value)
                        <th>{{$key}}</th>
                    @endforeach

                </tr>

                </thead>
                <tbody>
                @foreach ($list as $key => $record)
                    <tr>
                        @foreach ($record as $key => $value)

                            @if ($key == $ignore)

                            {{--@elseif($key == 'cover_images')--}}

                                {{--<td><img src="{{asset($value['path'])}}" class="img-rounded" width="200"></td>--}}

                            {{--@elseif($key == 'roles_connection_data')--}}

                                {{--@foreach($record['roles_connection_data'] as $role)--}}

                                    {{--<td>{{$role['name']}}</td>--}}
                                {{--@endforeach--}}

                            {{--@elseif($key == 'category_translations')--}}

                                {{--@foreach($record['category_translations'] as $translation)--}}

                                    {{--<td>{{$translation['name']}}</td>--}}
                                {{--@endforeach--}}

                            {{--@elseif($key == 'translations')--}}

                                {{--@foreach($record['translations'] as $translation)--}}

                                    {{--<td>{{$translation['name']}}</td>--}}

                                {{--@endforeach--}}
                            {{--@elseif($key == 'translations_info')--}}

                                {{--@foreach($record['translations_info'] as $translation)--}}

                                    {{--<td>{{$translation['title']}}</td>--}}

                                {{--@endforeach--}}

                            @else
                                <td>
                                    {{$value}}
                                </td>
                            @endif
                        @endforeach

                        @if(isset($showDelete))

                            <td><a href="{{route($showDelete, $record['id'])}}"
                                   class="btn btn-primary btn-sm">View</a>
                            </td>
                        @endif

                        @if(isset($edit))

                            <td><a href="{{route($edit, [$record['id'], app()->getLocale()])}}"
                                   class="btn btn-info btn-sm">Edit</a>
                            </td>
                        @endif
                        @if(isset($showDelete))

                            <td><a onclick="deleteItem('{{route($showDelete, $record['id'])}}')"
                                   class="btn btn-info btn-sm">Delete</a>
                            </td>
                        @endif
                            @if(isset($is_active))

                                <td><a href="{{''}}"
                                       class="btn btn-info btn-sm">{{trans('app.is_active')}}</a>
                                </td>
                            @endif

                    </tr>

                @endforeach

                </tbody>
    @else
        {{'No items!'}}
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
                },
                error: function () {
                    alert('ERROR');
                }
            });
        }

    </script>
@endsection
