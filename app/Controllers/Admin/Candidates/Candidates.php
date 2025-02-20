<?php

namespace App\Controllers\Admin\Candidates;

use App\Controllers\profile_img;
use App\Models\ProfileModel;
use App\Controllers\BaseController;
use App\Models\CandidatesModel;
use App\Models\Job_prefModel;
use App\Models\RoleModel;
use App\Models\ResumeModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

class Candidates extends BaseController
{
    protected $candidatesModel;

    public function __construct()
    {
        $this->candidatesModel = new CandidatesModel();
    }

    private function validateToken($token)
    {
        if ($token !== session()->get('token')) {
            return false;
        }
        return true;
    }

    private function jsonResponse($status, $message)
    {
        return $this->response->setJSON(['status' => $status, 'message' => $message]);
    }

    // Display all candidates
    public function listAllCandidates($segment)
    {
        if (!$this->validateToken($segment)) {
            return redirect()->to('/admin/login');
        }

        $data = [
            'token' => $segment,
            'role' => session()->get('role'),
            'admin_name' => session()->get('admin_name'),

            'users' => [] // Initialize 'users' to an empty array
        ];


        // echo "testt". $data['admin_name'];
        // die();

        $model = new CandidatesModel();
        $data['roles'] = $model->get_data();





        //  echo "<pre>";

        //                 print_r($data);
        //                 echo "</pre>";
        //                 die();
        // If no users are found, 'users' will be an empty array
        // No need to add null values

        // Debugging

        $permission = session()->get('admin_permission');

        $permissionsArray = explode(',', $permission); // Convert the string to an array for easier checking
        if (in_array('users_view', $permissionsArray)) {
            return view('admin/candidates/list_candidates', $data);
        } else {
            echo ('<script>
        
            alert("You do not have permission to access this page.");
       
        </script>');
        }
    }

    public function listCandidate_delete($id)
    {
        $permission = session()->get('admin_permission');

        $permissionsArray = explode(',', $permission); // Convert the string to an array for easier checking
        if (in_array('users_delete', $permissionsArray)) {
            $model = new CandidatesModel();

        $post = $model->delete_d($id);
        } else {
            echo ('<script>
        
            alert("You do not have permission to access this page.");
       
        </script>');
        }
        // echo "yes";
       

        return redirect()->to(base_url('admin/candidates/list_candidates' . session()->get('token')));
    }
    public function listCandidate_status($id)
    {
        $permission = session()->get('admin_permission');

        $permissionsArray = explode(',', $permission); // Convert the string to an array for easier checking
        if (in_array('users_edit', $permissionsArray)) {
            $model = new CandidatesModel();

            $post = $model->update_status_d($id);
        } else {
            echo ('<script>
        
            alert("You do not have permission to access this page.");
       
        </script>');
        }
        // echo "yes";
       

        return redirect()->to(base_url('admin/candidates/list_candidates' . session()->get('token')));
    }
    public function listCandidate_save()
    {

        $data = $this->request->getPost();

        $input = [
            'name' => isset($data['name']) ? $data['name'] : '',
            'mobile_number' => isset($data['mobile_number']) ? $data['mobile_number'] : '',
            'role' => isset($data['role']) ? $data['role'] : '',
            'email' => isset($data['email']) ? $data['email'] : '',
            'pass1' => isset($data['pass']) ? $data['pass'] : ''
            

        ];


        // echo "<pre>"; print_r($input); echo "</pre>";
        // die();

        $model = new CandidatesModel();

        $user = $model->findUserByUserNumber1($input['mobile_number']);

        if ($user == 0) {

            if ($input['pass1'] !== '') {
                $input['pass'] = password_hash($input['pass1'], PASSWORD_DEFAULT);
            } else {
                $input['pass'] = $input['pass1'];
            }

            $user1 = $model->save_d($input);
        } else {
            // print_r($user);

            $user_id = $user['id'];
            if ($input['pass1'] == '') {
                $input['pass'] = $user['pass'];
            } else {
                $input['pass'] = password_hash($input['pass1'], PASSWORD_DEFAULT);
            }

            $user1 = $model->update_profile($user_id, $input);
        }
        if ($user1 == true) {


            return redirect()->to(base_url('admin/candidates/' . session()->get('token')));
        } else {
            return "Error: Data not inserted successfully";
        }
    }
    public function listCandidate_getByid($id)
    {
        $permission = session()->get('admin_permission');

        $permissionsArray = explode(',', $permission); // Convert the string to an array for easier checking
        if (in_array('users_delete', $permissionsArray)) {
            $user = new CandidatesModel();
        $posts = $user->findUserById($id); // Find all job applications by job ID

        if ($posts) {

            $data = [
                'token' => session()->get('token'),
                'role' => session()->get('role'),
                'admin_name' => session()->get('admin_name'),
                'users' => [] // Initialize 'users' to an empty array
            ];

            $data['role'] = $posts;
            $model = new RoleModel();
            $data['roles'] = $model->getallRoleData();
            //   echo "<pre>";

            //                     print_r($data);
            //                     echo "</pre>";
            //                     die();
            return view('admin/candidates/candidate_form_value', $data);
        } else {
            return $this->response->setStatusCode(400)->setBody('user not foruned');
        }
        } else {
            echo ('<script>
        
            alert("You do not have permission to access this page.");
       
        </script>');
        }
        
    }


    public function store_prof_img($user_id, $input)
    {
        // Get the uploaded file
        $file = $input['profile_img'];

        // Check if the file is uploaded successfully
        if ($file->isValid() && !$file->hasMoved()) {
            // Move the file to the uploads folder
            $newName = $file->getRandomName();
            $file->move('uploads/profile/', $newName);

            // Save file information to the database
            $filepath = 'uploads/profile/' . $newName; // Relative path for storage
            // You may store other file details like $filename if needed

            $model = new ProfileModel();
            $existingProfile = $model->findByUId($user_id);

            // Handle existing profile image
            if ($existingProfile) {
                // Delete existing file if it exists
                $existingFilePath = FCPATH . $existingProfile['image_path'];
                if (file_exists($existingFilePath)) {
                    unlink($existingFilePath);
                }
            }

            // Move the file to user's folder if needed
            $userFolder = FCPATH . 'uploads/profile/' . $user_id . '-img';
            if (!file_exists($userFolder)) {
                mkdir($userFolder, 0777, true); // Create user's folder if it doesn't exist
            }

            $newResumePath = $userFolder . '/' . $newName; // New path with folder
            rename('uploads/profile/' . $newName, $newResumePath); // Move to user's folder
            $res_p = '/uploads/profile/' . $user_id . '-img/' . $newName;
            // Update database with new file path
            $data = [
                'user_id' => $user_id,
                'image_path' => $res_p // Save the file path relative to 'uploads/profile/'
                // Add more information about the file as needed
            ];

            if ($existingProfile) {
                $model->update1($data); // Update existing profile record
            } else {
                $model->save($data); // Save new profile record
            }

            // Prepare data for view
            $post = $model->findByUId($user_id); // Fetch updated data
            $baseUrl = base_url(); // Get base URL from CI configuration
            $baseUrl = rtrim($baseUrl, '/') . '/'; // Ensure base URL ends with '/'

            $imagePath = $post['image_path'];

            if ($imagePath && file_exists($imagePath)) {
                $data['image_path'] = $baseUrl . $imagePath; // Full URL to uploaded image
            } else {
                $data['image_path'] = $baseUrl . 'images/user_img.png'; // Default image if not found
            }

            return $data; // Return data for further processing or display
        } else {
            // Handle file upload error
            return "Error uploading file";
        }
    }


    public function addCandidate($segment)
    {
        if (!$this->validateToken($segment)) {
            return redirect()->to('/admin/login');
        }

        $data = [
            'token' => $segment,
            'role' => session()->get('role'),
            'admin_name' => session()->get('admin_name'),
            'users' => [] // Initialize 'users' to an empty array
        ];
        $model = new RoleModel();
        $data['roles'] = $model->getallRoleData();


        return view('admin/candidates/candidate_form', $data);
    }
}
