<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegistrantRequest;
use App\Http\Requests\UpdateRegistrantRequest;
use App\Models\Registrant;
use Illuminate\Http\Request;
use chillerlan\QRCode\QRCode;
use Inertia\Inertia;

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

    public function fileUpload(Request $request)
    {
        // Validate the file input
        $request->validate([
            'file' => 'required|file|mimes:csv,txt|max:2048',  // Assuming CSV for simplicity
        ]);

        // Retrieve the file from the request
        $file = $request->file('file');

        // Open and read the file
        $fileData = file($file->getRealPath());

        // Parse the CSV or text data (assumes CSV in this example)
        foreach ($fileData as $key => $line) {
            if ($key === 0) continue;  // Skip header row if there's one

            // Example: Parse CSV data by splitting the line
            $row = str_getcsv($line);

            $first_name = $row[1];
            $last_name = $row[2];
            $company_name = $row[7];
            $company_email = $row[5];
            $company_phone = $row[8];

            // Use updateOrCreate to insert or update based on email
            Registrant::updateOrCreate(['company_email' => $company_email], ['first_name' => $first_name, 'last_name' => $last_name, 'company_name' => $company_name, 'company_phone' => $company_phone]);
        }

        return response()->json(['message' => 'File processed successfully and registrations saved.']);
    }


}
