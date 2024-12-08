<?php

namespace App\Controllers;

use App\Models\ProductModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Product extends BaseController
{
    protected $productModel, $db, $builder, $cart, $auth;
    public function __construct()
    {
        // productmodel
        $this->productModel = new ProductModel();
        // database user
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('users');
        // cart
        $this->cart = \Config\Services::cart();
        // auth
        $this->auth = service('authorization');
    }

    public function index()
    {
        $data['title'] = "Market Section";
        return view('product/index', $data);
    }

    public function product_type($type = 0, $contentSize = 12)
    {
        $data = [];
        $data['title'] = "Daftar Produk";
        $product = $this->productModel;

        if ($type >= 0):
            $product = $product->getAllProductbyVar('type', $type);
        endif;

        $currentPage = $this->request->getVar('page_' . $product->table);
        $currentPage = $currentPage ?? 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword):
            $product = $product->search($keyword);
        endif;

        $data['ptable']      = $product->table;
        $data['product']     = $product->paginate($contentSize, $product->table);
        $data['pager']       = $product->pager;
        $data['contentSize'] = $contentSize;
        $data['currentPage'] = $currentPage;
        $data['type']        = $type;
        $data['auth']        = $this->auth;



        if ($type == -1):
            $data['title'] = "Daftar Semua Produk";
        // return view('product/all', $data);
        elseif ($type == 0):
            $data['title'] = "Daftar Produk Kerajinan Rumah Tangga";
        elseif ($type == 1):
            $data['title'] = "Daftar Produk Hasil Bumi";
        elseif ($type == 2):
            $data['title'] = "Daftar Produk Hasil Laut";
        elseif ($type == 3):
            $data['title'] = "Daftar Produk Hasil Pertambangan";
        elseif ($type == 4):
            $data['title'] = "Daftar Produk Kuliner";
        elseif ($type == 5):
            $data['title'] = "Daftar Produk Wisata dan Umroh";
        endif;
        return view('product/product-type', $data);
    }

    public function all()
    {
        return $this->product_type(-1);
    }

    public function product_home()
    {
        return $this->product_type(0);
    }

    public function product_agri()
    {
        return $this->product_type(1);
    }

    public function product_sea()
    {
        return $this->product_type(2);
    }

    public function product_mining()
    {
        return $this->product_type(3);
    }

    public function product_culinary()
    {
        return $this->product_type(4);
    }

    public function product_tour()
    {
        return $this->product_type(5);
    }


    public function detail($slug)
    {
        $data['title']   = "Detail Produk";
        $data['product'] = $this->productModel->getProduct($slug);
        $data['auth']    = $this->auth;

        // if url product doesn't exist
        if (empty($data['product'])) {
            throw PageNotFoundException::forPageNotFound();
        }

        // // user data
        $data['user'] = $this->getUser($data['product']['id_user']);
        return view('product/detail', $data);
    }

    public function create()
    {
        // session();
        $data['title']      = "Form Tambah Data Produk";
        $data['validation'] = \Config\Services::validation();
        $data['auth']       = $this->auth;
        return view('product/edit', $data);
    }


    public function edit($slug)
    {
        $data['title']      = "Form Ubah Data Produk";
        $data['validation'] = \Config\Services::validation();
        $data['auth']       = $this->auth;
        $data['product']    = $this->productModel->getProduct($slug);
        return view('product/edit', $data);
    }

    public function update($id)
    {

        // variable barang
        $item = $this->productModel->find($id);
        $validation = \Config\Services::validation();

        // cek validasi
        if (!$this->validate([
            'name' => 'required',
            'cover' => [
                'rules' => 'max_size[cover,1024]|is_image[cover]|mime_in[cover,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Maximum image size 1MB',
                    'is_image' => 'The file you selected is not an image',
                    'mime_in' => 'The file you selected is not an image'
                ],
            ],
            'type' => 'required',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'weight' => 'required|integer',
            'description' => 'required|max_length[255]',
        ])) :
            session()->setFlashdata('Failure', $validation->listErrors());
            $destination = '/product/' . (empty($item) ? 'create' : 'edit/' . $item['slug']);
            return redirect()->to($destination)->withInput();
        endif;

        // ambil gambar
        $fileCover = $this->request->getFile('cover');
        $cover = empty($item) ? 'not-found.jpg' : $item['cover'];
        $cover = $this->updateCover($id, $fileCover,  $cover);


        // cek bila user belum melengkapi data profil
        $userdata = [];
        $temp = [];
        $temp['ktp']            = $this->request->getVar('ktp');
        $temp['phone']          = $this->request->getVar('phone');
        $temp['shopname']       = $this->request->getVar('shopname');
        $temp['street_address'] = $this->request->getVar('street_address');
        $temp['postalcode']     = $this->request->getVar('postalcode');

        if (!empty($temp['ktp']) && !$this->validate([
            'ktp' => 'numeric|min_length[16]|max_length[16]',
        ])) :
            session()->setFlashdata('Failure', $validation->listErrors());
            $destination = '/product/' . (empty($item) ? 'create' : 'edit/' . $item['slug']);
            return redirect()->to($destination)->withInput();
        endif;

        foreach ($temp as $key => $value) {
            ($temp[$key]) ? ($userdata[$key] = $value) : null;
        }

        $this->addUserMissingData($userdata);



        $name = $this->request->getVar('name');
        $slug = (!empty($item) && $name == $item['name']);
        $slug = $slug ? $item['slug'] : (dechex(gmdate('yzGis')) . '-' . url_title($name, '-', true));

        // update data
        $temp = [];

        if (empty($id)) {
            $temp['id_user']     = user_id();
            $temp['postalcode']  = user()->postalcode;
        } else {
            $user                = $this->getUser($item['id_user']);
            $temp['id']          = $id;
            $temp['postalcode']  = isset($user) ? $user['postalcode'] : '';
        }

        $temp['name']        = $name;
        $temp['slug']        = $slug;
        $temp['cover']       = $cover;
        $temp['type']        = $this->request->getVar('type');
        $temp['price']       = $this->request->getVar('price');
        $temp['stock']       = $this->request->getVar('stock');
        $temp['weight']      = $this->request->getVar('weight');
        $temp['description'] = $this->request->getVar('description');

        $this->productModel->save($temp);

        if (empty($id)) :
            $text = 'Data barang berhasil ditambahkan.';
        else :
            $text = 'Data barang berhasil dirubah.';
        endif;

        session()->setFlashdata('Success', $text);
        return redirect()->to("/product/" . $slug);
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

    public function addUserMissingData($userdata)
    {
        foreach ($userdata as $key => $value) :
            if (empty(user()->$key)) {
                $query = $this->builder->select('*');
                $query->set($key, $value);
                $query->where('id', user_id());
                $query->update();
            }
        endforeach;
    }

    public function delete($id)
    {
        $this->deletePicturefromID($id);
        $this->productModel->delete($id);
        session()->setFlashdata('Success', 'Data barang berhasil dihapus.');
        return redirect()->to('/product/all');
    }

    public function updateCover($id, $fileCover, $oldcover)
    {
        if ($fileCover->getError() == 4) {
            return $cover = $oldcover;
        }
        $cover = md5_file($fileCover) . '.' .  $fileCover->getExtension();
        empty($id) ? null : $this->deletePicturefromID($id);
        if (file_exists("img/product/$cover")) {
            unlink($fileCover);
        } else {
            $fileCover->move('img/product', $cover);
        }
        return $cover;
    }

    public function deletePicturefromID($id)
    {
        $image = $this->productModel->select(['cover'])->find($id);
        $count = $this->productModel->getAllProductbyVar('cover', $image)->countAllResults();
        if (($count == 1) && !(empty($image)) && !(empty($image['cover']))) {
            $file = ("img/product/" . $image['cover']);
            ($file != 'not-found.jpg' && file_exists($file)) ? unlink($file) : null;
        }
    }
    function compressImage($source, $destination, $quality)
    {
        $info = getimagesize($source);
        if ($info['mime'] == 'image/jpeg') :
            $image = imagecreatefromjpeg($source);
            imagejpeg($image, $destination, $quality);
            return $destination;
        endif;
    }

    public function checkItemPostalCode($id)
    {
        $item = $this->productModel->find($id);
        $seller = $this->getUser($item['id_user']);

        if ($seller['postalcode'] != $item['postalcode']) :
            $temp = [];
            $temp['id']          = $id;
            $temp['postalcode']  = $seller['postalcode'];
            $this->productModel->save($temp);
        endif;
    }


    // crud shopping cart

    public function cek_cart()
    {
        $response = $this->cart->contents();
        echo '<pre>';
        print_r($response);
        echo '</pre>';
    }

    public function add_to_cart($id)
    {
        $item = $this->productModel->find($id);

        $seller = $this->getUser($item['id_user']);
        if (empty($seller)):
            session()->setFlashdata('Failure', "Data penjual barang ini sudah tidak ada.");
            return redirect()->to(previous_url());
        endif;

        foreach ($this->cart->contents() as $i):
            if (($i['id'] == $item['id']) and $i['qty'] >= $item['stock']) :
                session()->setFlashdata('Failure', 'Stok barang tidak cukup.');
                return redirect()->to(previous_url());
            endif;
        endforeach;

        $this->cart->insert(array(
            'id'      => $item['id'],
            'qty'     => 1,
            'price'   => $item['price'],
            'name'    => $item['name'],
            'options' => array(
                'cover' => $item['cover'],
                'slug' => $item['slug'],
                'weight' => $item['weight'],
                'stock' => $item['stock'],
                'postalcode' => $item['postalcode'],
                'seller_id' => $item['id_user'],
            )
        ));
        session()->setFlashdata('Success', 'Barang berhasil ditambahkan ke keranjang belanja anda.');
        return redirect()->to(previous_url());
    }

    public function clear_cart()
    {

        $this->cart->destroy();
        session()->setFlashdata('Success', 'Keranjang belanja anda dibersihkan');
        return redirect()->to(previous_url());
    }

    public function update_cart()
    {
        $failMsg = [];
        foreach ($this->cart->contents() as $key => $value):
            $item = $this->productModel->find($value['id']);
            $qty = $this->request->getPost("qty" . $value['id']);
            if ($item['stock'] > 0) :
                if ($qty > $item['stock']):
                    $qty = $item['stock'];
                    array_push($failMsg, 'Stok untuk barang "' . $item['name'] . '" tidak cukup.');
                endif;
                $this->cart->update(array(
                    'rowid'   => $value['rowid'],
                    'qty'     => $qty,
                    'stock'   => $item['stock'],
                ));
            else:
                $this->cart->remove($value['rowid']);
                array_push($failMsg, 'Stok dari barang "' . $item['name'] . '" sudah habis, barang di hapus dari cart.');
            endif;
        endforeach;
        if (!empty($failMsg)):
            session()->setFlashdata('Failure', implode("<br>", $failMsg));
        endif;
        session()->setFlashdata('Success', 'Data shopping cart successfully updated.');
        return redirect()->to(previous_url());
    }

    public function delete_from_cart($rowid)
    {
        $this->cart->remove($rowid);
        session()->setFlashdata('Success', 'Data shopping cart successfully updated.');
        return redirect()->to(previous_url());
    }
}
