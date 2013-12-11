<?php
namespace Base\Model\Component\Panel;

use Base\Model\Component\Core\ExtGenerator;

class MenuBar extends Panel
{
	public function __construct()
	{
		parent::__construct('');
		$this->setLibrary('Ext.menu.Menu');
		$this->addRequire('Ext.menu.*');
		$this->addOption('floating', 'false', true);
	}	
	public function addChild(Menu $element)
	{
		parent::addChild($element);
	}
}