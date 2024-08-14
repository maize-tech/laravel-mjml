@props(['url', 'color' => '#2d3748', 'align' => 'center'])
<mj-button
    background-color="{{ $color }}"
    color="#ffffff"
    href="{{ $url }}"
    font-size="16px"
    border-radius="4px"
    padding="30px 0"
    inner-padding="8px 18px"
    align="{{ $align }}"
>
    {{ $slot }}
</mj-button>
