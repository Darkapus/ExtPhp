<?php
namespace Base\Model\Component\Panel;

use Base\Model\Component\Core\Behavior;

use Base\Model\Component\Core\ExtGenerator;

class TabPanel extends Panel
{
	public function __construct($title)
	{
		parent::__construct($title);
		$this->setLibrary('Ext.tab.Panel');
		$this->setBorder(true);
		ExtGenerator::i()->addRequire('Ext.tab.Panel');
		$this->addRequire('Ext.ux.TabReorderer');
		$this->addEvent('add', 'panel, container, pos, eOpts');
		//$this->addPlugin("Ext.create('Ext.ux.TabReorderer')");	 // ne fonctionne pas pour le moment	
	}
	public function bAdd($url)
	{
		return new Behavior('$.ajax({
				url:\''.$url.'?partial='.$this.'\',
				dataType:"script",
				type: "POST",
				success: function(){'.$this.'.setActiveTab('.$this.'.items.last())}
		});');
	}
	public function bAddDistantContent($title, $url)
	{
		if(!is_object($title)) $title = "'$title'";
		if(!is_object($url)) $url = "'$url'";
		return new Behavior("$this.add({xtype:'panel', title:$title, closable:true, loader:{url:$url,autoLoad:true,params:{noheader:true}}});$this.setActiveTab($this.items.last());");
	}
}