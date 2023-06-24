<!-- Top Header -->
<div class="top-header desktop-only">
    <div class="container">
        <div class="th-wrap">
            <div class="th-left">
                <ul>
                    @if ($appSetting->email)
                        <li><i class="las la-envelope-open-text"></i>{{ $appSetting->email }}</li>
                    @endif
                    @if ($appSetting->phone)
                        <li><i class="las la-phone-volume"></i> {{ @$appSetting->phone[0]['phone_number'] }}</li>
                    @endif
                </ul>
            </div>
            <div class="thl-right">
                <div class="socail-media">
                    <ul>
                        @if ($appSetting->facebook)
                            <li class="facebook"><a href="{{ $appSetting->facebook }}"><i
                                        class="lab la-facebook-f"></i></a></li>
                        @endif
                        @if ($appSetting->youtube)
                            <li class="youtube"><a href="{{ $appSetting->youtube }}"><i
                                        class="lab la-youtube"></i></a></li>
                        @endif
                        @if ($appSetting->twitter)
                            <li class="skype"><a href="{{ $appSetting->twitter }}"><i
                                        class="lab la-twitter"></i></a></li>
                        @endif
                        @if ($appSetting->skype)
                            <li class="skype"><a href="{{ $appSetting->skype }}"><i
                                        class="lab la-skype"></i></a></li>
                        @endif
                    </ul>
                </div>
                <div class="account">
                    <ul>
                        <li><a href="#" target="_blank"><i class="fas fa-envelope-open"></i> Check Mail</a></li>
                       
                        <li><a href="{{ route('login') }}"><i class="far fa-user"></i> Login</a></li>
                        <li><a href="{{ route('register') }}"><i class="fas fa-sign-in-alt"></i> Register</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Top Header End -->
<!-- Header Middle -->
<div class="header-middle">
    <div class="container">
        <div class="mh-wrap">
            <div class="logo">
                <a href="{{ route('index') }}">
                    <img src="{{ $appSetting->logo_url }}" alt="images"></a>
            </div>
            <div class="flag">
                <img src="{{ asset('front/img/flag.gif') }}" alt="images">
            </div>
            <div class="toggle-btn">
                <div class="toggle-wrap">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="toggle-wrap">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="toggle-wrap">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Header Middle End -->
<!-- Header -->
<header id="header" class="header">
    <div class="header-col">
        <div class="container">
            <div class="h-wrap">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            @foreach ($headerMenu as $item)
                                @if (count($item['child']))
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ $item['title'] }}
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            @foreach ($item['child'] as $childMenu)
                                                <li> <a href="{{ $childMenu['href'] }}"
                                                        target="{{ $childMenu['target'] }}">{{ $childMenu['title'] }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    @continue

                                @endif
                                @if ($item['title'] == 'Tracking')
                                    <li class="nav-item tracking" role="progressbar" aria-valuenow="100"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                        <a class="nav-link" aria-current="page" href=" {{ $item['href'] }}"
                                            target="">{{ $item['title'] }}</a>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href=" {{ $item['href'] }}"
                                            target="{{ $item['target'] }}">{{ $item['title'] }}</a>
                                    </li>
                                @endif

                            @endforeach

                        </ul>
                    </div>
                </nav>
                <div class="search">
                    <div class="search-box">
                        <i class="flaticon-search"></i>
                    </div>
                    <div class="search-overlay">
                        <div class="d-table">
                            <div class="d-table-cell">
                                <div class="search-overlay-layer"></div>
                                <div class="search-overlay-layer"></div>
                                <div class="search-overlay-layer"></div>
                                <div class="search-overlay-close">
                                    <span class="search-overlay-close-line"></span>
                                    <span class="search-overlay-close-line"></span>
                                </div>
                                <div class="search-overlay-form">
                                    <form>
                                        <input type="text" class="input-search" placeholder="Search here...">
                                        <button type="submit"><i class="flaticon-search"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="scroll-news">
        <div class="container">
            <div class="scroll-news-wrap">
                <h3>Update</h3>
                <marquee behavior="scroll" direction="left" onMouseOver="this.stop()" onMouseOut="this.start()">
                    <ul>
                        @foreach ($latestNews as $update)
                            <li>
                                <a href="{{ route('blogDetails', $update->slug) }}">
                                    {{ $update->title['en'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </marquee>
            </div>
        </div>
    </div>
</header>
<!-- Header End -->
<!-- Mobile Menu -->
<div id="mySidenav" class="sidenav">
    <div class="mobile-logo">
        <a href="index.html"><img src="{{ $appSetting->logo_url }}" alt="logo"></a>
        <a href="javascript:void(0)" id="close-btn" class="closebtn">&times;</a>
    </div>
    <div class="no-bdr1">
        <ul id="menu1">
            @foreach ($sidebar as $sidebarItem)
                @if (count($sidebarItem['child']))
                    <li>
                        <a href="#" class="has-arrow">{{ $sidebarItem['title'] }}</a>
                        <ul>
                            @foreach ($sidebarItem['child'] as $item)
                                <li>
                                    <a href="{{ $item['href'] }}"
                                        target="{{ $item['target'] }}">{{ $item['title'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    @continue
                @endif
                <li><a href="{{ $sidebarItem['href'] }}"
                        target="{{ $sidebarItem['target'] }}">{{ $sidebarItem['title'] }}</a></li>
            @endforeach
        </ul>
        <div class="mobile-contact-details">
            <div class="th-left">
                <ul>
                    @if ($appSetting->email)
                        <li><i class="las la-envelope-open-text"></i>{{ $appSetting->email }}</li>
                    @endif
                    @if ($appSetting->phone)
                        <li><i class="las la-phone-volume"></i> {{ @$appSetting->phone[0]['phone_number'] }}</li>
                    @endif
                </ul>
            </div>
            <div class="account">
                <ul>
                    <li><a href="#" target="_blank"><i class="fas fa-envelope-open"></i> Check Mail</a></li>
                   
                    <li><a href="{{ route('login') }}"><i class="far fa-user"></i> Login</a></li>
                    <li><a href="{{ route('register') }}"><i class="fas fa-sign-in-alt"></i> Register</a></li>
                </ul>
            </div>
            <div class="socail-media">
                <ul>
                    @if ($appSetting->facebook)
                        <li class="facebook"><a href="{{ $appSetting->facebook }}"><i
                                    class="lab la-facebook-f"></i></a></li>
                    @endif
                    @if ($appSetting->youtube)
                        <li class="youtube"><a href="{{ $appSetting->youtube }}"><i
                                    class="lab la-youtube"></i></a></li>
                    @endif
                    @if ($appSetting->twitter)
                        <li class="skype"><a href="{{ $appSetting->twitter }}"><i
                                    class="lab la-twitter"></i></a></li>
                    @endif
                    @if ($appSetting->skype)
                        <li class="skype"><a href="{{ $appSetting->skype }}"><i
                                    class="lab la-skype"></i></a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Mobile Menu End -->
