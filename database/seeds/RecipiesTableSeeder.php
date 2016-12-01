<?php

use Illuminate\Database\Seeder;
use App\Factories\RecipyFactory;
use App\Repositories\RecipyRepository;

class RecipiesTableSeeder extends Seeder
{
    const CSV_PATH = "data/input.csv";

    /**
     * Run the database seeds.
     * This method reads our input CSV file with the list of recipies and store
     * them in our model.
     *
     * @return void
     */
    public function run()
    {
        $data = Excel::load(self:: CSV_PATH)->get();
        $output = []; // for debugging purposes
        foreach($data as $element) {
            DB::table('recipies')->insert([
                'id'                    => $element->id,
                'created_at'            => $element->created_at,
                'updated_at'            => $element->updated_at,
                'box_type'              => $element->box_type,
                'title'                 => $element->title,
                'slug'                  => $element->slug,
                'short_title'           => $element->short_title,
                'marketing_description' => $element->marketing_description,
                'calories_kcal'         => $element->calories_kcal,
                'protein_grams'         => $element->protein_grams,
                'fat_grams'             => $element->fat_grams,
                'carbs_grams'           => $element->carbs_grams,
                'bulletpoint1'          => $element->bulletpoint1,
                'bulletpoint2'          => $element->bulletpoint2,
                'bulletpoint3'          => $element->bulletpoint3,
                'recipe_diet_type_id'   => $element->recipe_diet_type,
                'season'                => $element->season,
                'base'                  => $element->base,
                'protein_source'        => $element->protein_source,
                'preparation_time_minutes' => $element->preparation_time_minutes,
                'shelf_life_days'       => $element->shelf_life_days,
                'equipment_needed'      => $element->equipment_needed,
                'origin_country'        => $element->origin_country,
                'recipe_cuisine'        => $element->recipe_cuisine,
                'in_your_box'           => $element->in_your_box,
                'gousto_reference'      => $element->gousto_reference
                ]);
        }
    }
}
