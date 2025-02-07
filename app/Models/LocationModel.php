<?php

namespace App\Models;

use CodeIgniter\Model;

class LocationModel extends Model
{
    // Common properties
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
  

    // Table-specific properties
    private $tableConfigs = [
        'cities' => [
            'table' => 'unified_pincodes',
            'allowedFields' => ['id','city_name','pincode']
        ],
        'states' => [
            'table' => 'unified_pincodes',
            'allowedFields' => ['id','pincode','state_name']
        ],
        'pincodes' => [
            'table' => 'unified_pincodes',
            'allowedFields' => ['id','pincode']
        ],
        'rewords' => [
            'table' => 'reword',
            'allowedFields' => ['id','name','points']
        ]
    ];

    public function setTableConfig($type)
    {
        if (isset($this->tableConfigs[$type])) {
            $this->table = $this->tableConfigs[$type]['table'];
            $this->allowedFields = $this->tableConfigs[$type]['allowedFields'];
        }
    }
}
