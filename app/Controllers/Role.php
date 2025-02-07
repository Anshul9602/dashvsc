<?php

namespace App\Controllers;

use App\Models\RoleModel;

use App\Models\ProfileModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use \DateTime;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Session\Session;
use ReflectionException;

class Role extends BaseController
{
    use ResponseTrait;
    protected $session;

    public function index()
    {
        //    echo "test";
        //    die();

        $model = new RoleModel();
        $post = $model->getallJobData();
        return $this->getResponse(
            [
                'message' => 'Job retrieved successfully',
                'post' => $post,
                'status' => 'success'
            ]
        );
    }
    public function job_prf($id)
{
    try {
        // Fetch all job data
        $model = new RoleModel();
        $post = $model->getallJobData();

        // Fetch user job preferences based on user id
       

        
        // Function to match jobs with user preferences
       

       

        return $this->getResponse(
            [
                'message' => 'Job retrieved successfully according to preferences',
             
                'status' => 'success'
            ]
        );
    } catch (Exception $e) {
        return $this->getResponse(
            [
                'message' => 'An error occurred: ' . $e->getMessage(),
                'status' => 'error'
            ],
            500 // HTTP status code for Internal Server Error
        );
    }
}



    public function store()
    {
        $input = $this->getRequestInput($this->request);
        $model = new RoleModel();

        // $required_fields = ['user_id', 'job_title', 'job_description', 'job_type', 'skill_requirements', 'location', 'department', 'experience_requirements'];
        // foreach ($required_fields as $field) {
        //     if (!isset($input[$field]) || empty($input[$field])) {
        //         return "Error: Missing required field '$field'";
        //     }
        // }

        $post = $model->save($input);



        return $this->getResponse(
            [
                'message' => 'Job  added successfully',
                'job' => $post,

                'status' => 'success'

            ]
        );
    }

    public function show($id)
    {
        // user_id pass
        try {
            $model = new RoleModel();
            $post = $model->getJobDataid($id);



            return $this->getResponse(
                [
                    'message' => 'Job retrieved successfully',
                    'Job' => $post,

                    'status' => 'success'
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find Job for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
    public function user_show($id)
    {
        // user_id pass
        try {
            $model = new RoleModel();
            $post = $model->getJobData($id);
            // $model1 = new UserModel();
            // $hotel = $model1->getHUserData($id);
            return $this->getResponse(
                [
                    'message' => 'Job retrieved successfully',
                    'Job' => $post,
                    // 'hotel' => $hotel ,
                    'status' => 'success'
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find Job for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    public function update($id)
    {
        try {
            $model = new RoleModel();
            $input = $this->getRequestInput($this->request);
            $model->update1($id, $input);
            $post = $model->findJobById($id);
            return $this->getResponse(
                [
                    'message' => 'job  updaetd successfully',
                    'job' => $post,
                    'status' => 'success'
                ]
            );
        } catch (Exception $exception) {
            return $this->getResponse(
                [
                    'message' => $exception->getMessage(),
                    'status' => 'error',
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
    public function st_update($id)
    {
        try {
            $model = new RoleModel();
            $input = $this->getRequestInput($this->request);
            $model->update_st($id, $input);
            $post = $model->findJobById($id);
            return $this->getResponse(
                [
                    'message' => 'Job Status updaetd successfully',
                    'job' => $post,
                    'status' => 'success'
                ]
            );
        } catch (Exception $exception) {
            return $this->getResponse(
                [
                    'message' => $exception->getMessage(),
                    'status' => 'error',
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
    public function destroy($id)
    {
        try {
            $model = new RoleModel();
            $model->deletedata($id);
            return $this
                ->getResponse(
                    [
                        'message' => 'Job deleted successfully',
                    ]
                );
        } catch (Exception $exception) {
            return $this->getResponse(
                [
                    'message' => $exception->getMessage()
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
}
