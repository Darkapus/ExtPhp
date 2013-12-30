<?php
namespace Base\Model\Component\Form;

use Base\Model\Component\Core\Behavior;

use Base\Model\Component\Core\Action;

use Base\Model\Component\Core\ExtGenerator;

use Base\Model\Component\Core\Element;

class Button extends Element
{
	public function __construct($label, Action $action=null)
	{
		parent::__construct();
		$this->addOption('xtype', 'button');
		$this->addOption('text', $label);
		$this->setLibrary('Ext.Button');
		ExtGenerator::i()->addRequire('Ext.button.Button');
		$this->addEvent('click', 'button, e, eOpts');
		
		$this->on('click', $this->bBlur());
		$action && $this->on('click', $action->bDo());
		
		
	}
	public function bGetText()
	{
		return new Behavior("$this.getText()");
	}
	public function bSetText($value)
	{
		if(!is_object($value)) $value = "'$value'";
		return new Behavior("$this.setText($value)");
	}
	public function bBlur()
	{
		return new Behavior("$this.blur()");
	}
}