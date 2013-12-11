<?php
namespace Base\Model\Component\Form;
use Base\Model\Component\Form\AbstractInput;

class TextArea extends AbstractInput
{
	public function __construct($label, $name, $value=null)
	{
		parent::__construct($label, $name, $value);
		$this->setLibrary('Ext.form.field.TextArea');
		$this->addOption('xtype', 'textareafield');
	}

}