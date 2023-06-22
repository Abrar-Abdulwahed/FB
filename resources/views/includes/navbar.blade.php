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
        {{-- <div class="justify_content_end">
            {{ auth()->user()->name }}
        </div> --}}
        {{-- <li class="nav-item">
            <a href={{ url('/admin/custom-messages') }} class="nav-link">
                <i class="fa-solid fa-message"></i>
                الرسائل المخصصة
            </a>
        </li> --}}
    </ul>
    <div class="mr-0 ml-auto">
        <button type="button" class="btn btn-transparent dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="{{ auth()->user()->avatar_path }}" style="width:50px; height:50px" class="img-circle">

            {{ Auth::user()->name }}
        </button>
        <ul class="dropdown-menu" style="">
            <li class="dropdown-item"><a href="#">Action</a></li>
            <li class="dropdown-item"><a href="{{ route('settings.index') }}">الإعدادات</a></li>
            <li class="dropdown-divider"></li>
            <li class="dropdown-item"><i class="nav-icon fa-solid fa-sign-out"></i> <a
                    class="text-dark text-decoration-none" href="{{ route('logout') }}">تسجيل
                    الخروج</a></li>
        </ul>
    </div>
</nav>
