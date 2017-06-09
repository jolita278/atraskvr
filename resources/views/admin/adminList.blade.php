@extends('admin.adminBase')

@section('adminList')
    <div id="list">
        <div class="container">

            <h2> {{$listName}}</h2>

            <table class="table table-hover">
                @if(isset($url))
                    <a href="{{$url}}" class="btn btn-primary" role="button">
                        Add new</a>
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
                        <tr>
                            @foreach ($record as $key => $value)

                                <td>
                                    @if($key == 'is_active')
                                        @if($value == 1)

                                            <a onclick="toggleActive('{{route($call_to_action, $record['id']), 1}}')"
                                               class="btn btn-success btn-sm" style="display :none;">{{trans('app.activate')}}</a>

                                            <a onclick="toggleActive('{{route($call_to_action, $record['id']), 0}}')"
                                               class="btn btn-danger btn-sm">{{trans('app.deactivate')}}</a>

                                        @else

                                            <a onclick="toggleActive('{{route($call_to_action, $record['id']), 1}}')"
                                               class="btn btn-success btn-sm">{{trans('app.activate')}}</a>

                                            <a onclick="toggleActive('{{route($call_to_action, $record['id']), 0}}')"
                                               class="btn btn-danger btn-sm" style="display :none;">{{trans('app.deactivate')}}</a>

                                        @endif

                                    @else

                                        {{$value}}

                                    @endif
                                </td>
                            @endforeach


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

        function toggleActive(url, value)
        {
            $.ajax({

                dataType: 'json',
                type: 'POST',
                success: function () {
                    alert('UPDATED');
                },
                error: function () {
                    alert('ERROR');
                }
            });
        }

    </script>

@endsection
