@extends('layouts.app')

@section('menuDinamic')
    <li  class="nav-item">
        <a href="{{ route('admin.apartments.create')}}" class="nav-link">Aggiungi Appartamento</a>
    </li>
@endsection

@section('content')
<div class="container">
    index apartment

    <div class="row" style="width: 100%; gap:35px">
        @foreach ($listaAppartamenti as $apartment)
            <div class="card my_card">
                {!! $apartment->images->isNotEmpty()
                    ? '<img src="' . $apartment->images[0]->url_image . '" alt="Immagine appartamento" style="width: 100%; height:100%; object-fit: cover;">'
                    : '<div style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%; min-height: 228px; background-color: #f0f0f0;">Immagine al momento non disponibile</div>'
                !!}
                {{-- <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/485225608.jpg?k=dc9a61baa7090167bda1686f9879340406af131709638976d4f8c15fce4b4f8f&o=" class="card-img-top" alt="..."> --}}
                <div class="card-body" style="position: relative">
                    <h5 class="card-title">{{$apartment->titolo}}</h5>
                    <p class="card-text">{{$apartment->category->nome}} / <strong>{{$apartment->città}}</strong></p>
                    <a href="{{ route('admin.apartments.show', $apartment->id)}}" class="btn btn-info" style="position:absolute; bottom: -18px; right: 20px;">Info</a>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection