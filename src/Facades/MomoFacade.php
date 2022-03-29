<?php
namespace Kilala\Momo\Facades;
use Illuminate\Support\Facades\Facade;

class MomoFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'momo';
    }
    
    public function helloWorld()
    {
        echo "Hello, Custom Facade";
    }
}