@extends('layouts.app')
{{-- @dd($apartment->disponibile) --}}

@section('content')
<div class="container">
   
    <h2 class="text-center">Modifica appartamento</h2>
    <form action="{{route('admin.apartments.update', $apartment->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="titolo" class="form-label">Titolo</label>
            <input type="text" class="form-control" id="titolo" aria-describedby="titolo" name="titolo" placeholder="Inserisci un titolo" value="{{$apartment->titolo}}">
        </div>
        <div class="mb-3">
            <label for="user_id" class="form-label">Proprietario</label>
            <select name="user_id" id="user_id" class="form-control">
                <option value="" disabled>Seleziona il proprietario</option>
                <option value="" 
                {{(old('user_id', $apartment->user_id ?? ''
                /*qui dovrei mettere $apartment->user->nome dopo creata la relazione*/) == "" ) ? 'selected' : '' }}>Nessuno</option>
                 @foreach ($listaProprietari as $user)
                     <option value="{{$user->id}}"
                        {{ old('user_id', $apartment->user_id ?? '') == $user->id ? 'selected' : '' }}>
                        {{$user->name}}</option>
                 @endforeach
                
            </select>
        </div>
        <div class="mb-3">
            <label for="descrizione" class="form-label">Descrizione</label>
            <textarea name="descrizione" id="descrizione" cols="30" rows="10" class="form-control" placeholder="Inserisci una descrizione">{{$apartment->descrizione}}</textarea>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Categoria</label>
            <select name="category_id" id="category_id" class="form-control">
                <option value=""disabled selected>Seleziona una categoria</option>   
                @foreach ($listaCategory as $cat)
                    <option
                        {{(old('category_id', $apartment->category_id ?? '') == $cat->id) ? 'selected' : '' }} 
                        value="{{$cat->id}}">{{$cat->nome}}
                    </option>   
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <div class="form-group">
                <label for="prezzo_per_notte">Prezzo per notte (€)</label>
                <input type="number"
                    name="prezzo_per_notte"
                    id="prezzo_per_notte"
                    class="form-control"
                    step="0.50"
                    min="0"
                    max="999999.99"
                    value="{{old('prezzo_per_notte', $apartment->prezzo_per_notte) }}">
            </div>
        </div>

        <div class="form-group">
            <label for="numero_stanze">Numero di stanze</label>
            <input type="number"
                name="numero_stanze"
                id="numero_stanze"
                class="form-control"
                step="1"
                min="1"
                max="10"
                value="{{ old('numero_stanze', $apartment->numero_stanze) }}">
        </div>
        <div class="form-group">
            <label for="posti_letto">Posti letto</label>
            <input type="number"
                name="posti_letto"
                id="posti_letto"
                class="form-control"
                step="1"
                min="1"
                max="20"
                value="{{ old('posti_letto', $apartment->posti_letto) }}">
        </div>
        <div class="mb-3">
            <label for="città" class="form-label">città</label>
            <input type="text" class="form-control" id="città" aria-describedby="città" name="città" value="{{$apartment->città}}">
        </div>
        <div class="mb-3">
            <label for="regione" class="form-label">regione</label>
            <input type="text" class="form-control" id="regione" aria-describedby="regione" name="regione" value="{{$apartment->regione}}">
        </div>
        <div class="mb-3">
            <label for="indirizzo" class="form-label">indirizzo</label>
            <input type="text" class="form-control" id="indirizzo" aria-describedby="indirizzo" name="indirizzo" value="{{$apartment->indirizzo}}">
        </div>
        
        <div class="mb-3">
            <label for="image" class="form-label">Immagine</label>
            <input type="text" class="form-control" id="image" aria-describedby="image" name="image"
            value="{{$apartment->images[0]->url_image}}" >
        </div>

        <div class="container-immaggini">
            <div class="mb-3 image-input" id="image2-wrapper">
                <label for="image2" class="form-label">Aggiungi altre immagini</label>
                <input type="text" class="form-control" id="image2" name="image2" placeholder="Inserisci l'url dell'immagine" style="position: relative">
            </div>

            <div class="mb-3 image-input" id="image3-wrapper" style="display: none;">
                <label for="image3" class="form-label">Aggiungi altre immagini</label>
                <input type="text" class="form-control" id="image3" name="image3" placeholder="Inserisci l'url dell'immagine" style="position: relative">
            </div>

            <div class="mb-3 image-input" id="image4-wrapper" style="display: none;">
                <label for="image4" class="form-label">Aggiungi altre immagini</label>
                <input type="text" class="form-control" id="image4" name="image4" placeholder="Inserisci l'url dell'immagine" style="position: relative">
            </div>

            <div class="mb-3 image-input" id="image5-wrapper" style="display: none;">
                <label for="image5" class="form-label">Aggiungi altre immagini</label>
                <input type="text" class="form-control" id="image5" name="image5" placeholder="Inserisci l'url dell'immagine" style="position: relative">
            </div>

            <button type="button" id="add-image" class="btn btn-outline-primary" style=" position: absolute; z-index: 100;">+</button>
        </div>
        
        <div class="form-group form-check">
            <input type="checkbox"
                name="wifi"
                id="wifi"
                class="form-check-input"
                value="1"
                {{ old('wifi', $apartment->disponibile) ? 'checked' : '' }}>
            <label class="form-check-label" for="wifi">Wifi</label>
        </div>
        <div class="form-group form-check">
            <input type="checkbox"
                name="disponibile"
                id="disponibile"
                class="form-check-input"
                value="1"
                {{ old('disponibile', $apartment->disponibile) ? 'checked' : '' }}>
            <label class="form-check-label" for="disponibile">Disponibile</label>
        </div>

        <div class="but-sub d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Modifica</button>
        </div>


        

    </form>
</div>
@endsection