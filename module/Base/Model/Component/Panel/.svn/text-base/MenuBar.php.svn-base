<?php
namespace Base\Model\Component\Panel;

use Base\Model\Component\Core\ExtGenerator;
/**
 * 
 * @author bbaschet
 *
 */
class MenuBar extends Panel
{
	public function __construct()
	{
		parent::__construct('');
		$this->setLibrary('Ext.menu.Menu');
		$this->addRequire('Ext.menu.*');
		$this->addOption('floating', 'false', true);
	}
	/**
	 * (non-PHPdoc)
	 * @see Base\Model\Component\Core.Container::addChild()
	 */
	public function addChild(Menu $element)
	{
		parent::addChild($element);
	}
}