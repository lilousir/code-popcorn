<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Movie extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'release_date' => [ // Nom explicite
                'type' => 'DATE',
            ],
            'duration' => [
                'type' => 'INT',
                'constraint' => 3, // Limite à 999 minutes
            ],
            'rating' => [
                'type' => 'ENUM',
                'constraint' => ['Tous publics', '-12', '-16', '-18'],
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'description' => [
                'type' => 'TEXT',
            ],
            'active' => [
                'type' => 'BOOLEAN',
            ],
            'id_cat' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_cat', 'category_movie', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('movies');
    }

    public function down()
    {
        $this->forge->dropTable('movies');
    }
}
