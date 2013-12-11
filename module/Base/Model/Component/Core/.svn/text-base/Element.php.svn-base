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
		DEV && error_log('Invocation de '.get_called_class());
		
		$this->config 	= new Config();
		if(!is_null($id)) $this->setId($id);
		else $this->setId(uniqid('element_'));
		
		DEV && error_log('Identifiant : '.$this->getId());
		
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
			DEV && error_log('Rendu de '.get_called_class().' en cours ...');
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
			DEV && error_log('Rendu de '.get_called_class().' done');
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
	/**
	 * gestion des evenements ici
	 * @param string $name
	 * @param Behavior $behavior
	 * @return Element
	 */
	public function on($name, Behavior $behavior)
	{
		$this->getListeners()->addAttribute($name, "function(".$this->getEventAttributes($name)."){ $behavior; }", true);
		return $this;		
	}
	public function addRequire($require)
	{
		ExtGenerator::i()->addRequire($require);
		return $this;
	}
}