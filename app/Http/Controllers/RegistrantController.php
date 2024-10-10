<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegistrantRequest;
use App\Http\Requests\UpdateRegistrantRequest;
use App\Models\Registrant;
use chillerlan\QRCode\QRCode;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use function Termwind\render;

class RegistrantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registrants = Registrant::all();
        return Inertia::render('Registrants', ['registrants' => $registrants]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('EditRegistrant');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRegistrantRequest $request)
    {
        $registrant = new Registrant();
        $registrant->fill($request->toArray());
        $registrant->save();

        return to_route('registrations.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Registrant $registrant, $request)
    {
       $r = $registrant::find($request);
       // Since we are printing the badge,
       // lets set check them in.
       if ($r) {
        $r->checked_in = 1;
        $r->save();
       }

       $url = "https://reecesupply.com";
       $qrCode = (new QRCode())->render($url);

        return Inertia::render('PrintRegistrant', ['registrant' => $r, 'qrcode' => $qrCode]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Registrant $registrant)
    {
        return Inertia::render('EditRegistrant', ['registrant' => $registrant]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRegistrantRequest $request, Registrant $registrant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Registrant $registrant)
    {
        //
    }
}
