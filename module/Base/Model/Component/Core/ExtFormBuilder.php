<?php
namespace Base\Model\Component\Core;

use Base\Model\Component\Panel\Panel;

use Base\Model\Component\Form\Button;

use Base\Model\Component\Panel\StatusBar;

use Base\Model\Component\Form\TextArea;

use Base\Model\Component\Form\AbstractInput;

use Base\Model\Component\Form\InputText;

use Zend\Form\ElementInterface;

use Base\Model\Component\Panel\Form;

class ExtFormBuilder 
{
	private $form=null;
	private $bbar;
	
	/**
	 * 
	 * @param string $title
	 * @param Action $action
	 * @param array $elements
	 */
	public function __construct($title, Action $action, $elements=array())
	{
		
		$this->setForm(new Form($title, $action->getUrl()));
		$this->getForm()->setBorder(false);
		$action->setSubmit($this->getForm());
		$this->getForm()->setBottomBar(new StatusBar());
		$this->getForm()->getBottomBar()->addChild(new Button($action->getLabel(), $action));
		$elements && $this->addAll($elements);
		
		return $this;
	}
	/**
	 * @return ExtFormBuilder
	 */
	public function setActions()
	{
		foreach(func_get_args() as $action)
		{
			$this->getForm()->getBottomBar()->addChild(new Button($action->getLabel(), $action));
		}
		return $this;
	}
	/**
	 * 
	 * @param Action $action
	 * @return Button
	 */
	public function addButton(Action $action)
	{
		$this->getForm()->getBottomBar()->addChild($b=new Button($action->getLabel(), $action));
		return $b;
	}
	public function setForm(Form $form)
	{
		$this->form = $form;
		return $this;
	}
	/**
	 * @return Form
	 */
	public function getForm()
	{
		return $this->form;
	}
	/**
	 * Ajoute un element Zend au formulaire extjs
	 * @param ElementInterface $element
	 * @return ExtFormBuilder
	 */
	public function add(ElementInterface $element, $to=null)
	{
		if(is_null($to)) $to = $this->getForm();
		if($o = $this->build($element)) $to->addChild($o);
		return $$o;
	}
	/**
	 * Construit un element extjs à partir d'un élement zend
	 * @param ElementInterface $element
	 * @return AbstractInput
	 */
	public function build(ElementInterface $element)
	{
		
		$attributes = $element->getAttributes();
		
		$o = null;
		switch($element->getAttribute('type'))
		{
			case 'text':
				$o = new InputText($element->getOption('label'), $element->getAttribute('name'), $element->getOption('value'));
				break;
			case 'textarea':
				$o = new TextArea($element->getOption('label'), $element->getAttribute('name'), $element->getOption('value'));
				break;
		}
		if(!is_null($o)) return $o;
		else return false;
	}
	/**
	 * 
	 * @param array $elements
	 * @return ExtFormBuilder
	 */
	public function addAll($elements, $to=null)
	{
		foreach($elements as $element)
		{
			$this->add($element, $to);
		}
		return $this;
	}
	/**
	 * Rendre le formulaire
	 * @param string $where laisser vide si on souhaite le rendre en tant qu'element unique
	 * @return ExtFormBuilder
	 */
	public function render($where =null)
	{
		ExtGenerator::i()->render($this->getForm(), $where);
		return $this;
	}
	
}