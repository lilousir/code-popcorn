<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Addtecno extends Migration
{
    public function up()
    {
        // Ajouter les colonnes pour les horodatages
        $this->forge->addColumn('techno', [
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true, // Permet des valeurs NULL initiales
                'after' => 'name', // Remplacez `last_column_name` par le dernier champ actuel
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
        $this->forge->dropColumn('techno', ['created_at', 'updated_at', 'deleted_at']);
    }
}
