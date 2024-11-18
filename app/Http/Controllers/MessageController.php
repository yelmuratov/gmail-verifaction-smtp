<?php

namespace App\Http\Controllers;

use App\Mail\EmailMessage;
use App\Models\User;
use App\Models\ValidationCode;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, User $user)
    {
        // dd($user,$request->all());
        Mail::to($user->email)->send(new EmailMessage($request->all()));
        return back();
    }

    public static function sendCode($id, $data)
    {
        $user = User::find($id);
        Mail::to($user->email)->send(new EmailMessage($data));
    }


    public function verify(){
        return view('mail.code_verify');
    }

    public function verify_code(Request $request)
    {
        // Check if the provided code matches the stored verification code
        $validationCode = ValidationCode::where('user_id', auth()->user()->id)->first();
    
        if ($validationCode && $validationCode->code == $request->code) {
            // Update the email_verified_at field
            auth()->user()->update(['email_verified_at' => now()]);
    
            // Refresh the user instance to ensure the update is reflected
            auth()->user()->refresh();
    
            // Delete the verification code after successful verification
            $validationCode->delete();
    
            return redirect()->route('user.index')->with('success', 'Your email has been successfully verified!');
        } else {
            return redirect()->back()->with('error', 'Invalid verification code.');
        }
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    public function users(){
        $users = User::all();    
        // dd($users);    
        return view('main',['users'=>$users]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
