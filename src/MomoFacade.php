<?php
namespace Kilala\Momo;
use Illuminate\Support\Facades\Facade;

class MomoFacade extends Facade
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