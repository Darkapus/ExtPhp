<?php
namespace Base\Model\Component\Panel;

use Base\Model\Component\Core\ExtGenerator;

use Base\Model\Component\Core\Container;

class Viewport extends Panel
{
	public function __construct()
	{
		parent::__construct();
		
		$this->setLibrary('Ext.Viewport');
		ExtGenerator::i()->addRequire('Ext.Viewport');
		$this->addOption('padding', 0, true);
	}
}
