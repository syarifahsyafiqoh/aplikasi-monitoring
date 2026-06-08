<?php
namespace App\Models;

use CodeIgniter\Model;

class PerjalananDinasModel extends Model
{
    protected $table = 'perjalanan_dinas';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;

    protected $allowedFields = [
        'no_surat_tugas',
        'uraian',
        'no_akun',
        'sumber_dana',
        'posisi_no_akun',          
        'harian_perjalanan',
        'penginapan',
        'transport',
        'seksi',
        'operator_id'
    ];

    protected $beforeInsert = ['setOperatorId'];
    protected $beforeUpdate = ['setOperatorId'];

    protected function setOperatorId(array $data)
    {
        if (!isset($data['data']['operator_id'])) {
            $data['data']['operator_id'] = session()->get('id');
        }
        return $data;
    }
}