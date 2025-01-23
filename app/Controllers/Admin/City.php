<?php

namespace App\Controllers\Admin;

// Importation du contrôleur de base
use App\Controllers\BaseController;

class City extends BaseController
{
    // Méthode pour rechercher une ville en fonction d'un terme saisi par l'utilisateur
    public function searchCity()
    {
        // Récupère le terme de recherche envoyé via une requête GET (par exemple, "term=Paris")
        $city = $this->request->getGet('term');

        // Instancie le modèle CityModel pour interagir avec la base de données
        $cityModel = new \App\Models\CityModel();

        // Requête pour rechercher les villes dont le nom (label) contient le terme saisi
        // La méthode `like` effectue une recherche partielle (par exemple, "Par" correspond à "Paris")
        // La méthode `findAll(10)` limite les résultats à 10 villes
        $results = $cityModel->like('label', $city)->findAll(10);

        // Prépare les résultats pour une réponse JSON
        $response = [];
        foreach ($results as $city) {
            $response[] = [
                'id' => $city['id'],       // ID unique de la ville
                'label' => $city['label'], // Nom de la ville
                'zip' => $city['zip'],     // Code postal de la ville
            ];
        }

        // Renvoie les résultats au format JSON pour les consommer dans une application front-end
        return $this->response->setJSON($response);
    }
}
