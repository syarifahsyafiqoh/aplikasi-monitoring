<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBerkasTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'no_berkas' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'unique'     => true,
            ],
            'jenis_modul' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'id_modul' => [
                'type'       => 'BIGINT',
                'unsigned'   => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['draft', 'menunggu_verifikasi', 'diverifikasi', 'disetujui', 'ditolak'],
                'default'    => 'draft',
            ],
            'catatan_bendahara' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'operator_id' => [
                'type'       => 'INT',           
                'unsigned'   => false,           
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('operator_id'); 
        $this->forge->createTable('berkas');
    }

    public function down()
    {
        $this->forge->dropTable('berkas');
    }
}