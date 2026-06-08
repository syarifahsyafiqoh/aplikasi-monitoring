<?php
namespace App\Models;

use CodeIgniter\Model;

class TunjanganKinerjaModel extends Model
{
    protected $table = 'tunjangan_kinerja';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'uraian', 'no_akun', 'total_bruto', 'total_netto', 'seksi', 'operator_id'
    ];

    protected $beforeInsert = ['setOperator'];
    protected $beforeUpdate = ['setOperator'];

    protected function setOperator(array $data)
    {
        $data['data']['operator_id'] = session()->get('id');
        return $data;
    }
}