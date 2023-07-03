<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
        <div class="user-pan e mt-3 pb-3 mb-3 d-f lex text-white">
            <div class="info text-center">
                <img src="{{ auth()->user()->avatar_image }}" style="border-radius: 50%" width="60px" height="60px">
                <p class="text-center">{{ auth()->user()->name }}</p>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item @if (Route::is('admin.index')) ? 'active' : '' bg-primary @endif">
                    <a href="{{ route('admin.index') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-house"></i>
                        <p>
                            الصفحة الرئيسية
                        </p>
                    </a>
                </li>
                <li
                    class="nav-item {{ Route::is('admin.custom-message.create') || Route::is('admin.custom-message.index') || Route::is('admin.custom-message.edit') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-message"></i>
                        <p>
                            الرسائل المخصصة
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item @if (Route::is('admin.custom-message.create')) ? 'active' : '' bg-primary @endif">
                            <a href={{ route('admin.custom-message.create') }} class="nav-link">
                                <i class="fa fa-commenting nav-icon"></i>
                                <p>إنشاء رسالة مخصصة</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li
                class="nav-item {{ Route::is('admin.custom-message.create') || Route::is('admin.custom-message.index') || Route::is('admin.custom-message.edit') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa-solid fa-message"></i>
                    <p>
                        التذاكر
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">

                    <li class="nav-item @if (Route::is('admin.tickets.index')) ? 'active' : '' bg-primary @endif ">
                        <a href={{ route('admin.tickets.index') }} class="nav-link">
                            {{-- <i class="far fa-circle nav-icon"></i> --}}
                            <p>قائمة التذاكر</p>
                        </a>
                    </li>
                    <li class="nav-item @if (Route::is('admin.TicketsCategory.index')) ? 'active' : '' bg-primary @endif ">
                        <a href={{ route('admin.TicketsCategory.index') }} class="nav-link">
                            {{-- <i class="far fa-circle nav-icon"></i> --}}
                            <p>قائمة تصنيفات التذاكر</p>
                        </a>
                    </li>
                </ul>
            </li>
                <li class="nav-item {{ Route::is('admin.users.*') || Route::is('admin.roles.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-user"></i>
                        <p>
                            ادارة المستخدمين
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item @if (Route::is('admin.users.*')) ? 'active' : '' bg-primary @endif">
                            <a class="nav-link" href="{{ route('admin.users.index') }}">
                                <i class="far fa-address-book nav-icon"></i>الأعضاء
                            </a>
                        </li>
                        <li class="nav-item @if (Route::is('admin.roles.*')) ? 'active' : '' bg-primary @endif">
                            <a class="nav-link" href="{{ route('admin.roles.index') }}">
                                <i class="fa fa-tasks nav-icon"></i>الأدوار
                            </a>
                        </li>
                    </ul>
                </li>
                @if (\App\Models\Setting::where('name', 'article_enable')?->first()?->value == 'on')
                    <li
                        class="nav-item {{ Route::is('admin.articles.*') || Route::is('admin.comments.*') || Route::is('admin.deleted_comments.*') || Route::is('admin.tags.*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa-solid fa-newspaper"></i>
                            <p>
                                ادارة المدونات
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item @if (Route::is('admin.articles.*')) ? 'active' : '' bg-primary @endif">
                                <a class="nav-link" href="{{ route('admin.articles.index') }}">
                                    <i class="fa fa-list-alt nav-icon"></i>المقالات
                                </a>
                            </li>
                            <li class="nav-item @if (Route::is('admin.comments.*')) ? 'active' : '' bg-primary @endif">
                                <a class="nav-link" href="{{ route('admin.comments.index') }}">
                                    <i class="fa fa-list-alt nav-icon"></i>عرض التعليقات
                                </a>
                            </li>
                            <li class="nav-item @if (Route::is('admin.deleted_comments.*')) ? 'active' : '' bg-primary @endif">
                                <a class="nav-link" href="{{ route('admin.deleted_comments.index') }}">
                                    <i class="fa fa-list-alt nav-icon"></i>عرض التعليقات المحذوفة 
                                </a>
                            </li>
                            <li class="nav-item @if (Route::is('admin.tags.*')) ? 'active' : '' bg-primary @endif">
                                <a class="nav-link" href="{{ route('admin.tags.index') }}">
                                    <i class="fa fa-tag nav-icon"></i>Tags
                                </a>
                            </li>
                            <li class="nav-item @if (Route::is('admin.pages.index')) ? 'active' : '' bg-primary @endif">
                                <a class="nav-link" href="{{ route('admin.pages.index') }}">
                                    <i class="far fa-circle nav-icon"></i> الصفحات
                                </a>
                            </li>
                            <li class="nav-item @if (Route::is('admin.articles-categories.index')) ? 'active' : '' bg-primary @endif">
                                <a class="nav-link" href="{{ route('admin.articles-categories.index') }}">
                                    <i class="fa-solid fa-section nav-icon"></i> الاقسام
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if (\App\Models\Setting::where('name', 'faq_enable')?->first()?->value == 'on')
                    <li class="nav-item @if (Route::is('admin.faqs.*')) ? 'active' : '' bg-primary @endif">
                        <a class="nav-link" href="{{ route('admin.faqs.index') }}">
                            <i class="nav-icon fa-solid fa-question"></i>الاسئلة الشائعة
                        </a>
                    </li>
                @endif
                <li class="nav-item @if (Route::is('admin.settings.*')) ? 'active' : '' bg-primary @endif">
                <li class="nav-item">
                    <a href="{{ route('admin.settings.index') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-cog"></i>
                        <p>
                            الاعدادات
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.payments.index') }}" class="nav-link">
                        <i class="fa-solid fa-credit-card"></i>
                        <p>
                            اعدادات وسائل الدفع
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('*ads*') ? 'active' : '' }}"
                        href="{{ route('admin.ads.index') }}">
                        <i class="nav-icon fa-solid fa-image"></i> الاعلانات</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link @if (Route::is('admin.short_links*')) ? 'active' : '' bg-primary @endif"
                    href="{{ route('admin.short_links.index') }}">الروابط المختصرة</a>
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
