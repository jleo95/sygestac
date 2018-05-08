<?php
/**
 * Created by PhpStorm.
 * User: LEOBA
 * Date: 10/04/2018
 * Time: 12:38
 */

namespace Tables;


use Core\Table;

class DroitsTable extends Table
{
    protected $id = 'iddroit';
    public function __construct()
    {
        parent::__construct();
    }

}