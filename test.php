<?php


require_once "vendor/autoload.php";

use Defer\Defer;
use Defer\Event;

$defer = new Defer();
$event = new Event();





Event::group("dene",function (){



    Event::add("users",function ($a,$b){

        echo $a*$b;
    });

    Event::add('ddd',function ($a){

        echo $a;

    });

});

Event::callEventsGroup('dene',[30,3]);













