<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;
use \Datetime;

class CatModel extends Model
{
    protected $table = 'category';

    protected $allowedFields = [
        'mobile_number',

    ];
    protected $updatedField = 'updated_at';

    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data): array
    {

        return $this->getUpdatedDataWithHashedPassword($data);
    }

    protected function beforeUpdate(array $data): array
    {
        return $this->getUpdatedDataWithHashedPassword($data);
    }

    private function getUpdatedDataWithHashedPassword(array $data): array
    {
        if (isset($data['data']['password'])) {
            $plaintextPassword = $data['data']['password'];
            $data['data']['password'] = $this->hashPassword($plaintextPassword);
        }
        return $data;
    }

    private function hashPassword(string $plaintextPassword): string
    {
        return password_hash($plaintextPassword, PASSWORD_BCRYPT);
    }
    

    /// get user information
    public function getallData()
    {
        $builder = $this->db->table('category');
        $builder->select('category.*');
       
        
        $query = $builder->get();
    
        // Get the result
        $result = $query->getResult();
    
        if (!$result) {
            return null;
        } else {
            return $result;
        }
    }
    public function getallDataDesh()
    {
        $builder = $this->db->table('category');
        $builder->select('category.*');
        $builder->where('category.type', 'Empanel');
        
        $query = $builder->get();
    
        // Get the result
        $result = $query->getResult();
    
        if (!$result) {
            return null;
        } else {
            return $result;
        }
    }
    public function getCatDataid($id)
    {
        $builder = $this->db->table('category');
        $builder->select('category.*');
    
        $builder->where('category.id', $id);
        $query = $builder->get();
    
        // Get the result
        $result = $query->getResult();
    
        if (!$result) {
            return null;
        } else {
            return $result;
        }
    }
    public function getCatDatabranch($branch)
    {
        $builder = $this->db->table('category');
        $builder->select('category.*');
    
        $builder->where('category.branch', $branch);
        $query = $builder->get();
    
        // Get the result
        $result = $query->getResult();
    
        if (!$result) {
            return null;
        } else {
            return $result;
        }
    }




    
    public function findRoleById(string $id)
    {

        $user = $this
            ->asArray()
            ->where(['id' => $id])
            ->first();

        if (!$user) {
            throw new Exception('Role does not found');
        } else {
            return $user;
        }
    }
    public function update_status_d($id)
    {
        $user_id = $id;


        $result = $this->findRoleById($user_id);

        // print_r($result);

        if ($result) {
            $current_status = $result['status'];

            // Toggle the status
            $new_status = ($current_status === '1') ? '0' : '1';

            // Update the status in the database
            $date = new DateTime();
            $date = date_default_timezone_set('Asia/Kolkata');
            $date1 = date("m-d-Y h:i A");

            $sql = "UPDATE `category` SET `status`='$new_status' WHERE `id` = $user_id";
            $post = $this->db->query($sql);

            if (!$post) {
                return false;
            } else {
                return $post;
            }
        } else {
            return false; // User not found
        }
    }
    public function findAll(int $limit = 0, int $offset = 0)
    {
        if ($this->tempAllowCallbacks) {
            // Call the before event and check for a return
            $eventData = $this->trigger('beforeFind', [
                'method'    => 'findAll',
                'limit'     => $limit,
                'offset'    => $offset,
                'singleton' => false,
            ]);

            if (!empty($eventData['returnData'])) {
                return $eventData['data'];
            }
        }

        $eventData = [
            'data'      => $this->doFindAll($limit, $offset),
            'limit'     => $limit,
            'offset'    => $offset,
            'method'    => 'findAll',
            'singleton' => false,
        ];

        if ($this->tempAllowCallbacks) {
            $eventData = $this->trigger('afterFind', $eventData);
        }

        $this->tempReturnType     = $this->returnType;
        $this->tempUseSoftDeletes = $this->useSoftDeletes;
        $this->tempAllowCallbacks = $this->allowCallbacks;

        return $eventData['data'];
    }
   


    public function save($data): bool
    {
        if (empty($data)) {
            echo "1";
            return true;
        }
    //     echo "<pre>";
    //     print_r($data);
    //    echo "</pre>";
    //    die();
        $name= $data['name'];
        $branch= $data['branch'];
        $completion= $data['completion'];
        $working= $data['working'];
        $security_deposit= $data['security_deposit'];
        $recovery_status= $data['recovery_status'];
        $invoice_no= $data['invoice_no'];
        $bill_type= $data['bill_type'];
        $bill_date= $data['bill_date'];
        $report_submit_date= $data['report_submit_date'];
        $submit_date= $data['submit_date'];
        $fee= $data['fee'];
        $udin= $data['udin'];
        $udin_no= $data['udin_no'];
        $udin_trun= $data['udin_trun'];
        $audit= $data['audit'];
        $assignment= $data['assignment'];
        $type= $data['type'];
       
        $status =$data['status'];    
        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');

        $date1 = date('Y-m-d H:i:s');
        $sql = "INSERT INTO `category`( `id`,`name`,`branch`,`completion`,`working`,`security_deposit`, 
        `recovery_status`,`invoice_no`,`bill_type`,`bill_date`,`report_submit_date`,`submit_date`,`fee`,`udin`,
        `udin_no`,`udin_trun`,`audit`,`assignment`,`type`,`status`,`created_at`) VALUES (null,'$name','$branch','$completion','$working','$security_deposit','$recovery_status','$invoice_no','$bill_type','$bill_date','$report_submit_date','$submit_date','$fee','$udin','$udin_no','$udin_trun','$audit','$assignment','$type','$status','$date1')";


        //     echo "<pre>"; print_r($sql); echo "</pre>";
        // die();

        $post = $this->db->query($sql);
        // echo json_encode($post);
        if (!$post){
            return false;
        }else{
            return $post;
        }
           

        
    }

    public function update1($id, $data): bool
    {

        // echo $id;

        if (empty($data)) {
            echo "1";
            return true;
        }

        $name= $data['name'];
        $branch= $data['branch'];
        $completion= $data['completion'];
        $working= $data['working'];
        $security_deposit= $data['security_deposit'];
        $recovery_status= $data['recovery_status'];
        $invoice_no= $data['invoice_no'];
        $bill_date= $data['bill_date'];
        $bill_type= $data['bill_type'];
        $report_submit_date= $data['report_submit_date'];
        $submit_date= $data['submit_date'];
        $fee= $data['fee'];
        $udin= $data['udin'];
        $udin_no= $data['udin_no'];
        $udin_trun= $data['udin_trun'];
        $audit= $data['audit'];
        $assignment= $data['assignment'];
        $type= $data['type'];
        $status= $data['status'];
        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');
        $date1 = date('Y-m-d H:i:s');


        $sql = "UPDATE `category` SET name = '$name', 
        branch = '$branch',completion = '$completion',working = '$working',security_deposit = '$security_deposit',recovery_status = '$recovery_status',invoice_no = '$invoice_no',bill_date = '$bill_date',bill_type = '$bill_type',report_submit_date = '$report_submit_date',submit_date = '$submit_date',
         fee = '$fee',udin = '$udin',udin_no = '$udin_no',udin_trun = '$udin_trun',audit = '$audit',
         assignment = '$assignment',
         type = '$type',
         status ='$status' WHERE id = $id";
        // echo "<pre>"; print_r($sql);
        // echo "</pre>";
        $post = $this->db->query($sql);
        if (!$post)
            throw new Exception('Post does not exist for specified id');

        return $post;
    }

    public function deletedata($id)
    {
        $post = $this
            ->asArray()
            ->where(['id' => $id])
            ->delete();

        if (!$post) 
            throw new Exception('Role does not exist for specified id');

        return $post;
    }
}

