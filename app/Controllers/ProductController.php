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
        echo 'Product list to be shown here';
    }

    /**
     * Single product page
     */
    function show($id){
        echo 'Product ID > ' . $id . ' card';
    }

    /**
     * Create product
     */
    function create(){
        echo 'creating the product...';
    }
}