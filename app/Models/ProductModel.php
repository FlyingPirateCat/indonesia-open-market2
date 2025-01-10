<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table      = 'tableproduct';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'cover',
        'name',
        'slug',
        'type',
        'description',
        'postalcode',
        'price',
        'weight',
        'stock',
        'id_user',
        'additionalcost',
    ];


    public function getProduct($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }
        // return $this->where(['slug' => $slug])->first();
        return $this->getAllProductbyVar('slug', $slug)->first();
    }

    public function getAllProductbyVar($var, $value)
    {
        return $this->where([$var => $value]);
    }

    public function search($keyword)
    {
        $builder = $this->table($this->table);
        $builder->like('name', $keyword);
        $builder->orLike('postalcode', $keyword);
        $builder->orLike('description', $keyword);
        return $builder;
    }
}
