@if($token)
    <iframe
            width="793"
            height="850"
            frameborder="0"
            id="menukaart_{{ $uuid }}"
            onload="iFrameResize(null, '#menukaart_{{ $uuid }}')"
            style="border:0; margin-bottom: 10px; padding: 10px 10px;"
            src="{{ ONLINEMENUKAART_API }}/embed/{{ $uuid }}.html"
    ></iframe>
@else
    <div>
        <strong>Onlinemenukaart.nl is nog niet geauthoriseed.</strong>
    </div>
@endif
