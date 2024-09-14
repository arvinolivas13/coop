<?php

namespace App\Http\Controllers;

use Auth;
use App\Members;
use App\ShareCapital;
use App\Transactions;
use Illuminate\Http\Request;

class ShareCapitalController extends Controller
{

    public function get($id)
    {
        $rows = ShareCapital::where('member_id', $id)->get();
        $total = $rows->count();
        $sum_total = ShareCapital::where('member_id', $id)->sum('amount');
        
        $record = Members::with('beneficiaries')->where('id', $id)->orderBy('id')->first();

        return response()->json([
            'total' => $total,
            'rows' => $rows,
            'sum' => $sum_total,
            'record' => $record
        ]);
    }

    public function save(Request $request)
    {
        $validate = $request->validate([
            'date' => ['required'],
            'amount' => ['required'],
            'receipt_number' => ['required']
        ]);

        $balance = ShareCapital::where('member_id', $request->member_id)->sum('amount');

        $request['balance'] = $balance + $request->amount;
        $request['deleted_at'] = null;
        $request['created_by'] = Auth::user()->id;
        $request['updated_by'] = Auth::user()->id;

        $record = ShareCapital::create($request->all());
        
        $transaction = array(
            "member_id" => $request->member_id,
            "date" => $request->date,
            "particulars" => "Share Capital",
            "amount" => $request->amount,
            "status" => "new"
        );

        Transactions::create($transaction);

        return response()->json(compact('validate'));
    }

    public function edit($id)
    {
        $record = ShareCapital::where('id', $id)->orderBy('id')->first();
        return response()->json(compact('record'));
    }


    public function update(Request $request, $id)
    {
        $old = ShareCapital::where("id", $id)->first();
        $balance = ShareCapital::where('member_id', $request->member_id)->sum('amount') - $old->amount;
        $request['balance'] = $balance + $request->amount;

        ShareCapital::find($id)->update($request->all());
        
        $transaction = array(
            "member_id" => $request->member_id,
            "date" => $request->date,
            "particulars" => "Share Capital",
            "amount" => $request->amount,
            "status" => "new"
        );

        Transactions::where("member_id", $old->member_id)->where("particulars", "Share Capital")->where("date", $old->date)->where("amount", $old->amount)->update($transaction);

        return response()->json();
    }

    public function destroy($id)
    {
        $old = ShareCapital::where("id", $id)->first();
        $record = ShareCapital::find($id);
        $record->delete();
        
        Transactions::where("member_id", $old->member_id)->where("particulars", "Share Capital")->where("date", $old->date)->where("amount", $old->amount)->delete();

        return response()->json();
    }
}
