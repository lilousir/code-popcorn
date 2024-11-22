<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Ticket extends Migration
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
            'amount' => [
                'type' => 'FLOAT',

            ],
            'movie_title' => [
                'type' => 'VARCHAR',
                'constraint' => '255',

            ],
            'showing' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'showing_date' => [
                'type' => 'DATE',

            ],
            'id_user' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_user', 'user', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('ticket');
    }

    public function down()
    {
        $this->forge->dropTable('ticket');
    }
}
