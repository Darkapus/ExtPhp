<html>
    <head>
        <script src='js/Box2dWeb-2.1.a.3.min.js' type='text/javascript'></script>
        <script src='js/jquery.min.js' type='text/javascript'></script>
    </head>
    <body onload="init()">
        <canvas id="test" height="600" width="800" style="background-color:appworkspace; border: black solid 1px;"></canvas>
    <?php
        define('RC', "\r\n");
        require 'Object.php';
        require 'Vector.php';
        require 'Gravity.php';
        require 'Action.php';
        require 'BodyDefinition.php';
        require 'FixtureDefinition.php';
        require 'Body.php';
        require 'Fixture.php';
        require 'World.php';
        require 'Fixtures/Circle.php';
        require 'Fixtures/Polygon.php';
        require 'Fixtures/Box.php';
        require 'WorldGenerator.php';

        $world = new World(0,10);
        $world->addCircle(2, 2, 1);
        $world->addBox(5, 10, 10, 0.5, false, null, 0.5);
        $world->addBox(20, 40, 40, 0.5, false);
        
        $world->addBox(1, 20, 0.5, 40, false);
        $world->addBox(60, 20, 0.5, 40, false);
        WorldGenerator::i()->setScale(10);
        WorldGenerator::i()->setWorld($world);
        WorldGenerator::i()->setDebugMode(true);
        WorldGenerator::i()->setCanvas('test');
        WorldGenerator::i()->render();
    ?>
    </body>
</html>