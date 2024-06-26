<?php

namespace App\Module\Recruitis;

class Configuration
{
    private string $transport;

    public function __construct()
    {
        $this->transport = 'sendmail';
    }

    // ...
}

