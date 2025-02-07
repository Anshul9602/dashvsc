<?php

namespace App\Services;
use CodeIgniter\Config\BaseConfig;
use Google\Client;

class GoogleService
{
    
    public static function getClient()
    {
        $config = config('Google');

        $client = new Client();
        $client->setApplicationName($config->applicationName);
        $client->setScopes($config->scopes);
        $client->setAuthConfig($config->serviceAccountKeyPath);
        $client->setAccessType('offline');

        return $client;
    }
}
