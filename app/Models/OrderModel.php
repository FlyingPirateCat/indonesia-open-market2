<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table      = 'tableorder';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'ordercode',
        'id_seller',
        'id_buyer',
        'data_product',
        'status',
        'payment_proof',
    ];


    public function getDatabyVar($var, $value)
    {
        return $this->where([$var => $value]);
    }
}
