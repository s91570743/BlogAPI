<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Blog as BlogModel;

class Blog extends ResourceController
{

    private $blogModel;

    public function __construct()
    {
        $this->blogModel = new BlogModel();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        return $this->respond($this->blogModel->findAll());
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        return $this->respond(['data'=>$this->blogModel->find($id) , 'status'=>1]);
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
        $file = $this->request->getFile("image");
        $fileName = null;
        if ($file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move('./uploads/blog',$fileName);
        }
        $data = [
            "id" => $this->request->getVar('id'),
            "user_id" => $this->request->getVar("user_id"),
            "description" => $this->request->getVar("description"),
            "title" => $this->request->getVar("title"),
            'img' => $fileName ? "uploads/blog/". $fileName : null,
        ];

        $res = $this->blogModel->save($data);

        if ($res > 0) {
            return $this->respondCreated(['status' => 1], "Blog created successfully");
        } else {
            return $this->respondCreated(['status' => 0], "Blog not created");
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
        if ($this->request->getVar("img")) {
            $data = [
                "id" => $this->request->getVar('id'),
                "user_id" => $this->request->getVar("user_id"),
                "description" => $this->request->getVar("description"),
                "title" => $this->request->getVar("title"),
                'img' => $this->request->getVar("img") ,
            ];
        }else{
            $file = $this->request->getFile("image");

            $fileName = null;
            if ($file->isValid() && !$file->hasMoved()) {
                $fileName = $file->getRandomName();
                $file->move('./uploads/blog',$fileName);
            }
            $data = [
                "description" => $this->request->getVar("description"),
                "title" => $this->request->getVar("title"),
                'img' => $fileName ? "uploads/blog/". $fileName : null,
            ];

        }

        $res = $this->blogModel->update($id, $data);

        if ($res > 0) {
            return $this->respondCreated(['status' => 1], "Blog created successfully");
        } else {
            return $this->respondCreated(['status' => 0], "Blog not created");
        }
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
        $remove = $this->blogModel->delete($id);
        if ($remove) {
            return $this->respondCreated(['status' => 1], "Blog removed successfully");
        } else {
            return $this->respondCreated(['status' => 0], "Blog was not removed");
        }
    }
}
