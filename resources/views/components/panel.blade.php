<mj-wrapper full-width="full-width" padding="0">
    <mj-section full-width="full-width"	padding="21px 0">
        <mj-column background-color="#edf2f7" border-left="4px solid #2d3748" padding="16px" width="100%">
            <mj-text color="#718096" font-size="16px" line-height="1.5">
                {{ Illuminate\Mail\Markdown::parse($slot) }}
            </mj-text>
        </mj-column>
    </mj-section>
</mj-wrapper>
