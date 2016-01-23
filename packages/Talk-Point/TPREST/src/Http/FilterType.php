<?php
/**
 * Created by PhpStorm.
 * User: konstantinstoldt
 * Date: 23/01/16
 * Time: 16:10
 */

namespace TPREST\Http;


interface FilterType
{
    CONST STRING = 'LIKE';
    CONST BOOLEAN = 'BOOLEAN';
    CONST NUMERIC = 'NUMERIC';
}