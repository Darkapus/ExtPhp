<?php
namespace Base\Model\Component\Core;
use Base\Model\Component\Core\Config;
class Element
{
	protected $id;
	protected $library;
	protected $config;
	protected $listeners;
	protected $events =array();
	protected $is_render = false;
	public function __construct($id=null)
	{
		getenv('APPLICATION_ENV')=='development'  && error_log('Invocation de '.get_called_class());
		
		$this->config 	= new Config();
		if(!is_null($id)) $this->setId($id);
		else $this->setId(uniqid('element_'));
		
		getenv('APPLICATION_ENV')=='development'  && error_log('Identifiant : '.$this->getId());
		
		$this->listeners= new Config();
		$this->addOption('listeners', $this->getListeners(), true);
		$this->setGlobal();
		
		$this->addEvent('render', 'element, eOpts');
		$this->addEvent('afterrender', 'element, eOpts');
	}
	
	public function setGlobal()
	{
		ExtGenerator::i()->addGlobal($this);
	}
	public function __clone()
	{
		$this->id 		= uniqid('element_');
	}
	public function isRender()
	{
		return $this->is_render;
	}
	public function setRender($bool)
	{
		$this->is_render = $bool;
		return false;
	}
	public function setId($id)
	{
		$this->id = $id;
		$this->config->setAttribute('id', $id);
		return $this;
	}
	public function getId()
	{
		return $this->id;
	}
	public function addOption($k, $v, $object=false)
	{
		$this->getOptions()->addAttribute($k, $v, $object);
		return $this;
	}
	public function setOption($k, $v, $object=false)
	{
		$this->getOptions()->setAttribute($k, $v, $object);
		return $this;
	}
	public function getOption($k)
	{
		return $this->getOptions()->$k;
	}
	/**
	 * @return Config
	 */
	public function getOptions()
	{
		return $this->config;
	}
	public function getConfig()
	{
		
		return $this->getOptions()->getJson();
	}
	public function setLibrary($v)
	{
		$this->library = $v;
		return $this;
	}
	public function getLibrary()
	{
		return $this->library;
	}
	protected function preRender()
	{
		return $this;
	}
	protected function postRender()
	{
		return $this;
	}
	public function render()
	{
		if(!$this->isRender())
		{
			getenv('APPLICATION_ENV')=='development'  && error_log('Rendu de '.get_called_class().' en cours ...');
			// pre rendu
			$this->preRender();
			echo ''.$this->getId().' = new '.$this->getLibrary().'('.RC;
			// recuperation des config
			echo $this->getConfig().RC;
			echo ');'.RC;
			// post rendu
			$this->postRender();
			
			// on ne rend pas deux fois le meme objet
			$this->setRender(true);
			getenv('APPLICATION_ENV')=='development'  && error_log('Rendu de '.get_called_class().' done');
		}
	}
	public function getEvents()
	{
		return $this->events;
	}
	public function getEventAttributes($name)
	{
		return $this->events[$name];
	}
	public function addEvent($name, $attributes)
	{
		$this->events[$name] = $attributes;
		return $this;
	}
	public function __toString()
	{
		return $this->getId();
	}
	/**
	 * @return Config
	 */
	public function getListeners()
	{
		return $this->listeners;
	}
	public function bFire($name){
		return new Behavior("$this.fireEvent('$name')");
	}
	/**
	 * gestion des evenements ici
	 * @param string $name
	 * @param Behavior $behavior
	 * @return Element
	 */
	public function on($name, Behavior $behavior)
	{
		if(property_exists($this->getListeners(), $name))
		{
			$behavior = str_replace('; }', ';'.$behavior.'; }', $this->getListeners()->$name);
			$this->getListeners()->setAttribute($name, $behavior, true);
		}
		else
		{
			$this->getListeners()->addAttribute($name, "function(".$this->getEventAttributes($name)."){ $behavior; }", true);
		}
		return $this;		
	}
	public function addRequire($require)
	{
		ExtGenerator::i()->addRequire($require);
		return $this;
	}
	
	public function bHide()
	{
		return new Behavior($this.'.hide()');
	}
}