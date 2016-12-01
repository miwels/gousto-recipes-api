<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Recipy extends Model
{
    protected $table = 'recipies';
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $dateFormat = 'd-m-Y H:i:s';
    protected $fillable = [
        'id',
        'created_at',
        'updated_at',
        'box_type',
        'title',
        'slug',
        'short_titile',
        'marketing_description',
        'calories_kcal',
        'protein_grams',
        'fat_grams',
        'carbs_grams',
        'bulletpoint1',
        'bulletpoint2',
        'recipe_diet_type_id',
        'season',
        'base',
        'protein_source',
        'preparation_time_minutes',
        'shelf_life_days',
        'equipment_needed',
        'origin_country',
        'recipe_cuisine',
        'in_your_box',
        'gousto_reference',
    ];

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
     * But we have to manually set them
     */
    public function getDates() {
        return [];
    }

}
