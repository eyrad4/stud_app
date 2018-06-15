<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use Mindk\Framework\Http\Request\Request;
use Mindk\Framework\Exceptions\NotFoundException;
use Mindk\Framework\Http\Response\JsonResponse;

/**
 * Category controller
 *
 * Class CategoryController
 * @package App\Controllers
 */
class CategoryController
{
    /**
     * Categories list
     */
    function categoryList(CategoryModel $model){

        return $model->getList();
    }

}