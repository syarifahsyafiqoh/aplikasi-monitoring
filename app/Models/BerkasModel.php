<?php
namespace App\Models;

use CodeIgniter\Model;

class BerkasModel extends Model
{
    protected $table = 'berkas';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'no_berkas', 'jenis_modul', 'id_modul', 'status', 
        'catatan_bendahara', 'operator_id',
        'verifed_by', 'verifed_at'
    ];
    protected $useTimestamps = true;
}