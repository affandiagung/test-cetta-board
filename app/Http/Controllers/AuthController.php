<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Session::has('api_token')) {
            return redirect('/');
        }
        return view('login');
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');



        $response = Http::post(config('app.be_url') . 'auth/login', [
            'email' => $username,
            'password' => $password,
        ]);



        if ($response->successful() && $response['statusCode'] == 200) {
            $token = $response->json();

            $request->session()->put('api_token', $token['data']['accessToken']);
            $request->session()->put('user', $token['data']['user']['name']);
            return redirect('/sensors');
        }


        return redirect()->back()->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        Session::invalidate();
        Session::regenerateToken();

        return redirect('/sensors');
    }

    public function register(Request $request)
    {
        if (!Session::has('api_token')) {
            return redirect('/login');
        }
        $token = Session::get('api_token');

        $name = $request->name;
        $username = $request->username;
        $password = $request->password;
        $status = $request->status;
        $email = $request->email;
        $phone = $request->phone;
        $roleId = $request->roleId;

        $responseUpdate = Http::withHeaders([
            'Accept' => '*/*',
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
        ])->post(config('app.be_url') . 'users', [
            "username" => $username,
            "name" => $name,
            "password" => $password,
            "status" => $status,
            "email" => $email,
            "phone" => $phone,
            "roleId" => $roleId
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

    public function update(Request $request)
    {
        if (!Session::has('api_token')) {
            return redirect('/login');
        }
        $token = Session::get('api_token');

        $id = $request->editUserId;
        $name = $request->name;
        $username = $request->username;
        $password = $request->password;
        $status = $request->status;
        $email = $request->email;
        $phone = $request->phone;


        $responseUpdate = Http::withHeaders([
            'Accept' => '*/*',
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
        ])->patch(config('app.be_url') . 'users/' . $id, [
            "username" => $username,
            "name" => $name,
            ...($password ? ['password' => $password] : []),
            "email" => $email,
            "phone" => $phone,
            ...($status ? ['status' => $status] : []),
            // "roleId" => $roleId
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
}
