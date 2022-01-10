<?php
namespace App\Models;
class Objeto
{
    public function __construct(array $arguments = array())
    {
        if (!empty($arguments)) {
            foreach ($arguments as $property => $argument) {
                $this->{$property} = $argument;
            }
        }
    }
}