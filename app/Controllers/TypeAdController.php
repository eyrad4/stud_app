<?php

namespace App\Controllers;

use App\Models\TypeAdModel;
use Mindk\Framework\Http\Request\Request;
use Mindk\Framework\Exceptions\NotFoundException;
use Mindk\Framework\Http\Response\JsonResponse;

/**
 * Category controller
 *
 * Class CategoryController
 * @package App\Controllers
 */
class TypeAdController
{
    /**
     * TypeAd list
     */
    function cityList(TypeAdModel $model){

        return $model->getList();
    }
}