<?php

namespace App\Controllers\Admin;
use App\Models\RoleModel;
use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\TaskModel;

class Auth extends BaseController
{
    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    public function login()
    {
        return view('admin/auth/login');
    }

    public function attemptLogin()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('pass');
        
        $admin = $this->adminModel->where('email', $email)->first();
        // echo "<pre>"; print_r($admin); echo "</pre>";
        // die();
        if($admin !== null){
            if ($admin['status'] == "Enable") {
                if(password_verify($password, $admin['pass'])) {
                    $token = bin2hex(random_bytes(16)); // Generate a random token
                    
                    $model = new RoleModel();
                    $roles = $model->getRoleDatabyrole($admin['role']);
    
                    session()->set([
                        'admin_id' => $admin['id'],
                        'admin_email' => $admin['email'],
                        'admin_name' => $admin['name'],
                        'admin_permission' =>  $roles->permission,
                        'role' => $admin['role'],
                        'token' => $token,
                        'logged_in' => true,
                    ]);
    
                    return redirect()->to("/admin/dashboard/$token");
                }else{
                    return redirect()->back()->with('error', 'Invalid login password');
                }
              
            } else {
                return redirect()->back()->with('error', 'Username not found');
            }
        }else {
            return redirect()->back()->with('error', 'Username not found');
        }
       
    }

    public function logout()
    {
        $token = null;
        if ($token === session()->get('token')) {
            session()->destroy();
        }
        return redirect()->to('/admin/login');
    }
    public function password_verify1($pass, $admin_pass)
    {
        $token = null;
        if ($token === session()->get('token')) {
            session()->destroy();
        }
        return redirect()->to('/admin/login');
    }
}