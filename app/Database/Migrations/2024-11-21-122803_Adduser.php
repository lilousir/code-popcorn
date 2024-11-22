<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class adduser extends Migration
{
    public function up()
    {
        $this->forge->addColumn('user', [
            'firstname' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'after'      => 'username', // Place ce champ après "username"
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'after'      => 'firstname', // Place ce champ après "firstname"
            ],
            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 15, // Limité à un format standard
                'after'      => 'email', // Place ce champ après "email"
                'null'       => true, // Autorise une valeur nulle
            ],
            'dob' => [
                'type' => 'DATE', // Date de naissance
                'after' => 'phone', // Place après le champ "phone"
                'null' => true,
            ],
            'id_city' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'id_permission', // Place après le champ "id_permission"
            ],
        ]);

        // Ajouter une clé étrangère pour `id_city`
        $this->forge->addForeignKey('id_city', 'city', 'id', 'CASCADE', 'SET NULL');
    }

    public function down()
    {
        // Supprimer les champs ajoutés
        $this->forge->dropForeignKey('user', 'user_id_city_foreign'); // Supprime la clé étrangère
        $this->forge->dropColumn('user', ['firstname', 'name', 'phone', 'dob', 'id_city']);
    }
}
