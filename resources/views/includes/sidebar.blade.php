<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info text-center">
                
                   
                    <img src="{{ asset('users/'.auth()->user()->avatar) }}" class="rounded circle">
                    {{ auth()->user()->name }}
                
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item @if(Route::is('admin.index'))  ? 'active' : '' bg-primary @endif">
                    <a href="{{ route('admin.index')}}" class="nav-link">
                        <i class="nav-icon fa-solid fa-house"></i>
                        <p>
                            الصفحة الرئيسية
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-message"></i>
                        <p>
                            الرسائل المخصصة
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item @if(Route::is('custom-message.create')) ? 'active' : '' bg-primary @endif">
                            <a href={{ route('custom-message.create') }} class="nav-link">
                                {{-- <i class="far fa-circle nav-icon"></i> --}}
                                <p>إنشاء رسالة مخصصة</p>
                            </a>
                        </li>
                        <li class="nav-item @if(Route::is('custom-message.index')) ? 'active' : '' bg-primary @endif ">
                            <a href={{ route('custom-message.index') }} class="nav-link">
                                {{-- <i class="far fa-circle nav-icon"></i> --}}
                                <p>قائمة الرسائل المخصصة</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-user"></i
                        <p>
                             ادارة المستخدمين
                             <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item @if(Route::is('users.index'))  ? 'active' : '' bg-primary @endif">
                            <a class="nav-link" href="{{ route('users.index') }}">
                                {{-- <i class="far fa-circle nav-icon"></i> --}}الأعضاء
                            </a>
                        </li>
                        <li class="nav-item @if(Route::is('roles.index'))  ? 'active' : '' bg-primary @endif">
                            <a class="nav-link" href="{{ route('roles.index') }}">
                                {{-- <i class="far fa-circle nav-icon"></i> --}}الأدوار
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-newspaper"></i>
                        <p>
                                ادارة المدونات
                             <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item @if(Route::is('articles.index'))  ? 'active' : '' bg-primary @endif">
                            <a class="nav-link" href="{{ route('articles.index') }}">
                                {{-- <i class="far fa-circle nav-icon"></i> --}}المقالات
                            </a>
                        </li>
                        <li class="nav-item @if(Route::is('tags.index'))  ? 'active' : '' bg-primary @endif">
                            <a class="nav-link" href="{{ route('tags.index') }}">
                                {{-- <i class="far fa-circle nav-icon"></i> --}}Tags
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link d-flex justify-content-between">
                        <p>
                            تسجيل الخروج
                        </p>
                        <p>
                            <i class="nav-icon fa-solid fa-sign-out"></i>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
