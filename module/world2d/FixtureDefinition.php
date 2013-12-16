<?php
class FixtureDefinition extends Object
{
	public function __construct($form = null, $density=1, $friction=0.5, $restitution=0.2)
	{
		parent::__construct();
		$this->setClass("Box2D.Dynamics.b2FixtureDef");
                $this->setDensity($density);
                $this->setFriction($friction);
                $this->setRestitution($restitution);
                if ($form) {
                    $this->setForm($form);
                }
        }
	public function setForm($v)
	{
		$this->setAttribute('shape', $v, true);
	}
	public function setFriction($v)
	{
		$this->setAttribute('friction', $v, true);
		return $this;
	}
	public function setDensity($v)
	{
		$this->setAttribute('density', $v, true);
		return $this;
	}
	public function setRestitution($v)
	{
		$this->setAttribute('restitution', $v, true);
		return $this;
	}
}