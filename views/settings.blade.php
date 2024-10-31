<h2>Online Menukaart</h2>

@if($token)
    <div class="updated notice" style="margin-left: 0; margin-bottom: 30px;">
        <p>{{ __('Succesvol geauthoriseerd', 'onlinemenukaart') }}</p>
    </div>
    <h3>Integraties</h3>
    <p>Hier vind je lijst van de integraties in je Online Menukaart account. Je kunt de shortcodes kopieren en op de pagina naar keuze zetten.</p>

    <div>
        @foreach($integrations as $integration)
            <div>
                <div><h4>{{ $integration['name'] }}</h4></div>
                <textarea style="resize: none;" cols="65" rows="1">[menukaart uuid="{{ $integration['uuid'] }}"]</textarea>
            </div>
        @endforeach
    </div>

@else
    <form method="POST" action="{{ $url }}">
        {{ submit_button(__('Koppel je Onlinemenukaart.nl account', 'onlinemenukaart')) }}
    </form>
@endif
