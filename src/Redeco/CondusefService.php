<?php

namespace OpenFintech\Condusef\Redeco;

use GuzzleHttp\Client;

abstract class CondusefService
{
    public function __construct(public readonly Client $http)
    {
    }

    abstract public function getBaseUrl(): string;

    public function renovateToken(string $username, string $password): array
    {
        $response = $this->http->get($this->getBaseUrl() . '/auth/users/token', [
            'json' => [
                'username' => $username,
                'password' => $password
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function createSuperUser(string $key, string $username, string $password, string $confirm): array
    {
        $response = $this->http->post($this->getBaseUrl() . '/auth/users/create-super-user', [
            'json' => [
                'key' => $key,
                'username' => $username,
                'password' => $password,
                'confirm_password' => $confirm
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function createUser(
        string $key,
        string $username,
        string $password,
        string $confirm,
        string $accessToken
    ): array {
        $response = $this->http->post($this->getBaseUrl() . '/auth/users/create-user', [
            'json' => [
                'key' => $key,
                'username' => $username,
                'password' => $password,
                'confirm_password' => $confirm
            ],
            'headers' => [
                'Authorization' => $accessToken
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}