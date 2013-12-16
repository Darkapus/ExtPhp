<?php
class World extends Object
{
	private $gravity;
	public static $i;
	
	public static function i()
	{
		if(is_null(self::$i)) self::$i = new World();
		return self::$i;
	}
	
	public function __construct($x, $y)
	{
		parent::__construct();
		$this->setGravity(new Gravity($x, $y));
		$this->setClass('Box2D.Dynamics.b2World');
	}
	public function getGravity()
	{
		return $this->gravity;
	} 
	public function setGravity(Gravity $gravity)
	{
		$this->gravity = $gravity;
		return $this;
	}
        public function addCircle($x, $y, $radius, $dynamic=true)
        {
            $body=$this->addBody(new BodyDefinition($dynamic));
            $body->addFixture(new FixtureDefinition(new Circle($radius)));
            $body->setPosition($x, $y);
            return $body;
        }
        public function addBox($x, $y, $width, $height, $dynamic=true, $center=null, $angle=0.0)
        {
            $body=$this->addBody(new BodyDefinition($dynamic));
            $body->addFixture(new FixtureDefinition(new Box($width, $height, $center, $angle)));
            $body->setPosition($x, $y);
            return $body;
        }
	public function addBody(BodyDefinition $body_def)
	{
		 $this->addMethod($action = new Body('CreateBody', $body_def));
                 return $action;
	}
	public function preRender()
	{
		$this->getGravity()->render();
		$this->setArguments($this->getGravity() ,'true');
		parent::preRender();
	}
}