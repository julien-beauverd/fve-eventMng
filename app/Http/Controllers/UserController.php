<?php

namespace App\Http\Controllers;

use App\User;
use App\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */ 
    public function update(Request $request, $id)
    {
        $newUser['name'] = $request->name;
        $newUser['first_name'] = $request->first_name;
        $newUser['company_name'] = $request->company_name;
        $newUser['email'] = $request->email;

        $validator = User::getValidation($newUser);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return view('profile')->withErrors($messages);
        }

        $oldUser = User::find($id);
        if (empty($oldUser)) {
            return response()->json(['error' => 'utilisateur introuvable.']);
        }

        DB::beginTransaction();

        try {
            $oldUser->update($newUser);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error', $e->getMessage()]);
        }
        $validator = User::getValidation($newUser, false);
        if (!$validator->fails()) {
            $validator->getMessageBag()->add('email', 'le compte a correctement été mis à jour.');
            $messages = $validator->messages();
            return redirect()->to('/profile')->withErrors($messages);
        } else {
            $validator->getMessageBag()->add('email', "le compte n'a pas pu être mis à jour.");
            $messages = $validator->messages();
            return view('profile')->withErrors($messages);
        }
    }

    /**
     * Add a user to a event. Create a participant
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function participate($id, $unsubscribe = false)
    {

        $event = Event::find($id);
        if (empty($event)) {
            return response()->json(['error' => 'événement introuvable.']);
        }

        $user['name'] = Auth::User()->name;
        $user['first_name'] = Auth::User()->first_name;
        $user['company_name'] = Auth::User()->company_name;
        $user['email'] = Auth::User()->email;

        DB::beginTransaction();

        try {
            $validator = User::getValidation($user, false);
            if (!$validator->fails()) {
                $user = User::find(Auth::User()->id);
                if($unsubscribe)
                {
                    $event->users()->wherePivot('user_id','=',$user->id)->detach();
                }else{
                    $event->users()->save($user);
                }
                
                DB::commit();
                if($unsubscribe){
                    return redirect()->action(
                        'EventController@show',
                        ['id' => $id, 'OK' => 'KO']
                    );
                }else{
                    return redirect()->action(
                        'EventController@show',
                        ['id' => $id, 'OK' => 1]
                    );
                }
                
            } else {
                return redirect()->action(
                    'EventController@show',
                    ['id' => $id]
                );
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error', $e->getMessage()]);
        }
    }
}
