<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'location_id',
        'type',
        'name',
        'description',
        'image',
        'date'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $errors;

    // Définition des règles de validation
    public static $rules = [
        'location_id' => 'exists:locations,id|nullable',
        'type' => 'required|in:"grand-rdv","rdv-juridique","rdv-formation","rencontres-entrepreneurs"',
        'name' => 'required|string|regex:/^((?!script).)*$/i',
        'description' => 'required|string|regex:/^((?!script).)*$/i',
        'image' => 'nullable|string|regex:/^((?!script).)*$/i',
        'date' => 'required|date|after:today',
    ];

    public static function getValidation(array $inputs, bool $updated = true)
    {
        $validator = Validator::make($inputs, static::$rules);
        if ($updated) {
            $validator->after(function ($validator) use ($inputs) {

                $exist = Event::where('name', $inputs['name'])
                    ->where('date', $inputs['date'])
                    ->first();

                if (!empty($exist)) {
                    $validator->getMessageBag()->add('name', 'Cet événement existe déjà.');
                }
            });
        }
        return $validator;
    }

    public function documents()
    {
        return $this->belongsToMany('App\Document', 'event_document');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_event');
    }

    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    public function topics()
    {
        return $this->hasMany('App\Topic');
    }

    public function errors()
    {
        return $this->errors;
    }
}
