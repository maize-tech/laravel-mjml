<mjml>
    <mj-head>
        <mj-title>{{ config('app.name') }}</mj-title>
        <mj-attributes>
            <mj-all
                font-family="-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'"></mj-all>
            <mj-text color="#718096" line-height="1.4em" padding="0"></mj-text>
        </mj-attributes>
        <mj-style inline="inline">
            a {
                color: #3869d4;
            }
        </mj-style>
        <mj-style inline="inline">
            p {
                margin: 0 !important;
            }
            .greeting p {
                margin: 0 0 12px 0 !important;
            }
            .subcopy p {
                margin: 0 0 14px 0 !important;
            }
            .footer p {
                margin: 0 0 12px 0 !important;
            }
            .line p {
                margin: 0 0 16px 0 !important;
            }
        </mj-style>
        <mj-style inline="inline">
            .body-section {
                -webkit-box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4px 0 rgba(0, 0, 150, 0.015);
                -moz-box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4px 0 rgba(0, 0, 150, 0.015);
                box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4px 0 rgba(0, 0, 150, 0.015);
            }
        </mj-style>
    </mj-head>
    <mj-body background-color="#edf2f7" width="570px">
        {{ $header ?? '' }}

        <mj-wrapper
            background-color="#ffffff"
            css-class="body-section"
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
