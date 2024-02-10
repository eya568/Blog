<x-mail::message>
    # Introduction
    Thank you for joining our community. We're excited to have you on board.

    <x-mail::button :url="''">
        Button Text
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
