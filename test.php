<?php


require_once "vendor/autoload.php";

use Defer\Defer;
use Defer\Event;

$defer = new Defer();
$event = new Event();


$defer->addEvent(function (){

    echo "\nby by script closed\n";
});





Event::group('deneme')->add('yaz',function (){ echo "fff";});


Event::group("other",function (){

    Event::add('one',function ($param){  echo $param. "from one event";});
    Event::add('two',function ($param){  echo $param. "from two event";});
    Event::add('tee',function ($param){  echo $param. "from two event";});
});




Event::removeGroup('other');
Event::dispatchGroup('other',[34]);





























