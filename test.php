<?php


require_once "vendor/autoload.php";

use Defer\Defer;
use Defer\Event;

$defer = new Defer();
$event = new Event();


$defer->addEvent( function () {

    echo "script closed\n";
} );


$defer->addEvent( function () {

    Event::dispatch( 'foo', [10, 15] );
} );


Event::add( 'foo', function ($param1, $param2) {

    echo $param1 + $param2 . "\n";
} );




echo "start page \n";


echo  "hello world\n";












