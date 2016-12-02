<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RecipyRepository;

class RecipyController extends Controller
{
    protected $recipyRepositoy;

    public function __construct(RecipyRepository $recipyRepositoy) {
        $this->recipyRepositoy = $recipyRepositoy;
    }
    /**
     * Display a listing of the resource.
     * This method allows paginating the results, simply add an extra parameter
     * in your query string:
     *
     * i.e /api/recipes?page=2
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->recipyRepositoy->getAll();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @todo create helper to define the mandatory fields or add some accessors
     *       in our Eloquent model
     */
    public function store(Request $request)
    {
        $data = $request->all();

        // here we can define a list of mandatory fiedls. It'd make more sense
        // to put this function in a  helper i.e. app\Helpers
        $requestKeys = array_keys($data);
        $mandatoryFields = [
            'box_type',
            'title',
            'slug',
            'gousto_reference',
            'marketing_description'
        ];
        $fields = array_intersect($mandatoryFields, $requestKeys);

        if(count($fields) !== count($mandatoryFields)) {
            return ['error' => 'Missing mandatory fields'];
        }

        return $this->recipyRepositoy->store($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return $this->recipyRepositoy->findBy(['id' => (int) $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * NOTE: in order for Laravel to understand PUT|PATCH methods we have to send
     * the params in x-www-form-urlencoded format
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $data = $request->all();
        $recipy = $this->recipyRepositoy->findBy(['id' => $id])->first();
        if(!$recipy) {
            return ['error' => 'Recipy not found!'];
        }

        return $this->recipyRepositoy->edit($data, $recipy);
    }

    /**
     * Filters recipes by a certain criteria.
     * We can restrict the categories we allow filtering
     *
     * @param string $nane  The category name
     * @param string $value The category value
     * @return \Illuminate\Http\Response
     */
    public function category($name, $value)
    {
        static $allowedCategories = [
            'recipe_cuisine'
        ];

        if(!in_array($name, $allowedCategories)) {
            return ['error' => 'Category not found'];
        }

        return $this->recipyRepositoy->findBy([$name => $value]);
    }

    // -------------------------------------------------------------------------
    // Unused resources. These can also be filtered in routes/api.php
    // Do 'php artisan route:list' to take a look at the available routes
    // (or GET the root folder of the project '/')
    // -------------------------------------------------------------------------

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

    }
}
