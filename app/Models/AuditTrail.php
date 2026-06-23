<?php

namespace App\Models;

use CodeIgniter\Model;

class AuditTrail extends Model
{
    protected $table            = 'audit_trails';
    protected $primaryKey       = 'id';
    protected $useTimestamps    = false;
    protected $allowedFields    = ['berkas_id', 'user_id', 'action', 'description', 'ip_address', 'created_at'];

    public function log($berkasId, $action, $description = null)
    {
        $request = service('request');

        $data = [
            'berkas_id'   => $berkasId,
            'user_id'     => session()->get('id'),
            'action'      => $action,
            'description' => $description,
            'ip_address'  => $request->getIPAddress(),
            'created_at'  => date('Y-m-d H:i:s')   // Manual timestamp
        ];

        return $this->insert($data);
    }
}