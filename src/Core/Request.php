<?php

namespace Paw\Core;

class Request 
{
    public function uri() 
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    public function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function get($key)
    {
        global $log;

        // $log->info("key: ", $key);
        // $log->info('POST[key]: ', [$_POST[$key]]);
        return $_POST[$key] ?? $_GET[$key] ?? null;
    }
        
    public function route()
    {
        return [
            $this->uri(),
            $this->method()
        ];
    }
}