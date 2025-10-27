<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MyService\Geolocalizzazione;
use Illuminate\support\Str;


use App\Apartment;
use App\Category;
use App\Image;
use App\User;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaAppartamenti = Apartment::all();
        return view('admin.apartments.index', compact('listaAppartamenti'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listaCategory = Category::all();
        return view('admin.apartments.create', compact('listaCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Geolocalizzazione $geo)
    {
        // imposto le coordinate
        $address = $request->indirizzo . " " . $request->città;
        $coords = $geo->getCoordinates($address);

        $data = $request->all();

        $newApartment = new Apartment();
        $newApartment->titolo = $data["titolo"];
        if(!empty($data["user_id"])){
            $newApartment->user_id = $data["user_id"];
        }else {
            $newApartment->user_id = null;
        }

        $newApartment->descrizione = $data["descrizione"];

        if(!empty($data["category_id"])){
            $newApartment->category_id = $data["category_id"];
        }else {
            $newApartment->category_id = null;
        }
    
        $newApartment->prezzo_per_notte = $data["prezzo_per_notte"];
        $newApartment->numero_stanze = $data["numero_stanze"];
        $newApartment->posti_letto = $data["posti_letto"];
        $newApartment->città = $data["città"];
        $newApartment->regione = $data["regione"];
        $newApartment->indirizzo = $data["indirizzo"];
        if( isset($data['wifi']) && $data['wifi'] == 'on'){
            $newApartment->wifi = 1;
        }else {
            $newApartment->wifi = 0;
        }
        if( isset($data['disponibile']) && $data['disponibile'] == 'on'){
            $newApartment->disponibile = 1;
        }else {
            $newApartment->disponibile = 0;
        }

        if( !empty($coords)){
            $newApartment->latitudine = $coords["lat"];
            $newApartment->longitudine = $coords["lng"];
        }else {
            $newApartment->latitudine = null;
            $newApartment->longitudine = null;
        }

        $newApartment->save();
        // dd($newApartment);

        $newImage = new Image();
        $newImage->url_image = $data['image'];
        $newImage->apartment_id = $newApartment->id;
        $newImage->save();

        return redirect()->route('admin.apartments.show', $newApartment->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        return view('admin.apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $listaProprietari = User::all();
        $listaCategory = Category::all();
        return view('admin.apartments.edit', compact('apartment', 'listaCategory', 'listaProprietari'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment, Geolocalizzazione $geo)
    {
        // imposto le coordinate
        $address = $request->indirizzo . " " . $request->città;
        $coords = $geo->getCoordinates($address);

        $data = $request->all();

        if( $apartment->titolo != $data["titolo"]){
            $apartment->titolo = $data["titolo"];
            $baseSlug = Str::slug($apartment->titolo);
            $slug = $baseSlug;
            $count = 1;

            while (Apartment::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $count++;
            }

            $apartment->slug = $slug;
        }
        $apartment->user_id = !empty($data['user_id']) ? $data['user_id'] : null;

        $apartment->descrizione = $data["descrizione"];

        if(!empty($data["category_id"])){
            $apartment->category_id = $data["category_id"];
        }else {
            $apartment->category_id = null;
        }
    
        $apartment->prezzo_per_notte = $data["prezzo_per_notte"];
        $apartment->numero_stanze = $data["numero_stanze"];
        $apartment->posti_letto = $data["posti_letto"];
        $apartment->città = $data["città"];
        $apartment->regione = $data["regione"];
        $apartment->indirizzo = $data["indirizzo"];
        if( isset($data['wifi']) && $data['wifi'] == 'on'){
            $apartment->wifi = 1;
        }else {
            $apartment->wifi = 0;
        }
        if( isset($data['disponibile']) && $data['disponibile'] == 'on'){
            $apartment->disponibile = 1;
        }else {
            $apartment->disponibile = 0;
        }

        if( !empty($coords)){
            $apartment->latitudine = $coords["lat"];
            $apartment->longitudine = $coords["lng"];
        }else {
            $apartment->latitudine = null;
            $apartment->longitudine = null;
        }

        // $apartment->update();
        dd($apartment);

        if(!empty($data["image2"]) || !empty($data["image3"]) || !empty($data["image4"]) || !empty($data["image5"])){

        }
        $newImage = new Image();
        $newImage->url_image = $data['image'];
        $newImage->apartment_id = $apartment->id;
        // $newImage->save();

        // return redirect()->route('admin.apartments.show', $apartment->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
