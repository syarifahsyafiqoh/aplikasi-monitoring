<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGajiIndukTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'uraian' => [
                'type' => 'TEXT',
            ],
            'no_akun' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'total_bruto' => [
                'type'    => 'BIGINT',
                'default' => 0,
            ],
            'total_netto' => [
                'type'    => 'BIGINT',
                'default' => 0,
            ],
            'pajak' => [
                'type'    => 'BIGINT',
                'default' => 0,
            ],
            'seksi' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'operator_id' => [
                'type'       => 'INT',           
                'unsigned'   => false,           
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('operator_id');
        $this->forge->createTable('gaji_induk');
    }

    public function down()
    {
        $this->forge->dropTable('gaji_induk');
    }
}