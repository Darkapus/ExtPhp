<?php
class Vector extends Object
{
	public function __construct($x=0, $y=0)
	{
		parent::__construct();
		$this->setClass('Box2D.Common.Math.b2Vec2');
		$this->setArguments($x, $y);
	}
}