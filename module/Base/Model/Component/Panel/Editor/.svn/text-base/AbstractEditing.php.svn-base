<?php
namespace Base\Model\Component\Panel\Editor;
use Base\Model\Component\Core\Element;

class AbstractEditing extends Element
{
	public function __contruct()
	{
		parent::__construnct();
		ExtGenerator::i()->addRequire('Ext.grid.*');
		$this->addOption('clicksToEdit', '2', true);
	}
	
}