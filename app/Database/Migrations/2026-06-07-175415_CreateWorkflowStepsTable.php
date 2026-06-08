<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateWorkflowStepsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'workflow_id' => [
                'type'     => 'BIGINT',
                'unsigned' => true,
            ],
            'urutan' => [
                'type' => 'INT',
            ],
            'role' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('workflow_id', 'workflows', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('workflow_steps');
    }

    public function down()
    {
        $this->forge->dropTable('workflow_steps');
    }
}