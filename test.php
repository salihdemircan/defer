<?php


require_once "vendor/autoload.php";

use Defer\Defer;
use Defer\Event;

$defer = new Defer();
$event = new Event();


$defer->addEvent(function (){

    echo "\nby by script closed\n";
});





Event::group('deneme')::add('yaz',function (){ echo "fff";});


Event::group("other",function (){

    Event::add('one',function ($param){  echo $param. "from one event";});
    Event::add('two',function ($param){  echo $param. "from two event";});
});



Event::dispatchGroup('deneme');
Event::dispatchGroup('other',[63]);




Event::add('specific',function ($name){ echo "specific function $name";});
Event::dispatch('specific',["dılo sürücü"]);


Event::remove("specific");


Event::dispatchAll([34]);




Event::removeGroup('deneme');

Event::dispatch('yaz');
























