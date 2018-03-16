<?php

namespace App\Http\Controllers\User;

use App\Country;
use App\EventsImage;
use App\UsersEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use File;
use App\EventApply;
use App\UsersEventsRegistationType;



class EventController extends Controller
{
   /* Authentication*/

    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /*add*/
    public function event()
    {
        /*fetch all country*/
        $countries = Country::orderBy('name','asc')->get();
        return view('users.event')->with([
            'countries' => $countries,
        ]);
    }

    /*save event1*/
    public function eventSave(Request $request)
    {


        $this->validate($request,[
            'event_title' => 'required',
            'description' => 'required',
            'venue' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'cover_image' => 'required|image|mimes:jpeg,jpg,png',

        ]);

        if($request->hasFile('cover_image'))
        {
            $file = $request->file('cover_image');
            $fileExtention = $file->getClientOriginalExtension();
            $file_name = str_random(10).'_event.'.$fileExtention;
            Storage::disk('public')->put('event/'.$file_name,File::get($request->file('cover_image')));

            $pathSave = 'storage/event/'.$file_name;

        }
      $slug = str_slug($request->event_title.'-'.str_random(10).rand(1111,9999));
        $usersEvent = UsersEvent::create([
            'slug' => $slug,
            'user_id' => Auth::id(),
            'event_title' => $request->event_title,
            'description' => $request->description,
            'venue' => $request->venue,
            'country_id' => $request->country,
            'state_id' => $request->state,
            'city_id' => $request->city,
            'cover_image' => $pathSave
        ]);

        $id = $usersEvent->id;
        /*image upload*/
        $files = Input::file('image');
        foreach ($files as $file) {
            // Validate each file
            $rules = array('file' => 'required|mimes:jpeg,jpg,bmp,png'); // 'required|mimes:png,gif,jpeg,txt,pdf,doc'
            $validator = Validator::make(array('file'=> $file), $rules);

            if($validator->passes()) {
                $destinationPath = 'photos/';
                $filename = str_random(12).$file->getClientOriginalName();
                $file->move($destinationPath, $filename);


                // upload image on data base
                $usersEvent = new EventsImage();
                $usersEvent->slug = str_slug(str_random(20).'-'.rand(1000,9999));
                $usersEvent->users_event_id = $id;
                $usersEvent->image = "photos/".$filename;
                $usersEvent->save();
            } else {
                // redirect back with errors.
                return Redirect::back()->withInput()->withErrors($validator);
            }

        }

        return redirect()->route('event2Add',$slug)->with('success','saved successfully be continue...');
    }

    public function event2(UsersEvent $usersEvent)
    {

        return view('users.event2',[
            'usersEvent' => $usersEvent
        ]);
    }

    /*save event2*/
    public function event2Save(UsersEvent $usersEvent , Request $request)
    {
           
       $message = [
           'datetimepicker.required' => 'The date field is required.',
           'datetimepicker.date' => 'The date is not a valid date.'
       ];

        $this->validate($request,[
            'datetimepicker' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'event_organizer' => 'required',
            'event_type' => 'required',
            'admission' => 'required',
            'price' => 'required|numeric',
            'event_type_name' => 'required',
            'reg_form' => 'required'
        ],$message);

       $userEvent = UsersEvent::where('id',$usersEvent->id)->update([
            'date' => $request->datetimepicker,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'event_organizer' => $request->event_organizer,
            'event_type' => $request->event_type,
            'admission' => $request->admission,
            'event_type_name' => $request->event_type_name,
            'price' => $request->price,
            'reg_from' => $request->reg_form,
            'reg_url' => $request->url,
        ]);

       $eventregistrationType = array();
            if ($request->competition_type != "free") {
                foreach ($request->early_bird_registration_type as $key => $value) {
                    $innerArray = [
                        'user_id' => Auth::id(),
                        'event_id' => $usersEvent->id,
                        'type' => $value,
                        'currency' => $request->early_bird_registration_currency[$key],
                        'amount' => $request->early_bird_registration_amount[$key],
                        'registration_type' => "early_bird"
                    ];

                    $eventregistrationType[] = $innerArray;
                }

                foreach ($request->advance_registration_type as $key => $value) {
                    $innerArray = [
                        'user_id' => Auth::id(),
                        'event_id' => $usersEvent->id,
                        'type' => $value,
                        'currency' => $request->advance_registration_currency[$key],
                        'amount' => $request->advance_registration_amount[$key],
                        'registration_type' => "advance"
                    ];

                    $eventregistrationType[] = $innerArray;
                }


                foreach ($request->last_minute_registration_type as $key => $value) {
                    $innerArray = [
                        'user_id' => Auth::id(),
                        'event_id' => $usersEvent->id,
                        'type' => $value,
                        'currency' => $request->last_minute_registration_currency[$key],
                        'amount' => $request->last_minute_registration_amount[$key],
                        'registration_type' => "last_minute"
                    ];

                    $eventregistrationType[] = $innerArray;
                }
                UsersEventsRegistationType::insert($eventregistrationType);
               
        }

        notify()->flash("Saved successfully.",'success');


        return redirect()->route('eventList')->with('success','saved successfully');
    }

    /*list of event*/

    public function eventList(Request $request)
    {
        $events = UsersEvent::latestFirst()->with('eventsImage.usersEvent')->get();


        return view('users.event-list',[
            'events' => $events
        ]);
    }

    public function eventDetail(UsersEvent $usersEvent)
    {

        $event = $usersEvent::with('eventsImage.usersEvent')->first();

        return view('users.event-detail')->with(
            ['event' =>$event ]
        );

    }
    public function eventApply(Request $request)
    {
        $eventExist = EventApply::where('user_id', Auth::id())
            ->count();
        if ($eventExist  <= 0) {
            $eventApply = EventApply::Insert([
                'user_id' => Auth::id(),
                'users_event_id' => $request->users_event_id,
                'created_at' => time(),
            ]);
            if ($eventApply) {
                $response['return'] = true;
                $response['message'] = "Applied successfully";
                return Response()->json($response, 200);
            } else {
                $response['return'] = false;
                return Response()->json($response, 200);
            }
        } else {
            $response['return'] = false;
            $response['message'] = "you already applied for this event";
            return Response()->json($response, 200);
        }
    }

    
    public function viewEventUser()
    {
        $eventUserList = EventApply::orderBy('id', 'desc')
            ->with('userEventDetail', 'user')->get();
        return view('users.partials.event-list', compact('eventUserList'));

    }
}
