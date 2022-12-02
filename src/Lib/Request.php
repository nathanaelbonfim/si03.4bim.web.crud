<?php

namespace Phphademic\Lib;

class Request
{
    protected array $get;
    protected array $post;

    public function __construct(array $get, array $post)
    {
        $this->get = $get;
        $this->post = $post;
    }

    public function get(string $key): string
    {
        return $this->get[$key];
    }

    public function post(string $key): string
    {
        return $this->post[$key];
    }
}