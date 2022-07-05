<?php

namespace App\Http\Controllers;

use \App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Firebase\JWT\JWK;
use Firebase\JWT\JWT;
use App\Models\Broadcast;
use PDF;

class PageController extends Controller
{
    public function home()
    {
        $announcements = \App\Models\Announcement::where('is_active', 1)->take(5)->orderBy('created_at', 'DESC')->get();
        $schedules = \App\Models\Schedule::where('is_active', 1)->
            where("start_at",">",date('Y-m-d h:i:s'))->take(3)->orderBy('start_at', 'ASC')->get();
        return view('pages.home', [
            'announcements' => $announcements,
            'schedules' => $schedules
        ]);
    }
    
    public function about()
    {
        return view('pages.about', []);
    }

    public function announcement(Request $request)
    {
        $obj = new \App\Models\Announcement();
        $filters = $request->query('filters');
        $filters['is_active'] = 1;
        $page = $request->query('page');
        $sort = [];
        $sort_q = $request->query('sort');
        if($sort_q) {
            $sort_q = explode('-', $sort_q);
            $sort['sort_name'] = $sort_q[0];
            $sort['sort_type'] = 'desc';
        }

        if($filters)
            $obj->fill($filters);

        $sort['sort_name'] = 'id';//$sort_q[0];
        $sort['sort_type'] = 'desc';//$sort_q[1];

        $announcements = $obj->filter($filters, [
            'pagination' => true,
            'page' => $page,
            'sort' => $sort
        ]);

        return view('pages.annoucement', [
            'announcements' => $announcements,
        ]);
    }

    public function gallery(Request $request)
    {
        $obj = new \App\Models\Gallery();
        $sliders = \App\Models\Gallery::where([
            'is_active' => 1,
            'is_slider' => 1
        ])->get();

        $filters = $request->query('filters');
        $filters['is_active'] = 1;
        $filters['is_slider'] = 0;
        $page = $request->query('page');
        $sort = [];
        $sort_q = $request->query('sort');
        if($sort_q) {
            $sort_q = explode('-', $sort_q);
            $sort['sort_name'] = $sort_q[0];
            $sort['sort_type'] = 'desc';
        }

        if($filters)
            $obj->fill($filters);

        $sort['sort_name'] = 'id';//$sort_q[0];
        $sort['sort_type'] = 'asc';//$sort_q[1];

        $galleries = $obj->filter($filters, [
            'pagination' => false,
            'page' => $page,
            'sort' => $sort
        ]);

        return view('pages.gallery', [
            'galleries' => $galleries,
            'sliders' => $sliders,
        ]);
    }

    public function contact()
    {
        return view('pages.contact', []);
    }

    public function contactPost(Request $request)
    {
        $data = $request->all();
        $contact = new \App\Models\Contact();
        $validator = $contact->register($data);

        if($validator === true) {
            return redirect()->back()
                ->with('success', 'contact-success');
        }

        return redirect()
        ->back()
        ->with('error', 'contact-error')
        ->withInput($data)
        ->withErrors($validator);
    }

    public function scheduleApply(Request $request)
    {
        $data = $request->all();
        $schedule = \App\Models\Schedule::find($request['id']);
        $validator = $schedule->apply($data);

        if($validator === true) {
            return redirect()->back()
                ->with('success', 'schedule-apply-success');
        }

        return redirect()
            ->back()
            ->with('error', $validator)
            ->withInput($data)
            ->withErrors($validator);
    }
    
    public function schedule()
    {
        return view('pages.schedule', []);
    }

    public function scheduleDetail(Request $request)
    {
        $schedule = \App\Models\Schedule::find($request['id']);
        $result = $schedule->isAllowedToApply();
        if (!$result) {
            return redirect()
            ->back()
            ->with('error', '会員だけのスケジュール');
        }
        
        $scheduleDetail = $schedule->details;
        $scheduleDetails = \App\Models\Schedule::formatFullCalendar($scheduleDetail, false);

        return view('pages.schedule-detail', [
            'schedule' => $schedule,
            'scheduleDetails' => $scheduleDetails
        ]);
    }
}