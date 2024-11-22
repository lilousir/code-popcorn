<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Alterprice extends Migration
{
    public function up()
    {
        // Ajouter les colonnes pour les horodatages
        $this->forge->addColumn('price', [
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true, // Permet des valeurs NULL initiales
                'after' => 'amount', // Remplacez `last_column_name` par le dernier champ actuel
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
        $this->forge->dropColumn('price', ['created_at', 'updated_at', 'deleted_at']);
    }
}
