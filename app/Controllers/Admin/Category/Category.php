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

        $role = session()->get('role');
        $model = new CatModel();
        if ($role == 'DATA MINER') {
            $data['users'] = $model->getallData();
        } else {
            $branch = session()->get('admin_name');
            $data['users'] = $model->getCatDatabranch($branch);
        }
        if ($data['users'] !== null) {
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
        }

        // echo "<pre>";
        // print_r($not_complete_on_time);
        // echo "</pre>";
        // die();
        return view('admin/catalog/category_list', $data);
    }
    public function listAllCategory_export($segment)
    {
        if (!$this->validateToken($segment)) {
            return redirect()->to('/admin/login');
        }
    
        date_default_timezone_set('Asia/Kolkata');
        $current_date = date('Y-m-d');
    
        $role = session()->get('role');
        $model = new CatModel();
    
        if ($role == 'DATA MINER') {
            $users = $model->getallData();
        } else {
            $branch = session()->get('admin_name');
            $users = $model->getCatDatabranch($branch);
        }
    
        // Set headers for CSV file download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="category_export.csv"');
        header('Pragma: no-cache');
        header('Expires: 0');
    
        $output = fopen('php://output', 'w');
    
        // **CSV Headers** - Matching Table Columns
        fputcsv($output, [
            'Sr. No', 'Name', 'Branch', 'Type', 'Type Of Assignment', 'Frequency Of Audit',
            'Professional Fees', 'Last Date of Submission', 'Report Date of Submission',
            'Bill Type', 'Bill Date', 'UDIN', 'UDIN No', 'UDIN Turnover',
            'Invoice Number','Invoice Amount', 'Recovery Status', 'Security Deposit', 'Working Environment',
            'Completion Certificate Received', 'Status', 'Date Added'
        ]);
    
        // **CSV Data**
        $index = 1;
        foreach ($users as $user) {
            $audit_values = explode(',', $user->audit);
            $fee_values = explode(',', $user->fee);
            $submit_dates = explode(',', $user->submit_date);
            $report_dates = explode(',', $user->report_submit_date);
            $bill_dates = explode(',', $user->bill_date);
            $invoice_nos = explode(',', $user->invoice_no);
            $invoice_amounts = explode(',', $user->invoice_amount);
            $recovery_status = explode(',', $user->recovery_status);
            $security_deposit = explode(',', $user->security_deposit);
            $working_values = explode(',', $user->working);
            $completion_values = explode(',', $user->completion);
    
            // Determine max count to handle multi-value fields
            $max_count = max(
                count($audit_values), count($fee_values), count($submit_dates),
                count($report_dates), count($bill_dates), count($invoice_nos),
                count($invoice_amounts), count($recovery_status),
                count($security_deposit), count($working_values), count($completion_values)
            );
    
            // Loop through multi-value fields
            for ($i = 0; $i < $max_count; $i++) {
                fputcsv($output, [
                    $i === 0 ? sprintf("%02d", $index++) : '', // Only first row shows index
                    $i === 0 ? $user->name : '',
                    $i === 0 ? $user->branch : '',
                    $i === 0 ? $user->type : '',
                    $i === 0 ? $user->assignment : '',
                    $audit_values[$i] ?? '',
                    $fee_values[$i] ?? '',
                    $submit_dates[$i] ?? '',
                    $report_dates[$i] ?? '',
                    $bill_dates[$i] ?? '',
                    $invoice_nos[$i] ?? '',
                    $invoice_amounts[$i] ?? '',
                    $recovery_status[$i] ?? '',
                    $security_deposit[$i] ?? '',
                    $working_values[$i] ?? '',
                    $completion_values[$i] ?? '',
                    $i === 0 ? $user->udin : '',
                    $i === 0 ? $user->udin_no : '',
                    $i === 0 ? $user->udin_trun : '',
                    $i === 0 ? ($user->status == '1' ? 'Active' : 'Inactive') : '',
                    $i === 0 ? $user->created_at : ''
                ]);
            }
        }
    
    
        fclose($output);
        exit;
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

        $model = new CandidatesModel();
        $data['roles'] = $model->get_data();
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

        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // die();
        $fee = isset($data['fee']) ? $data['fee'] : [];
        $recovery_status = isset($data['recovery_status']) ? $data['recovery_status'] : [];
        $security_deposit = isset($data['security_deposit']) ? $data['security_deposit'] : [];
        $working = isset($data['working']) ? $data['working'] : [];
        $completion = isset($data['completion']) ? $data['completion'] : [];
        $submit_dates = isset($data['submit_date']) ? $data['submit_date'] : [];
        $report_dates = isset($data['report_submit_date']) ? $data['report_submit_date'] : [];
        $bill_dates = isset($data['bill_date']) ? $data['bill_date'] : [];
        $invoice_no = isset($data['invoice_no']) ? $data['invoice_no'] : [];
        $invoice_amount = isset($data['invoice_amount']) ? $data['invoice_amount'] : [];



        // Convert arrays to comma-separated strings
        $fee_string = !empty($fee) ? implode(',', $fee) : '';
        $recovery_status_string = !empty($recovery_status) ? implode(',', $recovery_status) : '';
        $security_deposit_string = !empty($security_deposit) ? implode(',', $security_deposit) : '';
        $working_string = !empty($working) ? implode(',', $working) : '';
        $completion_string = !empty($completion) ? implode(',', $completion) : '';
        $submit_date_string = !empty($submit_dates) ? implode(',', $submit_dates) : '';
        $report_date_string = !empty($report_dates) ? implode(',', $report_dates) : '';
        $bill_date_string = !empty($bill_dates) ? implode(',', $bill_dates) : '';
        $invoice_no_string = !empty($invoice_no) ? implode(',', $invoice_no) : '';
        $invoice_amount_string = !empty($invoice_amount) ? implode(',', $invoice_amount) : '';
       
        $model = new CatModel();

        if ($data['id']) {
            $id = $data['id'];
            $input = [
                'id' => isset($data['id']) ? $data['id'] : '',
                'name' => isset($data['name']) ? $data['name'] : '',
                'branch' => isset($data['branch']) ? $data['branch'] : '',
                'assignment' => isset($data['assignment']) ? $data['assignment'] : '',
                'type' => isset($data['type']) ? $data['type'] : '',
                'audit' => isset($data['audit']) ? $data['audit'] : '',
                'fee' => $fee_string,
                'submit_date' => $submit_date_string,
                'report_submit_date' => $report_date_string,
                'bill_date' => $bill_date_string,
                'invoice_no' =>  $invoice_no_string,
                'invoice_amount' =>  $invoice_amount_string,
                'recovery_status' => $recovery_status_string,
                'security_deposit' => $security_deposit_string,
                'working' => $working_string,
                'udin' => isset($data['udin']) ? $data['udin'] : '',
                'udin_no' => isset($data['udin_no']) ? $data['udin_no'] : '',
                'udin_trun' => isset($data['udin_trun']) ? $data['udin_trun'] : '',
                'completion' => $completion_string,
                'status' => isset($data['status']) ? $data['status'] : ''
            ];
            $user = $model->update1($id, $input);
        } else {
            $input = [
                'name' => isset($data['name']) ? $data['name'] : '',
                'branch' => isset($data['branch']) ? $data['branch'] : '',
                'assignment' => isset($data['assignment']) ? $data['assignment'] : '',
                'type' => isset($data['type']) ? $data['type'] : '',
                'audit' => isset($data['audit']) ? $data['audit'] : '',
                'fee' => $fee_string,
                'submit_date' => $submit_date_string,
                'report_submit_date' => $report_date_string,
                'bill_date' => $bill_date_string,
                'invoice_no' =>  $invoice_no_string,
                'invoice_amount' =>  $invoice_amount_string,
                'recovery_status' => $recovery_status_string,
                'security_deposit' => $security_deposit_string,
                'working' => $working_string,
                'udin' => isset($data['udin']) ? $data['udin'] : '',
                'udin_no' => isset($data['udin_no']) ? $data['udin_no'] : '',
                'udin_trun' => isset($data['udin_trun']) ? $data['udin_trun'] : '',
                'completion' => $completion_string,
                'status' => isset($data['status']) ? $data['status'] : ''
            ];



        //      echo "<pre>";
        // print_r($input);
        // echo "</pre>";
        // die();
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


    public function listAllcat_Form_value($id)
    {

        $data['token'] = session()->get('token');
        $model = new CatModel();

        $model = new CatModel();
        $role = $model->getCatDataid($id); // Ensure the base URL does not have a trailing slash
        $data['cat'] = $role[0];
        //      echo "<pre>"; print_r( $data['cat']);
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


       
     