<?php
namespace App\Controllers;

class Bendahara extends BaseController
{
    public function index()
    {
        return redirect()->to('/dashboard/bendahara');
    }
}