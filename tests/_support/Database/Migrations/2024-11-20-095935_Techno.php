<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Techno extends Migration
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
        'name' => [
            'type' => 'VARCHAR',
            'constraint' => 255,
        ],
           'created_at' => [
               'type' => 'DATETIME',
               'null' => true,
           ],
           'updated_at' => [
               'type' => 'DATETIME',
               'null' => true,
           ],
           'deleted_at' => [
               'type' => 'DATETIME',
               'null' => true,
           ]
       ]);
       $this->forge->addPrimaryKey('id');
       $this->forge->createTable('techno');

    }

    public function down()
    {
        $this->forge->dropTable('techno');
    }
}
