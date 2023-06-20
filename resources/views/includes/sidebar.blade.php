<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info text-center">
                <a href="#" class="d-block">
                    {{-- {{ Auth::user()->name }} --}}
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="#" class="nav-link">
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
                        <li class="nav-item">
                            <a href={{ route('custom-message.create') }} class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>إنشاء رسالة مخصصة</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href={{ route('custom-message.index') }} class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>قائمة الرسائل المخصصة</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.index') }}">
                        <i class="nav-icon fa-solid fa-user"></i>الأعضاء</a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
