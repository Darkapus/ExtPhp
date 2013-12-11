<?php
namespace Base\Model\Component\Panel;

use Base\Model\Component\Core\Behavior;

use Base\Model\Component\Core\ExtGenerator;

use Base\Model\Component\Panel\Panel;

class Form extends Panel
{
	public function __construct($title, $url=null)
	{
		parent::__construct($title);
		$this->setLibrary('Ext.form.Panel');
		$this->addOption('url', $url);
		$this->addOption('layout', 'form');
		ExtGenerator::i()->addRequire('Ext.form.*');
			
		$this->addEvent('actioncomplete', 'form, action, eOpts');
		$this->addEvent('actionfailed', 'form, action, eOpts');
	}
	public function onSuccess(Behavior $behavior)
	{
		$this->on('actioncomplete', $behavior);
		return $this;
	}
	public function onFailure(Behavior $behavior)
	{
		$this->on('actionfailed', $behavior);
		return $this;
	}
	public function bSubmit(Behavior $success=null, Behavior $failure=null)
	{
		return new Behavior("
		form = $this.getForm();
		if(form.isValid())
		{
			form.submit({
				success: function(form, action){ $success },
				failure: function(form, action){ $failure }
			});
		}
		");
	}
}