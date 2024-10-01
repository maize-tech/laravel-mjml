@props(['url', 'color' => '#2d3748', 'align' => 'center'])
<mj-button
    align="{{ $align }}"
    background-color="{{ $color }}"
    border-radius="4px"
    color="#ffffff"
    font-size="16px"
    href="{{ $url }}"
    inner-padding="8px 18px"
    line-height="1.4em"
    padding="30px 0"
>
    {{ $slot }}
</mj-button>
