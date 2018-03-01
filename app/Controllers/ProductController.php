<?php

namespace App\Controllers;

use App\Models\ProductModel;

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
     */
    function show($id){

        // Fixture:
        $item = [
                'id' => (int)$id,
                'name' => 'Samsung Galaxy A7',
                'description' => 'Original, Android 5.0.1',
                'price' => '100'
            ];

        return $item;
    }

    /**
     * Create product
     */
    function create(){

        //@TODO: Implement this
    }
}