<?php

namespace App\Http\Controllers;
use App\User;
use App\Models\Transaction;

use Illuminate\Http\Request;

class RechargeController extends Controller
{
    public function userRecharge()
   
    {
      $userId =  auth()->id(); // Get the authenticated user's ID
  
      $recharges = Transaction::where('user_id', $userId)
      ->where('type','CR')
      ->orderBy('id', 'desc')
       ->paginate(20);
  
      return view('frontend.recharge.index', compact('recharges'));
    }
   

   public function userRechargecreate()
   {
     return view('frontend.recharge.create');
   }

   public function userrechargeadd(Request $request)
    {
       // Validate the request data
       $validatedData = $request->validate([
           'amount' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
           'payon' => 'required|string|max:50',
           'payment_id' => 'required',
           'purpose' => 'required',
       ]);

       // Get the authenticated user's ID
       $userId = auth()->id();

       // Prepare data for insertion
       $data = [
           'amount' => $validatedData['amount'],
           'payon' => $validatedData['payon'],
           'payment_id' => $validatedData['payment_id'],
           'purpose' => $validatedData['purpose'],
           'user_id' => $userId, // Insert authenticated user's ID
           'status' => '0', // Set status to 0
           'type' => 'CR', // Insert type as 'cr'
       ];

       // Create a new transaction record
       $status = Transaction::create($data);

       // Check if transaction creation was successful
       if ($status) {
           request()->session()->flash('success', 'Recharge successfully added');
       } else {
           request()->session()->flash('error', 'Error occurred while adding Recharge');
       }

       // Redirect back to the recharge index page
       return redirect()->route('user.recharge.index');
   }
}
