<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;
use \Datetime;

class CandidatesModel extends Model
{
    protected $table = 'admin';

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
        $builder = $this->db->table('admin');
        $builder->select('admin.*');


        $query = $builder->get();

        $user = $query->getResult();

        $result = $user;
        return $result;
    }
  public function get_data_permission()
{
    $builder = $this->db->table('admin');
    $builder->select([
        'admin.id AS admin_id',
        'admin.name AS admin_name',
        'admin.email AS admin_email',
        'admin.role AS admin_role',
        'admin.status AS admin_status',
        'role.name AS role_name',
        'role.permission AS role_permission',
    ]);
    $builder->join('role', 'role.name = admin.role');

    $query = $builder->get();

    $user = $query->getResult();

    $result = $user;
    return $result;
}
    public function get_data_id($Id)
    {
        // echo "test";
        $builder = $this->db->table('admin');
        $builder->select(' admin.*');
        $builder->where('admin.id', $Id);

        $query = $builder->get();

        $user = $query->getResult();

        $result = $user;
        return $result;
    }
   

  
    public function getUserCount()
    {
        $builder = $this->db->table('admin');
        $builder->select('COUNT(*) as user_count');

        $query = $builder->get();
        $result = $query->getRow();

        return $result->user_count;
    }
    public function UserCount()
    {
        $builder = $this->db->table('user_profiles');
        $builder->select('COUNT(*) as user_count');

        $query = $builder->get();
        $result = $query->getRow();

        return $result->user_count;
    }
    public function HotelCount()
    {
        $builder = $this->db->table('hoteliers');
        $builder->select('COUNT(*) as user_count');

        $query = $builder->get();
        $result = $query->getRow();

        return $result->user_count;
    }
    public function AgentCount()
    {
        $builder = $this->db->table('agent');
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

    public function findUserByUserNumber(string $mobile_number)
    {

        $user = $this
            ->asArray()
            ->where(['mobile_number' => $mobile_number])
            ->first();

        if (!$user) {
            return null;
        } else {
            return $user;
        }
    }
    public function findUserByUserName(string $mobile_number)
    {

        $user = $this
            ->asArray()
            ->where(['mobile_number' => $mobile_number])
            ->first();

        if (!$user) {
            return null;
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
    public function findUserById($id)
    {
        $user = $this
            ->asArray()
            ->where(['id' => $id])
            ->first();

        if (!$user)
            throw new Exception('User does not exist for specified user id');

        return $user;
    }


   
    public function save_d($data)
    {
        $name = $data['name'];
        $mobile_number = $data['mobile_number'];
       
        $email = $data['email'];
        $role = $data['role'];
        $pass = $data['pass'];
        $status = "Enable" ;
        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');
        $date1 = date("m-d-Y h:i A");


        $sql = "INSERT INTO `admin`( `id`, `name`,`mobile_number`,`email`,`pass`,`role`, `created_at`, `updated_at`,`status`) VALUES (null,'$name','$mobile_number','$email','$pass','$role','$date1','$date1','$status')";
        $post = $this->db->query($sql);

        if (!$post) {
            return false;
        } else {
            return $post;
        }
    }
    public function update_profile($id, $data)
    {
        //    echo json_encode($sql);
        $user_id = $id;
        $name = $data['name'];
        $mobile_number = $data['mobile_number'];
       
        $email = $data['email'];
        $pass = $data['pass'];
        $role = $data['role'];
     
        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');
        $date1 = date("m-d-Y h:i A");

        $sql = "UPDATE `admin` SET `mobile_number` = '$mobile_number',
        `name`='$name',`pass`='$pass',`email`='$email',`role`='$role',`updated_at`='$date1' WHERE id = $user_id";
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


        $result = $this->findUserById($user_id);

        // print_r($result);

        if ($result) {
            $current_status = $result['status'];

            // Toggle the status
            $new_status = ($current_status === 'Enable') ? 'Disable' : 'Enable';

            // Update the status in the database
            $date = new DateTime();
            $date = date_default_timezone_set('Asia/Kolkata');
            $date1 = date("m-d-Y h:i A");

            $sql = "UPDATE `admin` SET `status`='$new_status',`updated_at`='$date1' WHERE `id` = $user_id";
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


    public function delete_d($id)
    {
        // Prepare the SQL statement with a placeholder for the id
        $sql = "DELETE FROM `admin` WHERE id = ?";

        // Execute the prepared statement with the id parameter
        $post = $this->db->query($sql, [$id]);

        // Check if the query was executed successfully
        if (!$post) {
            // If the query fails, return false
            return false;
        } else {
            // If the query succeeds, return true
            return true;
        }
    }

}
