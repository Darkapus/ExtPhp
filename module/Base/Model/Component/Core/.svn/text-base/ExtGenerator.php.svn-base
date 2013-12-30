<?php
namespace Base\Model\Component\Core;
class ExtGenerator
{
	private $requires=array();
	public static $i=null;
	private $global = array();
	/**
	 * @return ExtGenerator
	 */
	public static function i()
	{
		if(is_null(self::$i)) self::$i = new ExtGenerator();
		return self::$i;
	}
	public function addGlobal(Element $element)
	{
		$this->global[] = $element;
		return $this;
	}
	public function getGlobals()
	{
		return $this->global;
	}
	public function addRequire($require)
	{
		if(!in_array($require, $this->requires))
		{
			$this->requires[] = $require;
		}
		return $this;
	}
	/**
	 * 
	 * @param Element $element Element principal à rendre
	 * @param string $where où on souhaite le rendre, laisser à vide si unique élément graphique à rendre
	 */
	public function render(Element $element, $where=null)
	{
		$partial = null;
		if(key_exists('partial', $_GET)) $partial = $_GET['partial'];
		if(key_exists('partial', $_POST)) $partial = $_GET['partial'];
		
		if(is_null($partial))  echo '<script type="text/javascript">'.RC;
		if(is_null($partial))  echo "Ext.Loader.setConfig({enabled: true});".RC;
		if(is_null($partial))  echo "Ext.Loader.setPath('Ext.ux', '/js/ext-4.2.1/examples/ux');".RC;
		foreach($this->getGlobals() as $global)
		{
			echo "var $global;".RC;
		}
		
		if(count($this->requires)) echo "Ext.require(".json_encode($this->requires).");".RC;
		
		if(is_null($partial))  echo 'Ext.onReady(function() {'.RC;
		//else echo '$(function(){'.RC;
		
		if(!is_null($where)) $element->addOption('renderTo', $where);
		elseif(is_null($partial) || $partial=='true') $element->addOption('renderTo', 'Ext.getBody()', true);
		
		$element->render();
		
		if(is_null($partial))  echo '})'.RC;
		if(!is_null($partial) && $partial!='true') echo "$partial.add($element);";
		if(is_null($partial))  echo '</script>';
	}
	public function bConfirm($title, $text, $yes, $no)
	{
		return new Behavior("Ext.MessageBox.confirm('$title', '$text', function(btn){if(btn==='yes'){ $yes }else{ $no }});");
	}
	public function bBlock()
	{
		$behavior = new Behavior(implode(';',func_get_args()));
		return $behavior;
	}
	public function bLoad($url, $method='POST', Config $params=null, Behavior $success=null, Behavior $failure=null)
	{
		if(!is_null($params))
		{
			return new Behavior("Ext.Ajax.request({method:'$method',url: '$url',params: ".$params->getJson().", success:function(response, opts){ $success }, failure:function(response, opts){ $failure }});");
		}
		else 
		{
			return new Behavior("Ext.Ajax.request({method:'$method',url: '$url', success:function(response, opts){ $success }, failure:function(response, opts){ $failure }});");
		}
	}
}