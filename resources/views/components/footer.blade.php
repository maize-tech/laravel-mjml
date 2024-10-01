<mj-section full-width="full-width" padding="32px">
    <mj-column width="100%">
        <mj-text align="center" color="#b0adc5" font-size="12px" css-class="footer">
            {{ Illuminate\Mail\Markdown::parse($slot) }}
        </mj-text>
    </mj-column>
</mj-section>
