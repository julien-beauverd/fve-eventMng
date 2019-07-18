<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'doc_to_download'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $errors;

    // Définition des règles de validation
    public static $rules = [
        'name' => "required|string|regex:/^((?!script).)*$/i",
        'doc_to_download' => 'nullable|boolean',
        'title' => 'nullable|string|regex:/^((?!script).)*$/i',
        'description' => 'nullable|string|regex:/^((?!script).)*$/i'
        
    ];

    public static function getValidation(Array $inputs)
    {
        $validator = Validator::make($inputs, static::$rules);
        return $validator;
    }

    public function events(){
        return $this->belongsToMany('App\Event','event_document');
    }

    public function errors()
    {
        return $this->errors;
    }
}
