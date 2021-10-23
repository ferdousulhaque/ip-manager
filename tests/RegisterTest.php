<?php

// use Laravel\Lumen\Testing\DatabaseMigrations;
// use Laravel\Lumen\Testing\DatabaseTransactions;

class RegisterTest extends TestCase
{
    // use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRegister()
    {
        $this->json('POST', '/register', [
            'email' => $this->generateRandomString() . "@g.com",
            'password' => 123456,
            'name' => 'test'
        ], [])
            ->seeJson([
                'message' => "CREATED",
            ]);
    }

    /**
     * Random String
     *
     * @param integer $length
     * @return string
     */
    private function generateRandomString($length = 10): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * @dataProvider dataForLoginTest
     * @return void
     */
    public function testLogin($userCredentials, $http_code): void
    {
        $this->json('POST', '/login', $userCredentials, ['Accept' => 'application/json'])
            ->seeStatusCode($http_code);
    }

    /**
     * 
     *
     * @return array
     */
    function dataForLoginTest(): array
    {
        return [
            [
                [
                    'email' => 'ferdous@g.com',
                    'password' => "123456"
                ],
                200
            ],
            [
                [
                    'email' => 'ferdous@g.com',
                    'password' => "1234567"
                ],
                401
            ]
        ];
    }
}
