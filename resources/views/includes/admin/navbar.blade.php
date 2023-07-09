<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fa-solid fa-house"></i>
                الصفحة الرئيسية
            </a>
        </li>
    </ul>
    <div class="mr-0 ml-auto">
        <button type="button" class="btn btn-transparent dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="{{ auth()->user()->avatar_image }}" style="border-radius: 50%" width="50px" height="50px">

            {{ Auth::user()->name }}
        </button>
        <ul class="dropdown-menu" style="">

            <li class="dropdown-item"><i class="nav-icon fa-solid fa-user nav-icon"></i><a
                    href="{{ route('user.profile.edit', auth()->user()->id) }}">البروفايل</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>

            <li class="dropdown-item"><i class="nav-icon fa-solid fa-plus nav-icon"></i><a
                    href="{{ route('user.ticket.create') }}">انشاء تذكره</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li class="dropdown-item"><i class="fa-solid fa-question nav-icon"></i><a
                    href="{{ route('guest.support.faq.index') }}">الاسئلة الشائعة</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>

            <li class="dropdown-item"><i class="nav-icon fa-solid fa-newspaper nav-icon"></i><a
                    href="{{ route('user.ticket.index') }}">قائمه التذاكر</a></li>

            <li class="dropdown-divider"></li>
            <li class="dropdown-item"><i class="nav-icon fa-solid fa-sign-out"></i><a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                 {{ __('تسجيل الخروج') }}
             </a></li>
        </ul>
    </div>
</nav>
