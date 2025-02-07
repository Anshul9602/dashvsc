<?php

namespace App\Controllers;

use App\Models\UserModel;


use App\Models\BasicModel;

use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use CodeIgniter\API\ResponseTrait;
use ReflectionException;
use CodeIgniter\Session\Session;

class Auth extends BaseController
{
    /**
     * Register a new user
     * @return Response
     * @throws ReflectionException
     */

    protected $session;
    public function __construct()
    {
        $this->session = \Config\Services::session();
    }
    
   
    public function basic()
    {
        $model = new BasicModel();
        $basic = $model->findAll();
        return $basic;
    }
    /**
     * Authenticate Existing User
     * @return Response
     */
    public function login($data)
    {
        $rules = [

            'moblie_number' =>
            'required|min_length[10]|max_length[10]|validateUser[user_number, pin]'
        ];

        $errors = [
            'mobile_number' => [
                'validateUser' => 'Invalid login credentials provided'
            ]
        ];

        $input = $this->getRequestInput($this->request);
        // echo json_encode($input);
        if ($this->validateRequest($input, $rules, $errors)) {

            return $this->getJWTForUser($input['mobile_number']);
        } else {
            // return $this->getResponse($input);
            $response =
                $this->response->setStatusCode(400)->setBody('Invalid login Mobile Number');
            return $response;
        }
    }

   
   
   
    private function getJWTForUser(
        string $mobile_Number,
        int $responseCode = ResponseInterface::HTTP_OK
    ) {

        try {
            $model = new UserModel();

            $user = $model->findUserByUserNumber($mobile_Number);
            $userd = $model->getUserData($user['id']);
            if ($userd == null) {
                $userd = $model->getUserHData($user['id']);
            }

            if ($userd == null) {
                $userd = $model->getUserAData($user['id']);
            }


           

            // if($userd['role'] == 'Hoteliers'){
            //     $jobdata= $model11->findAll();
            // }else{
            //     $jobdata= $model11->findAll();
            // }
            // echo "<pre>";
            // print_r($jobdata);
            // echo "</pre>";
            // die();

            // echo "test";


            // unset('1234');
            helper('jwt');

            return $this
                ->getResponse(
                    [
                        'message' => 'User authenticated successfully',
                        'user' => $userd,
                        'status' => "success",

                        'access_token' => getSignedJWTForUser($mobile_Number)
                    ]
                );
        } catch (Exception $exception) {
            return $this
                ->getResponse(
                    [
                        'error' => $exception->getMessage(),
                    ],
                    $responseCode
                );
        }
    }
    private function getJWTForNewUser(
        string $mobile_number,
        int $responseCode = ResponseInterface::HTTP_OK
    ) {

        try {
            $model = new UserModel();
            $user = $model->findUserByUserNumber($mobile_number);
            // echo json_encode($user);

            helper('jwt');

            return $this
                ->getResponse(
                    [
                        'message' => 'User Created successfully',

                        'access_token' => getSignedJWTForUser($mobile_number)
                    ]
                );
        } catch (Exception $exception) {
            return $this
                ->getResponse(
                    [
                        'error' => $exception->getMessage(),
                    ],
                    $responseCode
                );
        }
    }
}
