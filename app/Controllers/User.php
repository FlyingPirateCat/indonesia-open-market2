<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\KodeposModel;
use App\Models\TarifposKargoModel;
use App\Models\TarifposRegulerModel;
use App\Models\UserModel;

class User extends BaseController
{


    protected $userModel, $productModel, $kodeposModel;
    protected $tarifposKargoModel, $tarifposRegulerModel;
    protected $db, $builder, $auth;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table($this->userModel->table);

        $this->productModel = new ProductModel();
        $this->kodeposModel = new KodeposModel();
        $this->tarifposKargoModel = new TarifposKargoModel();
        $this->tarifposRegulerModel = new TarifposRegulerModel();
        // auth
        $this->auth = service('authorization');
    }
    public function index()
    {

        // session();
        $data = [
            'title' => "My Profile",
            'validation' => \Config\Services::validation(),
        ];
        return view('user/index', $data);
    }


    public function detail_profile($id)
    {
        $this->builder->select(
            'users.id as userid, username, email, fullname, user_image, name,
        gender, birthdate, ktp, phone, shopname, street_address, postalcode'
        );
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $id);
        $query = $this->builder->get();


        $data['user'] = $query->getRow();

        if (empty($data['user'])) {
            return redirect()->to('/');
        }

        $data['title'] = 'User Detail';
        $data['items'] = $this->productModel->getAllProductbyVar('id_user', $id);
        $data['auth']  = $this->auth;

        return view('user/detail', $data);
    }

    public function update_profile()
    {

        //fullname, gender, birthdate,shopname, street_address,postalcode;
        if (!$this->validate([
            'user_image' => [
                'rules' => 'max_size[user_image,1024]|is_image[user_image]|mime_in[user_image,image/jpg,image/jpeg,image/png,image/svg]',
                'errors' => [
                    'max_size' => 'Besar maksimum gambar adalah 1MB',
                    'is_image' => 'File yang dipilih bukanlah gambar',
                    'mime_in' => 'Ekstensi file tidak disupport'
                ],
            ],
        ])) {
            $validation = \Config\Services::validation();
            session()->setFlashdata('Failure', $validation->listErrors());
            return redirect()->to('/user')->withInput()->with('validation', $validation);
        }

        // ambil gambar
        $fileCover = $this->request->getFile('user_image');
        $coverlama = $this->request->getVar('user_oldimage');
        $userid    = $this->request->getVar('userid');
        $user      = $this->getUser($userid);

        if ($fileCover->getError() == 4) {
            $user_image = $user['user_image'];
        } else {
            $user_image = md5_file($fileCover) . '.' . $fileCover->getExtension();
            if (file_exists("img/user/$user_image")) {
                unlink($fileCover);
            } else {
                $fileCover->move('img/user', $user_image);
            }
            $count = $this->countOldPicture($coverlama);
            if ($count == 1 and $coverlama != 'profile_default.svg') {
                $file = "img/user/$coverlama";
                if (file_exists($file)) {
                    unlink($file);
                }
            }
        };

        $query = $this->builder->select('*');
        $updCount = 0;
        $updates = ['fullname', 'gender', 'birthdate', 'ktp', 'phone', 'shopname', 'street_address', 'postalcode'];
        foreach ($updates as $u) {
            $upd = $this->request->getVar($u);
            if ($upd && $user[$u] != $upd):
                $query->set($u, $upd);
                $updCount++;
            endif;
        }

        $query->set('user_image', $user_image);
        $query->where('id', $user['id']);
        $query->update();


        $newrole = $this->request->getVar('role');
        $oldrole = $this->request->getVar('user_role');

        if (!empty($newrole) && !empty($oldrole) && ($newrole != $oldrole)):
            $updCount++;
            $this->auth->addUserToGroup($user['id'], $newrole);
            $this->auth->removeUserFromGroup($user['id'], $oldrole);
        endif;


        if ($updCount > 0):
            session()->setFlashdata('Success', 'Data berhasil dirubah!');
        else:
            session()->setFlashdata('Failure', 'Tidak ada yang dirubah!');
        endif;
        return redirect()->to('/user/' . $user['id']);
    }

    public function update_crt_profile()
    {
        $user      = $this->getUser(user_id());

        $query = $this->builder->select('*');
        $updCount = 0;
        $updates = ['fullname', 'phone',  'street_address', 'postalcode'];
        foreach ($updates as $u) {
            $upd = $this->request->getVar($u);
            if ($upd && $user[$u] != $upd):
                $query->set($u, $upd);
                $updCount++;
            endif;
        }

        $query->where('id', $user['id']);
        $query->update();
        session()->setFlashdata('Success', 'Data berhasil dirubah!');
        return redirect()->to('/user/cart');
    }

    public function getUser($id)
    {
        $this->builder->select('*');
        $this->builder->where(['id' => $id]);
        $query = $this->builder->get();
        $user = $query->getResultArray();
        $user = $user[0] ?? null;
        return $user;
    }

    public function countOldPicture($old_pic)
    {
        $this->builder->select('user_image');
        $this->builder->where('user_image', $old_pic);
        $query = $this->builder->get()->getResult();
        return count($query);
    }

    public function cart()
    {
        $data['title'] = 'View Cart';
        $data['cart'] = \Config\Services::cart();
        $data['users'] = $this->userModel;
        $data['kodepos'] = $this->kodeposModel;
        $data['poskargo'] = $this->tarifposKargoModel;
        $data['posreguler'] = $this->tarifposRegulerModel;
        return view('user/cart', $data);
    }
}
