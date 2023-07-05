<header class="mb-5">
    <nav class="navbar navbar-expand-lg bg-white align-items-start">
        <div class="container" style="flex-direction: row-reverse;">

            @if (Auth::user())
                <div class="mr-0 ml-auto">
                    <button type="button" class="btn btn-transparent dropdown-toggle" data-toggle="dropdown"
                        aria-expanded="false">
                        <img src="{{ auth()->user()->avatar_image }}" style="border-radius: 50%" width="50px"
                            height="50px">

                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu" style="">
                        <li class="dropdown-item"><i class="nav-icon fa-solid fa-cog nav-icon"></i><a
                                href="{{ route('admin.settings.index') }}">الاعدادات </a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="dropdown-item"><i class="nav-icon fa-solid fa-user nav-icon"></i><a
                                href="{{ route('profile.edit', auth()->user()->id) }}">البروفايل</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="dropdown-item"><i class="nav-icon fa-solid fa-plus nav-icon"></i><a
                                href="{{ route('ticket.create') }}">انشاء تذكره</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="dropdown-item"><i class="nav-icon fa-solid fa-newspaper nav-icon"></i><a
                                href="{{ route('ticket.index') }}">قائمه التذاكر</a></li>

                        <li class="dropdown-divider"></li>
                        <li class="dropdown-item"><i class="nav-icon fa-solid fa-sign-out"></i> <a
                                class="text-dark text-decoration-none" href="{{ route('logout') }}">تسجيل
                                الخروج</a></li>
                    </ul>
                </div>
            @else
                <a href="{{ route('login') }}" class="text-black-60 me-2 btn border border-dark-subtle py-2 px-4"
                    type="button">
                    دخول
                    <i class="fa-solid fa-arrow-right-to-bracket pe-1"></i>
                </a>
                <a href="{{ route('register') }}" class="text-black-60 me-2 btn border border-dark-subtle py-2 px-4"
                    type="button">
                    حساب جديد
                    <i class="fa-solid fa-user-plus ps-2"></i>
                </a>
            @endif

            {{ Auth::user()->name }}
            </button>
            <ul class="dropdown-menu" style="">
                <li class="dropdown-item"><i class="nav-icon fa-solid fa-cog nav-icon"></i><a
                        href="{{ route('admin.settings.index') }}">الاعدادات </a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>

                <li class="dropdown-item"><i class="nav-icon fa-solid fa-user nav-icon"></i><a
                        href="{{ route('profile.edit', auth()->user()->id) }}">البروفايل</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>

                <li class="dropdown-item"><i class="nav-icon fa-solid fa-plus nav-icon"></i><a
                        href="{{ route('ticket.create') }}">انشاء تذكره</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>

                <li class="dropdown-item"><i class="nav-icon fa-solid fa-newspaper nav-icon"></i><a
                        href="{{ route('ticket.index') }}">قائمه التذاكر</a></li>

                <li class="dropdown-divider"></li>
                <li class="dropdown-item"><i class="nav-icon fa-solid fa-sign-out"></i> <a
                        class="text-dark text-decoration-none" href="{{ route('logout') }}">تسجيل
                        الخروج</a></li>
            </ul>
        </div>
    @endauth


    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main"
        aria-controls="main" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa-solid fa-bars"></i>
    </button>

    <div class="collapse navbar-collapse" id="main">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link p-2 p-lg-3" aria-current="page" href="#">المقدمة</a>
            </li>
            @foreach (App\Models\Page::where('is_in_menu', 1)->select('title', 'slug')->get() as $page)
                <li class="nav-item">
                    <a class="nav-link p-2 p-lg-3 active"
                        href="{{ route('pages.show', $page->slug) }}">{{ $page->title }}</a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="search ps-3 pe-3 d-none d-lg-block">
        <i class="fa-solid fa-magnifying-glass"></i>
    </div>
    </div>
</nav>
</header>
