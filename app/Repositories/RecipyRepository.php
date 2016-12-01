<?php
namespace App\Repositories;

use App\Models\Recipy;
use App\Factories\RecipyFactory;
use App\Repositories\Interfaces\RecipyRepositoryInterface;

class RecipyRepository implements RecipyRepositoryInterface {

	protected $recipy;
	protected $recipyFactory;

	function __construct(Recipy $recipy, RecipyFactory $recipyFactory)
	{
		$this->recipy 		 = $recipy;
		$this->recipyFactory = $recipyFactory;
	}

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

		foreach($values as $key => $value) {
			$recipy->$key = $value;
		}

		if($recipy->save()) {
			return $recipy;
		}

		return false;
	}
}