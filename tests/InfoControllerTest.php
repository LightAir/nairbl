<?php

use App\Models\User;

class InfoControllerTest extends TestCase
{

    /**
     * @var Mockery
     */
    private $mock;

    public function setUp()
    {
        parent::setUp();
        // $this->mock = $this->mo(Keywords::class);
    }

    public function tearDown()
    {
        // Mockery::close();
    }

    public function mo($class)
    {
        $mock = Mockery::mock($class);

        $this->app->instance($class, $mock);

        return $mock;
    }

    public function testGetJWTIdentifier()
    {
        $user = new User();

        $this->assertEquals(null, $user->getJWTIdentifier());
    }

    public function testGetJWTCustomClaims()
    {
        $user = new User();

        $this->assertEquals([], $user->getJWTCustomClaims());
    }
}
