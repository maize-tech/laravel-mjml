<x-mjml::layout>
    {{-- Header --}}
    <x-slot:header>
        <x-mjml::header :url="config('app.url')">
            {{ config('app.name') }}
        </x-mjml::header>
    </x-slot:header>

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @isset($subcopy)
        <x-slot:subcopy>
            <x-mjml::subcopy>
                {{ $subcopy }}
            </x-mjml::subcopy>
        </x-slot:subcopy>
    @endisset

    {{-- Footer --}}
    <x-slot:footer>
        <x-mjml::footer>
            © {{ date('Y') }} {{ config('app.name') }}. {{ __('All rights reserved.') }}
        </x-mjml::footer>
    </x-slot:footer>
</x-mjml::layout>
