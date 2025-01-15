<?php

namespace App\Controllers\Api;

use CodeIgniter\Config\Services;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Migration extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function getindex()
    {
        $token = $this->request->getHeaderLine('Authorization'); // Récupère le token du header
        $staticToken = getenv('ENV_TOKEN'); // Token défini dans .env
        if ($token !== $staticToken) {
            return $this->failUnauthorized('Token invalide');
        }
        $migrations = Services::migrations();
        try {
            // Exécuter toutes les migrations
            $migrations->latest();

            // Retourner un message de succès avec le code 200
            return $this->respond(['message' => "Migrations exécutées avec succès !"], 200);
        } catch (\Exception $e) {
            // Retourner le message d'erreur avec un code 500
            return $this->respond(['message' => "Erreur lors de l'exécution des migrations : " . $e->getMessage()], 500);
        }
    }
}