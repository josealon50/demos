<?php

namespace App\Transformer;

abstract class Transformer 
{
    
    public $type = 'unknown';
    
    public abstract function transform($post);

}

?>
