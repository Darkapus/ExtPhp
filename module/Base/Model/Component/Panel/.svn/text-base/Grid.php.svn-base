<?php 
namespace Base\Model\Component\Panel;

use Base\Model\Component\Core\Behavior;

use Base\Model\Component\Panel\Editor\Column;

use Base\Model\Cis\Object;

use Base\Model\Component\Core\Element;

use Base\Model\Component\Core\Config;

use Base\Model\Component\Store\Storage;

use Base\Model\Component\Core\ExtGenerator;

use Base\Model\Component\Core\Container;

class Grid extends Panel
{
	protected $flex;
	protected $store;
	protected $columns = array();
	
	protected $paging = false;
	protected $features = array();
	protected $group = false;
	/**
	 * 
	 * @param Storage $store
	 * @param string $title
	 */
	public function __construct(Storage $store, $title = null)
	{
		parent::__construct();
		$this->setStore($store);
		$this->setLibrary('Ext.grid.Panel');
		
		$this->addOption('store'			, $store->getId()	,true);
		
		$this->addEvent('beforeedit'		, 'editor, e, eOpts');
		$this->addEvent('canceledit'		, 'grid, eOpts');
		$this->addEvent('edit'				, 'editor, e, eOpts');
		$this->addEvent('validateedit'		, 'editor, e, eOpts');
		$this->addEvent('beforerender'		, 'grid, eOpts');
		$this->addEvent('itemdblclick'		, 'grid, record, item, index, e, eOpts' );
		$this->setBorder(false);
		if(!is_null($title)) $this->addOption('title',$title);
		$this->addOption('padding', 0, true);
		$this->addOption('margin', 0, true);
		//ExtGenerator::i()->addRequire('Ext.toolbar.Paging');
		//ExtGenerator::i()->addRequire('Ext.ux.ajax.JsonSimlet');
		//ExtGenerator::i()->addRequire('Ext.ux.ajax.SimManager');
		
		ExtGenerator::i()->addRequire('Ext.grid.*');
	}
	/**
	 * Grouper les champs selon le field du storage
	 * @param string $field
	 */
	public function setGroup($field)
	{
		ExtGenerator::i()->addRequire('Ext.grid.feature.Grouping');
		$group = new Config();
		$group->addAttribute('ftype', 'grouping');
		$group->addAttribute('groupHeaderTpl', '{name} ({rows.length})');
		//$group->addAttribute('hideGroupedHeader', 'true', true);
		//$group->addAttribute('startCollapsed', 'true', true);
		
		$this->addFeature($group); 
		
		$this->getStore()->addOption('groupField', $field);
		
		$this->group = true;
	}
	/**
	 * 
	 * @param boolean $b
	 */
	public function setSelectMultiple($b=true)
	{
		$this->addOption('multiSelect'		, ($b?'true':'false'),true);
		return $this;
	}
	
	public function addFeature($feature)
	{
		$this->features[] = $feature;
		return $this;
	}
	public function getFeatures()
	{
		return $this->features;
	}
	
	/**
	 * @return Config
	 */
	public function getColumns()
	{
		return $this->columns;
	}
	/**
	 * Retourne le storage de la grille (obligatoire)
	 * @return Storage
	 */
	public function getStore()
	{
		return $this->store;
	}
	/**
	 * definition du storage
	 * @param Storage $store
	 */
	public function setStore(Storage $store)
	{
		$this->store = $store;
		return $this;
	}
	/**
	 * Ajoute un paging en bas de la grille
	 * @param unknown_type $bool
	 * @return Grid
	 */
	public function setPaging($bool=true)
	{
		$this->paging = $bool;
		return $this;
	}
	/**
	 * Si on souhaite redéfinir le style d'une row en fonction de la data c'est ici
	 * @param Behavior $return_code
	 * @return Grid
	 */
	public function setRowView(Behavior $return_code)
	{
		$viewConfig = new Config();
		$viewConfig->addAttribute('getRowClass', "function(record) { $return_code; }", true);
		
		$this->addOption('viewConfig'		, $viewConfig		,true);
		return $this;
	}
	/**
	 * ajoute une colonne à la grille
	 * @param string $header
	 * @param string $dataIndex
	 * @param integer $width
	 * @return Column;
	 */
	public function addColumn($header,	$dataIndex, $width=null)
	{
		$col = new Column();
		$col->addAttribute('header', $header);
		$col->addAttribute('dataIndex', $dataIndex);
		
		if(is_null($width)) $col->addAttribute('flex', 1, true);
		
		if(!is_null($width)) $col->addAttribute('width', $width, true);
		
		array_push($this->columns, $col);
		
		return $col;
	}
	/**
	 * (non-PHPdoc)
	 * @see Base\Model\Component\Core.Element::preRender()
	 */
	protected function preRender()
	{
		// ajout du plugin filter ne fonctionne pas en 4.2.1
		// $this->addOption('features', "[{ftype:'filters', local:true, encode:false,filters:[{type:'string', dataIndex:'name'}]}]", true);
		// $this->addOption('loadMask', 'true', true);
		
		if($this->features) $this->addOption('features', $this->getFeatures(), true);
		parent::preRender();
		$this->getStore()->render();
		
		$this->addOption('columns', $this->getColumns(), true);
	}
	public function bSave($url, $method='POST', Behavior $success=null, Behavior $failure=null)
	{
		$fields = array();
		foreach($this->getStore()->getFields() as $field)
		{
			$fields[$field] = "$field : e.record.data['$field']";
		}
		return new Behavior("Ext.Ajax.request({method:'$method',url: '$url',params: { ".implode(',',$fields)." }, success:function(response, opts){ $success }, failure:function(response, opts){ $failure }});");
	}
	public function bGetSelectionField($field)
	{
		return new Behavior($this.".getSelectionModel().getLastSelected().get('$field')");
	}
	public function bGetSelection()
	{
		return new Behavior($this.'.getSelectionModel().getLastSelected().getData()');
	}
	public function bGetSelections()
	{
		return new Behavior($this.'.getSelectionModel().getSelection()');
	}
}