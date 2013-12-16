<?php

class Fixture extends Action
{
    protected $body;
    public function __construct($method, $arguments = array()) {
        parent::__construct($method, $arguments);
    }
    public function setBody(Body $body)
    {
        $this->body = $body;
        return $this;
    }
    public function getBody()
    {
        return $this->body;
    }
}
