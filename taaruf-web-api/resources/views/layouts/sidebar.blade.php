<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{route('backend')}}">{!! config('app.name') !!}</a>
    </div>
    <ul class="sidebar-menu">
        @include('layouts.menu')
    </ul>

  <div class="p-3 mt-2 mb-4">
    <a href="#" onclick="$('#logout-form').submit();" class="btn btn-danger btn-shadow btn-round has-icon has-icon-nofloat btn-block">
      <i class="ion ion-log-out"></i> <div>Keluar</div>
    </a>
  </div>
</aside>