<?php
namespace Base\Model\Component\Panel\Editor;


use Base\Model\Component\Core\ExtGenerator;

use Base\Model\Component\Core\Config;

use Base\Model\Component\Core\Element;

class CellEditing extends AbstractEditing
{
	public function __construct()
	{
		parent::__construct();
		$this->setLibrary('Ext.grid.plugin.CellEditing');
		
	}
	
}