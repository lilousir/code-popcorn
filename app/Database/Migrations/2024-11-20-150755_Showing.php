<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Showing extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true, // Ajouté pour générer les identifiants automatiquement
            ],
            'date' => [
                'type' => 'DATETIME',
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true, // Permet d'accepter des champs vides si besoin
            ],
            'version' => [
                'type' => 'ENUM',
                'constraint' => ['vf', 'vost', 'audiodescription', 'vfstfr'],
            ],


            'id_type_showing' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'id_movie' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
        ]);

        $this->forge->addKey('id', true); // Clé primaire
        $this->forge->addForeignKey('id_movie', 'movies', 'id', 'CASCADE', 'CASCADE'); // Clé étrangère
        $this->forge->addForeignKey('id_type_showing', 'type_showing', 'id', 'CASCADE', 'CASCADE'); // Clé étrangère

        $this->forge->createTable('showing');
    }

    public function down()
    {
        $this->forge->dropTable('showing');
    }
}
