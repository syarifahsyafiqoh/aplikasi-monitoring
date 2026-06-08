<?php namespace App\Controllers;

use App\Controllers\BaseController;

class Debug extends BaseController
{
    public function session()
    {
        echo '<pre>SESSION:' . PHP_EOL;
        print_r(session()->get());
        echo '</pre>';
    }

    public function post()
    {
        echo '<pre>POST:' . PHP_EOL;
        print_r($this->request->getPost());
        echo PHP_EOL . 'SESSION:' . PHP_EOL;
        print_r(session()->get());
        echo '</pre>';
    }
}
