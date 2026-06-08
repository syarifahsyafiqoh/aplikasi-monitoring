<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePerjalananDinasTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'no_surat_tugas' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'uraian' => [
                'type' => 'TEXT',
            ],
            'no_akun' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'sumber_dana' => [
                'type'       => 'ENUM',
                'constraint' => ['RM', 'PNP'],
                'null'       => true,
            ],
            'posisi_no_akun' => [  
                'type'       => 'ENUM',
                'constraint' => ['atas', 'bawah'],
                'null'       => true,
            ],
            'harian_perjalanan' => [
                'type'       => 'BIGINT',
                'default'    => 0,
            ],
            'penginapan' => [
                'type'       => 'BIGINT',
                'default'    => 0,
            ],
            'transport' => [
                'type'       => 'BIGINT',
                'default'    => 0,
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
        $this->forge->createTable('perjalanan_dinas');
    }

    public function down()
    {
        $this->forge->dropTable('perjalanan_dinas');
    }
}