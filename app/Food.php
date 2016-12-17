<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
  
    protected $fillable = ['name', 'protein', 'carbohydrates', 'fat'];

    public function meal()
    {
    	return $this->belongsTo(Meal::class);
    }

    public function calories()
    {
    	return (($this->protein * 4) + ($this->carbohydrates * 4) + ($this->fat * 9));
    }
}
