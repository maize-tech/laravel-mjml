<mjml>
    <mj-head>
        <mj-title>{{ config('app.name') }}</mj-title>
        <mj-attributes>
            <mj-all
                font-family="-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'"></mj-all>
            <mj-text color="#718096" line-height="1.4" padding="0"></mj-text>
        </mj-attributes>
        <mj-style inline="inline">
            h1 {
                color: #3d4852;
                font-size: 18px;
                font-weight: bold;
                margin-top: 0;
            }
            h2 {
                font-size: 16px;
                font-weight: bold;
                margin-top: 0;
            }
            h3 {
                font-size: 14px;
                font-weight: bold;
                margin-top: 0;
            }
            p {
                line-height: 1.5;
                margin-top: 0;
            }
            a {
                color: #3869d4;
            }
            .footer a {
                color: #b0adc5;
                text-decoration: underline;
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
            border="1px solid #e8e5ef"
            border-radius="2px"
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
