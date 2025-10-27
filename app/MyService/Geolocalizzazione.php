<?php

    namespace App\MyService;

    use GuzzleHttp\Client;


    class Geolocalizzazione {
        protected $client;
        protected $apiKey;

        public function __construct(){
            $this->client = new Client();
            $this->apiKey = config('services.google_maps.key'); // chiave in config/services.php
        }

         public function getCoordinates($indirizzo){
            
            $url = 'https://maps.googleapis.com/maps/api/geocode/json';
            $response = $this->client->get($url, [
                'query' => [
                    'address' => $indirizzo,
                    'key' => $this->apiKey,
                ]
            ]);

            $data = json_decode($response->getBody(), true);
            

            if (!empty($data['results'])) {
                // dump($data['results']);
                $location = $data['results'][0]['geometry']['location'];
                return [
                    'lat' => $location['lat'],
                    'lng' => $location['lng'],
                ];
            }

            return null;
        }

    }