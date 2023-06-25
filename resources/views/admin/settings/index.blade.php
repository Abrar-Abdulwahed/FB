@extends('layouts.admin')
@section('title', 'إعدادات الموقع')
@push('css')
    <style>
        .img-preview {
            width: 200px;
            height: 200px;
            box-shadow: 0px 0px 20px 5px rgba(100, 100, 100, 0.1);
        }

        .img-preview input {
            display: none;
        }

        .img-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .img-preview div {
            position: relative;
            height: 40px;
            margin-top: -40px;
            background: rgba(0, 0, 0, 0.5);
            text-align: center;
            line-height: 40px;
            font-size: 13px;
            color: #f5f5f5;
            font-weight: 600;
        }

        .img-preview div span {
            font-size: 40px;
        }
    </style>
@endpush
@section('content')
    @if (session()->has('success'))
        <p class="alert alert-success" role="alert">
            {{ session('success') }}</p>
    @endif
    @if (session()->has('error'))
        <p class="alert alert-danger">{{ session('error') }}</p>
    @endif
    <div class="card shadow-sm">
        <div class="card-header bg-dark">
            إعدادات الموقع
        </div>
        <div class="card-body">
            <div class="col-12">
                <div class="card card-dark card-outline card-outline-tabs">
                    <div class="card-header p-0 pt-1 bg-gray-light">
                        <ul class="nav nav-tabs" id="settings" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link  {{ $errors->hasAny(['app_name', 'site_description', 'site_logo', 'site_status', 'reason_locked']) ? 'bg-danger' : '' }}"
                                    id="general-settings-tab" data-toggle="pill" href="#general-settings" role="tab"
                                    aria-controls="general-settings" aria-selected="true">إعدادات عامة</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $errors->hasAny(['google_client_id', 'google_client_secret', 'google_client_redirect', 'facebook_client_id', 'facebook_client_secret', 'facebook_client_redirect']) ? 'bg-danger' : '' }}"
                                    id="login-settings-tab" data-toggle="pill" href="#login-settings" role="tab"
                                    aria-controls="login-settings" aria-selected="false">تطبيقات تسجيل الدخول</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $errors->hasAny(['mail_mailer', 'mail_host', 'mail_port', 'mail_username', 'mail_password', 'mail_from_address', 'mail_from_name']) ? 'bg-danger' : '' }}"
                                    id="smtp-settings-tab" data-toggle="pill" href="#smtp-settings" role="tab"
                                    aria-controls="smtp-settings" aria-selected="false">SMTP</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $errors->hasAny(['recaptcha_site_key', 'recaptcha_secret_key']) ? 'bg-danger' : '' }}"
                                    id="recaptcha-settings-tab" data-toggle="pill" href="#recaptcha-settings" role="tab"
                                    aria-controls="recaptcha-settings" aria-selected="false">حروف التحقق</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $errors->hasAny(['recaptcha_site_key', 'recaptcha_secret_key']) ? 'bg-danger' : '' }}"
                                    id="additional-settings-tab" data-toggle="pill" href="#additional-settings"
                                    role="tab" aria-controls="additional-settings" aria-selected="false">إعدادات
                                    إضافية</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <form method="POST" action={{ route('admin.settings.store') }} enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content" id="settingsContent">
                                <div class="tab-pane fade show active" id="general-settings" role="tabpanel"
                                    aria-labelledby="general-settings-tab">
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="app_name">اسم الموقع</label>
                                                <input type="text" name="app_name" class="form-control" id="app_name"
                                                    placeholder="ادخل اسم الموقع"
                                                    value="{{ old('app_name') ?? $settings['app.name'] }}">
                                                @error('app_name')
                                                    <p class="text-danger small">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="">
                                                <label for="site_logo">شعار الموقع</label>
                                                <div class="img-preview">
                                                    <input type="file" id="file-1" accept="image/*" name="site_logo">
                                                    <label for="file-1" id="file-1-preview" class="w-100 h-100">
                                                        <img src={{ $settings['site_logo'] ? asset('storage/' . $settings['site_logo']) : 'https://bit.ly/3ubuq5o' }}
                                                            alt="">
                                                        <div>
                                                            <span>+</span>
                                                        </div>
                                                    </label>
                                                </div>
                                                @error('site_logo')
                                                    <p class="text-danger small">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="site_description">وصف الموقع</label>
                                            <textarea class="form-control" id="site_description" rows="10" name="site_description" placeholder="اكتب النص هنا">{{ old('site_description') ?? $settings['site_description'] }}</textarea>
                                            @error('site_description')
                                                <p class="text-danger small">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <label for="site_status">حالة الموقع</label>
                                        <select class="form-control col-md-2" name="site_status" id="site_status">
                                            <option value="">اختر حالة الموقع</option>
                                            <option value="active" @selected($settings['site_status'] == 'active')>
                                                مفتوح
                                            </option>
                                            <option value="inactive" @selected($settings['site_status'] == 'inactive')>
                                                مغلق
                                            </option>
                                        </select>
                                        <div class="form-group mt-4" id="reason_locked_div">
                                            <label for="reason_locked">سبب قفل الموقع</label>
                                            <textarea class="form-control" id="reason_locked" rows="10" name="reason_locked"
                                                placeholder="اكتب سبب قفل الموقع">{{ old('reason_locked') ?? $settings['reason_locked'] }}</textarea>
                                            @error('reason_locked')
                                                <p class="text-danger small">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="login-settings" role="tabpanel"
                                    aria-labelledby="login-settings-tab">
                                    <div>
                                        <label>الفيسبوك</label>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="facebook_client_id" class="text-muted">المعرف</label>
                                                <input type="text" name="facebook_client_id" class="form-control"
                                                    id="facebook_client_id" placeholder="ادخل معرف الفيسبوك "
                                                    value="{{ old('facebook_client_id') ?? $settings['services.facebook.client_id'] }}">
                                                @error('facebook_client_id')
                                                    <p class="text-danger small">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="facebook_client_secret" class="text-muted">كلمة
                                                    الأمان</label>
                                                <input type="text" name="facebook_client_secret" class="form-control"
                                                    id="facebook_client_secret" placeholder="ادخل كلمة أمان الفيسبوك "
                                                    value="{{ old('facebook_client_secret') ?? $settings['services.facebook.client_secret'] }}">
                                                @error('facebook_client_secret')
                                                    <p class="text-danger small">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="facebook_client_redirect" class="text-muted">رابط
                                                    التوجيه</label>
                                                <input type="text" name="facebook_client_redirect"
                                                    class="form-control" id="facebook_client_redirect"
                                                    placeholder="ادخل رابط التوجيه"
                                                    value="{{ old('facebook_client_redirect') ?? $settings['services.facebook.client_redirect'] }}">
                                                @error('facebook_client_redirect')
                                                    <p class="text-danger small">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <label>جوجل</label>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="google_client_id" class="text-muted">المعرف</label>
                                                <input type="text" name="google_client_id" class="form-control"
                                                    id="google_client_id" placeholder="ادخل معرف جوجل "
                                                    value="{{ old('google_client_id') ?? $settings['services.google.client_id'] }}">
                                                @error('google_client_id')
                                                    <p class="text-danger small">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="google_client_secret" class="text-muted">كلمة
                                                    الأمان</label>
                                                <input type="text" name="google_client_secret" class="form-control"
                                                    id="google_client_secret" placeholder="ادخل كلمة أمان جوجل "
                                                    value="{{ old('google_client_secret') ?? $settings['services.google.client_secret'] }}">
                                                @error('google_client_secret')
                                                    <p class="text-danger small">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="google_client_redirect" class="text-muted"> رابط
                                                    التوجيه
                                                </label>
                                                <input type="text" name="google_client_redirect" class="form-control"
                                                    id="google_client_redirect" placeholder="ادخل رابط التوجيه"
                                                    value="{{ old('google_client_redirect') ?? $settings['services.google.client_redirect'] }}">
                                                @error('google_client_redirect')
                                                    <p class="text-danger small">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="smtp-settings" role="tabpanel"
                                    aria-labelledby="smtp-settings-tab">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="mail_mailer" class="text-muted">بريد الارسال</label>
                                            <input type="text" name="mail_mailer" class="form-control"
                                                id="mail_mailer" placeholder="ادخل بريد الارسال"
                                                value="{{ old('mail_mailer') ?? $settings['mail.default'] }}" readonly>
                                            @error('mail_mailer')
                                                <p class="text-danger small">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="mail_host" class="text-muted">مضيف البريد</label>
                                            <input type="text" name="mail_host" class="form-control" id="mail_host"
                                                placeholder="ادخل مضيف البريد"
                                                value="{{ old('mail_host') ?? $settings['mail.mailers.smtp.host'] }}">
                                            @error('mail_host')
                                                <p class="text-danger small">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="mail_port" class="text-muted">منفذ البريد</label>
                                            <input type="text" name="mail_port" class="form-control" id="mail_port"
                                                placeholder="ادخل منفذ البريد"
                                                value="{{ old('mail_port') ?? $settings['mail.mailers.smtp.port'] }}">
                                            @error('mail_port')
                                                <p class="text-danger small">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row mt-3">
                                        <div class="form-group col-md-6">
                                            <label for="mail_username" class="text-muted">اسم مستخدم البريد</label>
                                            <input type="text" name="mail_username" class="form-control"
                                                id="mail_username" placeholder="ادخل اسم مستخدم البريد"
                                                value="{{ old('mail_username') ?? $settings['mail.mailers.smtp.username'] }}">
                                            @error('mail_username')
                                                <p class="text-danger small">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="mail_password" class="text-muted">كلمة سر البريد</label>
                                            <input type="text" name="mail_password" class="form-control"
                                                id="mail_password" placeholder="ادخل كملة سر البريد"
                                                value="{{ old('mail_password') ?? $settings['mail.mailers.smtp.password'] }}">
                                            @error('mail_password')
                                                <p class="text-danger small">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row mt-3">
                                        <div class="form-group col-md-6">
                                            <label for="mail_from_address" class="text-muted">عنوان المرسل</label>
                                            <input type="text" name="mail_from_address" class="form-control"
                                                id="mail_from_address" placeholder="ادخل عنوان المرسل"
                                                value="{{ old('mail_from_address') ?? $settings['mail.from.address'] }}">
                                            @error('mail_from_address')
                                                <p class="text-danger small">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="mail_from_name" class="text-muted">اسم المرسل</label>
                                            <input type="text" name="mail_from_name" class="form-control"
                                                id="mail_from_name" placeholder="ادخل اسم المرسل"
                                                value="{{ old('mail_from_name') ?? $settings['mail.from.name'] }}">
                                            @error('mail_from_name')
                                                <p class="text-danger small">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="recaptcha-settings" role="tabpanel"
                                    aria-labelledby="recaptcha-settings-tab">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="recaptcha_site_key" class="text-muted">المعرف</label>
                                            <input type="text" name="recaptcha_site_key" class="form-control"
                                                id="recaptcha_site_key" placeholder="ادخل معرف حروف التحقق"
                                                value="{{ old('recaptcha_site_key') ?? $settings['recaptcha.api_site_key'] }}">
                                            @error('recaptcha_site_key')
                                                <p class="text-danger small">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="recaptcha_secret_key" class="text-muted">كلمة الأمان</label>
                                            <input type="text" name="recaptcha_secret_key" class="form-control"
                                                id="recaptcha_secret_key" placeholder="ادخل كلمة أمان حروف التحقق "
                                                value="{{ old('recaptcha_secret_key') ?? $settings['recaptcha.api_secret_key'] }}">
                                            @error('recaptcha_secret_key')
                                                <p class="text-danger small">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="additional-settings" role="tabpanel"
                                    aria-labelledby="additional-settings-tab">
                                    <h5 class="text-muted mb-3">إضافة أو إلغاء بعض الميزات في الموقع</h5>
                                    <div class="custom-control custom-switch mt-2">
                                        <input type="checkbox" class="custom-control-input" id="faq-status"
                                            name="faq_status" value="{{ $settings['faq_status'] }}"
                                            @checked($settings['faq_status'] == 'on')>
                                        <label class="custom-control-label" for="faq-status">الأسئلة الشائعة</label>
                                    </div>
                                    <div class="custom-control custom-switch mt-2">
                                        <input type="checkbox" class="custom-control-input" id="article-status"
                                            name="article_status" value="{{ $settings['article_status'] }}"
                                            @checked($settings['article_status'] == 'on')>
                                        <label class="custom-control-label" for="article-status">المقالات</label>
                                    </div>
                                    <div class="custom-control custom-switch mt-2">
                                        <input type="checkbox" class="custom-control-input" id="page-status"
                                            name="page_status" value="{{ $settings['page_status'] }}"
                                            @checked($settings['page_status'] == 'on')>
                                        <label class="custom-control-label" for="page-status">المدونات</label>
                                    </div>

                                    {{-- <div class="card card-secondary">
                                        <div class="card-header">
                                            <h3 class="card-title">Bootstrap Switch</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-animate bootstrap-switch-off"
                                                style="width: 85.6px;">
                                                <div class="bootstrap-switch-container"
                                                    style="width: 126px; margin-left: -42px;"><span
                                                        class="bootstrap-switch-handle-on bootstrap-switch-primary"
                                                        style="width: 42px;">ON</span>
                                                    <span class="bootstrap-switch-label"
                                                        style="width: 42px;">&nbsp;</span>
                                                    <span class="bootstrap-switch-handle-off bootstrap-switch-default"
                                                        style="width: 42px;">OFF</span>
                                                    <input type="checkbox" name="my-checkbox" checked="">
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                            <button type="submit" class="btn btn-dark mt-4 d-inline-block">حفظ</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('js/previewImage.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
    <script>
        $(document).ready(function() {
            if ($('#site_status').val() === 'inactive') {
                $('#reason_locked').prop('disabled', false);
            } else {
                $('#reason_locked').val('').prop('disabled', true);
            }

            $('#site_status').change(function() {
                var selectedValue = $(this).val();
                if (selectedValue === 'inactive') {
                    $('#reason_locked').prop('disabled', false);
                } else {
                    $('#reason_locked').val('').prop('disabled', true);
                }
            });

            $("input[data-bootstrap-switch]").each(function() {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            })

        });
    </script>
@endpush
