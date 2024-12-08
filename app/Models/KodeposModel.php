<?php

namespace App\Models;

use CodeIgniter\Model;

class KodeposModel extends Model
{
    protected $table      = 'tbl_kodepos';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'kelurahan',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'kodepos'
    ];


    public function getData($var = false, $value = false)
    {
        if ($var == false && $value == false) {
            return $this->findAll();
        }
        return $this->getAllDatabyVar($var, $value)->first();
    }

    public function getAllDatabyVar($var, $value)
    {
        return $this->where([$var => $value]);
    }
}
