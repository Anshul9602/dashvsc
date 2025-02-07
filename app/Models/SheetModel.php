<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;
use \Datetime;

class SheetModel extends Model
{
    protected $table = 'google_sheets';

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
    public function get_data()
    {
        // echo "test";
        $builder = $this->db->table('google_sheets');
        $builder->select('google_sheets.*');


        $query = $builder->get();

        $user = $query->getResult();

        $result = $user;
        return $result;
    }
    public function get_data_id($Id)
    {
        // echo "test";
        $builder = $this->db->table('google_sheets');
        $builder->select(' google_sheets.*');
        $builder->where('google_sheets.id', $Id);

        $query = $builder->get();

        $user = $query->getResult();

        $result = $user;
        return $result;
    }
  
  


    public function getSheetCount()
    {
        $builder = $this->db->table('google_sheets');
        $builder->select('COUNT(*) as user_count');

        $query = $builder->get();
        $result = $query->getRow();

        return $result->user_count;
    }
 
    public function findUserByUserNumber1(string $mobile_number)
    {
        // echo "test";
        // die();
        $user = $this
            ->asArray()
            ->where(['mobile_number' => $mobile_number])
            ->first();

        if (!$user) {
            return 0;
        } else {
            return $user;
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
    public function findHrById($id)
    {
        $user = $this
            ->asArray()
            ->where(['id' => $id])
            ->first();

        if (!$user)
            throw new Exception('User does not exist for specified user id');

        return $user;
    }


    public function save($data): bool
    {

     
        // echo "<pre>"; print_r($mobile_number); echo "</pre>";
        // die();
        $name = $data['name'];
        $dis = $data['dis'];
        $sheet_url = $data['sheet_url1'];
        $prof_img = $data['prof_img'];
        $permistion = $data['permistion'];
        $emails = $data['emails'];
        $cat = $data['cat'];
        $sheet_cat = $data['sheet_cat'];
        $status = $data['status'];
        

        
        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');
        $date1 = date('Y-m-d H:i:s');

        $sql = "INSERT INTO `google_sheets`(`id`, `name`, `dis`, `status`, `sheet_url`,`prof_img`,`permistion`,`emails`,`cat`,`sheet_cat`,`created_at`) VALUES (null,'$name','$dis','$status','$sheet_url','$prof_img','$permistion','$emails','$cat','$sheet_cat','$date1')";


        //     echo "<pre>"; print_r($sql); echo "</pre>";
        // die();

        $post = $this->db->query($sql);
        // echo json_encode($post);
        if (!$post)
            throw new Exception('Post does not exist for specified id');

        return $post;
    }
    public function update1($id, $data)
    {
        //    echo json_encode($data);
        //    die();
        $name = $data['name'];
        $dis = $data['dis'];
        $sheet_url = $data['sheet_url1'];
        $status = $data['status'];
        $permistion = $data['permistion'];
        $cat = $data['cat'];
        $sheet_cat = $data['sheet_cat'];
        $emails = $data['emails'];
        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');
        $date1 = date("m-d-Y h:i A");

        $sql = "UPDATE `google_sheets` SET 
        `name` = '$name',      
        `permistion` = '$permistion',      
        `cat` = '$cat',      
        `dis` = '$dis',      
        `sheet_cat` = '$sheet_cat',      
        `emails` = '$emails',      
        `sheet_url` = '$sheet_url',
        `status`='$status' WHERE id = $id";
        // echo json_encode($sql);
        // echo ( $sql);
        //     die();
        $post = $this->db->query($sql);

        if (!$post) {
            return false;
        } else {
            return $post;
        }
    }
   
    public function update_status_d($id)
    {
        $user_id = $id;


        $result = $this->findHrById($user_id);

        // print_r($result);

        if ($result) {
            $current_status = $result['status'];

            // Toggle the status
            $new_status = ($current_status === '1') ? '0' : '1';

            // Update the status in the database
            $date = new DateTime();
            $date = date_default_timezone_set('Asia/Kolkata');
            $date1 = date("m-d-Y h:i A");

            $sql = "UPDATE `google_sheets` SET `status`='$new_status' WHERE `id` = $user_id";
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

    public function deletedata($id)
    {
        $post = $this
            ->asArray()
            ->where(['id' => $id])
            ->delete();

        if (!$post) 
            throw new Exception('Sheet does not exist for specified id');

        return $post;
    }
   
}
