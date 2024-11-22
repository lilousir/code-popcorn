<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Theater extends Migration
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
            'name' =>[
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'address' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],


            'id_city' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_city', 'city', 'id','CASCADE','CASCADE');
        $this->forge->createTable('theater');
    }

    public function down()
    {
        $this->forge->dropTable('theater');
    }
}
