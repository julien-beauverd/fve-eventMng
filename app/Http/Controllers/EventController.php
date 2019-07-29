<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Support\Facades\Auth;
use App\Location;
use Calendar;
use App\User;
use App\Document;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * Display the list of the events order by asc or desc
     * @param String $orderBy that has 'asc' or 'desc'
     * @return view eventList with all the informations
     */
    public function index($orderBy)
    {
        if ($orderBy == 'asc') {
            $events = Event::with('location', 'topics')->where('date_show_end', '>=', date('Y-m-d'))->orderBy('date', 'asc')->get();
        } else {
            $events = Event::with('location', 'topics')->where('date_show_end', '>=', date('Y-m-d'))->orderBy('date', 'desc')->get();
        }
        return view('eventList')->with(['events' => $events]);
    }

    /**
     * Display the calendar with all the events inside.
     *
     * @return View the calendar
     */
    public function calendar()
    {
        $events = [];
        $data = Event::with('location', 'topics')->where('date_show_end', '>=', date('Y-m-d'))->get();
        if ($data->count()) {
            foreach ($data as $key => $event) {
                $start = new \DateTime($event->date . " " . $event->topics[0]->time);
                $end = new \DateTime($event->date . " " . $event->topics[count($event->topics) - 1]->time);
                
                //assign the color of the event according to its type
                switch ($event->type) {

                    case 'grand-rdv':
                        $color = '#962404';
                        break;
                    case 'rdv-juridique':
                        $color = '#12437C';
                        break;
                    case 'rdv-formation':
                        $color = '#1EAFE6';
                        break;
                    case 'rencontres-entrepreneurs':
                        $color = '#E49D0A';
                        break;
                }
                $events[] = Calendar::event(

                    //assign the name, the start and the end with the topics
                    $event->name,
                    false,
                    $start->format(\DateTime::ATOM),
                    $end->format(\DateTime::ATOM),
                    null,
                    [
                        'color' => $color,
                        'url' => "/event/$event->id",
                    ]
                );
            }
        }

        //modify the height, the minimum time and the langage
        $calendar = Calendar::addEvents($events)->setOptions([
            'lang' => 'fr',
            'contentHeight' => 450,
            'minTime' => '08:00:00',
            
        ]);
        return view('eventCal', compact('calendar'));
    }

    /**
     * show the documentsToDownload page with all the informations
     * @return View documentsToDownload
     */
    public function documentsToDownload()
    {

        $docsToDownload = Document::where('doc_to_download', '=', true)->get();

        return view('documentsToDownload')->with(['docsToDownload' => $docsToDownload]);
    }


    /**
     * show the page myEvents with the events of the user
     * @param int the id of the user
     * @return View myEvents
     */
    public function myEvents($id)
    {
        //tests if the identifier is the same as the user who made the request
        if ($id != Auth::User()->id) {
            $events = null;
            $times = 0;
            return view('myEvents')->with(['events' => $events, 'times' => $times]);
        } else {
            $events = DB::select("SELECT e.image, e.id, e.date, e.name, l.street, l.street_number, l.zip_code, l.city, e.type FROM user_event AS ue
        INNER JOIN events AS e ON e.id = ue.event_id
        INNER JOIN locations AS l ON l.id = e.location_id
        WHERE ue.user_id = $id
        ORDER BY e.date DESC");

            $times = array();
            foreach ($events as $event) {
                $topic = Topic::where('event_id', $event->id)->first();
                array_push($times, $topic->time);
            }

            return view('myEvents')->with(['events' => $events, 'times' => $times]);
        }
    }

    /**
     * show a event with all the informations
     * @param int id of the event
     * @param boolean if the user participate or not
     * @return View of the event
     */
    public function show($id, $OK = null)
    {
        $event = Event::with('location', 'documents', 'users', 'topics')->where('id', '=', $id)->get();

        return view('event')->with(['event' => $event, 'OK' => $OK]);
    }
}
