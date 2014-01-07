<?php

// __expectation__
// will record the parameters passed along on the expectations stack. When called without parameters, will pop the last
// expectation from the stack.
function expectation () {
    static $stack = array();

    // no parameters ? return the last expectation
    if (!func_num_args())
        return array_pop($stack);

    // fetch current script line and arguments
    $args = func_get_args();
    $bt   = debug_backtrace();
    $line = $bt[0]['line'];

    // any function passed along ? call them !
    array_walk($args, function (& $item) {
        is_callable($item) && $item = $item();
    });

    // stack it
    $stack[] = compact('line', 'args');
    return true;
}

// __reality__
// will compare the provided parameters with the last expectation. If no previous expectation could be found or if the 
// reality's parameters doesn't match expectation, returns false and displays a message. Otherwise, returns true.
function reality () {
    static $eol;
    !isset($eol) && $eol = (PHP_SAPI == 'cli' ? "\n" : "<br />");

    if (!func_num_args())
        return true;

    // fetch current script line and arguments
    $args = func_get_args();
    $bt   = debug_backtrace();
    $line = $bt[0]['line'];

    // any function passed along ? call them !
    array_walk($args, function (& $item) {
        is_callable($item) && $item = $item();
    });

    // fetch the last expectation
    $expectation = expectation();

    // if there's nothing to expect
    if (empty($expectation)) {
        echo "Nothing is expected at line {$line}{$eol}";
        return false;
    }

    // compare argument by argument
    foreach ($args as $offset => $arg) {
        // if such argument doesn't exists or differ from expectation
        if (!isset($expectation['args'][$offset]) || $expectation['args'][$offset] != $arg) {
            echo "Reality defined at line {$line} doesn't match expectation from line {$expectation['line']}{$eol}";
            return false;
        }
    }

    return true;
}