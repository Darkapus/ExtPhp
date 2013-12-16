<?php
/**
 * 
 */
class Object
{
        /**
         *
         * @var string 
         */
	protected $varname;
        /**
         *
         * @var string 
         */
	protected $class;
        /**
         *
         * @var array 
         */
	protected $attributes 	= array();
        /**
         *
         * @var array 
         */
	protected $arguments 	= array();
        /**
         *
         * @var boolean 
         */
	protected $rendered	= false;
        /**
         *
         * @var array 
         */
        protected $methods      = array();
        /**
         * constructor
         */
	public function __construct()
	{
                WorldGenerator::i()->addVar($this);
		$this->setVarName(uniqid('element_'));
	}
        /**
         * 
         * @return string
         */
	public function __toString()
	{
		return $this->getVarName();
	}
        /**
         * 
         * @param string $class
         * @return \Object
         */
	public function setClass($class)
	{
		$this->class= $class;
		return $this;
	}
        /**
         * 
         * @return string
         */
	public function getClass()
	{
		return $this->class;
	}
        /**
         * 
         * @param string $name
         * @return \Object
         */
	public function setVarName($name)
	{
		$this->varname = $name;
		return $this;
	}
        /**
         * 
         * @return string
         */
	public function getVarName()
	{
		return $this->varname;
	}
        /**
         * 
         * @return \Object
         */
	protected function preRender()
	{
                foreach($this->getArguments() as $arg){
                    if(is_object($arg)){
                        $arg->render();
                    }
                }
		return $this;
	}
        /**
         * 
         * @return string
         */
        public function getCode()
        {
            return $this.' = new '.$this->getClass().'('.implode(',', $this->getArguments()).');';
        }
        /**
         * 
         * @return \Object
         */
	public function render()
	{
		if(!$this->rendered){
                        $this->preRender();
                        echo $this->getCode().RC;
                        $this->postRender();
			$this->rendered = true; // pour ne pas rendre deux fois l'objet
		}
                return $this;
	}
        /**
         * 
         * @param string $arg
         * @return \Object
         */
        public function addArgument($arg)
        {
            if (!is_object($arg) && !is_numeric($arg) && !is_null($arg)) {
                $arg = "'$arg'";
            }
            elseif(is_null($arg)){
                $arg = 'null';
            }
             
            $this->arguments[] = $arg;
            return $this;
        }
        /**
         * 
         * @return \Object
         */
	public function setArguments()
	{
		$this->arguments = func_get_args();
		return $this;
	}
        /**
         * 
         * @return string
         */
	public function getArguments()
	{
		return $this->arguments;
	}
        /**
         * 
         * @return \Object
         */
	protected function postRender()
	{
                foreach($this->getAttributes() as $k=>$v){
                    if(is_object($v)){
                        $v->render();
                    }
                    echo "$this.$k = $v;".RC;
                }
                foreach($this->getMethods() as $method){
                    $method->render();
                }
		return $this;
	}
        /**
         * 
         * @return string
         */
	public function getAttributes()
	{
		return $this->attributes;
	}
        /**
         * 
         * @param string $k
         * @param string $v
         * @param string $o
         * @return \Object
         */
	public function setAttribute($k, $v, $o=false)
	{
		$this->attributes[$k] = $o?$v:"'$v'";
		return $this;
	}
        /**
         * 
         * @return string
         */
        public function getMethods()
        {
            return $this->methods;
        }
        /**
         * 
         * @param Action $action
         * @return \Object
         */
        public function addMethod(Action $action)
        {
            $this->methods[] = $action;
            $action->setCaller($this);
            return $this;
        }
        /**
         * 
         * @param string $k
         * @return string
         */
        public function getAttribute($k)
        {
            return $this->attributes[$k];
        }
}