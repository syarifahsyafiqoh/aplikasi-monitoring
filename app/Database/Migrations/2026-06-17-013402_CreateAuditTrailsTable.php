<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAuditTrailsTable extends Migration
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
            'user_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'action' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'ip_address' => [
                'type'       => 'VARCHAR',
                'constraint' => '45',
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        
        // Foreign key hanya untuk berkas_id (yang pasti cocok)
        $this->forge->addForeignKey('berkas_id', 'berkas', 'id', 'CASCADE', 'CASCADE');
        
        // Foreign key user_id dinonaktifkan sementara
        // $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('audit_trails');
    }

    public function down()
    {
        $this->forge->dropTable('audit_trails');
    }
}