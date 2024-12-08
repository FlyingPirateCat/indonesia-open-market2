<?php

namespace App\Controllers;

class Admin extends BaseController
{
    protected $db, $builder;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('users');
    }
    public function index()
    {
        $userModel = new \Myth\Auth\Models\UserModel();

        $currentPage = $this->request->getVar('page_users');
        $currentPage = $currentPage ?? 1;

        $this->builder->select('users.id as userid, username, email, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query = $this->builder->get();

        $data['title'] = 'User List';
        $data['users'] = $query->getResult();

        $data['currentPage'] = $currentPage;

        return view('admin/index', $data);
    }

    public function detail($id = 0)
    {

        $this->builder->select(
            'users.id as userid, username, email, fullname, user_image, name,
            gender, birthdate, ktp, phone, shopname, street_address, postalcode'
        );
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $id);
        $query = $this->builder->get();


        $data['title'] = 'User Detail';
        $data['user'] = $query->getRow();

        if (empty($data['user'])) {
            return redirect()->to('/admin');
        }

        return view('admin/detail', $data);
    }
}
