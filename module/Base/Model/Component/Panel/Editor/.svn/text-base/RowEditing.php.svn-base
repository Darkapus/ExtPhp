<?php
namespace Base\Model\Component\Panel\Editor;


use Base\Model\Component\Core\Behavior;

use Base\Model\Component\Core\ExtGenerator;

use Base\Model\Component\Core\Config;

use Base\Model\Component\Core\Element;

class RowEditing extends AbstractEditing
{
	public function __construct()
	{
		parent::__construct();
		ExtGenerator::i()->addRequire('Ext.grid.*');
		
		$this->setLibrary('Ext.grid.plugin.RowEditing');
		$this->addOption('clicksToMoveEditor', '1', true);
		$this->addOption('autoCancel','false', true);
		
		$this->addEvent('beforeedit'		, 'editor, e, eOpts');
		$this->addEvent('canceledit'		, 'grid, eOpts');
		$this->addEvent('edit'				, 'editor, e, eOpts');
		$this->addEvent('validateedit'		, 'editor, e, eOpts');
		
	}
	
	
}