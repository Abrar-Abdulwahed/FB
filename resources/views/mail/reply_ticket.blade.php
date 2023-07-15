<x-mail::message>
    # أهلا بك!

    {!! $message !!}

    <x-mail::button :url="$ticket_link">
        انتقل إلى التذكرة التي انشأتها
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
