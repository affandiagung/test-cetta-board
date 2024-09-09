<?php

namespace App\Http\Controllers;

use Hamcrest\Arrays\IsArray;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class SensorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!Session::has('api_token')) {
            return redirect('/login');
        }
        $token = Session::get('api_token');

        $responseSensor = Http::withHeaders([
            'Accept' => '*/*',
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
        ])->get(config('app.be_url') . 'sensor', []);


        $data['sensors'] = ($responseSensor->json());
        return view('sensors.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Session::has('api_token')) {
            return redirect('/login');
        }
        $token = Session::get('api_token');

        $response = Http::withHeaders([
            'Accept' => '*/*',
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
        ])->post(config('app.be_url') . 'sensor', [
            "tanggal" => $request->tanggal,
            "sensorPM25" => (float)$request->sensorPM25,
            "sensorPM10" => (float)$request->sensorPM10,
            "sensorO3" => (float)$request->sensorO3,
            "sensorUVI" => (float)$request->sensorUVI
        ]);

        $jsonBody = $response->json();

        if ($response->successful()) {
            if ($jsonBody['statusCode'] != 201) {
                return redirect()->back()->with('error',  $jsonBody['message']);
            }
            return redirect()->back()->with('success',  $jsonBody['message']);
        }

        $errorMessage = $jsonBody['message'] ?? 'An error occurred';
        return redirect()->route('create')
            ->withInput()
            ->with('error', $errorMessage);
    }

    public function show(string $id) {}

    public function sync()
    {
        if (!Session::has('api_token')) {
            return redirect('/login');
        }
        $token = Session::get('api_token');

        $responseSync = Http::withHeaders([
            'Accept' => '*/*',
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
        ])->post(config('app.be_url') . 'sensor/sync', []);


        if ($responseSync->failed()) {
            if (is_array($responseSync->json()['message'])) {
                $message = $responseSync->json()['message'][0];
            } else {
                $message = $responseSync->json()['message'];
            }

            return redirect()->back()->with('error', $message);
        }


        return redirect()->back()->with('success', 'Success Synchronize Data');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Session::has('api_token')) {
            return redirect('/login');
        }
        $token = Session::get('api_token');

        $sensorO3 = (float)$request->sensorO3;
        $sensorPM10 = (float) $request->sensorPM10;
        $sensorPM25 = (float) $request->sensorPM25;
        $sensorUVI = (float) $request->sensorUVI;


        $responseUpdate = Http::withHeaders([
            'Accept' => '*/*',
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
        ])->put(config('app.be_url') . 'sensor/' . $id, [
            "sensorO3" => $sensorO3,
            "sensorPM10" => $sensorPM10,
            "sensorPM25" => $sensorPM25,
            "sensorUVI" => $sensorUVI,

        ]);

        if ($responseUpdate->failed()) {
            if (is_array($responseUpdate->json()['message'])) {

                $message = $responseUpdate->json()['message'][0];
            } else {
                $message = $responseUpdate->json()['message'];
            }

            return redirect()->back()->with('error', $message);
        }


        return redirect()->back()->with('success', 'Data Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $token = Session::get('api_token');

        $responseDestroy = Http::withHeaders([
            'Accept' => '*/*',
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
        ])->delete(config('app.be_url') . 'sensor/' . $id);


        if ($responseDestroy->failed()) {
            return redirect()->back()->with('error', 'Gagal menghapus data');
        }

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
