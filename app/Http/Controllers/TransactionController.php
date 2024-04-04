<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::where(['status'=>"0", 'type'=>"CR"])->with('user_info')->get();
        return view('backend.recharge.index')->with('transactions',$transactions);
    }

    public function rechargeapprove(Request $request)
    {
        $transactions = Transaction::where(['status'=>"1", 'type'=>"CR"])->with('user_info')->get();
        return view('backend.recharge.rechargeapprove')->with('transactions',$transactions);
    }

    public function withdrawal()
    {
        $transactions = Transaction::where(['status'=>"0", 'type'=>"DR"])->with('user_info')->get();
        return view('backend.recharge.withdrawal')->with('transactions',$transactions);
    }

    public function withdrawalapprove(Request $request)
    {
        $transactions = Transaction::where(['status'=>"1", 'type'=>"DR"])->with('user_info')->get();
        return view('backend.recharge.withdrawalapprove')->with('transactions',$transactions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function approve(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        $transaction->status = "1";
        $transaction->save();

        return redirect()->back()->with('success', 'Transaction approved successfully.');
    }

    public function reject($id)
    {
        $transaction = Transaction::find($id);
        $transaction->status = "2";
        $transaction->save();

        return redirect()->back()->with('success', 'Transaction rejected successfully.');
    }
}
