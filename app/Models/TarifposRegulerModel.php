<?php

namespace App\Models;

use CodeIgniter\Model;

class TarifposRegulerModel extends Model
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

    public function getDataTarif($asal, $tujuan)
    {
        return $this->where(['asal' => $asal, 'tujuan' => $tujuan])->first();
    }
}
