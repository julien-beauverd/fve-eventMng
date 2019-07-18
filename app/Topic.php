<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'event_id',
        'time',
        'title',
        'speaker',
        'description'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $errors;

    // Définition des règles de validation
    public static $rules = [
        'event_id' => 'exists:events,id|nullable',
        'time' => 'required|date_format:"H:i:s"',
        'title' => 'required|string',
        'speaker' => 'nullable|string',
        'description' => 'nullable|string'
    ];

    public static function getValidation(Array $inputs)
    {
        $validator = Validator::make($inputs, static::$rules);
        return $validator;
    }

    public function event(){
        return $this->belongsTo('App\Event');
    }

    public function errors()
    {
        return $this->errors;
    }
}