<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Recipy extends Model
{
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $dateFormat = 'd-m-Y H:i:s';
    /**
     * Allows to set properties dynamically
     * i.e. $recipy = new Recipy;
     *      $recipy->$key = $val;
     */
    public function __set($key, $value) {
        $this->$key = $value;
    }

    /**
     * Carbon tries to format 'created_at' and 'updated_at' fields
     * By using this accessor we prevent the dates to be converted
     * if we expect them to be in the right format (and they are inded
     * d-m-Y instead of Y-m-d)
     */
    public function getDates() {
        return [];
    }

}
