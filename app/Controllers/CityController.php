<?php

namespace App\Controllers;

use App\Models\CityModel;
use Mindk\Framework\Http\Request\Request;
use Mindk\Framework\Exceptions\NotFoundException;
use Mindk\Framework\Http\Response\JsonResponse;

/**
 * Category controller
 *
 * Class CategoryController
 * @package App\Controllers
 */
class CityController
{
    /**
     * City list
     */
    function cityList(CityModel $model){

        return $model->getList();
    }
}