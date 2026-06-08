<?php
namespace App\Models;

use CodeIgniter\Model;

class KontraktualModel extends Model
{
    protected $table = 'kontraktual';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'uraian', 'no_akun', 'total_uang_bruto', 'total_uang_netto', 'pajak', 'seksi', 'operator_id'
    ];

    protected $beforeInsert = ['setOperator'];
    protected $beforeUpdate = ['setOperator'];

    protected function setOperator(array $data)
    {
        $data['data']['operator_id'] = session()->get('id');
        return $data;
    }
}