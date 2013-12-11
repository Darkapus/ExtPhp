<?php
namespace Base\Model\Component\Store;


class SimpleStorage extends ArrayStorage
{
	public function __construct(array $data, $id=null)
	{
		parent::__construct($data,$id);
		$this->addField('value');
		$this->addField('label');
	}
}