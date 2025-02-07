<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;
use \Datetime;

class TaskModel extends Model
{
    protected $table = 'task';

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
        $builder = $this->db->table('task');
        $builder->select('task.*');


        $query = $builder->get();

        $user = $query->getResult();

        $result = $user;
        return $result;
    }
  public function get_data_users()
{
    $builder = $this->db->table('task');
    $builder->select([
        'task.id AS task_id',
        'task.title AS task_title',
        'task.assign AS task_assign',
        'task.des AS task_des',
        'task.category AS task_category',
        
        'admin.name AS admin_name',
        'admin.id AS admin_id',
    ]);
    $builder->join('admin', 'admin.name = task.assign');

    $query = $builder->get();

    $user = $query->getResult();

    $result = $user;
    return $result;
}
    public function get_data_id($Id)
    {
        // echo "test";
        $builder = $this->db->table('task');
        $builder->select(' task.*');
        $builder->where('task.id', $Id);

        $query = $builder->get();

        $user = $query->getResult();

        $result = $user;
        return $result;
    }
   

  
    public function getTaskCount()
    {
        $builder = $this->db->table('task');
        $builder->select('COUNT(*) as user_count');

        $query = $builder->get();
        $result = $query->getRow();

        return $result->user_count;
    }
    public function getTaskCount_com()
    {
        $builder = $this->db->table('task');
        $builder->select('COUNT(*) as user_count');
        $builder->where('status', 'complet');
        $query = $builder->get();
        $result = $query->getRow();

        return $result->user_count;
    }
    public function getTaskCount_pen()
    {
        $builder = $this->db->table('task');
        $builder->select('COUNT(*) as user_count');
        $builder->where('status', 'progress');
        $query = $builder->get();
        $result = $query->getRow();

        return $result->user_count;
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
            throw new Exception('task does not exist for specified task id');

        return $user;
    }


   
    public function save_d($data)
    {
        $title = $data['title'];
        $category = $data['category'];
        $assign = $data['assign'];
        $created_by = $data['created_by'];
        $des = $data['description'];
        $comment = "";
        $status = "progress";
        $date1 = $data['date'];
//  echo "<pre>";
//         print_r($date1);
//         echo "</pre>";
//         die();

        $sql = "INSERT INTO `task`( `id`, `title`,`category`,`created_by`,`assign`,`des`,`comment`,`status`,`created_at`) VALUES (null,'$title','$category','$created_by','$assign','$des','$comment','$status','$date1')";
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
        $title = $data['title'];
        $date = $data['date'];
        $category = $data['category'];
        $assign = $data['assign'];
        $des = $data['description'];
    
        $sql = "UPDATE `task` SET `title` = '$title',`created_at` = '$date',`category` = '$category',
        `assign`='$assign',`des`='$des' WHERE id = $user_id";
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
    public function update_com($id, $data)
    {
        //    echo json_encode($sql);
        $user_id = $id;
        $comment = $data['comment'];
     
        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');
        $date1 = date("m-d-Y h:i A");

        $sql = "UPDATE `task` SET `comment` = '$comment' WHERE id = $user_id";
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
    public function update_status($id)
    {
        //    echo json_encode($sql);
        $user_id = $id;
        $status = "complete";
        $category = "btn-secondary";
     
        $sql = "UPDATE `task` SET `category` = '$category',`status` = '$status' WHERE id = $user_id";
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

            $sql = "UPDATE `task` SET `status`='$new_status',`updated_at`='$date1' WHERE `id` = $user_id";
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
        $sql = "DELETE FROM `task` WHERE id = ?";

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
