<?php

/**
 * Session
 * Class library for setting, getting, and checking session state.
 */
class Session
{
    /**
     * Set a session variable.
     */
    public static function set($sKey, $sValue)
    {
        $_SESSION[$sKey] = $sValue;
    }

    /**
     * Get a session variable.
     */
    public static function get($sKey)
    {
    //    return $_SESSION[$sKey];
    }

    /**
     * Check if a session variable is set.
     */
    public static function isset($sKey)
    {
        return (isset($_SESSION[$sKey]));
    }

    /**
     * Fetch all session variables.
     */
    public static function all()
    {
        return $_SESSION;
    }
}
