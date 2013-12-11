<?php
namespace Base\Model\Component\Core;

class Behavior
{
	private $script;
	public function __construct($script)
	{
		$this->script = $script;
	}
	public function getScript()
	{
		return $this->script;
	}
	public function __toString()
	{
		return $this->getScript();
	}
	
}