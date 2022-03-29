<?php
namespace Kilala\Momo;
use Illuminate\Support\Facades\Facade;

class Momo extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'momo';
    }
    
    public function hello()
    {
        echo "Hello, Custom Facade";
    }
}