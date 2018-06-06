<?php

namespace App\Models;

use Mindk\Framework\DB\DBOConnectorInterface;
use Mindk\Framework\DI\Service;
use Mindk\Framework\Models\Model;

/**
 * Class CategoryModel
 *
 * @package App\Models
 */
class CategoryModel extends Model
{
    protected $tableName = 'categories';
}