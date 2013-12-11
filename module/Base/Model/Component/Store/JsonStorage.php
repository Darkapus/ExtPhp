<?php
namespace Base\Model\Component\Store;
use Base\Model\Component\Core\Behavior;

use Base\Model\Component\Core\Config;

use Base\Model\Cis\Object;

use Base\Model\Component\Core\ExtGenerator;

use Base\Model\Component\Core\Element;
/**
 * permet la recuperation de données en json et de le stocker dans un objet extjs storage
 * @author bbaschet
 *
 */
class JsonStorage extends Storage
{
	/**
	 * @param string|array $url read,create,update,destroy
	 * @param array $params Par exemple mettre $_POST pour pousser le post actuel en parametre
	 * @param string $method POST ou GET
	 * @param Object $object Ce parametre doit être un objet doctrine
	 * @param string $id
	 */
	public function __construct($url, array $params, $method = 'POST', Object $object=null,$id=null)
	{
		if(is_array($url))
		{
			$url_read 		= $url['read'];
			$url_create 	= $url['create'];
			$url_update 	= $url['update'];
			$url_destroy 	= $url['destroy'];
		}
		else
		{
			$url_read 		= $url;
			$url_create 	= $url;
			$url_update 	= $url;
			$url_destroy 	= $url;
		}
		
		parent::__construct($id);
		$read	= new Config;
		$read->addAttribute('read', $method);
		$reader = new Config;
		$reader
			->addAttribute('type', 'json')
			->addAttribute('root', 'items')
			->addAttribute('totalProperty', 'totalCount')
			;
			
		$api = new Config;
		$api
			->addAttribute('create'	, $url_read)
			->addAttribute('read'	, $url_create)
			->addAttribute('update'	, $url_update)
			->addAttribute('destroy', $url_destroy);
		$proxy 	= new Config;
		$proxy
			->addAttribute('type', 'ajax')
			->addAttribute('autoSave', 'true', true)
			->addAttribute('autoSync', 'true', true)
			->addAttribute('actionMethods', $read, true)
			->addAttribute('extraParams', json_encode($params), true)
			//->addAttribute('url', $url)
			->addAttribute('reader', $reader, true)
			->addAttribute('api', $api, true)
		;
		
		$this->addOption('autoDestroy'	, 'true'	, true);
		$this->addOption('pageSize'		, '100' 	, true);
		
		
		$this->addOption('proxy', $proxy, true);
		$this->setAutoload(false);
		if(!is_null($object))
		{
			foreach($object as $k=>$v)
			{
				$this->addField($k);
			}
		}
	}
	public function setAutoload($b=true)
	{
		$this->addOption('autoLoad'		, ($b?'true':'false')	, true);
	}
	/**
	 * Behavior pour charger un storage
	 * @return Behavior
	 */
	public function bLoad()
	{
		return new Behavior($this.'.load();');
	}
	
	/**
	 * Behavior pour charger un storage
	 * @return Behavior
	 */
	public function bReload()
	{
		return new Behavior($this.'.load();');
	}
}