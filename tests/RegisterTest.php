<?php

use Faker\Generator;

class RegisterTest extends TestCase
{
    private $faker;

    /**
     *
     * @return void
     */
    function setUp(): void
    {
        parent::setUp();
        $this->faker = new Generator();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRegister()
    {
        $this->json(
            'POST',
            '/api/register',
            [
                'email' => $this->faker->email(),
                'password' => 123456,
                'name' => $this->faker->name()
            ]
        )
            ->seeJson([
                'message' => "CREATED",
            ]);
    }
}
