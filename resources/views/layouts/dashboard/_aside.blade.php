 <!-- BEGIN: Header-->
 <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav">
                        <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon feather icon-menu"></i></a></li>
                    </ul>
                </div>
                <ul class="nav navbar-nav float-right">

                  <li class="dropdown dropdown-language nav-item">
                    <a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-globe fa-2x"></i></a>
                      <div class="dropdown-menu" aria-labelledby="dropdown-flag">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>

                        @endforeach
                      </div>
                  </li>


                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none"><span class="user-name text-bold-600">{{ auth()->user()->first_name}} {{ auth()->user()->last_name}}</span></div><span><img class="round" src="{{asset('dashboard_files/images/portrait/small/avatar-s-11.jpg')}}" alt="avatar" height="40" width="40"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="feather icon-power"></i> Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- END: Header-->

   <!-- BEGIN: Main Menu-->
   <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="../../../html/ltr/vertical-menu-template-semi-dark/index.html">
                    <div class="brand-logo"></div>
                    <h2 class="brand-text mb-0">Vuexy</h2>
                </a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class=" nav-item"><a href="{{route('dashboard.welcome')}}"><i class="feather icon-home"></i><span class="menu-title">@lang('site.dashboard')</span></a>
            </li>

            @if(auth()->user()->hasPermission('read_categories'))
            <li class="nav-item"><a href="{{route('dashboard.categories.index')}}"><i class="feather icon-list"></i><span class="menu-title">@lang('site.categories')</span></a>
            </li>
            @endif

            @if(auth()->user()->hasPermission('read_products'))
            <li class="nav-item"><a href="{{route('dashboard.products.index')}}"><i class="fa fa-th"></i></i><span class="menu-title">@lang('site.products')</span></a>
            </li>
            @endif

            @if(auth()->user()->hasPermission('read_clients'))
            <li class="nav-item"><a href="{{route('dashboard.clients.index')}}"><i class="fa fa-users"></i><span class="menu-title">@lang('site.clients')</span></a>
            </li>
            @endif

            @if(auth()->user()->hasPermission('read_orders'))
            <li class="nav-item"><a href="{{route('dashboard.orders.index')}}"><i class="fa fa-th"></i></i><span class="menu-title">@lang('site.orders')</span></a>
            </li>
            @endif

            @if(auth()->user()->hasPermission('read_users'))
            <li class="nav-item"><a href="{{route('dashboard.users.index')}}"><i class="feather icon-users"></i><span class="menu-title">@lang('site.users')</span></a>
            </li>
            @endif
            </li>

        </ul>
    </div>
</div>
<!-- END: Main Menu-->
