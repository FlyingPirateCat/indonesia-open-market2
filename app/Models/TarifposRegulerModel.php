<?php

namespace App\Models;

// use CodeIgniter\Model;
use App\Models\TarifposKargoModel;

class TarifposRegulerModel extends TarifposKargoModel
{
    protected $table      = 'tarifposreguler';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'asal',
        'tujuan',
        'rute',
        'tarif'
    ];
    public function getTarif($asal, $tujuan)
    {
        $tarif = $this->getDataTarif($asal, $tujuan);
        if (empty($tarif)):
            return 0;
        endif;

        return $tarif['tarif'];
    }
}
