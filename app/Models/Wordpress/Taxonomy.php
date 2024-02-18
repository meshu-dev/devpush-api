<?php

namespace App\Models\Wordpress;

use Corcel\Model\Taxonomy as Corcel;

class Taxonomy extends Corcel
{
    protected $connection = 'wordpress';
}
