<?php

namespace App\Controllers\Admin\Category;

use App\Controllers\profile_img;
use App\Models\ProfileModel;
use App\Controllers\BaseController;
use App\Models\CandidatesModel;
use App\Models\CatModel;
use App\Models\SheetModel;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use App\Services\GoogleService;
use CodeIgniter\Controller;
use Google\Service\Drive;

class Category extends BaseController
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
    public function listAllCategory($segment)
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

        date_default_timezone_set('Asia/Kolkata'); // Set your timezone
        $current_date = date('Y-m-d'); // Get the current date
        
        $model = new CatModel();
        $data['users'] = $model->getallData();
        $not_complete_on_time = [];
        
        foreach ($data['users'] as $user) {
            $submit_date = $user->submit_date; // Get submit date
            $report_submit_date = $user->report_submit_date; // Get report submit date
        
            // Check if the current date is greater than submit_date
            if ($current_date > $submit_date) {
                // If report_submit_date is empty OR report_submit_date is greater than submit_date
                if (empty($report_submit_date) || $report_submit_date > $submit_date) {
                    $not_complete_on_time[] = $user; // Add to the new array
                }
            }
        }
        
        // echo "<pre>";
        // print_r($not_complete_on_time);
        // echo "</pre>";
        // die();
        return view('admin/catalog/category_list', $data);
    }
    public function listAllCategory_Form($segment)
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

        $model = new CatModel();
        $users = $model->getallData();


        return view('admin/catalog/category_form1', $data);
    }
    public function listAllCategory_Form_save($segment)
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
        $data = $this->request->getPost();



        $model = new CatModel();

        if ($data['id']) {

            $id = $data['id'];
            $input = [
                'id' => isset($data['id']) ? $data['id'] : '',
                'name' => isset($data['name']) ? $data['name'] : '',
                'branch' => isset($data['branch']) ? $data['branch'] : '',
                'assignment' => isset($data['assignment']) ? $data['assignment'] : '',
                'audit' => isset($data['audit']) ? $data['audit'] : '',
                'fee' => isset($data['fee']) ? $data['fee'] : '',
                'submit_date' => isset($data['submit_date']) ? $data['submit_date'] : '',
                'report_submit_date' => isset($data['report_submit_date']) ? $data['report_submit_date'] : '',
                'bill_date' => isset($data['bill_date']) ? $data['bill_date'] : '',
                'invoice_no' => isset($data['invoice_no']) ? $data['invoice_no'] : '',
                'recovery_status' => isset($data['recovery_status']) ? $data['recovery_status'] : '',
                'security_deposit' => isset($data['security_deposit']) ? $data['security_deposit'] : '',
                'working' => isset($data['working']) ? $data['working'] : '',
                'completion' => isset($data['completion']) ? $data['completion'] : '',
                'status' => isset($data['status']) ? $data['status'] : ''
            ];
            $user = $model->update1($id, $input);
        } else {

            $input = [
                'name' => isset($data['name']) ? $data['name'] : '',
                'branch' => isset($data['branch']) ? $data['branch'] : '',
                'assignment' => isset($data['assignment']) ? $data['assignment'] : '',
                'audit' => isset($data['audit']) ? $data['audit'] : '',
                'fee' => isset($data['fee']) ? $data['fee'] : '',
                'submit_date' => isset($data['submit_date']) ? $data['submit_date'] : '',
                'report_submit_date' => isset($data['report_submit_date']) ? $data['report_submit_date'] : '',
                'bill_date' => isset($data['bill_date']) ? $data['bill_date'] : '',
                'invoice_no' => isset($data['invoice_no']) ? $data['invoice_no'] : '',
                'recovery_status' => isset($data['recovery_status']) ? $data['recovery_status'] : '',
                'security_deposit' => isset($data['security_deposit']) ? $data['security_deposit'] : '',
                'working' => isset($data['working']) ? $data['working'] : '',
                'completion' => isset($data['completion']) ? $data['completion'] : '',
                'status' => isset($data['status']) ? $data['status'] : ''
            ];
            $user = $model->save($input);
        }
        $role = session()->get('role');

        // Pass the role to the view
        $data = [
            'role' => $role,
            'token' => $segment
        ];

        return redirect()->to(base_url('admin/category/' . session()->get('token')));
    }
    public function listAllCategory_list($segment)
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

        $model = new CandidatesModel();
        $users = $model->getAllUserData();

        $profile = new ProfileModel();
        $baseUrl = rtrim(base_url(), '/'); // Ensure the base URL does not have a trailing slash



        return view('admin/catalog/category_list', $data);
    }

    public function listAllcat_Form_value($id)
    {

        $data['token'] = session()->get('token');
        $model = new CatModel();

        $model = new CatModel();
        $role = $model->getCatDataid($id); // Ensure the base URL does not have a trailing slash
        $data['cat'] = $role[0];
        //      echo "<pre>"; print_r( $data['role']);
        // echo "</pre>";
        // die();

        return view('admin/catalog/category_form2', $data);
    }

    public function listcat_delete($id)
    {

        // echo "yes";
        $model = new CatModel();

        $post = $model->deletedata($id);

        return redirect()->to(base_url('admin/category/' . session()->get('token')));
    }

    public function listcat_status($id)
    {

        // echo "yes";
        $model = new CatModel();

        $post = $model->update_status_d($id);

        return redirect()->to(base_url('admin/category/' . session()->get('token')));
    }
  
   
    
  
   

    public function createSheet($data)
    {
        try {
            // Get Google API Client
            $client = \App\Services\GoogleService::getClient();
            $service = new \Google\Service\Sheets($client);

            // Create the Google Sheet
            $spreadsheet = new \Google\Service\Sheets\Spreadsheet([
                'properties' => [
                    'title' => $data['name'],
                ],
            ]);
            $spreadsheet = $service->spreadsheets->create($spreadsheet);

            // Retrieve the Spreadsheet ID and URL
            $spreadsheetId = $spreadsheet->spreadsheetId;
            $spreadsheetUrl = $spreadsheet->spreadsheetUrl;

            // Make the file publicly accessible
            $driveService = new \Google\Service\Drive($client);

            $permission = new \Google\Service\Drive\Permission([
                'type' => 'anyone', // This makes the file publicly accessible
                'role' => 'writer', // 'reader' for view-only, 'writer' for edit access
            ]);

            $driveService->permissions->create(
                $spreadsheetId,
                $permission,
                ['sendNotificationEmail' => false]
            );

            return $spreadsheetUrl;
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
    public function sheet_permission($token)
    {
        try {
            // Get the Google Sheet URL from the POST request
            $sheetUrl = $this->request->getPost('sheet_url');

            // Validate the URL
            if (filter_var($sheetUrl, FILTER_VALIDATE_URL) === false) {
                throw new \Exception('Invalid URL');
            }

            // Extract the file ID from the Google Sheet URL
            preg_match('/\/d\/(.*?)\//', $sheetUrl, $matches);
            if (!isset($matches[1])) {
                throw new \Exception('Invalid Google Sheet URL');
            }
            $fileId = $matches[1];
            // Fetch permissions using your service or API logic
            $permissions = $this->getSheetPermission($fileId);

            // Return JSON response
            return $this->response->setJSON([
                'success' => true,
                'permissions' => $permissions,
            ]);
        } catch (\Exception $e) {
            // Handle errors gracefully
            return $this->response->setJSON([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
    public function getSheetPermission($fileId)
    {
        try {
            // Initialize the Google API Client
            $client = \App\Services\GoogleService::getClient();
            $service = new \Google\Service\Drive($client);

            // Fetch permissions from the API
            $response = $service->permissions->listPermissions($fileId, [
                'fields' => 'permissions(id,emailAddress,role,type)',
            ]);

            // Log the response for debugging
            log_message('debug', 'Google API Response: ' . json_encode($response));

            // Check if permissions exist
            if (empty($response->getPermissions())) {
                log_message('debug', 'No permissions found for file ID: ' . $fileId);
                return [];
            }

            return $response->getPermissions(); // Return the permissions
        } catch (\Exception $e) {
            // Log the error message
            log_message('error', 'Error fetching permissions: ' . $e->getMessage());
            return [];
        }
    }


    //     public function createSheet($data)
    // {
    //     try {

    //         $selectedUsers = $data['selected_users'] ?? [];

    // //         echo "<pre>"; print_r($selectedUsers);
    // //         echo "</pre>";
    // // die();
    //         // Get Google API Client
    //         $client = \App\Services\GoogleService::getClient();
    //         $service = new \Google\Service\Sheets($client);

    //         // Create the Google Sheet
    //         $spreadsheet = new \Google\Service\Sheets\Spreadsheet([
    //             'properties' => [
    //                 'title' => 'Form Data Sheet',
    //             ],
    //         ]);
    //         $spreadsheet = $service->spreadsheets->create($spreadsheet);

    //         // Retrieve the Spreadsheet ID and URL
    //         $spreadsheetId = $spreadsheet->spreadsheetId;
    //         $spreadsheetUrl = $spreadsheet->spreadsheetUrl;

    //         // Grant ownership to admin
    //         $driveService = new \Google\Service\Drive($client);

    //         $permission = new \Google\Service\Drive\Permission([
    //             'type' => 'user',
    //             'role' => 'owner',
    //             'emailAddress' => session()->get('admin_email'),
    //         ]);

    //         $driveService->permissions->create(
    //             $spreadsheetId,
    //             $permission,
    //             ['transferOwnership' => true, 'sendNotificationEmail' => true]
    //         );

    //         // 📌 Add Delay to Prevent Rate Limit Exceeded Error
    //         sleep(1);  // Delay after admin permission

    //         // Handle permissions for selected users

    //         if (!empty($selectedUsers)) {
    //             foreach ($selectedUsers as $userId => $value) {
    //                 $userEmail = $data['permissions'][$userId]['user_email'] ?? null;
    //                 $permissions = $data['permissions'][$userId] ?? [];

    //                 if ($userEmail && !empty($permissions)) {
    //                     $role = in_array('sheets_edit', $permissions) ? 'writer' : 'reader';

    //                     $permission = new \Google\Service\Drive\Permission([
    //                         'type' => 'user',
    //                         'role' => $role,
    //                         'emailAddress' => $userEmail,
    //                     ]);

    //                     try {
    //                         $driveService->permissions->create(
    //                             $spreadsheetId,
    //                             $permission,
    //                             ['sendNotificationEmail' => true]
    //                         );

    //                         sleep(1);  // ⏳ Delay between each permission to avoid rate limit

    //                     } catch (\Google\Service\Exception $e) {
    //                         if (strpos($e->getMessage(), 'sharingRateLimitExceeded') !== false) {
    //                             log_message('error', "Quota exceeded for $userEmail. Skipping...");
    //                             sleep(5);  // Wait longer before the next request
    //                         } else {
    //                             log_message('error', "Error sharing with $userEmail: " . $e->getMessage());
    //                         }
    //                     }
    //                 }
    //             }
    //         }

    //         return $spreadsheetUrl;

    //     } catch (\Exception $e) {
    //         return $this->response->setJSON([
    //             'success' => false,
    //             'message' => $e->getMessage(),
    //         ]);
    //     }
    // }


    private function grantSheetPermission($sheetUrl, $email, $role)
    {
        try {
            $client = \App\Services\GoogleService::getClient();
            $driveService = new \Google\Service\Drive($client);

            $permission = new \Google\Service\Drive\Permission([
                'type' => 'user',
                'role' => $role,
                'emailAddress' => $email,
            ]);

            $sheetId = $this->extractSheetIdFromUrl($sheetUrl);
            $driveService->permissions->create($sheetId, $permission, ['sendNotificationEmail' => true, 'transferOwnership' => true,]);
        } catch (\Exception $e) {
            log_message('error', 'Error assigning permission: ' . $e->getMessage());
        }
    }

    private function extractSheetIdFromUrl($url)
    {
        preg_match('/\/d\/([a-zA-Z0-9-_]+)/', $url, $matches);
        return $matches[1] ?? '';
    }

    public function listAllunit_product_form($segment)
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

        $model = new CatModel();
        $data['cat'] = $model->getallData();
        $model1 = new CandidatesModel();
        $data['users'] = $model1->get_data_permission();

        // echo "<pre>"; print_r($data['users']);
        // echo "</pre>";

        // die();
        return view('admin/catalog/unit_product_form', $data);
    }

    public function listCandidate_delete($id)
    {

        // echo "yes";
        $model = new CandidatesModel();

        $post = $model->delete_usweb($id);

        return redirect()->to(base_url('admin/candidates/list_candidates' . session()->get('token')));
    }
    public function listCandidate_status($id)
    {

        // echo "yes";
        $model = new CandidatesModel();

        $post = $model->update_status_d($id);

        return redirect()->to(base_url('admin/candidates/list_candidates' . session()->get('token')));
    }
    public function listCategory_save($segment)
    {

        $data = $this->request->getPost();
        print_r($data);
        return redirect()->to(base_url('admin/catalog/category_list/' . $segment));
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
            $file->move('uploads/sheet/', $newName);

            // Save file information to the database
            $filepath = 'uploads/sheet/' . $newName; // Relative path for storage
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
            $userFolder = FCPATH . 'uploads/sheet/' . $user_id . '-img';
            if (!file_exists($userFolder)) {
                mkdir($userFolder, 0777, true); // Create user's folder if it doesn't exist
            }

            $newResumePath = $userFolder . '/' . $newName; // New path with folder
            rename('uploads/sheet/' . $newName, $newResumePath); // Move to user's folder
            $res_p = 'uploads/sheet/' . $user_id . '-img/' . $newName;
            // Update database with new file path


            return $res_p; // Return data for further processing or display
        } else {
            // Handle file upload error
            return "Error uploading file";
        }
    }
}
