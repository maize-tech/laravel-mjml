<mjml>
    <mj-head>
        <mj-title>{{ config('app.name') }}</mj-title>
        <mj-attributes>
            <mj-all
                font-family="-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'"></mj-all>
            <mj-text color="#718096" line-height="1.4"
                     font-family="-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'"></mj-text>
        </mj-attributes>
    </mj-head>
    <mj-body background-color="#edf2f7" width="570px">
        {{ $header ?? '' }}

        <mj-wrapper
            border-top="1px solid #edf2f7"
            border-bottom="1px solid #edf2f7"
            background-color="#ffffff"
            padding="0"
        >
            <mj-section padding="32px">
                <mj-column width="100%">
                    {{ $slot }}

                    {{ $subcopy ?? '' }}
                </mj-column>
            </mj-section>
        </mj-wrapper>

        {{ $footer ?? '' }}
    </mj-body>
</mjml>
