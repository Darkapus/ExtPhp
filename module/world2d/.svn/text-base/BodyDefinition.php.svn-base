<?php
class BodyDefinition extends Object
{
	
	protected $dynamic = true;
	public function __construct($dynamic = true)
	{
		parent::__construct();
		$this->setDynamic($dynamic);
		$this->setClass("Box2D.Dynamics.b2BodyDef");
	}
	public function setDynamic($bool)
	{
		$this->dynamic = $bool;
		return $this->dynamic;
	}
	public function isDynamic()
	{
		return $this->dynamic;
	}
	
        public function setPosition($x, $y)
        {
            $this->setAttribute('position', new Vector($x, $y), true);
        }
	
	public function preRender()
	{
		
		if($this->isDynamic()){
                    $this->setAttribute('type', 'Box2D.Dynamics.b2Body.b2_dynamicBody', true);
                }
		else{
                    $this->setAttribute('type', 'Box2D.Dynamics.b2Body.b2_staticBody' ,true);
                }
		
                parent::preRender();
	}
}