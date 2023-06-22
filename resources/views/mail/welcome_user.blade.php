<x-mail::message>
    # Hi, {{ $user->name }}

    مرحبا بك في موقعنا

    <x-mail::button :url="''">
        Button Text
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
