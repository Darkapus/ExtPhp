<?php
namespace Base\Model\Component\Form;

use Base\Model\Component\Core\ExtGenerator;

class DateField extends AbstractInput
{
	public function __construct($label, $name, $value=null)
	{
		parent::__construct($label, $name, $value);
		$this->setXType('datefield');
		$this->setLibrary('Ext.form.field.Date');
		$this->setFormat('d/m/Y');
		ExtGenerator::i()->addRequire('Ext.form.*');
		
	}
	public function setFormat($format)
	{
		$this->addOption('format', $format);
		return $this;
	}
}