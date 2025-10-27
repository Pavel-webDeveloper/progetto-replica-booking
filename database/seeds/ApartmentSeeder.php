<?php

use Illuminate\Database\Seeder;
use App\Apartment;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listaAppartamenti = config('apartments');

        foreach($listaAppartamenti as $apartment){
            $newApartment = new Apartment();
            $newApartment->titolo = $apartment['titolo'];
            $newApartment->user_id = $apartment['user_id'];
            $newApartment->descrizione = $apartment['descrizione'];
            $newApartment->category_id = $apartment['category_id'];
            $newApartment->prezzo_per_notte = $apartment['prezzo_per_notte'];
            $newApartment->numero_stanze = $apartment['numero_stanze'];
            $newApartment->posti_letto = $apartment['posti_letto'];
            $newApartment->città = $apartment['città'];
            $newApartment->regione = $apartment['regione'];
            $newApartment->indirizzo = $apartment['indirizzo'];
            $newApartment->latitudine = $apartment['latitudine'];
            $newApartment->longitudine = $apartment['longitudine'];
            $newApartment->wifi = $apartment['wifi'];
            $newApartment->disponibile = $apartment['disponibile'];

            $newApartment->save();
        }
    }
}
