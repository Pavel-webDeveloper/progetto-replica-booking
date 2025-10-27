@extends('layouts.app')
{{-- @dd($apartment->images->isNotEmpty()) --}}
@section('content')
    <div class="container">
        <a href="{{ route('admin.apartments.index')}}">Torna indietro</a>

        <div class="card mt-3" style="width: 100%; border-radius: 10px; overflow: hidden;">
          <div class="image-container" style="width: 100%; height: 500px;">
            {!! $apartment->images->isNotEmpty()
              ? '<img src="' . $apartment->images[0]->url_image . '" alt="Immagine appartamento" style="width: 100%; height:100%; object-fit: cover;">'
              : '<div style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%; background-color: #f0f0f0;">Immagine al momento non disponibile</div>'
            !!}
            {{-- <img src="{{$apartment->images[0]->url_image}}" class="card-img-top" alt="..." style="height: 100%; object-fit: cover;"> --}}
          </div>
          <div class="card-body">
            <div class="card-title-container d-flex justify-content-between">
              <h3 class="card-title">{{$apartment->titolo}}</h3>
              <a class="btn btn-info d-flex align-items-center" href="{{route('admin.apartments.edit', $apartment->id)}}">Modifica</a>
            </div>
            <h4 class="card-text">{{$apartment->città}} <i><span>({{$apartment->regione}})</span></i></h4>
            <p>
                <i>Descrizione:</i><br/>
                <span>{{$apartment->descrizione}}</span>
            </p>
            <p>
                <i>Tipologia:</i>
                <strong><span>{{$apartment->category->nome}}</span></strong>
            </p>
            <div class="footer-card d-flex">
              <div class="mini-thumb d-flex flex-wrap" style="width: 70%; padding: 20px 0; gap: 23px;">
                @if ($apartment->images->isNotEmpty())
                  @foreach ($apartment->images as $image)
                    <div class="image-mini" style="width: calc((100% / 3) - 40px); max-width: calc((100% / 3) - 40px); height: 220px; max-height: 220px;">
                      <img src="{{$image->url_image}}" alt="" style="width: 100%; height:100%; object-fit: cover;">
                    </div>
                  @endforeach
                @endif
                  
              </div>

              <div class="map-container d-flex justify-content-end" style="width: 30%">
                @if($apartment->latitudine && $apartment->longitudine)
                    <div id="map" style="height: 200px; width: 200px; margin-top: 20px;"></div>
                @else
                    <p class="text-danger">Coordinate non disponibili per questo appartamento.</p>
                @endif
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection


@push('scripts')
<script>
  (g => {
    var h, a, k, p = "The Google Maps JavaScript API", c = "google", l = "importLibrary", q = "__ib__", m = document, b = window;
    b = b[c] || (b[c] = {});
    var d = b.maps || (b.maps = {}), r = new Set, e = new URLSearchParams, u = () => h || (h = new Promise(async (f, n) => {
      await (a = m.createElement("script"));
      e.set("libraries", [...r] + "");
      for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]);
      e.set("callback", c + ".maps." + q);
      a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
      d[q] = f;
      a.onerror = () => h = n(Error(p + " could not load."));
      a.nonce = m.querySelector("script[nonce]")?.nonce || "";
      m.head.append(a);
    }));
    d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() => d[l](f, ...n));
  })({
    key: "AIzaSyCj5lEhYaJ8zoIyN1B4KSCRu2XanqIWQoA",
    v: "weekly"
  });
</script>

<script>
  async function initMap() {
    const mapElement = document.getElementById("map");
    if (!mapElement) {
      console.warn("Elemento #map non trovato.");
      return;
    }

    const { Map } = await google.maps.importLibrary("maps");
    const { Marker } = await google.maps.importLibrary("marker");

    const posizione = {
      lat: parseFloat({{ $apartment->latitudine }}),
      lng: parseFloat({{ $apartment->longitudine }})
    };

    const map = new Map(mapElement, {
      center: posizione,
      zoom: 14
    });

    new Marker({
      map,
      position: posizione,
      title: "{{ $apartment->titolo }}"
    });

    setTimeout(() => {
      const myBtn = document.querySelector('.gm-control-active.gm-fullscreen-control');
      if(myBtn){
        myBtn.style.zIndex = 1000000;
      }
    }, 1500);
  }

  // Aspetta che il DOM sia pronto
  document.addEventListener("DOMContentLoaded", initMap);
  console.log("Inizializzo mappa per:", "{{ $apartment->titolo }}");

</script>
@endpush

