<?php
namespace Base\Model\Component\Form;

use Base\Model\Component\Core\ExtGenerator;

use Base\Model\Component\Core\Element;

class AbstractInput extends Element
{
	public function __construct($label, $name, $value=null)
	{
		parent::__construct();
		$this->addOption('name', $name);
		$label&&$this->addOption('fieldLabel', $label);
		$this->addOption('labelWidth', 150, true);
		$value && $this->setValue($value);
		$this->addEvent('focus','');
		$this->addEvent('change', 'input, newValue, oldValue, eOpts');
		ExtGenerator::i()->addRequire('Ext.form.*');
	}
	
	public function setEmptyText($text)
	{
		$this->addOption('emptyText', $text);
		return $this;
	}
	public function getXType()
	{
		return $this->getOptions();
	}
	
	public function setRequire($b=true)
	{
		$this->addOption('allowBlank','false',true);
		return $this;
	}
	public function setLabelWidth($width)
	{
		$this->addOption('labelWidth', $width, true);
		return $this;
	}
	public function setXType($xtype)
	{
		$this->addOption('xtype', $xtype);
		return $this;
	}
	public function setValue($value)
	{
		$this->addOption('value', $value);
		return $this;
	}
	public function setWidth($width)
	{
		$this->addOption('width',$width);
		return $this;
	}
	
}