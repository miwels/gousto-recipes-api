<?php
namespace App\Factories;

use App\Models\Recipy;

class RecipyFactory
{
	public function __construct() {
		// inject dependencies here
	}

    public function make() {
        return new Recipy;
    }
}