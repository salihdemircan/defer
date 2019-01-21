<?php

namespace Defer;

/**
 * Class Defer
 * @package Defer
 *
 */
class Defer
{
    /**
     * @param callable $callback
     *
     */
    function addEvent(callable $callback)
    {

        register_shutdown_function( $callback );
    }

}