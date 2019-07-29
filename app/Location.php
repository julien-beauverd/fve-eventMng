<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'city',
        'street',
        'street_number',
        'zip_code',
        'building'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $errors;

    //rules for the validation
    public static $rules = [
        'city' => 'required|string|regex:/^((?!script).)*$/i',
        'street' => 'required|string|regex:/^((?!script).)*$/i',
        'street_number' => 'nullable|string|regex:/^((?!script).)*$/i',
        'zip_code' => 'required|numeric|digits:4',
        'building' => 'nullable|string|regex:/^((?!script).)*$/i'
    ];

    /**
     * validate the model before creating it
     * @param Array $inputs
     * @param boolean $updated
     * @return Validator $validator
     */
    public static function getValidation(array $inputs, bool $updated = true)
    {
        $validator = Validator::make($inputs, static::$rules);
        
        return $validator;
    }

    public function events(){
        return $this->hasMany('App\Event');
    }

    public function errors()
    {
        return $this->errors;
    }
}
