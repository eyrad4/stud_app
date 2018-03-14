<?php

namespace App\Controllers;

use App\Models\ProductModel;
use Mindk\Framework\Exceptions\NotFoundException;

/**
 * Product controller
 *
 * Class ProductController
 * @package App\Controllers
 */
class ProductController
{
    /**
     * Products index page
     */
    function index(){

        $model = new ProductModel();

        return $model->getList();
    }

    /**
     * Single product page
     *
     * @param   int Product ID
     * @return  mixed
     * @throws NotFoundException
     */
    function show($id){

        $model = new ProductModel();
        $item = $model->getRecord((int)$id);

        // Check if record exists
        if(empty($item)) {
            throw new NotFoundException('Product with id ' . $id . ' not found');
        }

        return $item;
    }

    /**
     * Create product
     */
    function create(){

        //@TODO: Implement this
    }
}