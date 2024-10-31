<x-mjml::message>
    {{-- Greeting --}}
    <x-mjml::line>
        @if (! empty($greeting))
            # {{ $greeting }}
        @else
            @if ($level === 'error')
                # @lang('Whoops!')
            @else
                # @lang('Hello!')
            @endif
        @endif
    </x-mjml::line>

    {{-- Intro Lines --}}
    <x-mjml::line>
        {!! implode(PHP_EOL . PHP_EOL, $introLines) !!}
    </x-mjml::line>

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
    <x-mjml::line>
        {!! implode(PHP_EOL . PHP_EOL, $outroLines) !!}
    </x-mjml::line>

    {{-- Salutation --}}
    <x-mjml::line>
        @if (! empty($salutation))
            {{ $salutation }}
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
