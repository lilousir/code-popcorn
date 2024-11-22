<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Payment extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true, // Clé primaire auto-incrémentée
            ],
            'amount' => [
                'type' => 'FLOAT', // Type pour les montants
            ],
            'date' => [
                'type' => 'DATETIME', // Date et heure
            ],
            'method' => [
                'type' => 'ENUM', // Valeurs définies
                'constraint' => ['Espèce', 'Chèque', 'Carte Bleue', 'Contremarque'], // Les options possibles
            ],
            'id_ticket' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true, // Référence à une autre table
            ],
        ]);

        // Définir la clé primaire
        $this->forge->addKey('id', true);

        // Ajouter une clé étrangère pour `ticket_id` si nécessaire
        $this->forge->addForeignKey('id_ticket', 'ticket', 'id', 'CASCADE', 'CASCADE');

        // Créer la table
        $this->forge->createTable('payment');
    }

    public function down()
    {
        // Supprimer la table en cas de rollback
        $this->forge->dropTable('payment');
    }
}
