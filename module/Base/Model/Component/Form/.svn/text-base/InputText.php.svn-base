<?php
namespace Base\Model\Component\Form;
use Base\Model\Component\Form\AbstractInput;

class InputText extends AbstractInput
{
	public function __construct($label, $name, $value=null)
	{
		parent::__construct($label, $name, $value);
		$this->setLibrary('Ext.form.field.Text');
		$this->addOption('xtype', 'textfield');
	}
	
}