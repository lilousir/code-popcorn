<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Price extends Migration
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
            'amount' => [
                'type' => 'FLOAT',

            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('price');
    }

    public function down()
    {
        $this->forge->dropTable('price');
    }
}