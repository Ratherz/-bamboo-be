@php
$menus = App\Models\SiteInfo::$SideMenu;
$menususer = App\Models\SiteInfo::$SideMenuUser;
@endphp

<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img style="width:50px;height: 50px;" src="{{ asset('public/images/bp-logo.png') }}" alt="Cool Admin">
            {{ env('APP_NAME') }}
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                @if (Auth::user()->getIdRoles() == 1)
                    @foreach ($menus as $menu)
                        @if (!empty($menu['sublist']))
                            <li class="has-sub">
                                <a class="js-arrow open" href="#">
                                    <i class="{{ $menu['icon'] }}"></i>{{ $menu['name'] }}</a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list" style="display:block">
                                    @foreach ($menu['sublist'] as $sublist)
                                        @php
                                        $class = url()->current()==url($sublist['url']) ? 'active' : '';
                                        @endphp
                                        <li class="{{ $class }}">
                                            <a href="{{ url($sublist['url']) }}"><i class="{{ $sublist['icon'] }}"
                                                    aria-hidden="true"></i>{{ $sublist['name'] }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            @php
                            $class = url()->current() == url($menu['url']) ? 'active' : '';
                            @endphp
                            <li class="{{ $class }}">
                                <a href="{{ url($menu['url']) }}">
                                    <i class="{{ $menu['icon'] }}"></i>{{ $menu['name'] }}</a>
                            </li>
                        @endif
                    @endforeach
                @else
                    @foreach ($menususer as $menu)
                        @if (!empty($menu['sublist']))
                            <li class="has-sub">
                                <a class="js-arrow open" href="#">
                                    <i class="{{ $menu['icon'] }}"></i>{{ $menu['name'] }}</a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list" style="display:block">
                                    @foreach ($menu['sublist'] as $sublist)
                                        @php
                                        $class = url()->current()==url($sublist['url']) ? 'active' : '';
                                        @endphp
                                        <li class="{{ $class }}">
                                            <a href="{{ url($sublist['url']) }}"><i class="{{ $sublist['icon'] }}"
                                                    aria-hidden="true"></i>{{ $sublist['name'] }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            @php
                            $class = url()->current() == url($menu['url']) ? 'active' : '';
                            @endphp
                            <li class="{{ $class }}">
                                <a href="{{ url($menu['url']) }}">
                                    <i class="{{ $menu['icon'] }}"></i>{{ $menu['name'] }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            </ul>
        </nav>
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
        </div>
    </div>
</aside>
