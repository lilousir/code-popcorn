<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TypeShowing extends Migration
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
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('type_showing');
    }

    public function down()
    {
        $this->forge->dropTable('type_showing');
    }
}
