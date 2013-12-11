<?php
namespace Base\Model\Component\Panel;

use Base\Model\Component\Core\Element;

class Menu extends Element
{
	public function __construct($label, $icon=null)
	{
		parent::__construct();
		$this->setLibrary('Ext.menu.Item');
		$this->addRequire('Ext.menu.*');
		$this->setLabel($label);
		$icon && $this->setIcon($icon);
	}
	public function setLabel($label)
	{
		$this->addOption('text', $label);
		return $this;
	}
	public function setIcon($icon)
	{
		$this->addOption('iconCls', $icon);
		return $this;
	}
}