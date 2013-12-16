<?php

class Body extends Action
{
    protected $fixtures = array();
    public function __construct($method, $arguments = array()) {
        parent::__construct($method, $arguments);
        
    }
    
    public function addFixture(FixtureDefinition $fixture_def)
    {
        $fixture = new Fixture('CreateFixture', $fixture_def);
        $fixture->setBody($this);
        $this->fixtures[] = $fixture;
        return $fixture;
    }
    public function getFixtures()
    {
        return $this->fixtures;
    }
    public function setPosition($x, $y)
    {
        $this->addMethod($this->bSetPosition($x, $y));
        return $this;
    }
    public function bSetPosition($x, $y)
    {
        return new Action('SetPosition', array(new Vector($x, $y)));
    }
    public function preRender() {
        foreach ($this->getFixtures() as $fixture) {
            $this->addMethod($fixture);
        }
        parent::preRender();
        
    }
}

