<?php


require_once "vendor/autoload.php";

use Defer\Defer;
use Defer\Event;

$defer = new Defer();
$event = new Event();


$defer->addEvent(function (){

    echo "\nby by script closed\n";
});


Event::group( "dene", function () {


    Event::add( "users", function ($a, $b) {

        echo $a * $b;
    } );

    Event::add( 'ddd', function ($a) {

        echo $a;

    } );

} );

Event::dispatchByGroup( 'dene', [30, 3] );


Event::dispatch( 'ddd', [3] );


Event::add( 'der', function () {


    echo "\nfff";
} );

























