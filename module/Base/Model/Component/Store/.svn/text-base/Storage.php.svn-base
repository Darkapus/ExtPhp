<?php
namespace Base\Model\Component\Store;
use Base\Model\Component\Core\Behavior;

use Base\Model\Cis\Object;

use Base\Model\Component\Core\ExtGenerator;

use Base\Model\Component\Core\Element;

class Storage extends Element
{
	private $fields;
	public function __construct($id=null)
	{
		parent::__construct($id);
		
		$this->setLibrary('Ext.data.Store');
		$this->addEvent('load', 'store, records, successful, operation, eOpts ');
		$this->addEvent('beforeload', 'store, operation, eOpts ');
		ExtGenerator::i()->addRequire('Ext.data.*');
	}
	public function addField($v)
	{
		$this->fields[] = $v;
		return $this;
	}
	public function getFields()
	{
		return $this->fields;
	}
	protected function preRender()
	{
		$this->addOption('fields', json_encode($this->getFields()), true);
		return $this;
	}
	/**
	 * Behavior pour charger un storage
	 * @return Behavior
	 */
	public function bLoad()
	{
		return new Behavior($this.'.load();');
	}
	/**
	 * Behavior pour charger un storage
	 * @return Behavior
	 */
	public function bReload()
	{
		return new Behavior($this.'.load();');
	}
}