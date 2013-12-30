<?php
namespace Base\Model\Component\Panel;

use Base\Model\Component\Core\Element;

class Menu extends Element
{
	/**
	 * 
	 * @param string $label
	 * @param string $icon
	 */
	public function __construct($label, $icon=null)
	{
		parent::__construct();
		$this->setLibrary('Ext.menu.Item');
		$this->addRequire('Ext.menu.*');
		$this->setLabel($label);
		$icon && $this->setIcon($icon);
	}
	/**
	 * 
	 * @param string $label
	 * @return \Base\Model\Component\Panel\Menu
	 */
	public function setLabel($label)
	{
		$this->addOption('text', $label);
		return $this;
	}
	/**
	 * 
	 * @param string $icon
	 * @return \Base\Model\Component\Panel\Menu
	 */
	public function setIcon($icon)
	{
		$this->addOption('iconCls', $icon);
		return $this;
	}
}