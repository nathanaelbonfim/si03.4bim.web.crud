<?php

namespace PHPhademic\Lib;

/**
 * Loads environments variables
 * 
 * @package PHPhademic\Lib
 */
class Env
{
    /**
     * Loads the environment variables from the .env file or the environment
     * the priority is given to the environment variable
     */
    public static function get(string $key, $default = null): string | null
    {
        $value = getenv($key);

        if ($value === false)
            $value = self::loadEnv($key);

        return $value;
    }

    /**
     * Loads the environment variables from the .env file
     */
    public static function loadEnv(string $key): string | null
    {
        // Verify if envfile is already in memory
        if (isset($_ENV['envfile']))
            return $_ENV['envfile'][$key];

        // Load the envfile
        $envfile = file_get_contents(CONFIG_DIR . '/.env');

        // Parse the envfile
        $envfile = parse_ini_string($envfile);

        // Store the envfile in memory
        $_ENV['envfile'] = $envfile;

        // Return the value
        return $envfile[$key];
    }
}