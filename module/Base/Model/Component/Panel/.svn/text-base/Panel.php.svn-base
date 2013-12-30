<?php
namespace Base\Model\Component\Panel;

use Base\Model\Component\Core\Behavior;

use Base\Model\Component\Core\Config;

use Base\Model\Component\Form\Button;

use Base\Model\Component\Core\ExtGenerator;

use Base\Model\Component\Core\Container;
/**
 * Panel de base
 * @author bbaschet
 *
 */
class Panel extends Container
{
	protected $plugins = array();
	private $topbar 	= null;
	private $bottombar 	= null;
	private $buttons	= array();
	/**
	 * 
	 * @param string $title
	 */
	public function __construct($title='')
	{
		parent::__construct();
		$this->setLibrary('Ext.panel.Panel');
		$this->addOption('title', $title);
		ExtGenerator::i()->addRequire('Ext.panel.Panel');
		$this->setLayout('auto');
		$this->setBorder(false);
		$this->addOption('buttons', array(), true);
		$this->addEvent('expand', 'p, eOpts');
		$this->addEvent('collapse', 'p, eOpts');
		$this->addEvent('beforecollapse', 'p, direction, animate, eOpts');
		$this->addEvent('beforeexpand', 'p, animate, eOpts');
		$this->addEvent('remove', 'p, component, eOpts');
	}
	/**
	 * 
	 * @param Button $button
	 * @return \Base\Model\Component\Panel\Panel
	 */
	public function addButton(Button $button)
	{
		// récupere option bouton
		$option = $this->getOption('buttons');
		// ajoute id du bouton dans les options (sera rendu dans le prerender
		$option[] = $button->getId();
		// redéfinition
		$this->setOption('buttons', $option, true);
		// ajoute le bouton pour le prerender
		$this->buttons[] = $button;
		return $this;
	}
	
	public function setLayout($layout)
	{
		$this->addOption('layout', $layout);
		return $this;
	}
	/**
	 * @return array(Button)
	 */
	public function getButtons()
	{
		return $this->buttons;
	}
	/**
	 * 
	 * @param boolean $b
	 * @return \Base\Model\Component\Panel\Panel
	 */
	public function setFrame($b=true)
	{
		$this->addOption('frame'		, ($b?'true':'false'),true);
		return $this;
	}
	/**
	 * 
	 * @param boolean $b
	 * @return \Base\Model\Component\Panel\Panel
	 */
	public function setBorder($b=true)
	{
		$this->addOption('border'		, ($b?'true':'false'),true);
		return $this;
	}
	/**
	 * Le panel peut il se fermer ?
	 * @param boolean $bool
	 * @return \Base\Model\Component\Panel\Panel
	 */
	public function setClosable($bool=true)
	{
		$this->addOption('closable', $bool);
		return $this;
	}
	/**
	 * 
	 * @param StatusBar $tb
	 * @return \Base\Model\Component\Panel\Panel
	 */
	public function setTopBar(StatusBar $tb)
	{
		$this->addOption('tbar', $tb->getId(), true);
		$this->topbar = $tb;
		return $this;
	}
	/**
	 * 
	 * @param StatusBar $bb
	 * @return \Base\Model\Component\Panel\Panel
	 */
	public function setBottomBar(StatusBar $bb)
	{
		$this->addOption('bbar', $bb->getId(), true);
		$this->bottombar = $bb;
		return $this;
	}
	/**
	 * @return StatusBar
	 */
	public function getTopBar()
	{
		return $this->topbar;
	}
	/**
	 * @return StatusBar
	 */
	public function getBottomBar()
	{
		return $this->bottombar;
	}
	/**
	 * (non-PHPdoc)
	 * @see Base\Model\Component\Core.Element::preRender()
	 */
	protected function preRender()
	{
		$this->addOption('plugins', $this->getPlugins(), true);
		if($this->getTopBar()) $this->getTopBar()->render();
		if($this->getBottomBar()) $this->getBottomBar()->render();
		foreach($this->getButtons() as $button)
		{
			$button->render();
		}
		return parent::preRender();
	}
	public function bToggleCollapse()
	{
		return new Behavior("$this.toggleCollapse()");
	}
	public function bExpand()
	{
		return new Behavior("$this.expand()");
	}
	public function bCollapse()
	{
		return new Behavior("$this.collapse()");
	}
	public function setMargin($margin=0)
	{
		$this->addOption('margin', $margin);
		return $this;
	}
	public function setPadding($padding=0)
	{
		$this->addOption('padding', $padding);
		return $this;
	}
	public function setCollapse($b=true)
	{
		$this->addOption('collapsible'		, ($b?'true':'false'),true);
		return $this;
	}
	public function setResizable($b=true)
	{
		$this->addOption('resizable'		, ($b?'true':'false'),true);
		return $this;
	}
	public function setRegion($region)
	{
		$this->addOption('region', $region);
		return $this;
	}
	public function west()
	{
		return $this->setRegion('west');
	}
	public function east()
	{
		return $this->setRegion('east');
	}
	public function north()
	{
		return $this->setRegion('north');
	}
	public function south()
	{
		return $this->setRegion('south');
	}
	public function center()
	{
		return $this->setRegion('center');
	}
	
	
	
	
	
	public function addPlugin($plugin)
	{
		$this->plugins[] = $plugin;
		return $this;
	}
	public function getPlugins()
	{
		return $this->plugins;
	}
}