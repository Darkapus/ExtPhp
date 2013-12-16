<?php

class Circle extends Object
{
    public function __construct($radius) {
        parent::__construct();
        $this->setArguments($radius);
        $this->setClass('Box2D.Collision.Shapes.b2CircleShape');
    }
}