<?php

namespace App\Models;

use Mindk\Framework\DI\Service;

/**
 * Class ProductModel
 *
 * @package App\Models
 */
class ProductModel
{
    /**
     * @var mixed|null DB Connection
     */
    protected $db = null;

    /**
     * ProductModel constructor.
     */
    public function __construct()
    {
        $this->db = Service::get('db');
    }

    /**
     * Get product list
     */
    public function getList(){

        return $this->db
            ->query('SELECT * FROM `products`')
            ->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Get single record by id
     *
     * @param int $id
     * @return  mixed
     */
    public function getRecord(int $id){

        return $this->db
            ->query('SELECT * FROM `products` WHERE `id`='.$id)
            ->fetch(\PDO::FETCH_ASSOC);
    }
}