<?php

class LoginTest extends TestCase
{

    /**
     * @dataProvider dataForLoginTest
     * @return void
     */
    public function testLogin($userCredentials, $http_code): void
    {
        dd($this->json('POST', '/login', $userCredentials, ['Accept' => 'application/json'])->seeStatusCode($http_code));
        // $this->json('POST', '/login', $userCredentials, ['Accept' => 'application/json'])
        //     ->seeStatusCode($http_code);
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
                422
            ],
            [
                [
                    'email' => 'ferdous@g.com',
                    'password' => "1234567"
                ],
                422
            ]
        ];
    }
}
