<?php

namespace App\Http\Controllers;
use App\Models\partner;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Imports\PartnersImport;
use Maatwebsite\Excel\Facades\Excel;

class PartnerController extends Controller
{
     public function index()
{
    $partners = Partner::all();
    return view('partner.index', compact('partners'));
}   
    public function create(){
      $companies = Company::all();
      return view("partner.create", compact('companies'));
    }
      
    public function store() 
    {
      partner::create([
        "name"        => request()->name,
        "company_id" => request()->company_id,
        "comment"       => request()->comment,
        "address"       => request()->address,
        "city"     => request()->city,
        "state"    => request()->state,
        "country"    => request()->country,
        "zip"    => request()->zip,
        'title'      => request()->title,
        "email"    => request()->email,
        "phone"    => request()->phone,
        "tax_code"    => request()->tax_code,
        "party_type"    => request()->party_type,
    ]);

    return redirect("/partner");  }

     
public function edit($id)
{   
    
    $partners = partner::findOrFail($id);
    return view('partner.edit', compact('partners'));
} 


 public function update($id) 
{ 
    $partner = Partner::findOrFail($id);

    $partner->name = request()->name;
    $partner->company_id = request()->company_id;
    $partner->comment = request()->comment;
    $partner->address = request()->address;
    $partner->city = request()->city;
    $partner->state = request()->state;
    $partner->country = request()->country;
    $partner->zip = request()->zip;
    $partner->title = request()->title;
    $partner->email = request()->email;
    $partner->phone = request()->phone;
    $partner->tax_code = request()->tax_code;
    $partner->party_type = request()->party_type;

    $partner->save();

    return redirect("/partner");
}



public function destroy($id)
{
    $partner = partner::findOrFail($id);
    $partner->delete();

    return redirect("/partner");
}

 public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls'
        ]);

        Excel::import(new PartnersImport, $request->file('file'));

        return back()->with('success', 'Partners imported successfully!');
    }


}
