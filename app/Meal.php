<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{

	protected $fillable = ['name'];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function foods()
	{
		return $this->hasMany(Food::class);
	}

	public function calories()
	{
		return $this->foods->reduce(function ($totalCalories, $food) {
			return $totalCalories += $food->calories();
		}, 0);
	}


	public function macronutrients()
	{
		$macrosMap = [
			'protein' => 0, 
			'carbohydrates' => 0,
			'fat' => 0
		];

		return $this->foods->reduce(function ($totalMacros, $food) {

			$totalMacros['protein'] += $food->protein;	
			$totalMacros['carbohydrates'] += $food->carbohydrates;	
			$totalMacros['fat'] += $food->fat;	

			return $totalMacros;
		}, $macrosMap);
	}
	public function macros()
	{
		return $this->macronutrients();
	}
	public function protein()
	{
		return $this->macronutrients()['protein'];
	}
	public function carbohydrates()
	{
		return $this->macronutrients()['carbohydrates'];
	}
	public function fat()
	{
		return $this->macronutrients()['fat'];
	}
}
