<header id="site_header">
    <!-- Site header here  -->
    <div class="topnav">
        <nav class="container">
            <a href="{{route('admin')}}">Admin</a>
            <a href="#">DC Power</a>
            <a href="#">Additional dc Sites</a>

        </nav>
    </div>
    <nav class="menu_wrapper">
        <div class="container d_flex align_center">
            <div class="logo">
                <!-- LOGO HERE -->
                <img src="{{asset('img/dc-logo.png')}}" alt="dc logo">
            </div>
            <div class="main_menu">
                <ul class="list_inline">
                    @foreach(config('db.menu') as $item)
                    <li><a class="{{ Route::currentRouteName() === $item['href'] ? 'active' :'' }}" href="{{ route($item['href']) }}"> {{ $item['text'] }}</a></li>
                    @endforeach

                </ul>
            </div>
        </div>
    </nav>

</header>
