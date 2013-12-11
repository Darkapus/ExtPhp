<?php
namespace Base\Model\Component\Form;

use Base\Model\Component\Store\Storage;

use Base\Model\Component\Core\ExtGenerator;

use Base\Model\Component\Core\Element;

class ComboBox extends AbstractInput
{
	private $store;
	public function __construct($label, $name, $value=null, Storage $store, $valueField, $displayField)
	{
		parent::__construct($label, $name, $value=null);
		$this->setLibrary('Ext.form.ComboBox');
		
		// on clone le storage pour éviter des conflit de lecture
		$this->setStore($store);
		$this->addOption('xtype', 'combobox');
		$this->addOption('valueField',$valueField);
		$this->addOption('displayField',$displayField);
				
	}
	public function setEditable($b=true)
	{
		$this->addOption('editable', ($b?'true':'false'),true);
		return $this;
	}
	public function setStore(Storage $store)
	{
		$this->store = $store;
		$this->addOption('store', $store->getId(), true);
		return $this;
	}
	public function getStore()
	{
		return $this->store;
	}
	protected function preRender()
	{
		$this->getStore()->render();
		parent::preRender();
	}
	
}