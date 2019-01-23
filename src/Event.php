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
    private static $group = null;

    /**
     * @param $name
     * @param callable $callback
     *
     */
    static function add($name, callable $callback)
    {
        self::$events [] = [

            'name' => $name,
            'callback' => $callback,
            'group' => self::$group

        ];
    }


    /**
     * @param string $name
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
        if (isset( self::findCallback( $name )['callback'] )) {
            return call_user_func( self::findCallback( $name )['callback'], ...$params );
        }


        return false;
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
     */
    static function dispatchAll($params = [])
    {
        foreach (self::$events as $event) {

            call_user_func( $event['callback'], ...$params );
        }

    }

    /**
     * @param $groupName
     * @param array $params
     */
    static function dispatchGroup($groupName, $params = [])
    {


        $callbacks = self::findCallbackGroup( $groupName );

        if (isset( $callbacks)) {

            foreach ($callbacks as $callback) {
                call_user_func( $callback['callback'], ...$params );
            }

        }


    }

    /**
     * @param $group
     * @return array
     *
     */
    static private function findCallbackGroup($group)
    {
        $array = [];
        foreach (self::$events as $event) {

            if ($event['group'] == $group)
                $array[] = $event;
        }

        return $array;

    }

    /**
     * @param $name
     * @param callable|null $callback
     * @return Event
     *
     */
    static function group($name, callable $callback = null)
    {

        self::$group = $name;

        if ($callback != null)
            $callback();

        return new self();

    }


    /**
     * @param string $name group name
     */
    static function removeGroup($name)
    {

        $array = self::$events;

        foreach (self::$events as $key => $value) {

            if ($value['group'] == $name)
                unset( $array[$key] );

        }

        self::$events = $array;


    }


    /**
     * @return array
     *
     */
    static function removeAll()
    {

        return self::$events = [];
    }


}