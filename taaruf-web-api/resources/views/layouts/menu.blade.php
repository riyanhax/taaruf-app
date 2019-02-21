<li class="{{ Request::is('home') ? 'active' : '' }}">
    <a href="{!! route('home') !!}"><i class="ion ion-speedometer"></i><span>Dashboard</span></a>
</li>

<li class="{{ Request::is('backend/users*') ? 'active' : '' }}">
    <a href="{!! route('backend.users.index') !!}"><i class="ion ion-person"></i><span>Users</span></a>
</li>

<li class="{{ Request::is('backend/kotaTaarufs*') ? 'active' : '' }}">
    <a href="{!! route('backend.kotaTaarufs.index') !!}"><i class="ion ion-map"></i><span>Kota Taaruf</span></a>
</li>

<li class="{{ Request::is('backend/blogs*') ? 'active' : '' }}">
    <a href="{!! route('backend.blogs.index') !!}"><i class="ion ion-ios-paper"></i><span>Blog</span></a>
</li>

<li class="{{ Request::is('backend/banners*') ? 'active' : '' }}">
    <a href="{!! route('backend.banners.index') !!}"><i class="ion ion-image"></i><span>Banners</span></a>
</li>

<li class="{{ Request::is('backend/sliders*') ? 'active' : '' }}">
    <a href="{!! route('backend.sliders.index') !!}"><i class="ion ion-images"></i><span>Sliders</span></a>
</li>

<li class="{{ Request::is('pages*') ? 'active' : '' }}">
    <a href="{!! route('backend.pages.index') !!}"><i class="ion ion-document"></i><span>Pages</span></a>
</li>


<li class="{{ Request::is('proposals*') ? 'active' : '' }}">
    <a href="{!! route('backend.proposals.index') !!}"><i class="ion ion-ios-heart"></i><span>Proposals</span></a>
</li>

<li class="{{ Request::is('appusers*') ? 'active' : '' }}">
    <a href="{!! route('backend.appusers.index') !!}"><i class="ion ion-android-contacts"></i><span>Appusers</span></a>
</li>

