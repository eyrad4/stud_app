<?php

namespace App\Models;

use Mindk\Framework\DB\DBOConnectorInterface;
use Mindk\Framework\DI\Service;
use Mindk\Framework\Models\Model;

/**
 * Class CityModel
 *
 * @package App\Models
 */
class CityModel extends Model
{
    protected $tableName = 'cities';
}