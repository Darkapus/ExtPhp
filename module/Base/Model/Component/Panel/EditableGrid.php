<?php
namespace Base\Model\Component\Panel;
use Base\Model\Component\Panel\Editor\AbstractEditing;

use Base\Model\Component\Store\Storage;

use Base\Model\Component\Panel\Editor\RowEditing;

use Base\Model\Component\Panel\Editor\Column;

use Base\Model\Component\Core\Config;

use Base\Model\Component\Core\Element;

use Base\Model\Component\Panel\Editor\CellEditing;

use Base\Model\Component\Panel\Grid;

class EditableGrid extends Grid
{
	
	private $elements = array();
	private $editor;
	/**
	 * 
	 * @param Storage $store
	 * @param string $title
	 * @param string $url_save
	 * @param boolean $rowediting
	 */
	public function __construct(Storage $store, $title = null, $rowediting=false)
	{
		parent::__construct($store, $title);
		
		if($rowediting){
			$this->setEditor(new RowEditing());
			$this->addPlugin( $this->getEditor()->getId());
		}
		else{
			$this->setEditor(new CellEditing());
			$this->addPlugin( $this->getEditor()->getId());
		}
	}
	/**
	 * retourne l'éditeur de ligne utilisé par la grille
	 * @param AbstractEditing $editor
	 * @return AbstractEditing
	 */
	public function setEditor(AbstractEditing $editor)
	{
		$this->editor = $editor;
		return $this;
	}
	/**
	 * (non-PHPdoc)
	 * @see Base\Model\Component\Panel.Grid::preRender()
	 */
	public function preRender()
	{
		parent::preRender();
		getenv('APPLICATION_ENV')=='development'  && error_log('pre rendu done');
		
		// on fait le rendu du cell editing
		$this->getEditor()->render();
		getenv('APPLICATION_ENV')=='development'  && error_log('editeur rendu');
		
		foreach($this->getColumnElements() as $element)
		{
			$element->render();
		}
		getenv('APPLICATION_ENV')=='development'  && error_log('elements rendus');
		
	} 
	public function getColumnElements()
	{
		return $this->elements;
	}
	/**
	 * @return mixte(RowEditing,CellEditing)
	 */
	public function getEditor()
	{
		return $this->editor;
	}
	/**
	 * (non-PHPdoc)
	 * @see Base\Model\Component\Panel.Grid::addColumn()
	 */
	public function addColumn($header, $dataIndex, Element $element=null, $width=null)
	{
		
		$col = parent::addColumn($header, $dataIndex, $width);
		
		if(!is_null($element))
		{
			if(method_exists($element, 'getXType'))
			{
				$col->addAttribute('editor', $element->getXType(), true);
			}
			
			array_push($this->elements, $element);
		}
		
		if(method_exists($element, 'getStore'))
		{
			$col->setDataView("if(value==null) return '<font style=\'color:#ccc\'>Aucun'; try{ var val='<b>'+".$element->getStore().".findRecord(".$element->getOption('valueField').", value).get(".$element->getOption('displayField').")+'</b>'; return val; }catch(err){ return '<i>Non chargé</i>';} ");
		}
		
		return $col;
	}
	
}