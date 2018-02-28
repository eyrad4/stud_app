<?php

namespace App\Controllers;

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

        // Fixture:
        $list = [
            [
                'id' => 1,
                'name' => 'Samsung Galaxy A7',
                'description' => 'Original, Android 5.0.1',
                'price' => '100'
            ],
            [
                'id' => 2,
                'name' => 'iFone',
                'description' => 'Chinese copy',
                'price' => '100'
            ]
        ];

        return $list;
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