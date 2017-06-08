<div id="menu">
    <h3>{{trans('app.admin_side_bar')}}</h3>
    <div>
        <ul>
            <a href="{{ url('/admin/pages/')}}">{{trans('app.pages')}}</a><br>
            <a href="{{ url('/admin/categories/')}}">{{trans('app.categories')}}</a><br>
            <a href="{{ url('/admin/resources/')}}">{{trans('app.resources')}}</a><br>
            <a href="{{ url('/admin/orders/')}}">{{trans('app.orders')}}</a><br>
            <a href="{{ url('/admin/users/')}}">{{trans('app.users')}}</a><br>
            <a href="{{ url('/admin/languages/')}}">{{trans('app.languages')}}</a><br>
            <a href="{{ url('/admin/menus/')}}">{{trans('app.menus')}}</a><br>
        </ul>
    </div>
</div>
