<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\CityModel;
use App\Models\TypeAdModel;
use Mindk\Framework\Http\Request\Request;
use Mindk\Framework\Exceptions\NotFoundException;
use Mindk\Framework\Http\Response\JsonResponse;

/**
 * Data controller
 *
 * Class CategoryController
 * @package App\Controllers
 */
class DataController
{
    /**
     * DataList list
     */
    function dataList(CategoryModel $categoryModel, CityModel $cityModel, TypeAdModel $typeModel){

        return [
            'cities' => $cityModel->getList(),
            'categories' => $categoryModel->getList(),
            'adTypes' => $typeModel->getList()
        ];
    }
}