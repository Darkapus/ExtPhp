<?php
namespace Base\Model\Component\Panel\Editor;
use Base\Model\Component\Core\ExtGenerator;

use Base\Model\Component\Core\Config;

class Column extends Config
{
	protected $filter = null;
	public function __construct()
	{
		$this->filter = new Config();
	}
	public function setDataView($return_code)
	{
		$this->addAttribute('renderer',"function(value,meta){ $return_code; }", true);
		return $this;
	}
	public function getFilter()
	{
		return $this->filter;
	}
	public function setFilter($type)
	{
		ExtGenerator::i()->addRequire('Ext.ux.grid.FiltersFeature');
		
		$this->addAttribute('filter', $this->getFilter());
		$this->getFilter()->addAttribute('type', $type);
		
		return $this;
	}
}