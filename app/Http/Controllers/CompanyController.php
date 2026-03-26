<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request; 
use App\Models\Company;
use App\Models\Orderdetail;

class CompanyController extends Controller
{
   public function index() 
    {
        $companies = Company::simplepaginate(8);
        return view('company.index', compact('companies'));
    }

    public function create(){ 
       return view("company.create");
    }

    public function list() {
        
    }

    public function store() 
    {
      Company::create([
        "name"        => request()->name,
        "create_date" => request()->create_date,
        "email"       => request()->email,
        "phone"       => request()->phone,
        "address"     => request()->address,
        "tax_code"    => request()->tax_code,
    ]);

    return redirect("/company");
}

        
  
public function edit($id)
{
    $company = Company::findOrFail($id); // Fetch the company
    return view('company.edit', compact('company'));
}

public function update($id){
     $company = Company::find($id);
     $company->name = request()->name;
     $company->create_date = request()->create_date;
     $company->email = request()->email;
     $company->phone = request()->phone;
     $company->address = request()->address;
     $company->tax_code = request()->tax_code;
     $company->save();
     
      Company::create([
        "name"        => request()->name,
        "create_date" => request()->create_date,
        "email"       => request()->email,
        "phone"       => request()->phone,
        "address"     => request()->address,
        "tax_code"    => request()->tax_code,
    ]);

    return redirect("/company");



}

public function destroy($id)
{
    $company = Company::findOrFail($id);
    $company->delete();

    return redirect("/company");
}

  /*public function destroy($id) {
        $company = Company::find($id);
        $company->delete();
        return redirect("/company");

    }*/

  
}
