<?php

namespace App\Http\Controllers;

use App\Event;
use App\User;
use App\Topic;
use App\Location;
use App\Document;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;
use App\Mail\SendMail;

class AdminController extends Controller
{
    /**
     * Display the dashboard
     *
     */
    public function dashboard()
    {
        if (Auth::User()->is_admin == false) {
            return view('errors/404');
        } else {
            $event = Event::with('location', 'topics')->where('date_show_end', '>=', date('Y-m-d'))->orderBy('date', 'asc')->first();
            $participantsCount = DB::select("SELECT COUNT(u.id) AS 'count' FROM users AS u INNER JOIN user_event AS ue ON ue.user_id = u.id INNER JOIN events AS e ON e.id = ue.event_id WHERE e.id = " . $event->id . "");
            $users = User::paginate(12);
            $totalAccount = User::all()->count();
            $eventCount = Event::all()->count();
            return view('admin/dashboard')->with(['event' => $event, 'users' => $users, 'participantCount' => $participantsCount, 'eventCount' => $eventCount, 'totalAccount' => $totalAccount]);
        }
    }

    public function sendMail(Request $request)
    {

        if (Auth::User()->is_admin == false) {
            return view('errors/404');
        } else {

            $title = $request->title;
            $mailType = $request->mailType;
            $eventName = $request->eventName;
            $subject = $request->subject;
            $message = $request->message;
            
            if ($mailType == 'specific') {
                $event = Event::where('name', '=', $eventName)->first();
                $link = url('event/' . $event->id . '');
                $eventWithUsers = Event::with('users')->where('name', '=', $eventName)->get();
                Mail::bcc($eventWithUsers[0]->users)->send(new SendMail($eventName, $subject, $message, $link, $mailType, $title));
            } else {
                $link = url('eventList/asc');
                Mail::bcc(User::all())->send(new SendMail($eventName, $subject, $message, $link, $mailType, $title));
            }

            $eventsWithUsers = Event::with('users')->where('date_show_end', '>=', date('Y-m-d'))->orderBy('date', 'asc')->get();
            return view('admin/sendMail')->with(['eventsWithUsers' => $eventsWithUsers, 'OK' => 'OK']);
        }
    }

    /**
     * Display the newEvent view
     *
     */
    public function showNewEventPage()
    {
        if (Auth::User()->is_admin == false) {
            return view('errors/404');
        } else {
            return view('admin/newEvent');
        }
    }

    /**
     * Display the newEvent view
     *
     */
    public function showNextEventsPage()
    {
        if (Auth::User()->is_admin == false) {
            return view('errors/404');
        } else {

            $events = Event::with('location', 'topics')->where('date', '>=', date('Y-m-d'))->orderBy('date', 'asc')->get();

            $usersArray = array();

            foreach ($events as $event) {
                $users = DB::select("SELECT * FROM users AS u
                INNER JOIN user_event AS ue ON ue.user_id = u.id
                WHERE ue.event_id = '.$event->id.'");
                $nameArray[] = $event->id;
                $firstNameArray[] = $event->id;
                $companyNameArray[] = $event->id;
                $emailArray[] = $event->id;
                foreach ($users as $user) {
                    $nameArray[] = $user->name;
                    $firstNameArray[] = $user->first_name;
                    $companyNameArray[] = $user->company_name;
                    $emailArray[] = $user->email;
                }
                $nameArray[] = $event->id;
                $firstNameArray[] = $event->id;
                $companyNameArray[] = $event->id;
                $emailArray[] = $event->id;
            }
            return view('admin/nextEvents')->with(
                [
                    'events' => $events,
                    'nameArray' => $nameArray,
                    'firstNameArray' => $firstNameArray,
                    'companyNameArray' => $companyNameArray,
                    'emailArray' => $emailArray
                ]
            );
        }
    }

    /**
     * Display the newEvent view
     *
     */
    public function showModifyEvent($id)
    {
        if (Auth::User()->is_admin == false) {
            return view('errors/404');
        } else {

            $event = Event::with('location', 'topics', 'documents')->where('id', '=', $id)->first();

            $topicNumber = DB::select("SELECT COUNT(*) AS count FROM topics
            WHERE event_id = $event->id AND deleted_at IS NULL");
            $number = $topicNumber[0]->count;
            $topicCount = 11 + ($number - 3) * 2;

            return view('admin/modifyEvent')->with(['event' => $event, 'topicCount' => $topicCount, 'topicNumber' => $number]);
        }
    }

    /**
     * Display docs to download
     *
     */
    public function showDocsToDownload()
    {
        if (Auth::User()->is_admin == false) {
            return view('errors/404');
        } else {
            $docsToDownload = Document::where('doc_to_download', '=', true)->get();
            $docCount = count($docsToDownload);
            return view('admin/docsToDownloadManagement')->with(['docsToDownload' => $docsToDownload, 'docCount' => $docCount]);
        }
    }

    public function showSendMail()
    {
        if (Auth::User()->is_admin == false) {
            return view('errors/404');
        } else {
            $eventsWithUsers = Event::with('users')->where('date_show_end', '>=', date('Y-m-d'))->orderBy('date', 'asc')->get();
            return view('admin/sendMail')->with(['eventsWithUsers' => $eventsWithUsers]);
        }
    }

    /**
     * Modify the list of docs to download
     *
     */
    public function modifyDocsToDownload(Request $request)
    {
        if (Auth::User()->is_admin == false) {
            return view('errors/404');
        } else {

            $docsToDownload = Document::where('doc_to_download', '=', true)->get();

            DB::beginTransaction();

            try {

                if ($request->delDoc_1 == '1') {

                    $docToDelete = $docsToDownload[0];
                    File::delete(public_path() . '/docs/download/' . $docToDelete->name . '');
                    Document::destroy($docToDelete->id);
                }

                if ($request->delDoc_2 == '1') {
                    $docToDelete = $docsToDownload[1];
                    File::delete(public_path() . '/docs/download/' . $docToDelete->name . '');
                    Document::destroy($docToDelete->id);
                }

                if ($request->delDoc_3 == '1') {
                    $docToDelete = $docsToDownload[2];
                    File::delete(public_path() . '/docs/download/' . $docToDelete->name . '');
                    Document::destroy($docToDelete->id);
                }

                if ($request->delDoc_4 == '1') {
                    $docToDelete = $docsToDownload[3];
                    File::delete(public_path() . '/docs/download/' . $docToDelete->name . '');
                    Document::destroy($docToDelete->id);
                }

                if ($request->delDoc_5 == '1') {
                    $docToDelete = $docsToDownload[4];
                    File::delete(public_path() . '/docs/download/' . $docToDelete->name . '');
                    Document::destroy($docToDelete->id);
                }

                if ($request->delDoc_6 == '1') {
                    $docToDelete = $docsToDownload[5];
                    File::delete(public_path() . '/docs/download/' . $docToDelete->name . '');
                    Document::destroy($docToDelete->id);
                }

                if ($request->delDoc_7 == '1') {
                    $docToDelete = $docsToDownload[6];
                    File::delete(public_path() . '/docs/download/' . $docToDelete->name . '');
                    Document::destroy($docToDelete->id);
                }

                if ($request->delDoc_8 == '1') {
                    $docToDelete = $docsToDownload[7];
                    File::delete(public_path() . '/docs/download/' . $docToDelete->name . '');
                    Document::destroy($docToDelete->id);
                }

                if ($request->delDoc_9 == '1') {
                    $docToDelete = $docsToDownload[8];
                    File::delete(public_path() . '/docs/download/' . $docToDelete->name . '');
                    Document::destroy($docToDelete->id);
                }

                if ($request->delDoc_10 == '1') {
                    $docToDelete = $docsToDownload[9];
                    File::delete(public_path() . '/docs/download/' . $docToDelete->name . '');
                    Document::destroy($docToDelete->id);
                }

                $newDocuments = array();

                for ($i = 1; $i <= count($docsToDownload); $i++) {
                    $title = "title_document_" . $i;
                    $description = "description_document_" . $i;
                    $newDocument['name'] = $docsToDownload[$i - 1]->name;
                    $newDocument['title'] = $request->$title;
                    $newDocument['description'] = $request->$description;

                    $newDocuments[] = $newDocument;
                }

                foreach ($newDocuments as $newDocument) {
                    $validator = Document::getValidation($newDocument);
                    if ($validator->fails()) {
                        $messages = $validator->messages();

                        return redirect('admin/docsToDownloadManagement')->withInput()->withErrors($messages);
                    }
                }

                $i = 0;
                foreach ($newDocuments as $newDocument) {

                    $oldDocument = $docsToDownload[$i];
                    $oldDocument->title = $newDocument['title'];
                    $oldDocument->description = $newDocument['description'];

                    $oldDocument->save();
                    $i++;
                }

                $testIfFileUpload = 'document_' . ($i + 1);

                if ($request->$testIfFileUpload != null) {
                    for ($i = count($docsToDownload) + 1; $i <= $request->docCount; $i++) {

                        $document = "document_" . $i;
                        $titleDocument = "title_document_" . $i;
                        $descriptionDocument = "description_document_" . $i;
                        $fileArray = array('document' => $request->$document);

                        $rules = array(
                            'document' => 'nullable|max:8388608'
                        );
                        $validator = Validator::make($fileArray, $rules);
                        if ($validator->fails()) {
                            $messages = $validator->messages();
                            DB::rollback();
                            return redirect('admin/docsToDownloadManagement')->withInput()->withErrors($messages);
                        }

                        $request->$document->move(public_path('docs/download'), $request->$document->getClientOriginalName());

                        $newDocument = new Document;
                        $newDocument->name = $request->$document->getClientOriginalName();
                        $newDocument->title = $request->$titleDocument;
                        $newDocument->description = $request->$descriptionDocument;
                        $newDocument->doc_to_download = true;
                        $newDocument->save();
                    }
                }

                $testDocument['name'] = 'test';

                $validator = Document::getValidation($testDocument);
                if (!$validator->fails()) {
                    $validator->getMessageBag()->add('OK', "OK");
                    $messages = $validator->messages();
                    DB::commit();
                    return redirect('admin/docsToDownloadManagement')->withInput()->withErrors($messages);
                }
                DB::rollback();
            } catch (\Exception $e) {
                DB::rollback();
                return redirect('admin/docsToDownloadManagement')->withInput()->withErrors($e);
            }
        }
    }

    /**
     * Display the newEvent view
     *
     */
    public function showPastEventsPage()
    {
        if (Auth::User()->is_admin == false) {
            return view('errors/404');
        } else {

            $events = Event::with('location', 'topics')->where('date', '<', date('Y-m-d'))->orderBy('date', 'desc')->get();

            return view('admin/pastEvents')->with(['events' => $events]);
        }
    }

    /**
     * add a new event
     *
     *
     */
    public function newEvent(Request $request)
    {

        if (Auth::User()->is_admin == false) {
            return view('errors/404');
        } else {

            $newImage = $request->image;

            $newEvent['name'] = $request->name;
            $newEvent['description'] = $request->description;
            $newEvent['date'] = $request->date;
            $newEvent['type'] = $request->typeEvent;
            $newEvent['image'] = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $request->name) . "-" . $request->date . "." . $newImage->getClientOriginalExtension();
            $newLocation['city'] = $request->city;
            $newLocation['zip_code'] = $request->zip_code;
            $newLocation['street'] = $request->street;
            $newLocation['street_number'] = $request->street_number;
            $newLocation['building'] = $request->building;

            $newtopics = array();

            for ($i = 1; $i <= $request->topicNumber; $i++) {
                $time = "time_topic_" . $i;
                $title = "title_topic_" . $i;
                $speaker = "sepaker_topic_" . $i;
                $description = "description_topic_" . $i;
                $newtopic['time'] = $request->$time . ":00";
                $newtopic['title'] = $request->$title;
                $newtopic['speaker'] = $request->$speaker;
                $newtopic['description'] = $request->$description;
                $newtopics[] = $newtopic;
            }

            $location = Location::where('city', $newLocation['city'])
                ->where('street', $newLocation['street'])
                ->where('zip_code', $newLocation['zip_code'])
                ->where('street_number', $newLocation['street_number'])
                ->where('building', $newLocation['building'])
                ->first();

            $createNewLocation = 0;
            if (empty($location)) {

                $validator = Location::getValidation($newLocation);
                if ($validator->fails()) {
                    $messages = $validator->messages();

                    return redirect('admin/newEvent')->withInput()->withErrors($messages);
                }
                $createNewLocation = 1;
            }

            $validator = Event::getValidation($newEvent);
            if ($validator->fails()) {
                $messages = $validator->messages();
                return redirect('admin/newEvent')->withInput()->withErrors($messages);
            }

            $previousTime = null;
            foreach ($newtopics as $newtopic) {
                $validator = Topic::getValidation($newtopic);
                $validator->after(function ($validator) use ($newtopic, $previousTime) {
                    if ($previousTime != null) {
                        if ($newtopic['time'] <= $previousTime) {
                            $validator->getMessageBag()->add('time_topic', "Le programme doit être trié dans l'ordre chronologique.");
                        }
                    }
                });
                if ($validator->fails()) {
                    $messages = $validator->messages();
                    return redirect('admin/newEvent')->withInput()->withErrors($messages);
                }
                $previousTime = $newtopic['time'];
            }

            DB::beginTransaction();

            try {

                if ($createNewLocation) {
                    $newLocation = new Location;
                    $newLocation->city = $request->city;
                    $newLocation->street = $request->street;
                    $newLocation->street_number = $request->street_number;
                    $newLocation->zip_code = $request->zip_code;
                    $newLocation->building = $request->building;

                    $newLocation->save();
                }

                $location = Location::where('city', $newLocation['city'])
                    ->where('street', $newLocation['street'])
                    ->where('zip_code', $newLocation['zip_code'])
                    ->where('street_number', $newLocation['street_number'])
                    ->where('building', $newLocation['building'])
                    ->first();

                $createEvent = new Event;
                $createEvent->location_id = $location['id'];
                $createEvent->type = $request->typeEvent;
                $createEvent->name = $request->name;
                $createEvent->description = $request->description;
                $createEvent->image = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $request->name) . "-" . time() . "." . $newImage->getClientOriginalExtension();
                $createEvent->date = $request->date;
                $createEvent->date_show_end = Carbon::createFromDate($createEvent->date)->add(10, 'day');

                $createEvent->save();

                $event = Event::where('name', $createEvent->name)
                    ->where('description', $createEvent->description)
                    ->where('date', $createEvent->date)
                    ->first();

                $fileArray = array('image' => $newImage);

                $rules = array(
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2097152',
                );
                $validator = Validator::make($fileArray, $rules);
                if ($validator->fails()) {

                    $validator->getMessageBag()->add('image_upload', "La taille ou le format de l'image n'est pas valide.");
                    $messages = $validator->messages();
                    DB::rollback();
                    return redirect('admin/newEvent')->withInput()->withErrors($messages);
                }

                $filename = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $request->name)
                    . "-" . time() . "." .
                    $newImage->getClientOriginalExtension();
                $storagePath = public_path('img/events/');

                Image::make($newImage->getRealPath())->resize(1150, 420)->save($storagePath . '/' . $filename, 100);

                if ($request->document_1 != null) {
                    for ($i = 1; $i <= $request->docCount; $i++) {

                        $document = "document_" . $i;
                        $fileArray = array('document' => $request->$document);

                        $rules = array(
                            'document' => 'nullable|max:8388608'
                        );
                        $validator = Validator::make($fileArray, $rules);
                        dd($fileArray);
                        if ($validator->fails()) {
                            $messages = $validator->messages();
                            DB::rollback();
                            return redirect('admin/newEvent')->withInput()->withErrors($messages);
                        }
                        $request->$document->move(public_path('docs/events'), $request->$document->getClientOriginalName());

                        $newDocument = new Document;
                        $newDocument->name = $request->$document->getClientOriginalName();

                        $newDocument->save();

                        $newDocument->events()->save($event);
                    }
                }


                foreach ($newtopics as $newtopic) {

                    $createTopic = new Topic;

                    $createTopic->event_id = $event->id;
                    $createTopic->time = $newtopic['time'];
                    $createTopic->title = $newtopic['title'];
                    $createTopic->speaker = $newtopic['speaker'];
                    $createTopic->description = $newtopic['description'];

                    $createTopic->save();
                }

                $validator = Event::getValidation($newEvent, false);
                if (!$validator->fails()) {
                    $validator->getMessageBag()->add('OK', "OK");
                    $messages = $validator->messages();
                    DB::commit();
                    return redirect('admin/newEvent')->withInput()->withErrors($messages);
                }
                DB::rollback();
            } catch (\Exception $e) {
                DB::rollback();
                return redirect('admin/newEvent')->withInput()->withErrors($e);
            }
        }
    }

    /**
     * modify a event
     *
     *
     */
    public function modifyEvent(Request $request, $id)
    {
        if (Auth::User()->is_admin == false) {
            return view('errors/404');
        } else {

            $oldEvent = Event::find($id);

            $newEvent['name'] = $request->name;
            $newEvent['description'] = $request->description;
            $newEvent['date'] = $request->date;
            $newEvent['type'] = $request->typeEvent;
            if ($request->image != null) {
                $newImage = $request->image;
                $newEvent['image'] = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $request->name) . "-" . $request->date . "." . $newImage->getClientOriginalExtension();
            }

            $newLocation['city'] = $request->city;
            $newLocation['zip_code'] = $request->zip_code;
            $newLocation['street'] = $request->street;
            $newLocation['street_number'] = $request->street_number;
            $newLocation['building'] = $request->building;

            $newtopics = array();

            for ($i = 1; $i <= $request->topicNumber; $i++) {
                $time = "time_topic_" . $i;
                $title = "title_topic_" . $i;
                $speaker = "speaker_topic_" . $i;
                $description = "description_topic_" . $i;
                if (substr_count($request->$time, ":") == 1) {
                    $newtopic['time'] = $request->$time . ":00";
                } else {
                    $newtopic['time'] = $request->$time;
                }
                $newtopic['title'] = $request->$title;
                $newtopic['speaker'] = $request->$speaker;
                $newtopic['description'] = $request->$description;
                $newtopics[] = $newtopic;
            }

            $oldLocation = Location::find($oldEvent->location_id);

            $validator = Location::getValidation($newLocation);
            if ($validator->fails()) {
                $messages = $validator->messages();
                return redirect('admin/modifyEvent/' . $oldEvent->id . '')->withInput()->withErrors($messages);
            }

            $validator = Event::getValidation($newEvent, false);
            if ($validator->fails()) {
                $messages = $validator->messages();
                return redirect('admin/modifyEvent/' . $oldEvent->id . '')->withInput()->withErrors($messages);
            }
            $previousTime = null;
            foreach ($newtopics as $newtopic) {

                $validator = Topic::getValidation($newtopic);
                $validator->after(function ($validator) use ($newtopic, $previousTime) {
                    if ($previousTime != null) {
                        if ($newtopic['time'] <= $previousTime) {
                            $validator->getMessageBag()->add('time_topic', "Le programme doit être trié dans l'ordre chronologique.");
                        }
                    }
                });
                if ($validator->fails()) {
                    $messages = $validator->messages();

                    return redirect('admin/modifyEvent/' . $oldEvent->id . '')->withInput()->withErrors($messages);
                }
                $previousTime = $newtopic['time'];
            }



            DB::beginTransaction();

            try {

                $oldLocation->city = $request->city;
                $oldLocation->street = $request->street;
                $oldLocation->street_number = $request->street_number;
                $oldLocation->zip_code = $request->zip_code;
                $oldLocation->building = $request->building;

                $oldLocation->save();

                $location = Location::where('city', $newLocation['city'])
                    ->where('street', $newLocation['street'])
                    ->where('zip_code', $newLocation['zip_code'])
                    ->where('street_number', $newLocation['street_number'])
                    ->where('building', $newLocation['building'])
                    ->first();

                $oldEvent->location_id = $location['id'];
                $oldEvent->type = $request->typeEvent;
                $oldEvent->name = $request->name;
                $oldEvent->description = $request->description;
                if ($request->image != null) {
                    $oldImage = $oldEvent->image;
                    $oldEvent->image = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $request->name) . "-" . time() . "." . $newImage->getClientOriginalExtension();
                }
                $oldEvent->date = $request->date;
                $oldEvent->date_show_end = Carbon::createFromDate($oldEvent->date)->add(10, 'day');

                $oldEvent->save();

                $event = Event::where('name', $oldEvent->name)
                    ->where('description', $oldEvent->description)
                    ->where('date', $oldEvent->date)
                    ->first();

                if ($request->image != null) {

                    $fileArray = array('image' => $newImage);

                    $rules = array(
                        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2097152',
                    );
                    $validator = Validator::make($fileArray, $rules);
                    if ($validator->fails()) {
                        $validator->getMessageBag()->add('image_upload', "La taille ou le format de l'image n'est pas valide.");
                        $messages = $validator->messages();
                        DB::rollback();
                        return redirect('admin/modifyEvent/' . $oldEvent->id . '')->withInput()->withErrors($messages);
                    }

                    $filename = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $request->name)
                        . "-" . time() . "." .
                        $newImage->getClientOriginalExtension();
                    $storagePath = public_path('img/events/');

                    Image::make($newImage->getRealPath())->resize(1150, 420)->save($storagePath . '/' . $filename, 100);

                    File::delete(public_path() . '/img/events/' . $oldImage);
                }

                if ($request->delDoc_1 == '1') {

                    $oldDocument = Event::with('documents')->where('id', '=', $oldEvent->id)->get();
                    $docToDelete = Document::find($oldDocument[0]->documents[0]->id);
                    File::delete(public_path() . '/docs/events/' . $docToDelete->name . '');
                    Document::destroy($docToDelete->id);
                }

                if ($request->delDoc_2 == '1') {
                    $oldDocument = Event::with('documents')->where('id', '=', $oldEvent->id)->get();
                    $docToDelete = Document::find($oldDocument[0]->documents[1]->id);
                    File::delete(public_path() . '/docs/events/' . $docToDelete->name . '');
                    Document::destroy($docToDelete->id);
                }

                if ($request->delDoc_3 == '1') {
                    $oldDocument = Event::with('documents')->where('id', '=', $oldEvent->id)->get();
                    $docToDelete = Document::find($oldDocument[0]->documents[2]->id);
                    File::delete(public_path() . '/docs/events/' . $docToDelete->name . '');
                    Document::destroy($docToDelete->id);
                }

                if ($request->delDoc_4 == '1') {
                    $oldDocument = Event::with('documents')->where('id', '=', $oldEvent->id)->get();
                    $docToDelete = Document::find($oldDocument[0]->documents[3]->id);
                    File::delete(public_path() . '/docs/events/' . $docToDelete->name . '');
                    Document::destroy($docToDelete->id);
                }

                if ($request->delDoc_5 == '1') {
                    $oldDocument = Event::with('documents')->where('id', '=', $oldEvent->id)->get();
                    $docToDelete = Document::find($oldDocument[0]->documents[4]->id);
                    File::delete(public_path() . '/docs/events/' . $docToDelete->name . '');
                    Document::destroy($docToDelete->id);
                }

                if ($request->document_1 != null) {
                    for ($i = 1; $i <= $request->docCount; $i++) {

                        $document = "document_" . $i;
                        $fileArray = array('document' => $request->$document);

                        $rules = array(
                            'document' => 'nullable|max:8388608'
                        );
                        $validator = Validator::make($fileArray, $rules);
                        if ($validator->fails()) {
                            $messages = $validator->messages();

                            DB::rollback();
                            return redirect('admin/modifyEvent/' . $oldEvent->id . '')->withInput()->withErrors($messages);
                        }
                        $request->$document->move(public_path('docs/events'), $request->$document->getClientOriginalName());

                        $newDocument = new Document;
                        $newDocument->name = $request->$document->getClientOriginalName();

                        $newDocument->save();

                        $newDocument->events()->save($event);
                    }
                }

                $oldTopics = Topic::where('event_id', $id)->get();
                if (count($oldTopics) > count($newtopics)) {
                    $i = 0;
                    foreach ($newtopics as $newtopic) {

                        $oldTopic = $oldTopics[$i];
                        $oldTopic->event_id = $event->id;
                        $oldTopic->time = $newtopic['time'];
                        $oldTopic->title = $newtopic['title'];
                        $oldTopic->speaker = $newtopic['speaker'];
                        $oldTopic->description = $newtopic['description'];

                        $oldTopic->save();
                        $i++;
                    }
                    for ($i; $i < count($oldTopics); $i++) {
                        Topic::destroy($oldTopics[$i]->id);
                    }
                } elseif (count($oldTopics) == count($newtopics)) {
                    $i = 0;
                    foreach ($newtopics as $newtopic) {

                        $oldTopic = $oldTopics[$i];
                        $oldTopic->event_id = $event->id;
                        $oldTopic->time = $newtopic['time'];
                        $oldTopic->title = $newtopic['title'];
                        $oldTopic->speaker = $newtopic['speaker'];
                        $oldTopic->description = $newtopic['description'];

                        $oldTopic->save();
                        $i++;
                    }
                } else {
                    for ($i = 0; $i < count($oldTopics); $i++) {
                        $oldTopic = $oldTopics[$i];
                        $oldTopic->event_id = $event->id;
                        $oldTopic->time = $newtopics[$i]['time'];
                        $oldTopic->title = $newtopics[$i]['title'];
                        $oldTopic->speaker = $newtopics[$i]['speaker'];
                        $oldTopic->description = $newtopics[$i]['description'];

                        $oldTopic->save();
                    }
                    for ($i; $i < count($newtopics); $i++) {

                        $createTopic = new Topic;

                        $createTopic['event_id'] = $event->id;
                        $createTopic['time'] = $newtopics[$i]['time'];
                        $createTopic['title'] = $newtopics[$i]['title'];
                        $createTopic['speaker'] = $newtopics[$i]['speaker'];
                        $createTopic['description'] = $newtopics[$i]['description'];

                        $createTopic->save();
                    }
                }

                $validator = Event::getValidation($newEvent, false);
                if (!$validator->fails()) {
                    $validator->getMessageBag()->add('OK', "OK");
                    $messages = $validator->messages();
                    DB::commit();
                    return redirect('admin/modifyEvent/' . $oldEvent->id . '')->withInput()->withErrors($messages);
                }
                DB::rollback();
            } catch (\Exception $e) {
                DB::rollback();
                return redirect('admin/modifyEvent/' . $oldEvent->id . '')->withInput()->withErrors($e);
            }
        }
    }
}
