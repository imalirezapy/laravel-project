<?php

namespace App\Helpers;

class Zarinpal
{
    protected $info;

    public function setInfo($info)
    {
        $this->info = $info;
    }

    public function payment()
    {
        return $this->info;
    }

}
