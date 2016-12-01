<?php
namespace App\Repositories;

use App\Models\Recipy;
use App\Factories\RecipyFactory;
use App\Repositories\Interfaces\RecipyRepositoryInterface;
use Carbon\Carbon;

class RecipyRepository implements RecipyRepositoryInterface {

	protected $recipy;
	protected $recipyFactory;

	function __construct(Recipy $recipy, RecipyFactory $recipyFactory)
	{
		$this->recipy 		 = $recipy;
		$this->recipyFactory = $recipyFactory;
	}

	/**
	 * Retrieves all results in the system
	 *
	 * @param int $results Number of results per page
	 */
	public function getAll(int $results = 5)
	{
		return $this->recipy->simplePaginate($results);
	}

	/**
	 * Retrieves a recipy entry
	 *
	 * @param  array       	$column  	key-value element where the key is the table column and
	 *                                	value is the column value
	 * @param  int  		$results 	paginates the output with the number of elements of $results
	 * @return \Collection            	returns a Collection of results
	 */
	public function findBy(array $column, int $results = 5)
	{
		return $this->recipy->where([key($column) => $column[key($column)]])
							->simplePaginate($results);
	}

	/**
	 * Edits a recipy
	 *
	 * @param  array  $values  key-value element where the key is the table column and
	 *                         value is the column value
	 * @return [type]         [description]
	 */
	public function edit(array $values, Recipy $recipy)
	{
		foreach($values as $key => $value)
		{
			$recipy->$key = $value;
		}

		if($recipy->save()) {
			return $recipy;
		}
		return false;
	}

	/**
	 * Saves a new recipy
	 *
	 * @param  array  $values 	key-value element where the key is the property and the value the property value
	 * @return \Recipy|bool     Returns the newly saved object or false if error
	 */
	public function store(array $values)
	{
		$recipy = $this->recipyFactory->make();

		$nextId = $this->getLastId() + 1;
		$values['id'] = $nextId;
		$values['created_at'] = Carbon::now();
		$values['updated_at'] = Carbon::now();

		$newRecipy = $recipy->create($values);
		if($newRecipy) {
			return $newRecipy;
		}
		return false;
	}

	/**
	 * Due to the fact that we are using an in-memory engine or sqlite we have
	 * to manually retrieve the last inserted ID
	 */
	public function getLastId()
	{
		return $this->recipy->select(\DB::raw('max(id) as id'))->first()->id;
	}
}