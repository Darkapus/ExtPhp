<?php
namespace Base\Model\Component\Core;

use Base\Model\Component\Panel\Form;

class Action
{
	private $url;
	private $success=null;
	private $failure=null;
	private $method='POST';
	private $params=null;
	private $submit=null;
	private $label='Sauvegarder';
	
	public function __construct($label, $url, Config $params=null, Behavior $success=null, Behavior $failure=null, $method='POST')
	{
		$this->setUrl($url);
		$success && $this->setSuccess($success);
		$failure && $this->setFailure($failure);
		$this->setMethod($method);
		$params && $this->setParams($params);
		$this->setLabel($label);
	}
	public function setLabel($label)
	{
		$this->label = $label;
		return $this;
	}
	public function getLabel()
	{
		return $this->label;
	}
	/**
	 * Retourne le formulaire traitant
	 * @param Form $submit
	 */
	public function setSubmit(Form $submit)
	{
		$this->submit = $submit;
		return $this;
	}
	/**
	 * retorune le formulaire
	 * @return Form
	 */
	public function getSubmit()
	{
		return $this->submit;
	}
	/**
	 * est ce un submit ?
	 * @return boolean
	 */
	public function isSubmit()
	{
		return !is_null($this->getSubmit());
	}
	public function setMethod($method)
	{
		$this->method = $method;
		return $this;
	}
	public function getMethod()
	{
		return $this->method;
	}
	public function setUrl($url)
	{
		$this->url = $url;
		return $this;
	}
	public function getUrl()
	{
		return $this->url;
	}
	public function setSuccess(Behavior $success)
	{
		$this->success = $success;
		return $this;
	}
	public function getSuccess()
	{
		return $this->success;
	}
	public function setFailure(Behavior $failure)
	{
		$this->failure = $failure;
		return $this;
	}
	public function getFailure()
	{
		return $this->failure;
	}
	public function setParams(Config $params)
	{
		$this->params = $params;
		return $this;
	}
	public function getParams()
	{
		return $this->params;
	}
	public function bDo()
	{
		if($this->isSubmit())
		{
			return $this->getSubmit()->bSubmit($this->getSuccess(), $this->getFailure());
		}
		else
		{
			if(!is_null($this->getParams()))
			{
				return new Behavior("Ext.Ajax.request({method:'".$this->getMethod()."',url: '".$this->getUrl()."',params: ".$this->getParams().", success:function(response, opts){ ".$this->getSuccess()." }, failure:function(response, opts){ ".$this->getFailure()." }});");
			}
			else
			{
				return new Behavior("Ext.Ajax.request({method:'".$this->getMethod()."',url: '".$this->getUrl()."', success:function(response, opts){ ".$this->getSuccess()." }, failure:function(response, opts){ ".$this->getFailure()." }});");
			}
		}
	}
}