<?php
namespace Base\Model\Component\Panel;

use Base\Model\Component\Core\Config;

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
		$this->addPlugin("Ext.create('Ext.ux.TabReorderer')");	 // ne fonctionne pas pour le moment	
	}
	public function bAdd($url, Config $params=null, $method='POST')
	{
		$config = '';
		if($params) $config='data:'.$params->getJson().','.RC;
		return new Behavior('$.ajax({
				url:\''.$url.'?partial='.$this.'\',
				dataType:"script",
				'.$config.'
				type: "'.$method.'",
				success: function(){'.$this.'.setActiveTab('.$this.'.items.last())}
		});');
	}
	public function bAddDistantContent($title, $url, $closable=true, Config $config=null)
	{
		if(!is_object($title)) $title = "'$title'";
		if(!is_object($url)) $url = "'$url'";
		$closable = $closable?'true':'false';
		$config = $config?$config:new Config();
		$config->addAttribute('noheader', 'true', true);
		
		return new Behavior("$this.add({xtype:'panel', title:$title, closable:$closable, loader:{url:$url,autoLoad:true,params:".$config->getJson()."}});$this.setActiveTab($this.items.last());");
	}
}