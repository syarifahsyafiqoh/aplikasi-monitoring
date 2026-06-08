<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBerkasApprovalsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'berkas_id' => [
                'type'     => 'BIGINT',
                'unsigned' => true,
            ],
            'workflow_step_id' => [
                'type'     => 'BIGINT',
                'unsigned' => true,
            ],
            'approver_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected'],
                'default'    => 'pending',
            ],
            'catatan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'approved_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('berkas_id', 'berkas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('workflow_step_id', 'workflow_steps', 'id', 'CASCADE', 'CASCADE');
        // $this->forge->addForeignKey('approver_id', 'users', 'id', 'SET NULL', 'SET NULL');
        $this->forge->createTable('berkas_approvals');
    }

    public function down()
    {
        $this->forge->dropTable('berkas_approvals');
    }
}