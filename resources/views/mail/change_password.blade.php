<x-mail::message>
    # تغيير كلمة السر


    {{ $message }}

    <x-mail::button :url="url('/')">
        الصفحة الرئيسية
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
