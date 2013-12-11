<?php
namespace Base\Model\Component\Store;
use Base\Model\Component\Store\Storage;
/**
 * Storage de base que l'on souhaite charger manuellement par des données par le biais d'un array
 * @author bbaschet
 *
 */
class ArrayStorage extends Storage
{
	public function __construct(array $data, $id=null)
	{
		parent::__construct($id);
		
		$this->setLibrary('Ext.data.ArrayStore');
		
		
		$this->addOption('data', json_encode($data), true);
	}
}