@php
$menus = App\Models\SiteInfo::$SideMenu;
@endphp

<header class="header-mobile">
    <div class="header-mobile__bar">
        <div class="container">
            <div class="header-mobile-inner">
                <a class="logo" href="{{ url('/admin') }}">
                    <img src="{{asset('public/images/bp-logo.png')}}" style="width:45px;height: 45px;" alt="CoolAdmin">
                </a>
                <button class="hamburger hamburger--slider" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar-mobile">

        <ul class="navbar-mobile__list list-unstyled">
            @foreach ($menus as $menu)
            @if (!empty($menu['sublist']))
            <li class="active has-sub">
                <a class="js-arrow" href="#">
                    <i class=" {{ $menu['icon'] }} "></i>{{$menu['name']}}</a>
                <ul class="list-unstyled navbar__sub-list js-sub-list">
                    @foreach ($menu['sublist'] as $sublist)
                    <li>
                        <a href="{{url($sublist['url'])}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i
                                class=" {{ $sublist['icon'] }} "></i> {{$sublist['name']}}</a>
                    </li>
                    @endforeach
                </ul>
            </li>
            @else
            <li>
                <a href="{{url($menu['url'])}}">
                    <i class="{{$menu['icon']}}"></i>{{$menu['name']}}</a>
            </li>
            @endif
            @endforeach
        </ul>

    </nav>
</header>
