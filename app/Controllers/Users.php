<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Users as UserModel;

class Users extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $res = $this->userModel->findAll();
        return $this->respondCreated($res);
    }

    /**
     * Return the properties of a resource object.
     * @return ResponseInterface
     */
    public function login()
    {
        $userName = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $check = $this->userModel->where(['email' => $userName, 'password' => $password])->first();
        $checkDisplayData = [
            'id' => $check["id"],
            "name" => $check["name"],
            "email" => $check["email"],
            'phone' => $check["phone"],
        ];
        if ($check != null) {
            return $this->respondCreated(['data' => $checkDisplayData, "status" => 1,]);
        } else {
            return $this->respondCreated(["status" => 401]);

        }
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        //
    }

    public function createAdmin()
    {
        $data = [
            "name" => "Admin",
            "email" => "Admin@admin.com",
            "phone" => "",
            "password" => "admin123",
        ];
        $res = $this->userModel->insert($data);
        if ($res) {
            $this->respondCreated("Success");
        } else {
            $this->respondCreated(["error" => $this->userModel->errors()]);
        }
    }


    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        //
    }
}
