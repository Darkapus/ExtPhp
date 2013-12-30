<?php
namespace Base\Model\Component\Panel\Editor;
use Base\Model\Component\Panel\Grid;

use Base\Model\Component\Core\ExtGenerator;

use Base\Model\Component\Core\Config;

class Column extends Config
{
	protected $grid;
	public function __construct($grid)
	{
		$this->grid = $grid;
	}
	/**
	 * @return Grid
	 */
	public function getGrid()
	{
		return $this->grid;
	}
	/**
	 * modification à la volée du contenu
	 * @param Behavior $return_code
	 */
	public function setDataView($return_code)
	{
		$this->addAttribute('renderer',"function(value,meta){ $return_code; }", true);
		return $this;
	}
	/**
	 * permet la definition d'un filtre sur la colonne
	 * @param string $type
	 */
	public function setFilter($type)
	{
		$this->getGrid()->addFilter($this, $type);	
		return $this;
	}
}