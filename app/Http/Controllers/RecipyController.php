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
     * i.e /api/recipies?page=2
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
     */
    public function store(Request $request)
    {
        $data = $request->all();
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $data = $request->all();
        $recipy = $this->recipyRepositoy->findBy(['id' => $id]);
        return $this->recipyRepositoy->edit($data, $recipy);
    }

    /**
     * Filters recipies by a certain criteria.
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
            return ['error' => 'Cateogry not found'];
        }

        return $this->recipyRepositoy->findBy(['recipe_cuisine' => $value]);
    }

    // -------------------------------------------------------------------------
    // Unused resources. These can also be filtered in routes/api.php
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
