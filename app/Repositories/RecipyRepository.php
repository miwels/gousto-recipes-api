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
	 * @return \Illuminate\Contracts\Pagination\Paginator
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
	 * @return \Illuminate\Contracts\Pagination\Paginator
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
	 * @return Recipy|bool
	 */
	public function edit(array $values, Recipy $recipy)
	{
		// prevent users from updating the id
		// NOTE: we could use a method similar to the one used in RecipyController@store
		// to restrict fields we allow to update
		// we can also use mass-asignement by defining our properties in the model
		if(isset($values['id'])) {
			unset($values['id']);
		}

		// update timestamp, this should be done by Eloquent automatically but we
		// have disabled it for now
		$values['updated_at'] = Carbon::now();

		$recipy->fill($values);

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
	 *
	 * @return int
	 */
	public function getLastId()
	{
		return $this->recipy->select(\DB::raw('max(id) as id'))->first()->id;
	}
}