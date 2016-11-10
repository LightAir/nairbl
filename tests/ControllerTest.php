<?php

use App\Http\Controllers\Controller;

class ControllerTest extends TestCase
{

    public function testConstructor()
    {
        $controller = new Controller();
        $this->assertInstanceOf(League\Fractal\Manager::class, $this->invokeProperty($controller, 'fractal'));
    }
}