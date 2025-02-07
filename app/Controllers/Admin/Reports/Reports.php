<?php

namespace App\Controllers\Admin\Reports;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Reports extends BaseController
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

    // Display all candidates
    public function listAllReports($segment)
    {
        if (!$this->validateToken($segment)) {
            return redirect()->to('/admin/login');
        }
        $data = [
            'token' => $segment,
            'role' => session()->get('role')
        ];
       
        return view('admin/reports/reports', $data);
    }

}
