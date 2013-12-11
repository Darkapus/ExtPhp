<?php
namespace Base\Model\Component\Form;

use Base\Model\Component\Core\ExtGenerator;

use Base\Model\Component\Core\Element;

class CheckBox extends AbstractInput
{
	public function __construct($label, $name, $checked=false)
	{
		parent::__construct();
		$this->setLibrary('Ext.form.field.Checkbox');
		
		//$this->addAttribute('xtype', 'checkbox');
		$this->addOption('boxLabel', $label);
		
		if($checked)	$this->addOption('value', 'true', true);
		
		$this->addOption('inputValue', 'true', true);
		$this->addOption('uncheckedValue', 'true', false);
		
		if($checked) 	$this->addOption('checked', 'true', true);
		$this->addOption('xtype', 'checkbox');
		
	}
}