<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class City extends BaseController
{
    public function searchCity()
    {
        $city = $this->request->getGet('term'); // Récupère le terme de recherche

        $cityModel = new \App\Models\CityModel();
        $results = $cityModel->like('label', $city)->findAll(10); // Limite à 10 résultats

        // Prépare les résultats pour le JSON
        $response = [];
        foreach ($results as $city) {
            $response[] = [
                'id' => $city['id'],
                'label' => $city['label'],
                'zip' => $city['zip'],
            ];
        }

        return $this->response->setJSON($response); // Renvoie le JSON
    }
}
