<?php
namespace App\Controllers;

use App\Controllers\BaseController;

class Operator extends BaseController
{
    public function index()
    {
        return redirect()->to('/dashboard/operator');
    }
}