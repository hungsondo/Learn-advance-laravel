<?php

if (!function_exists('my_custom_helper')) {
    /**
     * A custom helper function.
     *
     * @param string $name
     * @return string
     */
    function my_custom_helper(string $name): string
    {
        return "Hello, " . ucfirst($name) . "!";
    }
}