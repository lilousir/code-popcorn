<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableAuditorium extends Migration
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
                'constraint' => 50,
            ],
            'capacity' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'theater_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'deleted_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('theater_id', 'theater', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('auditorium');
    }

    public function down()
    {
        $this->forge->dropTable('auditorium');
    }
}
