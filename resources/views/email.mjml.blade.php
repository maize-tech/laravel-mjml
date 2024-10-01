<x-mjml::message>
    {{-- Greeting --}}
    <x-mjml::greeting>
        @if (! empty($greeting))
            {!! $greeting !!}
        @else
            @if ($level === 'error')
                @lang('Whoops!')
            @else
                @lang('Hello!')
            @endif
        @endif
    </x-mjml::greeting>

    {{-- Intro Lines --}}
    @foreach ($introLines as $line)
        <x-mjml::line>{!! $line !!}</x-mjml::line>
    @endforeach

    {{-- Action Button --}}
    @isset($actionText)
            <?php
            $color = match ($level) {
                'success' => '#48bb78',
                'error' => '#e53e3e',
                default => '#2d3748',
            };
            ?>
        <x-mjml::button :url="$actionUrl" :color="$color">
            {{ $actionText }}
        </x-mjml::button>
    @endisset

    {{-- Outro Lines --}}
    @foreach ($outroLines as $line)
        <x-mjml::line>{!! $line !!}</x-mjml::line>
    @endforeach

    {{-- Salutation --}}
    <x-mjml::line>
        @if (! empty($salutation))
            {!! $salutation !!}
        @else
            @lang('Regards'),<br>
            {{ config('app.name') }}
        @endif
    </x-mjml::line>

    {{-- Subcopy --}}
    @isset($actionText)
        <x-slot:subcopy>
            @lang(
                "If you're having trouble clicking the \":actionText\" button, copy and paste the URL below\n".
                'into your web browser:',
                [
                    'actionText' => $actionText,
                ]
            ) [{{ $displayableActionUrl }}]({{ $actionUrl }})
        </x-slot:subcopy>
    @endisset
</x-mjml::message>
