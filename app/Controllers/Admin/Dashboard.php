<?php

namespace App\Controllers\Admin;

use App\Models\CandidatesModel;
use App\Models\TaskModel;
use App\Models\CatModel;
use \Datetime;
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

        // Initialize data array
        $data = [
            'role' => $role,
            'admin_name' => session()->get('admin_name'),
            'token' => $token
        ];

        $user = new CandidatesModel();
        $user1 = new TaskModel();

        $admin_email = session()->get('admin_email');

        date_default_timezone_set('Asia/Kolkata'); // Set timezone
        $current_date = date('Y-m-d'); // Get current date

        $model = new CatModel();

        // Fetch data based on user role
        if ($role == 'DATA MINER') {
            $data['users'] = $model->getallData();
        } else {
            $branch = session()->get('admin_name');
            $data['users'] = $model->getCatDatabranch($branch);
        }

        // Check if users exist
        if (!isset($data['users']) || empty($data['users'])) {
            $data['total_task'] = 0;
            $data['total_task_com'] = 0;
            $data['total_task_pending'] = 0;
            $data['total_task_late'] = 0;
            $data['completed_percentage'] = 100;
            $data['pending_percentage'] = 0;
            $data['completed_late'] = 0;
            $data['pending'] = '';
            $data['late'] = '';
            $data['complete'] = '';
        } else {
            $total_task = count($data['users']); // Total tasks
            $pending = [];
            $late_complete = [];
            $complete = [];
            $current_date = (new DateTime())->format('Y-m-d');

            foreach ($data['users'] as $user) {
                $submit_dates = explode(',', $user->submit_date);
                $report_dates = explode(',', $user->report_submit_date);

                // Remove empty values & trim spaces
                $submit_dates = array_filter(array_map('trim', $submit_dates));
                $report_dates = array_filter(array_map('trim', $report_dates));

                // Convert to DateTime for comparison
                $submit_dates = array_map(fn($date) => new DateTime($date), $submit_dates);
                $report_dates = array_map(fn($date) => new DateTime($date), $report_dates);

                // Sort dates to align them
                sort($submit_dates);
                sort($report_dates);

                // echo "<pre>";
                // echo "Submit Dates:\n";
                // print_r($submit_dates);
                // echo "Report Dates:\n";
                // print_r($report_dates);
                // echo "</pre>";

                // If there are no submit or report dates, mark as complete
                if (empty($submit_dates) && empty($report_dates)) {
                    $complete[] = $user;
                    continue;
                }

                // If submitArray has values but reportArray is empty → Pending
                if (!empty($submit_dates) && empty($report_dates)) {
                    $pending[] = $user;
                    continue;
                }

                // Compare each submit date with the corresponding report date
                $is_pending = false;
                $is_late_complete = false;

                foreach ($submit_dates as $index => $submit_date) {
                    $formatted_submit_date = $submit_date->format('Y-m-d');

                    // Find corresponding report date (if exists)
                    $matching_report_date = $report_dates[$index] ?? null;

                    if (!$matching_report_date) {
                        $is_pending = true; // No report date found → Pending
                        break;
                    }

                    if ($matching_report_date->format('Y-m-d') > $formatted_submit_date) {
                        $is_late_complete = true; // Report submitted late
                    }
                }

                // Assign to the correct category
                if ($is_pending) {
                    $pending[] = $user;
                } elseif ($is_late_complete) {
                    $late_complete[] = $user;
                } else {
                    $complete[] = $user;
                }
            }

            // die();


            // echo "<pre>";
            //             echo "let complteArray\n";
            //             print_r($late_complete);


            //             echo "</pre>";

            //         die();

            // Count totals
            $total_pending = count($pending);
            $total_late_complete = count($late_complete);
            $total_complete = count($complete);

            // Store in data array
            $data['total_task'] = $total_task;
            $data['total_task_com'] = $total_complete;
            $data['total_task_pending'] = $total_pending;
            $data['total_task_late'] = $total_late_complete;

            // Calculate percentages
            if ($total_task > 0) {
                $data['completed_percentage'] = round(($total_complete / $total_task) * 100);
                $data['completed_late'] = round(($total_late_complete / $total_task) * 100);
                $data['pending_percentage'] = round(($total_pending / $total_task) * 100);
            } else {
                $data['completed_percentage'] = 100;
                $data['pending_percentage'] = 0;
                $data['completed_late'] = 0;
            }

            // Assign categorized data
            $data['pending'] = !empty($pending) ? $pending : '';
            $data['late'] = !empty($late_complete) ? $late_complete : '';
            $data['complete'] = !empty($complete) ? $complete : '';
        }
        // die();
        //  echo "<pre>";
        //     print_r($data);
        //     echo "</pre>";
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
