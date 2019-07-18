<?php

namespace App;

use Validator;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'name',
        'first_name',
        'company_name',
        'is_admin',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates = ['deleted_at'];

    protected $errors;

    // Définition des règles de validation
    public static $rules = [
        'email' => "required|email|regex:/^((?!script).)*$/i",
        'name' => "required|string|regex:/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/i|regex:/^((?!script).)*$/i",
        'first_name' => "required|string|regex:/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/i|regex:/^((?!script).)*$/i",
        'company_name' => 'required|string|regex:/^((?!script).)*$/i',
        'is_admin' => 'nullable|boolean',
        'password' => 'nullable|string'
    ];

    public function events()
    {
        return $this->belongsToMany('App\Event', 'user_event');
    }

    public static function getValidation(array $inputs, bool $updated = true)
    {
        $validator = Validator::make($inputs, static::$rules);
        if ($updated) {
            $validator->after(function ($validator) use ($inputs) {

                $exist = User::where('name', $inputs['name'])
                    ->where('first_name', $inputs['first_name'])
                    ->where('email', $inputs['email'])
                    ->first();

                if (!empty($exist)) {
                    $validator->getMessageBag()->add('email', 'un autre compte a déjà les mêmes données');
                }
            });
        }
        return $validator;
    }

    public function errors()
    {
        return $this->errors;
    }
}
