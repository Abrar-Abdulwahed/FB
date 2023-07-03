<x-mail::message>
    # أهلا بك!

    {{ $message }}

    <x-mail::button :url="url('/')">
        الصفحة الرئيسية
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
