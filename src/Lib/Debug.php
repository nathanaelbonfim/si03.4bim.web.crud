<?php

namespace PHPhademic\Lib;

/**
 * A collection of useful functions to debug your code
 */
class Debug
{
    /**
     * Prints the variable in a readable format
     */
    public static function dump($var): void
    {
        echo '<pre>';
        var_dump($var);
        echo '<hr/>';
        debug_print_backtrace(0);
        echo '</pre>';
    }

    /**
     * Prints the variable in a readable format and stops the execution
     */
    public static function dd($var): void
    {
        self::dump($var);
        die();
    }

    /**
     * Prints the variable in a readable format
     */
    public static function debug($var): void
    {
        self::dump($var);
    }
}