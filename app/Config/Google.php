<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Google extends BaseConfig
{
    public string $applicationName = 'ND Sheets'; // Replace with your project name
    public string $serviceAccountKeyPath = WRITEPATH . 'nd-sheets-project-4c46e297b290.json'; // Path to your JSON key
    public array $scopes = [
        'https://www.googleapis.com/auth/spreadsheets',
        'https://www.googleapis.com/auth/drive.file',
    ];
}
