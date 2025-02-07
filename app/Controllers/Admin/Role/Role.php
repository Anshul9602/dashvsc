<?php

namespace App\Controllers\Admin\Role;
use App\Models\JobViewModel;
use App\Models\RoleModel;
use App\Models\JobApplyModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Role extends BaseController
{
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

    public function listAllRoles($segment = null)
    {
        if (!$this->validateToken($segment)) {
            return redirect()->to('/admin/login');
        }

        $role = session()->get('role');

        // Pass the role to the view
        $data = [
            'role' => $role,
            'token' => $segment
        ];
        $model = new RoleModel();
        $data['roles'] = $model->getallRoleData();


        // echo "<pre>"; print_r( $data['Role']);
        // echo "</pre>";
        // die();

        return view('admin/userroll/role_list', $data);
    }
    public function listAllRole_Form($segment)
    {
        if (!$this->validateToken($segment)) {
            return redirect()->to('/admin/login');
        }

        $data = [
            'token' => $segment,
             'role' => session()->get('role'),'admin_name' => session()->get('admin_name'),
            'users' => [] // Initialize 'users' to an empty array
        ];

        $model = new RoleModel();
        
        $profile = new RoleModel();
        $baseUrl = rtrim(base_url(), '/'); // Ensure the base URL does not have a trailing slash

      

        return view('admin/userroll/role_form', $data);
    }
    public function listAllRole_Form_value($id)
    {
      
         $data['token'] = session()->get('token');
        $model = new RoleModel();
        
        $model = new RoleModel();
        $role = $model->getRoleDataid($id); // Ensure the base URL does not have a trailing slash
        $data['role'] = $role[0];
        //      echo "<pre>"; print_r( $data['role']);
        // echo "</pre>";
        // die();

        return view('admin/userroll/role_form1', $data);
    }
   
    public function listRole_delete($id)
    {

        // echo "yes";
        $model = new RoleModel();

        $post = $model->deletedata($id);

        return redirect()->to(base_url('admin/roles/' . session()->get('token')));
    }
    
    public function listRole_status($id)
    {

        // echo "yes";
        $model = new RoleModel();

        $post = $model->update_status_d($id);

        return redirect()->to(base_url('admin/roles/' . session()->get('token')));
    }

    public function listRole_save($segment)
    {

        $data = $this->request->getPost();

// echo "<pre>";
// print_r($data);
// echo "</pre>";


        $model = new RoleModel();
      


         if($data['id']){
           
            $id = $data['id'];
            $input = [
                'id' => isset($data['id']) ? $data['id'] : '',
                'name' => isset($data['name']) ? $data['name'] : '',
                'permission' => isset($data['permission']) ? implode(',', $data['permission']) : '',
                'status' => isset($data['status']) ? $data['status'] : ''
            ];
            $user = $model->update1($id,$input);
         }else{
          
            $input = [
                'name' => isset($data['name']) ? $data['name'] : '',
                'permission' => isset($data['permission']) ? implode(',', $data['permission']) : '',
                'status' => isset($data['status']) ? $data['status'] : ''
            ];
            $user = $model->save($input);
         }
       
       

        // echo "<pre>"; print_r($input); echo "</pre>";
        // die();

       

      

        if ($user === false) {

           
                return "Error: profile image not inserted successfully";
          
        } else {
            if (!$this->validateToken($segment)) {
                return redirect()->to('/admin/login');
            }
    
            $role = session()->get('role');
    
            // Pass the role to the view
            $data = [
                'role' => $role,
                'token' => $segment
            ];
            return redirect()->to(base_url('admin/roles/' . $segment));
            
        }

       
    }
  

}
