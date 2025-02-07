<?php

namespace App\Controllers\Admin;

use App\Models\CandidatesModel;
use App\Models\TaskModel;
use App\Models\SheetModel;
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

        $data['total_task'] = $user1->getTaskCount();
        $data['total_task_com'] = $user1->getTaskCount_com();
        $data['total_task_pending'] = $user1->getTaskCount_pen();
        if ($data['total_task'] > 0) {
            $data['completed_percentage'] = round(($data['total_task_com'] / $data['total_task']) * 100);

            $data['pending_percentage'] = round(($data['total_task_pending'] / $data['total_task']) * 100);
        } else {
            $data['completed_percentage'] = 100;
            $data['pending_percentage'] = 0;
        }
        $admin_email = session()->get('admin_email');
        $user2 = new SheetModel();
        $users = $user2->get_data();
        // $data['user_shreet'] = [];
        // $data['user_shreet'] = array_filter($data['sheet'], function ($item) use ($admin_email) {
        //     // Check if the email exists in the 'dis' field
        //     return strpos($item->dis, $admin_email) !== false;
        // });
        if ($users) {
            foreach ($users as $user) {
            
    
                // Parse the `dis` field and check if the admin has `sheets_view` permission
                $disEntries = explode(';', $user->dis); // Split `dis` into individual entries
                foreach ($disEntries as $entry) {
                    if (strpos($entry, 'Email:') !== false) {
                        preg_match('/Email:\s*([^,]+)/', $entry, $emailMatches);
                        preg_match('/Permissions:\s*(.+)/', $entry, $permissionMatches);
    
                        $email = isset($emailMatches[1]) ? trim($emailMatches[1]) : '';
                        $permissions = isset($permissionMatches[1]) ? explode(',', $permissionMatches[1]) : [];
    
                        if ($email === $admin_email && in_array('sheets_view', $permissions)) {
                            $data['user_shreet'][] = $user; // Add sheet data to the list
                            break; // No need to check further entries for this sheet
                        }
                    }
                }
            }
        }

        // Reset array keys to maintain numeric indexing if needed
        $data['user_shreet'] = array_values($data['user_shreet']);


        $model = new Hr_noticeModel();
        $users = $model->get_data_des();
        $baseUrl = rtrim(base_url(), '/'); // Ensure the base URL does not have a trailing slash

        if ($users) {
            foreach ($users as $user) {
                $post1 = $user->profile_pic;
                if ($post1 !== null) {
                    $resume1 = $post1;
                    $existingFilePath = FCPATH . $resume1; // FCPATH points to the 'public' directory

                    if (file_exists($existingFilePath)) {
                        $user_img = $baseUrl  . '/' . $resume1;
                    } else {
                        $user_img = $baseUrl . '/images/user_img.png';
                    }
                } else {
                    $user_img = $baseUrl . '/images/user_img.png';
                }
                // Add user image to user object
                $user->image_url = $user_img;
                $data['users'][] = $user;
            }
        } else {
            $data['users'] = '';
        }

        // echo "<pre>"; print_r($data['users']);
        // echo "</pre>";
        // die();
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
