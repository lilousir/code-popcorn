<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CategoryMovie extends Migration
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
            'id_movie' => [
                'type'       => 'int',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'id_category' => [
                'type'       => 'int',
                'constraint' => 11,
                'unsigned' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_movie', 'movies', 'id');
        $this->forge->addForeignKey('id_category', 'category', 'id');
        $this->forge->createTable('category_movie');
    }

    public function down()
    {
        $this->forge->dropTable('category_movie');
    }
}
