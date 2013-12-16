<?php
class Action extends Object
{
	protected $method;
	protected $caller;
        public function getCaller()
        {
            return $this->caller;
        }
        public function setCaller($caller)
        {
            $this->caller = $caller;
            return $this;
        }
	public function __construct($method, $arguments=array())
	{
                parent::__construct();
                $this->setVarName(uniqid('action_'));
                if(!is_array($arguments)){
                    $arguments    = array($arguments);
                }
                foreach($arguments as $arg){
                    $this->addArgument($arg);
                }
		$this->method 		= $method;
	}
	public function getMethod()
	{
		return $this->method;
	}
	public function getArguments()
	{
		return $this->arguments;
	}
	public function getCode()
	{
		return "$this = ".$this->getCaller().'.'.$this->getMethod().'('.implode(',', $this->getArguments()).')';
	}
}