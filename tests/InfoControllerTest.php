<?php

use App\Models\User;

class InfoControllerTest extends TestCase
{

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
