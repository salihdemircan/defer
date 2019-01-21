<?php


namespace Defer;

/**
 * Class Event
 * @package Defer
 *
 */
class Event
{

    private static $events = [];

    /**
     * @param $name
     * @param callable $callback
     *
     */
    static function add($name, callable $callback)
    {
        self::$events [] = [

            'name' => $name,
            'callback' => $callback

        ];
    }


    /**
     * @param $name
     * @return bool
     *
     */
    static function remove($name)
    {


        foreach (self::$events as $key => $value) {
            if ($key == $name) {
                unset( self::$events[$key] );
                return true;
            }


        }

        return false;

    }

    /**
     * @param $name
     * @param array $params
     * @return mixed
     *
     */
    static function dispatch($name, $params = [])
    {
        return call_user_func( self::findCallback( $name )['callback'], ...$params );
    }


    static private function findCallback($name)
    {


        foreach (self::$events as $event) {

            if ($event['name'] == $name)
                return $event;
        }

        return false;


    }


    /**
     * @param array $params
     *
     */
    static function callAllEvent($params = [])
    {

        foreach (self::$events as $event) {

            call_user_func( $event['callback'], ...$params );
        }
    }
}