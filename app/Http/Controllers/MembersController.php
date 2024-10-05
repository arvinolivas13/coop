<?php

namespace App\Http\Controllers;

use Auth;
use App\Members;
use App\MemberDetails;
use App\MemberBeneficiary;
use App\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MembersController extends Controller
{
    
    public function index()
    {
        return view('admin.content.member');
    }

    public function get(Request $request)
    {
        $query = Members::with('beneficiaries', 'share_capital', 'savings');

        if ($search = $request->input('search')) {
            $query->whereRaw("CONCAT(firstname, ' ', middlename, ' ', lastname) LIKE ?", ["%{$search}%"]);
            $query->orWhereRaw("acc_no LIKE ?", ["%{$search}%"]);
            $query->orWhereRaw("email_address LIKE ?", ["%{$search}%"]);
            $query->orWhereRaw("mobile_no LIKE ?", ["%{$search}%"]);
            $query->orWhereRaw("address LIKE ?", ["%{$search}%"]);
            $query->orWhereRaw("status LIKE ?", ["%{$search}%"]);
        }
        
        $total = $query->count();
        $rows = $query->skip($request->input('offset'))->take($request->input('limit'))->get();

        return response()->json([
            'total' => $total,
            'rows' => $rows
        ]);
    }

    public function save(Request $request)
    {
        $validate = $request->validate([
            'lastname' => ['required'],
            'firstname' => ['required'],
            'address' => ['required'],
            'religion' => ['required'],
            'birthdate' => ['required'],
            'birthplace' => ['required'],
            'gender' => ['required'],
            'mobile_no' => ['required'],
            'email_address' => ['required'],
            'occupation' => ['required'],
            'civil_status' => ['required'],
            'mothers_name' => ['required'],
            'fathers_name' => ['required'],
            'company' => ['required'],
            'company_phone_no' => ['required'],
            'company_address' => ['required'],
            'source_of_income' => ['required'],
            'monthly_income' => ['required'],
            'contact_person' => ['required'],
            'contact_person_no' => ['required'],
            'contact_person_address' => ['required'],
            'status' => ['required'],
        ]);

        $request['deleted_at'] = null;
        $request['created_by'] = Auth::user()->id;
        $request['updated_by'] = Auth::user()->id;

        $record = Members::create($request->all());

        if($request->beneficiary) {
            foreach($request->beneficiary as $item) {
                $data = [
                    "member_id" => $record->id,
                    "name" => $item['name'],
                    "age" => $item['age'],
                    "relationship" => $item['relationship'],
                ];
    
                MemberBeneficiary::create($data);
            }
        }

        return response()->json(compact('validate'));
    }

    public function edit($id)
    {
        $record = Members::with('beneficiaries', 'details')->where('id', $id)->orderBy('id')->first();
        return response()->json(compact('record'));
    }


    public function update(Request $request, $id)
    {
        Members::find($id)->update($request->all());

        if($request->beneficiary) {
            foreach($request->beneficiary as $item) {
                $data = [
                    "member_id" => $id,
                    "name" => $item['name'],
                    "age" => $item['age'],
                    "relationship" => $item['relationship'],
                ];
    
                MemberBeneficiary::create($data);
            }
        }

        return response()->json();
    }

    public function destroy($id)
    {
        $record = Members::find($id);
        $record->delete();

        MemberBeneficiary::where('member_id', $id)->delete();

        return response()->json();
    }
    
    public function destroyBeneficiaries($id)
    {
        $record = MemberBeneficiary::find($id);
        $record->delete();
        

        return response()->json();
    }

    public function getMembersList(Request $request) {
        $query = Members::with('beneficiaries', 'share_capital', 'savings');

        if ($search = $request->input('search')) {
            $query->whereRaw("CONCAT(firstname, ' ', middlename, ' ', lastname) LIKE ?", ["%{$search}%"]);
            $query->orWhereRaw("email_address LIKE ?", ["%{$search}%"]);
            $query->orWhereRaw("mobile_no LIKE ?", ["%{$search}%"]);
            $query->orWhereRaw("address LIKE ?", ["%{$search}%"]);
            $query->orWhereRaw("status LIKE ?", ["%{$search}%"]);
        }
        
        $total = $query->count();
        $rows = $query->where('id', '!=', $request->id)->get();

        return response()->json([
            'total' => $total,
            'rows' => $rows
        ]);
    }
    
    public function saveDetails(Request $request)
    {
        $validate = $request->validate([
            'resolution_no' => ['required'],
            'or_no' => ['required'],
        ]);

        $photo = $request->input('photo');
        $signature = $request->input('signature');


        if($request->action === "save") {
            
            $data = array(
                "member_id" => $request->member_id,
                "photo" => $this->uploadPhoto($photo, 'photo'),
                "signature" => $this->uploadPhoto($signature, 'signature'),
                "valid_id" => null,
                "member_fee" => $request->member_fee,
                "approve" => 1,
                "approve_by" => Auth::user()->id,
                "or_no" => $request->or_no,
                "resolution_no" => $request->resolution_no,
                "date" => $request->date
            );

            $record = MemberDetails::create($data);
        }
        else {
            $details = MemberDetails::where('member_id', $request->member_id)->first();

            $data = array(
                "member_id" => $request->member_id,
                "photo" => $photo !== null?$this->uploadPhoto($photo, 'photo'):$details->photo,
                "signature" => $signature !== null?$this->uploadPhoto($signature, 'signature'):$details->signature,
                "valid_id" => null,
                "member_fee" => $request->member_fee,
                "approve" => 1,
                "approve_by" => Auth::user()->id,
                "or_no" => $request->or_no,
                "resolution_no" => $request->resolution_no,
                "date" => $request->date
            );

            $record = MemberDetails::where('member_id', $request->member_id)->update($data);
            
        }

        if($request->member_fee === "1") {
            $transaction = array(
                "member_id" => $request->member_id,
                "date" => $request->date,
                "particulars" => "Membership fee",
                "amount" => "200.00",
                "status" => "new"
            );
            
            if(Transactions::where('member_id', $request->member_id)->where('particulars', "Membership fee")->count() === 0) {
                Transactions::create($transaction);
            }
            else {
                Transactions::where('member_id', $request->member_id)->where('particulars', "Membership fee")->update($transaction);
            }
        }
        

        return response()->json(compact('validate'));
    }

    public function getDetails($id) {
        $details = MemberDetails::where('member_id', $id)->first();

        return response()->json(compact('details'));
    }

    public function uploadPhoto($file, $path_pref) {
        $r = null;
        if($file !== null) {
            if (preg_match('/^data:image\/(\w+);base64,/', $file, $type)) {
                $data = substr($file, strpos($file, ',') + 1);
                $type = strtolower($type[1]);
            } else {
                $data = $file;
                $type = 'bin';
            }

            $data = base64_decode($data);

            $fileName = uniqid() . '.' . $type;

            $filePath = 'public/'.$path_pref.'/' . $fileName;
            Storage::put($filePath, $data);
            $r = $fileName;
        }

        return $r;
    }
}
