<?php
namespace Base\Model\Component\Panel;
use Base\Model\Component\Core\ExtGenerator;

use Base\Model\Component\Core\Container;

class StatusBar extends Container
{
	public function __construct()
	{
		parent::__construct();
		
		$this->setLibrary('Ext.toolbar.Toolbar');
		
		ExtGenerator::i()->addRequire('Ext.toolbar.Toolbar');
	}
	public function fill()
	{
		$this->addChild(new Fill());
	}
	
}