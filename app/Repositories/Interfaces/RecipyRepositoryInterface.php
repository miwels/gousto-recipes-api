<?php
namespace App\Repositories\Interfaces;

use App\Models\Recipy;

interface RecipyRepositoryInterface
{
    public function getAll(int $results);
	public function findBy(array $columns, int $results);
	public function edit(array $values, Recipy $recipy);
	public function store(array $values);
    public function getLastId();
}