<?php

namespace App\Models;

use CodeIgniter\Model;

class TarifposKargoModel extends Model
{
    protected $table      = 'tarifposkargo';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'asal',
        'tujuan',
        'rute',
        'tarif10kg',
        'tarif1kg',
    ];

    public function exist($place)
    {
        $result = $this->where(['asal' => $place])->first();
        return !empty($result);
    }


    public function getTarif1kg($asal, $tujuan)
    {
        $tarif = $this->getDataTarif($asal, $tujuan);
        if (empty($tarif)):
            return 0;
        endif;
        return $tarif['tarif1kg'];
    }

    public function getTarif10kg($asal, $tujuan)
    {
        $tarif = $this->getDataTarif($asal, $tujuan);
        if (empty($tarif)):
            return 0;
        endif;
        return $tarif['tarif10kg'];
    }

    public function getDataTarif($asal, $tujuan)
    {
        return $this->where(['asal' => $asal, 'tujuan' => $tujuan])->first();
    }
}
