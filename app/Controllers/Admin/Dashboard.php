<?php

namespace App\Controllers\Admin;

use App\Models\CandidatesModel;
use App\Models\TaskModel;
use App\Models\CatModel;

use App\Models\Hr_noticeModel;
use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index($token = null)
    {
        if ($token !== session()->get('token')) {
            return redirect()->to('/admin/login');
        }

        $role = session()->get('role');

        // Pass the role to the view
        $data = [
            'role' => $role,
            'admin_name' => session()->get('admin_name'),
            'token' => $token
        ];
        $user = new CandidatesModel();
        $user1 = new TaskModel();

       
        $admin_email = session()->get('admin_email');
       
        // $data['user_shreet'] = [];
        // $data['user_shreet'] = array_filter($data['sheet'], function ($item) use ($admin_email) {
        //     // Check if the email exists in the 'dis' field
        //     return strpos($item->dis, $admin_email) !== false;
        // });
        
        date_default_timezone_set('Asia/Kolkata'); // Set your timezone
        $current_date = date('Y-m-d'); // Get the current date
        
        $model = new CatModel();
        $data['users'] = $model->getallData();
        $total_task = count($data['users']); // Total tasks

        $pending = [];
        $late_complete = [];
        $complete = [];
        
        foreach ($data['users'] as $user) {
            $submit_date = $user->submit_date;
            $report_submit_date = $user->report_submit_date;
        
            if ($submit_date > $current_date) {
                // Future tasks - Pending
                $pending[] = $user;
            } elseif (empty($report_submit_date) || $report_submit_date > $submit_date) {
                // Report not submitted or submitted late
                $late_complete[] = $user;
            } else {
                // Completed on time
                $complete[] = $user;
            }
        }
        
        // Count totals
        $total_pending = count($pending);
$total_late_complete = count($late_complete);
$total_complete = count($complete);
        
        // Print results
        // echo "<pre>";
        // echo "Total Tasks: " . $total_task . "\n";
        // echo "Total Pending: " . $total_pending . "\n";
        // echo "Total Late Complete: " . $total_late_complete . "\n";
        // echo "Total Complete: " . $total_complete . "\n";
        
        // echo "\nPending Tasks:\n";
        // print_r($pending);
        
        // echo "\nLate Completed Tasks:\n";
        // print_r($late_complete);
        
        // echo "\nCompleted On-Time Tasks:\n";
        // print_r($complete);
        // echo "</pre>";
        
        // die();
        $data['total_task'] = $total_task;
        $data['total_task_com'] = $total_complete;
        $data['total_task_pending'] = $total_pending;
        $data['total_task_late'] = $total_late_complete;
         
        if ($data['total_task'] > 0) {
            $data['completed_percentage'] = round(($data['total_task_com'] / $data['total_task']) * 100);
            $data['completed_late'] = round(($data['total_task_late'] / $data['total_task']) * 100);

            $data['pending_percentage'] = round(($data['total_task_pending'] / $data['total_task']) * 100);
        } else {
            $data['completed_percentage'] = 100;
            $data['pending_percentage'] = 0;
            $data['completed_late'] = 0;
        }
        if ($pending || $late_complete) {
           if($pending){
            $data['pending']= $pending;
           }else{
            $data['pending']= '';
           }
           if($late_complete){
            $data['late']= $late_complete;
           }else{
            $data['late']= '';
           }
           if($complete){
            $data['complete']= $complete;
           }else{
            $data['complete']= '';
           }
            
        } else {
            $data['pending']= '';
            $data['late']= '';
            $data['complete']= '';
        }

    //  echo "<pre>";
    //     print_r($data);
    //     echo "</pre>";
    //     die();
        return view('admin/dashboard/dashboard', $data);
    }
    public function hr($token = null)
    {
        if ($token !== session()->get('token')) {
            return redirect()->to('/admin/login');
        }

        $role = session()->get('role');

        // Pass the role to the view
        $data = [
            'role' => $role,
            'token' => $token
        ];
        $user = new CandidatesModel();
        $data['total_user'] = $user->UserCount();
        $data['total_hotel'] = $user->HotelCount();
        $data['total_agent'] = $user->AgentCount();


        return view('admin/dashboard/hr', $data);
    }
    public function calendar($token = null)
    {
        if ($token !== session()->get('token')) {
            return redirect()->to('/admin/login');
        }

        $admin = session()->get('admin_name');

        // Pass the role to the view
        $data = [

            'token' => $token
        ];
        $user = new CandidatesModel();
        $data['users'] = $user->get_data();


        $user1 = new TaskModel();
        $tasks = $user1->get_data();

        // Filter the tasks based on created_by or assignTo matching $admin
        $filteredTasks = array_filter($tasks, function ($task) use ($admin) {
            return ($task->created_by == $admin || $task->assign == $admin);
        });

        // Re-index the array to reset the array keys (optional)
        $filteredTasks = array_values($filteredTasks);

        // start: new Date("' . date('D M d Y H:i:s \G\M\TO', strtotime($task->created_at)) . '"),
        $eventsJs = '[';
        foreach ($filteredTasks as $task) {
            $eventsJs .= '{
                id: "' . addslashes($task->id) . '",
                status: "' . addslashes($task->status) . '",
                title: "' . addslashes($task->title) . '",
                comment: "' . addslashes($task->comment) . '",
                start: "' . addslashes($task->created_at) . '",
                className: "' . addslashes($task->category) . '",
                createdBy: "' . addslashes($task->created_by) . '",
                assignTo: "' . addslashes($task->assign) . '",
                description: "' . addslashes($task->des) . '"
            },';
        }

        // Convert the events array to JSON with proper escaping for JavaScript
        $data['events'] = rtrim($eventsJs, ',') . ']';
        //   echo "<pre>"; print_r($data['events']);
        //         echo "</pre>";
        //         die();
        // $simplifiedUsers = iterator_to_array(map_users($data['users']));
        $simplifiedNames = array_map(function ($user) {
            return $user->name;
        }, $data['users']); // Map over the users data

        // Convert the simplified array (names only) to JSON

        // Convert the simplified array to JSON
        // $data['all_users_json'] = json_encode($simplifiedUsers);
        $data['all_users_json'] = json_encode($simplifiedNames);
        // $all_users_json = json_encode($data['users']); 
        // echo "<pre>"; print_r($data['all_users_json']);
        // echo "</pre>";
        // die();
        return view('admin/dashboard/calendar', $data);
    }
    public function calendar_table($token = null)
    {
        if ($token !== session()->get('token')) {
            return redirect()->to('/admin/login');
        }

        $admin = session()->get('admin_name');

        // Pass the role to the view
        $data = [

            'token' => $token
        ];
        $user = new CandidatesModel();
        $data['users'] = $user->get_data();


        $user1 = new TaskModel();
        $tasks = $user1->get_data();

        // Filter the tasks based on created_by or assignTo matching $admin
        $filteredTasks = array_filter($tasks, function ($task) use ($admin) {
            return ($task->created_by == $admin || $task->assign == $admin);
        });

        // Re-index the array to reset the array keys (optional)
        $data['users'] = array_values($filteredTasks);



        // start: new Date("' . date('D M d Y H:i:s \G\M\TO', strtotime($task->created_at)) . '"),


        return view('admin/dashboard/calendar_table', $data);
    }
    public function calendar_save($token)
    {
        if ($token !== session()->get('token')) {
            return redirect()->to('/admin/login');
        }
        $data = $this->request->getPost();

        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // die();
        $input = [
            'title' => isset($data['title']) ? $data['title'] : '',
            'category' => isset($data['category']) ?  $data['category'] : '',
            'created_by' => isset($data['created_by']) ?  $data['created_by'] : '',
            'assign' => isset($data['assign-to']) ? $data['assign-to'] : '',
            'date' => isset($data['date']) ? $data['date'] : '',
            'description' => isset($data['description']) ? $data['description'] : ''
        ];
        // Pass the role to the view
        $data = [

            'token' => $token
        ];
        $user = new TaskModel();
        $users = $user->save_d($input);
        if ($users === false) {
            return "Error: Task data not inserted successfully";
        } else {



            return redirect()->to(base_url(
                'admin/dashboard/calendar/' . $token
            ));
        }
    }
    public function calendar_update($token)
    {

        $data = $this->request->getPost();

        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // die();
        $input = [
            'title' => isset($data['title']) ? $data['title'] : '',
            'date' => isset($data['date']) ? $data['date'] : '',
            'category' => isset($data['category']) ?  $data['category'] : '',
            'assign' => isset($data['assignTo']) ? $data['assignTo'] : '',
            'description' => isset($data['description']) ? $data['description'] : ''
        ];
        // Pass the role to the view
        $token = session()->get('token');
        $id = $data['id'];
        $user = new TaskModel();
        $users = $user->update_profile($id, $input);
        if ($users === false) {
            return "Error: Task data not inserted successfully";
        } else {



            return redirect()->to(base_url(
                'admin/dashboard/calendar/' . $token
            ));
        }
    }
    public function calendar_comment($token)
    {
        if ($token !== session()->get('token')) {
            return redirect()->to('/admin/login');
        }
        $data = $this->request->getPost();

        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // die();
        $input = [
            'comment' => isset($data['comment']) ? $data['comment'] : '',
            'id' => $data['id']
        ];
        // Pass the role to the view
        $data = [
            'token' => $token
        ];
        $id = $input['id'];
        $user = new TaskModel();
        $users = $user->update_com($id, $input);
        if ($users === false) {
            return "Error: Task data not inserted successfully";
        } else {



            return redirect()->to(base_url(
                'admin/dashboard/calendar/' . $token
            ));
        }
    }
    public function calendar_complte($token)
    {
        if ($token !== session()->get('token')) {
            return redirect()->to('/admin/login');
        }
        $data = $this->request->getPost();
        $id = $data['id'];
        $user = new TaskModel();
        $users = $user->update_status($id);
        if ($users === false) {
            return "Error: Task data not inserted successfully";
        } else {
            return redirect()->to(base_url(
                'admin/dashboard/calendar/' . $token
            ));
        }
    }
    public function calendar_delete($token)
    {
        if ($token !== session()->get('token')) {
            return redirect()->to('/admin/login');
        }
        $data = $this->request->getPost();

        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // die();
        $input = [
            'id' => $data['id']
        ];
        // Pass the role to the view
        $data = [

            'token' => $token
        ];
        $id = $input['id'];
        $user = new TaskModel();
        $users = $user->delete_d($id);
        if ($users === false) {
            return "Error: Task data not delete successfully";
        } else {



            return redirect()->to(base_url(
                'admin/dashboard/calendar/' . $token
            ));
        }
    }
}
