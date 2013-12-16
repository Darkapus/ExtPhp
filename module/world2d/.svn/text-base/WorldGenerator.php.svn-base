<?php

class WorldGenerator
{
    public static $i = null;
    private $debug = false, $scale = 30;
    private $canvas = null, $world = null;
    private $vars = array();
    
    public static function i()
    {
        if (is_null(self::$i)) {
            self::$i = new WorldGenerator;
        }
        return self::$i;
    }
    public function setDebugMode($b)
    {
        $this->debug = $b;
        return $this;
    }
    public function getCanvas()
    {
        return $this->canvas;
    }
    public function setCanvas($canvas)
    {
        $this->canvas = $canvas;
        return $this;
    }
    public function getVars()
    {
        return $this->vars;
    }
    public function addVar($var)
    {
        $this->vars[] = $var;
        return $this;
    }
    public function getScale()
    {
        return $this->scale;
    }
    public function setScale($scale)
    {
        $this->scale = $scale;
        return $this;
    }
    public function getWorld()
    {
        return $this->world;
    }
    public function setWorld(World $world)
    {
        $this->world = $world;
        return $this;
    }
    public function getDebug()
    {
        $chaine = 'var debugDraw = new Box2D.Dynamics.b2DebugDraw();'.RC;
        $chaine .= 'debugDraw.SetSprite(document.getElementById("'.$this->getCanvas().'").getContext("2d"));'.RC;
        $chaine .= 'debugDraw.SetDrawScale('.$this->getScale().'.0);'.RC;
        $chaine .= 'debugDraw.SetFillAlpha(0.3);'.RC;
        $chaine .= 'debugDraw.SetLineThickness(1.0);'.RC;
        $chaine .= 'debugDraw.SetFlags(Box2D.Dynamics.b2DebugDraw.e_shapeBit | Box2D.Dynamics.b2DebugDraw.e_jointBit);'.RC;
        $chaine .= $this->getWorld().'.SetDebugDraw(debugDraw);'.RC;
        $chaine .= 'window.setInterval(update, 1000 / 60);'.RC;
        return $chaine;
    }
    public function getJsUpdater(){
        $chaine =  'function update() {'.RC;
        $chaine .=  ' '.$this->getWorld().'.Step('.RC;
        $chaine .=  '       1 / 60   //frame-rate'.RC;
        $chaine .=  '    ,  10       //velocity iterations'.RC;
        $chaine .=  '    ,  10       //position iterations'.RC;
        $chaine .=  ' );'.RC;
        if($this->debug) {  $chaine .=  ' '.$this->getWorld().'.DrawDebugData();'.RC;  }
        $chaine .=  ' '.$this->getWorld().'.ClearForces();'.RC;
        $chaine .=  '};'.RC;
        return $chaine;
    }
    public function getJsScript()
    {
        $chaine='';
        foreach($this->getVars() as $var)
        {
            $chaine.= 'var '.$var.RC;
        }
        $chaine.= 'function init(){'.RC;
        ob_start();$this->getWorld()->render();$chaine.= ob_get_contents();ob_end_clean();
        if($this->debug) {$chaine.=$this->getDebug();}
        $chaine.= '}'.RC;
        return $chaine;
    }
    public function render(){
        echo "<script type='text/javascript'>".RC;
        echo $this->getJsScript();
        echo $this->getJsVars();
        echo $this->getJsUpdater();
        echo $this->getJsMousePosition();
        echo $this->getJsQuery();
        echo $this->getJsBodySelector();
        echo "</script>".RC;
    }
    public function getJsVars()
    {
        $chaine = 'var mouseX, mouseY, mousePVec, isMouseDown, selectedBody, mouseJoint;'.RC;
        $chaine .= 'var canvasPosition = getElementPosition(document.getElementById("canvas"));'.RC;
        return $chaine;
    }
    public function getJsMousePosition()
    {
        $chaine = 'function handleMouseMove(e) {'.RC;
        $chaine .= '    mouseX = (e.clientX - canvasPosition.x) / '.$this->getScale().';'.RC;
        $chaine .= '    mouseY = (e.clientY - canvasPosition.y) / '.$this->getScale().';'.RC;
        $chaine .= '};'.RC;
        return $chaine;
    }
    public function getJsQuery()
    {
        $chaine = 'function getBodyAtMouse() {'.RC;
        $chaine .= '    mousePVec = new b2Vec2(mouseX, mouseY);'.RC;
        $chaine .= '    var aabb = new b2AABB();'.RC;
        $chaine .= '    aabb.lowerBound.Set(mouseX - 0.001, mouseY - 0.001);'.RC;
        $chaine .= '    aabb.upperBound.Set(mouseX + 0.001, mouseY + 0.001);'.RC;
        $chaine .= '   selectedBody = null;'.RC;
        $chaine .= '    world.QueryAABB(getBodyCB, aabb);'.RC;
        $chaine .= '    return selectedBody;'.RC;
        $chaine .= ' }'.RC;
        return $chaine;
    }
    public function getJsBodySelector()
    {
        $chaine = 'function getBodyCB(fixture) {'.RC;
        //$chaine .= '    if(fixture.GetBody().GetType() != b2Body.b2_staticBody) {'.RC;
        $chaine .= '       if(fixture.GetShape().TestPoint(fixture.GetBody().GetTransform(), mousePVec)) {'.RC;
        $chaine .= '          selectedBody = fixture.GetBody();'.RC;
        $chaine .= '          return false;'.RC;
        $chaine .= '       }'.RC;
        //$chaine .= '    }'.RC;
        $chaine .= '    return true;'.RC;
        $chaine .= ' }'.RC;
        return $chaine;
    }
}