<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Auditorium extends Migration
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
            'capacity' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'id_theater' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_theater', 'theater', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('auditorium');
    }

    public function down()
    {
        $this->forge->dropTable('auditorium');
    }
}
