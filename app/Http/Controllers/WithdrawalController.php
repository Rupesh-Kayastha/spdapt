<?php

namespace App\Http\Controllers;
use App\User;
use App\Models\Transaction;

use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    public function userWithdrawal()
    {
        $userId =  auth()->id(); // Get the authenticated user's ID
  
      $withdwawals = Transaction::where('user_id', $userId)
      ->where('type','DR')
      ->orderBy('id', 'desc')
       ->paginate(20);
        return view('frontend.withdrawal.index',compact('withdwawals'));
    }

    public function userWithdrawalcreate()
    {
        return view('frontend.withdrawal.create');
    }

    public function userwithdrawaladd(Request $request)
    {
       // Validate the request data
       $validatedData = $request->validate([
           'amount' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
           'purpose' => 'required',
       ]);

       // Get the authenticated user's ID
       $userId = auth()->id();

       // Prepare data for insertion
       $data = [
           'amount' => $validatedData['amount'],
           'payon' => 'admin',
           'payment_id' => $userId,
           'purpose' => $validatedData['purpose'],
           'user_id' => $userId, 
           'status' => '0',
           'type' => 'DR', 
       ];

       $status = Transaction::create($data);

       
       if ($status) {
           request()->session()->flash('success', 'Withdrawal successfully added');
       } else {
           request()->session()->flash('error', 'Error occurred while adding Withdrawal');
       }

      
       return redirect()->route('user.withdrawal.index');
   }
}
