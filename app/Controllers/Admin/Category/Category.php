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

        $model = new CatModel();
        $data['users'] = $model->getallData();
    //     echo "<pre>";
    //     print_r($data);
    //    echo "</pre>";
    //    die();

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
    public function listSheet_delete($id)
    {

        // echo "yes";
        $model = new SheetModel();

        $post = $model->deletedata($id);

        return redirect()->to(base_url('admin/category/unit_product_list' . session()->get('token')));
    }

    public function listSheet_status($id)
    {

        // echo "yes";
        $model = new SheetModel();

        $post = $model->update_status_d($id);



        return redirect()->to(base_url('admin/category/unit_product_list' . session()->get('token')));
    }

    public function listAllunit_product_list($segment)
    {
        if (!$this->validateToken($segment)) {
            return redirect()->to('/admin/login');
        }
    
        $adminEmail = session()->get('admin_email'); // Get the logged-in admin's email
    
        $data = [
            'token' => $segment,
            'role' => session()->get('role'),
            'admin_name' => session()->get('admin_name'),
            'admin_email' => $adminEmail,
            'users' => [] // Initialize 'users' to an empty array
        ];
    
        $model = new SheetModel();
        $users = $model->get_data();
    
        $baseUrl = rtrim(base_url(), '/');
        if ($users) {
            foreach ($users as $user) {
                $post1 = $user->prof_img;
    
                if ($post1 !== '') {
                    $resume1 = $post1;
                    $existingFilePath = FCPATH . $resume1; // FCPATH points to the 'public' directory
    
                    if (file_exists($existingFilePath)) {
                        $user_img = $baseUrl  . '/' . $resume1;
                    } else {
                        $user_img = $baseUrl . '/assets/images/drive.png';
                    }
                } else {
                    $user_img = $baseUrl . '/assets/images/drive.png';
                }
                // Add user image to user object
                $user->image_url = $user_img;
    
                // Parse the `dis` field and check if the admin has `sheets_view` permission
                $disEntries = explode(';', $user->dis); // Split `dis` into individual entries
                foreach ($disEntries as $entry) {
                    if (strpos($entry, 'Email:') !== false) {
                        preg_match('/Email:\s*([^,]+)/', $entry, $emailMatches);
                        preg_match('/Permissions:\s*(.+)/', $entry, $permissionMatches);
    
                        $email = isset($emailMatches[1]) ? trim($emailMatches[1]) : '';
                        $permissions = isset($permissionMatches[1]) ? explode(',', $permissionMatches[1]) : [];
    
                        if ($email === $adminEmail && in_array('sheets_view', $permissions)) {
                            $data['users'][] = $user; // Add sheet data to the list
                            break; // No need to check further entries for this sheet
                        }
                    }
                }
            }
        }
    
        // echo "<pre>";
        // print_r($data['users']);
        // echo "</pre>";
        // die();
    
        return view('admin/catalog/unit_product_list', $data);
    }
    
    public function listAllunit_product_list_card($segment)
    {
        if (!$this->validateToken($segment)) {
            return redirect()->to('/admin/login');
        }
        $adminEmail = session()->get('admin_email');
        $data = [
            'token' => $segment,
            'role' => session()->get('role'),
            'admin_name' => session()->get('admin_name'),
            'users' => [] // Initialize 'users' to an empty array
        ];
        $model = new SheetModel();
        $users = $model->get_data();


        $baseUrl = rtrim(base_url(), '/');
        if ($users) {
            foreach ($users as $user) {
                $post1 = $user->prof_img;
    
                if ($post1 !== '') {
                    $resume1 = $post1;
                    $existingFilePath = FCPATH . $resume1; // FCPATH points to the 'public' directory
    
                    if (file_exists($existingFilePath)) {
                        $user_img = $baseUrl  . '/' . $resume1;
                    } else {
                        $user_img = $baseUrl . '/assets/images/drive.png';
                    }
                } else {
                    $user_img = $baseUrl . '/assets/images/drive.png';
                }
                // Add user image to user object
                $user->image_url = $user_img;
    
                // Parse the `dis` field and check if the admin has `sheets_view` permission
                $disEntries = explode(';', $user->dis); // Split `dis` into individual entries
                foreach ($disEntries as $entry) {
                    if (strpos($entry, 'Email:') !== false) {
                        preg_match('/Email:\s*([^,]+)/', $entry, $emailMatches);
                        preg_match('/Permissions:\s*(.+)/', $entry, $permissionMatches);
    
                        $email = isset($emailMatches[1]) ? trim($emailMatches[1]) : '';
                        $permissions = isset($permissionMatches[1]) ? explode(',', $permissionMatches[1]) : [];
    
                        if ($email === $adminEmail && in_array('sheets_view', $permissions)) {
                            $data['users'][] = $user; // Add sheet data to the list
                            break; // No need to check further entries for this sheet
                        }
                    }
                }
            }
        }
        // echo "<pre>";
        // print_r($data['users']);
        // echo "</pre>";
        // die();
        return view('admin/catalog/unit_product_list_card', $data);
    }
    public function listAllunit_product_list_save($segment)
    {
        if (!$this->validateToken($segment)) {
            return redirect()->to('/admin/login');
        }

        $data = [
            'token' => $segment,
            'role' => session()->get('role'),
            'admin_name' => session()->get('admin_name'),
            'email' => 'admin@gmail.com',
            'users' => [] // Initialize 'users' to an empty array
        ];

        $data = $this->request->getPost();
        $rofile_pic = $this->request->getFile('cover_pic');
        $selectedUsers = $data['selected_users'] ?? [];
        //         echo "<pre>"; print_r(  $rofile_pic);
        //         echo "</pre>";
        // die();
        $filteredData = [];

        // Process only the selected users
        if (!empty($selectedUsers)) {
            foreach ($selectedUsers as $userId => $value) {
                // Get user data
                $userName = $data['permissions'][$userId]['user_name'] ?? null;
                $userEmail = $data['permissions'][$userId]['user_email'] ?? null;
                $defaultPermissions = [
                    'sheets_view' => 0,
                    'sheets_edit' => 0,
                ];
                // Check if permissions for this user exist
                $userPermissions = array_merge($defaultPermissions, $data['permissions'][$userId] ?? []);

                // echo "<pre>"; print_r($userPermissions);
                // echo "</pre>";
                // die();

                if ($userPermissions['sheets_view'] == 1) {
                    $userPermissions1['sheets_view'] = 'sheets_view';
                }
                if ($userPermissions['sheets_edit'] == 1) {
                    $userPermissions1['sheets_edit'] = 'sheets_edit';
                }
                // You can now process the data
                if ($userName && $userEmail) {
                    // Store the filtered data for this user
                    $filteredData[] = [
                        'user_name' => $userName,
                        'user_email' => $userEmail,
                        'permissions' => $userPermissions1
                    ];
                }
            }
        }

        $input['user'] = $filteredData;

        $userss = '';
        foreach ($filteredData as $user) {
            $userss .= 'Name: ' . $user['user_name'] . ', ';
            $userss .= 'Email: ' . $user['user_email'] . ', ';
            $userss .= 'Permissions: ' . implode(', ', $user['permissions']) . '; ';
        }

        // Trim any extra space at the end
        $userss = rtrim($userss, '; ');

        // echo "<pre>"; print_r($userss);
        // echo "</pre>";
        // die();

        $input = [
            'selected_users' => $selectedUsers,
            'sheet_url' => isset($data['sheet_url']) ? $data['sheet_url'] : '',
            'name' => isset($data['name']) ? $data['name'] : '',
            'dis' => $userss,
            'profile_img' => isset($rofile_pic) ? $rofile_pic : '',
            'emails' => session()->get('admin_email'),
            'permistion' => isset($data['permission']) ? implode(',', $data['permission']) : '',
            'cat' => isset($data['cat']) ? implode(',', $data['cat']) : '',
            'sheet_cat' => isset($data['sheet_cat']) ? $data['sheet_cat'] : 'sheet',
            'status' => isset($data['status']) ? $data['status'] : ''
        ];
        if ($rofile_pic && $rofile_pic->isValid() && !$rofile_pic->hasMoved()) {
            // Upload new image
            $input['prof_img'] = $this->store_prof_img($input);
        } else {
            // Use existing image if no new image is uploaded
            $input['prof_img'] = '';
        }
        if ($input['sheet_url'] == '') {

            $input['sheet_url1'] = $this->createSheet($input);
        } else {
            // getSheetPermission
            $input['sheet_url1'] = $input['sheet_url'];
        }
        $data['sheet_url'] = $input['sheet_url1'];

        // echo "<pre>";
        // print_r( $data['sheet_url']);
        // echo "</pre>";
        // die();

        $model = new SheetModel();
        $users = $model->save($input);

        // die();
        $data['token'] = session()->get('token');
        // return redirect()->to(base_url('admin/category/unit_product_list/' . session()->get('token')));
        return view('admin/catalog/sheet_view', $data);
    }
    public function listAllunit_product_list_update($segment)
    {
        if (!$this->validateToken($segment)) {
            return redirect()->to('/admin/login');
        }

        $data = [
            'token' => $segment,
            'role' => session()->get('role'),
            'admin_name' => session()->get('admin_name'),
            'email' => 'admin@gmail.com',
            'users' => [] // Initialize 'users' to an empty array
        ];

        $data = $this->request->getPost();
        $rofile_pic = $this->request->getFile('cover_pic');
        $selectedUsers = $data['selected_users'] ?? [];
        //         echo "<pre>"; print_r(  $rofile_pic);
        //         echo "</pre>";
        // die();
        $filteredData = [];

        // Process only the selected users
        if (!empty($selectedUsers)) {
            foreach ($selectedUsers as $userId => $value) {
                // Get user data
                $userName = $data['permissions'][$userId]['user_name'] ?? null;
                $userEmail = $data['permissions'][$userId]['user_email'] ?? null;
                $defaultPermissions = [
                    'sheets_view' => 0,
                    'sheets_edit' => 0,
                ];
                // Check if permissions for this user exist
                $userPermissions = array_merge($defaultPermissions, $data['permissions'][$userId] ?? []);

                // echo "<pre>"; print_r($userPermissions);
                // echo "</pre>";
                // die();

                if ($userPermissions['sheets_view'] == 1) {
                    $userPermissions1['sheets_view'] = 'sheets_view';
                }
                if ($userPermissions['sheets_edit'] == 1) {
                    $userPermissions1['sheets_edit'] = 'sheets_edit';
                }
                // You can now process the data
                if ($userName && $userEmail) {
                    // Store the filtered data for this user
                    $filteredData[] = [
                        'user_name' => $userName,
                        'user_email' => $userEmail,
                        'permissions' => $userPermissions1
                    ];
                }
            }
        }

        $input['user'] = $filteredData;

        $userss = '';
        foreach ($filteredData as $user) {
            $userss .= 'Name: ' . $user['user_name'] . ', ';
            $userss .= 'Email: ' . $user['user_email'] . ', ';
            $userss .= 'Permissions: ' . implode(', ', $user['permissions']) . '; ';
        }

        // Trim any extra space at the end
        $userss = rtrim($userss, '; ');

        // echo "<pre>"; print_r($userss);
        // echo "</pre>";
        // die();

        $input = [
            'selected_users' => $selectedUsers,
            'sheet_url' => isset($data['sheet_url']) ? $data['sheet_url'] : '',
            'name' => isset($data['name']) ? $data['name'] : '',
            'dis' => $userss,
            'profile_img' => isset($rofile_pic) ? $rofile_pic : '',
            'emails' => session()->get('admin_email'),
            'permistion' => isset($data['permission']) ? implode(',', $data['permission']) : '',
            'cat' => isset($data['cat']) ? implode(',', $data['cat']) : '',
            'sheet_cat' => isset($data['sheet_cat']) ? $data['sheet_cat'] : 'sheet',
            'status' => isset($data['status']) ? $data['status'] : ''
        ];
        if ($rofile_pic && $rofile_pic->isValid() && !$rofile_pic->hasMoved()) {
            // Upload new image
            $input['prof_img'] = $this->store_prof_img($input);
        } else {
            // Use existing image if no new image is uploaded
            $input['prof_img'] = '';
        }

        // getSheetPermission
        $input['sheet_url1'] = $input['sheet_url'];

        $data['sheet_url'] = $input['sheet_url1'];
        $id = $data['id'];
        // echo "<pre>";
        // print_r( $input);
        // echo "</pre>";
        // die();

        $model = new SheetModel();
        $users = $model->update1($id, $input);

        // die();
        $data['token'] = session()->get('token');
        return redirect()->to(base_url('admin/category/unit_product_list/' . session()->get('token')));
        // return view('admin/catalog/sheet_view', $data);
    }
    public function listAllSheet_View($id)
    {


        $model = new SheetModel();
        $users = $model->findHrById($id);


        $data['sheet_url'] = $users['sheet_url'];

        // die();
        $data['token'] = session()->get('token');

        return view('admin/catalog/sheet_view', $data);
    }
    public function listAllSheet_value($id)
    {
        $model = new SheetModel();
        $data['user'] = $model->findHrById($id); // Sheet data from the database
    
        $model = new CatModel();
        $data['cat'] = $model->getallData();
    
        $model1 = new CandidatesModel();
        $data['users'] = $model1->get_data_permission(); // Users data from the database
    
        // Parse the `dis` field into an array of permissions
        $permissionsData = [];
        $permissionsString = $data['user']['dis']; // Extract `dis` data
    
        if (!empty($permissionsString)) {
            $permissionGroups = explode(';', $permissionsString);
    
            foreach ($permissionGroups as $group) {
                $group = trim($group);
                if (!empty($group)) {
                    preg_match('/Name:\s*(.*?),\s*Email:\s*(.*?),\s*Permissions:\s*(.*)/', $group, $matches);
                    if (count($matches) === 4) {
                        $permissionsData[] = [
                            'name' => trim($matches[1]),
                            'email' => trim($matches[2]),
                            'permissions' => explode(',', str_replace(' ', '', trim($matches[3]))),
                        ];
                    }
                }
            }
        }
    
        // Add permissions data to users
        // Add permissions data to users
foreach ($data['users'] as $user) {
    $user->permissions = []; // Use -> instead of []

    foreach ($permissionsData as $perm) {
        if ($perm['email'] === $user->admin_email) { // Use -> for object properties
            $user->permissions = $perm['permissions']; // Assign the matched permissions
            break;
        }
    }
}

$data['permissionsData'] =$permissionsData;
        //   echo "<pre>"; print_r($permissionsData);
        // echo "</pre>";
        //         die();
        // Pass processed data to the view
        $data['token'] = session()->get('token');
    
        return view('admin/catalog/unit_product_form_value', $data);
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
