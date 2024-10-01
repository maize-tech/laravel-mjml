@props(['url'])
<mj-section full-width="full-width" padding="25px 0">
    <mj-column width="100%">
        @if (trim($slot) === 'Laravel')
            <mj-image
                src="https://laravel.com/img/notification-logo.png"
                alt="Laravel Logo"
                href="{{ $url }}"
                width="75px"
                height="75px"
            ></mj-image>
        @else
            <mj-text font-size="19px" font-weight="bold" color="#3d4852" align="center">
                <a style="text-decoration: none; color: inherit;" href="{{ $url }}">{{ $slot }}</a>
            </mj-text>
        @endif
    </mj-column>
</mj-section>
