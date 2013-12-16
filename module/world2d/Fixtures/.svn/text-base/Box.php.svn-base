<?php

class Box extends Polygon
{
    public function __construct($width, $height, $vector=null, $angle=0.0) {
        parent::__construct();
        if(is_null($vector)){
            $vector = new Vector($width/2, $height/2);
        }
        $this->addMethod( new Action('SetAsOrientedBox', array($width, $height, $vector , $angle)) );
    }
}