<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\KodeposModel;
use App\Models\OrderModel;
use App\Models\UserModel;

class Order extends BaseController
{
    protected $productModel, $kodeposModel;
    protected $userModel, $orderModel;
    protected $db, $builder, $cart, $auth;
    public function __construct()
    {
        // productmodel
        $this->productModel = new ProductModel();
        $this->kodeposModel = new KodeposModel();
        $this->userModel = new UserModel();
        $this->orderModel = new OrderModel();

        // database user
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('users');
        // cart
        $this->cart = \Config\Services::cart();
        // auth
        $this->auth = service('authorization');
    }


    public function add_order()
    {

        $products = (array)json_decode((str_replace("'", '"', $this->request->getVar('products'))));
        $subtotal = (array)json_decode((str_replace("'", '"', $this->request->getVar('subtotal'))));
        $pajak = (array)json_decode((str_replace("'", '"', $this->request->getVar('pajak'))));
        $totalweight = (array)json_decode((str_replace("'", '"', $this->request->getVar('totalweight'))));
        $shipping = (array)json_decode((str_replace("'", '"', $this->request->getVar('shipping'))));
        $additionalcost = (array)json_decode((str_replace("'", '"', $this->request->getVar('additionalcost'))));
        $total = (array)json_decode((str_replace("'", '"', $this->request->getVar('total'))));
        $fullname = $this->request->getVar('fullname');
        $address = $this->request->getVar('address');
        $postalcode = $this->request->getVar('postalcode');
        $phone = $this->request->getVar('phone');

        $newdata = [];
        $buyerID = user_id();
        $ordercode = gmdate('yzGis') . $buyerID;
        foreach ($products as $sellerID => $items) {
            $newdata[$sellerID] ??= [];
            $newdata[$sellerID]['ordercode'] = $ordercode;
            $newdata[$sellerID]['items'] = (array)$items;
            $newdata[$sellerID]['subtotal'] = $subtotal[$sellerID];
            $newdata[$sellerID]['pajak'] = $pajak[$sellerID];
            $newdata[$sellerID]['totalweight'] = $totalweight[$sellerID];
            $newdata[$sellerID]['shipping'] = $shipping[$sellerID];
            $newdata[$sellerID]['additionalcost'] = $additionalcost[$sellerID];
            $newdata[$sellerID]['total'] = $total[$sellerID];
            $newdata[$sellerID]['receiverName'] = $fullname;
            $newdata[$sellerID]['receiverAddress'] = $address;
            $newdata[$sellerID]['receiverPoscode'] = $postalcode;
            $newdata[$sellerID]['receiverPhone'] = $phone;

            $jsonname = $ordercode . '-' . $sellerID;
            $this->savetoJson($newdata[$sellerID], $jsonname);

            $data = [];
            $data['ordercode'] = $ordercode;
            $data['id_buyer'] = $buyerID;
            $data['id_seller'] = $sellerID;
            $data['data_product'] = $jsonname;
            $data['status'] = 'Belum Dibayar';

            $this->orderModel->save($data);
        };
        // clear cart
        $this->cart->destroy();
        return redirect()->to("/order/invoice/" . $ordercode);
    }

    public function savetoJson($var, $filename)
    {
        $path = ($_SERVER['DOCUMENT_ROOT'] . '/data/' . $filename . '.json');
        $fp = fopen($path, 'w');
        fwrite($fp, json_encode($var));
        fclose($fp);
    }

    public function readJson($filename)
    {
        $path = ($_SERVER['DOCUMENT_ROOT'] . '/data/' . $filename . '.json');
        $json = file_get_contents($path);
        $obj  = (array)json_decode($json);
        return $obj;
    }


    public function view_transaction($type = 0)
    {

        $data['title'] = 'Lihat Transaksi';


        $dataOrder = $this->orderModel;
        if ($type == 0) {
            $dataOrder = $dataOrder->where(['status' => "Belum Dibayar"]);
        } elseif ($type == 1) {
            $dataOrder = $dataOrder->where(['status' => "Verifikasi"]);
        } elseif ($type == 2) {
            $dataOrder = $dataOrder->where(['status' => "Sudah Dibayar"]);
        } elseif ($type == 3) {
            $dataOrder = $dataOrder->where(['status' => "Pengemasan"]);
        } elseif ($type == 4) {
            $dataOrder = $dataOrder->where(['status' => "Pengiriman"]);
        } elseif ($type == 5) {
            $dataOrder = $dataOrder->where(['status' => "Barang Sampai"]);
        } elseif ($type == 6) {
            $dataOrder = $dataOrder->where(['status' => "Selesai"]);
        } elseif ($type == 7) {
            $dataOrder = $dataOrder->where(['status' => "Dibatalkan"]);
        }
        $dataOrder = $dataOrder->findAll();

        $orders = [];
        foreach ($dataOrder as $data2) {
            array_push($orders, $this->readJson($data2['data_product']));
        }

        $data['type'] = $type;
        $data['users'] = $this->userModel;
        $data['ordermodel'] = $dataOrder;
        $data['orders'] = $orders;

        return view('admin/transaction', $data);
    }





    public function view_order($type = 0)
    {

        $data['title'] = 'Lihat Pesanan';


        $dataOrder = $this->orderModel->getDatabyVar('id_buyer', user_id());
        if ($type == 0) {
            $dataOrder = $dataOrder->where(['status' => "Belum Dibayar"]);
        } elseif ($type == 1) {
            $dataOrder = $dataOrder->where(['status' => "Verifikasi"]);
        } elseif ($type == 2) {
            $dataOrder = $dataOrder->where(['status' => "Sudah Dibayar"]);
        } elseif ($type == 3) {
            $dataOrder = $dataOrder->where(['status' => "Pengemasan"]);
        } elseif ($type == 4) {
            $dataOrder = $dataOrder->where(['status' => "Pengiriman"]);
        } elseif ($type == 5) {
            $dataOrder = $dataOrder->where(['status' => "Barang Sampai"]);
        } elseif ($type == 6) {
            $dataOrder = $dataOrder->where(['status' => "Selesai"]);
        } elseif ($type == 7) {
            $dataOrder = $dataOrder->where(['status' => "Dibatalkan"]);
        }
        $dataOrder = $dataOrder->findAll();

        $orders = [];
        foreach ($dataOrder as $data2) {
            array_push($orders, $this->readJson($data2['data_product']));
        }

        $data['type'] = $type;
        $data['users'] = $this->userModel;
        $data['ordermodel'] = $dataOrder;
        $data['orders'] = $orders;

        return view('user/order', $data);
    }

    public function view_sales($type = 0)
    {

        $data['title'] = 'Lihat Sales';


        $dataOrder = $this->orderModel->getDatabyVar('id_seller', user_id());
        if ($type == 0) {
            $dataOrder = $dataOrder->where(['status' => "Belum Dibayar"]);
        } elseif ($type == 1) {
            $dataOrder = $dataOrder->where(['status' => "Verifikasi"]);
        } elseif ($type == 2) {
            $dataOrder = $dataOrder->where(['status' => "Sudah Dibayar"]);
        } elseif ($type == 3) {
            $dataOrder = $dataOrder->where(['status' => "Pengemasan"]);
        } elseif ($type == 4) {
            $dataOrder = $dataOrder->where(['status' => "Pengiriman"]);
        } elseif ($type == 5) {
            $dataOrder = $dataOrder->where(['status' => "Barang Sampai"]);
        } elseif ($type == 6) {
            $dataOrder = $dataOrder->where(['status' => "Selesai"]);
        } elseif ($type == 7) {
            $dataOrder = $dataOrder->where(['status' => "Dibatalkan"]);
        }
        $dataOrder = $dataOrder->findAll();

        $orders = [];
        foreach ($dataOrder as $data2) {
            array_push($orders, $this->readJson($data2['data_product']));
        }


        $data['type'] = $type;
        $data['users'] = $this->userModel;
        $data['ordermodel'] = $dataOrder;
        $data['orders'] = $orders;

        return view('user/sales', $data);
    }


    public function invoice($ordercode)
    {

        $data['title'] = 'Invoice';

        $dataOrder = $this->orderModel->getDatabyVar('ordercode', $ordercode)->findAll();
        $orders = [];
        foreach ($dataOrder as $data2) {
            array_push($orders, $this->readJson($data2['data_product']));
        }
        $data['users'] = $this->userModel;
        $data['ordermodel'] = $dataOrder;
        $data['orders'] = $orders;

        return view('user/invoice', $data);
    }

    public function add_payment_proof()
    {
        $ordercode = $this->request->getVar('ordercode');

        // ambil gambar
        $paymentproof = $this->request->getFile('payment_proof');
        $oldproof = $this->request->getVar('oldproof');

        if ($paymentproof->getError() == 4) {
            session()->setFlashdata('Failure', 'Bukti pembayaran tidak berhasil diupload.');
            return redirect()->to(previous_url());
        } else {
            $imgname = $ordercode . '.' . $paymentproof->getExtension();
            $path = "img/payment/";
            if (file_exists($path . $imgname)) {
                unlink($path . $imgname);
                $paymentproof->move('img/payment', $imgname);
            } else {
                $paymentproof->move('img/payment', $imgname);
            }
        };

        $dataOrder = $this->orderModel->getDatabyVar('ordercode', $ordercode)->findAll();
        foreach ($dataOrder as $data2) {
            $temp = [];
            $temp['id']            = $data2['id'];
            $temp['payment_proof'] = $imgname;
            $temp['status']        = "Verifikasi";
            $this->orderModel->save($temp);
        }

        $countoldproof = count($this->orderModel->getDatabyVar('payment_proof', $oldproof)->findAll());
        if ($countoldproof == 0) {
            $file = "img/payment/" . $oldproof;
            if (file_exists($file)):
                unlink($file);
            endif;
        }

        session()->setFlashdata('Success', 'Bukti pembayaran berhasil diupload. Mohon tunggu proses verifikasi.');
        return redirect()->to(previous_url());
    }

    public function update_payment_status()
    {
        $ordercode = $this->request->getVar('ordercode');
        $status = $this->request->getVar('status');



        $dataOrder = $this->orderModel->getDatabyVar('ordercode', $ordercode)->findAll();
        foreach ($dataOrder as $data2) {
            $temp = [];
            $temp['id']            = $data2['id'];
            $temp['status']        = $status;
            $this->orderModel->save($temp);
        }

        session()->setFlashdata('Success', 'Status pembayaran berhasil di update.');
        return redirect()->to(previous_url());
    }
}
