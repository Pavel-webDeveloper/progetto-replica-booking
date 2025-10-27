@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">Crea un nuovo appartamento</h2>
    <form action="{{route('admin.apartments.store')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="titolo" class="form-label">Titolo</label>
            <input type="text" class="form-control" id="titolo" aria-describedby="titolo" name="titolo" placeholder="Inserisci un titolo">
        </div>
        <div class="mb-3">
            <label for="user_id" class="form-label">Proprietario</label>
            <select name="user_id" id="user_id" class="form-control">
                <option value="" selected disabled>Seleziona il proprietario</option>
                <option value="">Nessuno</option>
                <option value="1">Bho</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="descrizione" class="form-label">Descrizione</label>
            <textarea name="descrizione" id="descrizione" cols="30" rows="10" class="form-control" placeholder="Inserisci una descrizione"></textarea>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Categoria</label>
            <select name="category_id" id="category_id" class="form-control">
                <option value=""disabled selected>Seleziona una categoria</option>   
                @foreach ($listaCategory as $cat)
                    <option value="{{$cat->id}}">{{$cat->nome}}</option>   
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
                    value="{{ old('prezzo_per_notte') }}">
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
                value="{{ old('numero_stanze') }}">
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
                value="{{ old('posti_letto') }}">
        </div>
        <div class="mb-3">
            <label for="città" class="form-label">città</label>
            <input type="text" class="form-control" id="città" aria-describedby="città" name="città">
        </div>
        <div class="mb-3">
            <label for="regione" class="form-label">regione</label>
            <input type="text" class="form-control" id="regione" aria-describedby="regione" name="regione">
        </div>
        <div class="mb-3">
            <label for="indirizzo" class="form-label">indirizzo</label>
            <input type="text" class="form-control" id="indirizzo" aria-describedby="indirizzo" name="indirizzo">
        </div>
        
        <div class="mb-3">
            <label for="image" class="form-label">Immagine</label>
            <input type="text" class="form-control" id="image" aria-describedby="image" name="image"
            placeholder="Inserisci l'url dell'immagine potrai inserirne di nuove in seguito">
        </div>
        
        <div class="form-group form-check">
            <input type="checkbox"
                name="wifi"
                id="wifi"
                class="form-check-input"
                value="1"
                {{ old('wifi') ? 'checked' : '' }}>
            <label class="form-check-label" for="wifi">Wifi</label>
        </div>
        <div class="form-group form-check">
            <input type="checkbox"
                name="disponibile"
                id="disponibile"
                class="form-check-input"
                value="1"
                {{ old('disponibile') ? 'checked' : '' }}>
            <label class="form-check-label" for="disponibile">Disponibile</label>
        </div>
        
        <div class="but-sub d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Salva</button>
        </div>
        

    </form>
</div>
@endsection