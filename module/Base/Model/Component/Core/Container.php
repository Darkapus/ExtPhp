<?php
namespace Base\Model\Component\Core;
use Base\Model\Component\Core\Element;
class Container extends Element
{
	protected $childs = array();
	public function addChild($element)
	{
		$this->childs[] = $element;
		return $this;
	}
	public function getChilds()
	{
		return $this->childs;
	}
	public function render()
	{
		$childs = array();
		foreach($this->getChilds() as $child)
		{
			$child->render();
			$childs[] = $child->getId();
		}
		if(count($childs)) $this->addOption('items', $childs, true);
		parent::render();
	}
}