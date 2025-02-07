<?php

namespace App\Controllers\Admin\Hr;

use App\Models\ProfileModel;
use App\Controllers\BaseController;
use App\Models\HrModel;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

class Hr extends BaseController
{
    protected $HrModel;

    public function __construct()
    {
        $this->HrModel = new HrModel();
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
    public function listAllHr_policies($segment)
    {
        if (!$this->validateToken($segment)) {
            return redirect()->to('/admin/login');
        }

        $data = [
            'token' => $segment,
             'role' => session()->get('role'),'admin_name' => session()->get('admin_name'),
            'users' => [] // Initialize 'users' to an empty array
        ];

        $model = new HrModel();
        $users = $model->get_data();




      
        $baseUrl = rtrim(base_url(), '/'); // Ensure the base URL does not have a trailing slash

        if ($users) {
            foreach ($users as $user) {



          
               
                $post1 =$user->profile_pic;
                if ($post1 !== null) {
                    $resume1 = $post1;
                    $existingFilePath = FCPATH . $resume1; // FCPATH points to the 'public' directory

                    // Debugging
                    // echo "Checking path: " . $existingFilePath . "<br>";
                    // echo "File exists: " . (file_exists($existingFilePath) ? 'Yes' : 'No') . "<br>";

                    if (file_exists($existingFilePath)) {
                        $user_img = $baseUrl  .'/'. $resume1;
                    } else {
                        $user_img = $baseUrl . '/images/user_img.png';
                    }
                } else {
                    $user_img = $baseUrl . '/images/user_img.png';
                }

                $user->dis = isset($user->dis) ? str_replace("u0027", "'", json_decode($user->dis, true)) : '';


                // Add user image to user object
                $user->image_url = $user_img;
                $data['users'][] = $user;
              
            }
        }
       
        //  echo "<pre>";

        //                 print_r($data['users'] );
        //                 echo "</pre>";
        //                 die();
        // If no users are found, 'users' will be an empty array
        // No need to add null values

        // Debugging


        return view('admin/hr/hr_list', $data);
    }
    public function listAllHr_policies1($segment)
    {
        if (!$this->validateToken($segment)) {
            return redirect()->to('/admin/login');
        }

        $data = [
            'token' => $segment,
             'role' => session()->get('role'),'admin_name' => session()->get('admin_name'),
            'users' => [] // Initialize 'users' to an empty array
        ];

        $model = new HrModel();
        $users = $model->get_data();
        $baseUrl = rtrim(base_url(), '/'); // Ensure the base URL does not have a trailing slash

        if ($users) {
            foreach ($users as $user) {
                $post1 =$user->profile_pic;
                if ($post1 !== null) {
                    $resume1 = $post1;
                    $existingFilePath = FCPATH . $resume1; // FCPATH points to the 'public' directory

                    if (file_exists($existingFilePath)) {
                        $user_img = $baseUrl  .'/'. $resume1;
                    } else {
                        $user_img = $baseUrl . '/images/user_img.png';
                    }
                } else {
                    $user_img = $baseUrl . '/images/user_img.png';
                }
                
                $user->dis = isset($user->dis) ? str_replace("u0027", "'", json_decode($user->dis, true)) : '';
                // Add user image to user object
                $user->image_url = $user_img;
                $data['users'][] = $user;
            }
        }

        return view('admin/hr/hr_list1', $data);
    }
    public function listAllHr_form($segment)
    {
        if (!$this->validateToken($segment)) {
            return redirect()->to('/admin/login');
        }

        $data = [
            'token' => $segment,
             'role' => session()->get('role'),'admin_name' => session()->get('admin_name'),
            'users' => [] // Initialize 'users' to an empty array
        ];

   

        return view('admin/hr/hr_form', $data);
    }
    public function listAllHr_form_value($id)
    {


        
        $data['token'] = session()->get('token');
        $model = new HrModel();
        $users = $model->get_data_id($id);

       


      
        $baseUrl = rtrim(base_url(), '/'); // Ensure the base URL does not have a trailing slash

        if ($users) {
            foreach ($users as $user) {



          
               
                $post1 =$user->profile_pic;
                if ($post1 !== null) {
                    $resume1 = $post1;
                    $existingFilePath = FCPATH . $resume1; // FCPATH points to the 'public' directory

                    // Debugging
                    // echo "Checking path: " . $existingFilePath . "<br>";
                    // echo "File exists: " . (file_exists($existingFilePath) ? 'Yes' : 'No') . "<br>";

                    if (file_exists($existingFilePath)) {
                        $user_img = $baseUrl  .'/'. $resume1;
                    } else {
                        $user_img = $baseUrl . '/images/user_img.png';
                    }
                } else {
                    $user_img = $baseUrl . '/images/user_img.png';
                }

               
                $user->dis = isset($user->dis) ? str_replace("u0027", "'", json_decode($user->dis, true)) : '';

                // Add user image to user object
                $user->image_url = $user_img;
                $data['users'][] = $user;
            }
        }
       
$data['user'] = $data['users'][0];
//       echo "<pre>";

                        // print_r($data['user']);
                        // echo "</pre>";
                        // die();

        return view('admin/hr/hr_form1', $data);
    }

    public function listHr_delete($id)
    {

        // echo "yes";
        $model = new HrModel();

        $post = $model->deletedata($id);

        return redirect()->to(base_url('admin/hr_policies/' . session()->get('token')));
    }
    public function listHr_status($id)
    {

        // echo "yes";
        $model = new HrModel();

        $post = $model->update_status_d($id);

        return redirect()->to(base_url('admin/candidates/list_candidates' . session()->get('token')));
    }
    public function listHr_save()
    {

        $data = $this->request->getPost();
        $rofile_pic = $this->request->getFile('profile_pic');
        $model = new HrModel();
        if($data['id']){
           
            $id = $data['id'];
            $input = [
                'id' => isset($data['id']) ? $data['id'] : '',
                'name' => isset($data['name']) ? $data['name'] : '',
                'dis' => isset($data['dis']) ? json_encode($data['dis'], JSON_HEX_QUOT | JSON_HEX_APOS) : '',
                'profile_img' => isset($rofile_pic) ? $rofile_pic : '',
                'profile_img_h' => isset($data['profile_pic_h']) ? $data['profile_pic_h'] : '',
                'status' => isset($data['status']) ? $data['status'] : ''
            ];
            if ($rofile_pic && $rofile_pic->isValid() && !$rofile_pic->hasMoved()) {
                // Upload new image
                $input['prof_img'] = $this->store_prof_img($input);
            } else {
                // Use existing image if no new image is uploaded
                $input['prof_img'] = isset($data['profile_pic_h']) ? $data['profile_pic_h'] : '';
            }

       
           
            $user = $model->update1($id,$input);
          
         }else{
         
            $input = [
                'name' => isset($data['name']) ? $data['name'] : '',
               'dis' => isset($data['dis']) ? json_encode($data['dis'], JSON_HEX_QUOT | JSON_HEX_APOS) : '',
                'profile_img' => isset($rofile_pic) ? $rofile_pic : '',
              
                'status' => isset($data['status']) ? $data['status'] : ''
            ];
            $input['prof_img'] =  $this->store_prof_img($input);
        //   echo "<pre>"; print_r($input); echo "</pre>";
        // die();
         
            $user = $model->save($input);
           
         }
        // echo "<pre>"; print_r($input); echo "</pre>";
        // die();
        $token = session()->get('token');
    
            // Pass the role to the view
         
        return redirect()->to(base_url('admin/hr_policies/' . $token));
       

      

        return $this->response->setStatusCode(200)->setBody('user saved');
    }
  
  
    public function store_prof_img($input)
    {
        // Get the uploaded file
        $file = $input['profile_img'];
        $user_id = strtok($input['name'], ' ');
        // echo $user_id;
        // die();
        // Check if the file is uploaded successfully
        if ($file->isValid() && !$file->hasMoved()) {
            // Move the file to the uploads folder
            $newName = $file->getRandomName();
            $file->move('uploads/Hr/', $newName);

            // Save file information to the database
            $filepath = 'uploads/Hr/' . $newName; // Relative path for storage
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
            $userFolder = FCPATH . 'uploads/Hr/' . $user_id . '-img';
            if (!file_exists($userFolder)) {
                mkdir($userFolder, 0777, true); // Create user's folder if it doesn't exist
            }

            $newResumePath = $userFolder . '/' . $newName; // New path with folder
            rename('uploads/Hr/' . $newName, $newResumePath); // Move to user's folder
            $res_p = 'uploads/Hr/' . $user_id . '-img/' . $newName;
            // Update database with new file path
        

            return $res_p; // Return data for further processing or display
        } else {
            // Handle file upload error
            return "Error uploading file";
        }
    }

 
}
