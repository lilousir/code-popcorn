<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddThaeter extends Migration
{
    public function up()
    {
        // Ajouter les colonnes pour les horodatages
        $this->forge->addColumn('theater', [
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true, // Permet des valeurs NULL initiales
                'after' => 'id_city', // Ajoute le champ après 'id_city'
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'created_at', // Ajoute le champ après 'created_at'
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'updated_at', // Ajoute le champ après 'updated_at'
            ],
        ]);
    }

    public function down()
    {
        // Supprimer les colonnes ajoutées
        $this->forge->dropColumn('theater', ['created_at', 'updated_at', 'deleted_at']);
    }
}
