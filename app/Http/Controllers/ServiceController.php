<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Imports\ServicesImport;
use Maatwebsite\Excel\Facades\Excel;

class ServiceController extends Controller
{   
     public function index() 
    {
        $services = Service::simplePaginate(8);
        return view('services.index', compact('services'));
    }
     public function create(){
       return view("services.create");
    }

    public function store() 
    {
      Service::create([
        "name"        => request()->name,
        "description" => request()->description,
        "default_price"       => request()->default_price,
        "service_type"       => request()->service_type,
        "service_category"     => request()->service_category,
        "document_list"    => request()->document_list,
    ]);

    return redirect("/services");
}
  
public function edit($id)
{
    $services = Service::findOrFail($id); // Fetch the company
    return view('services.edit', compact('services'));
}
 public function update($id) 
{ 
    $services = Service::findOrFail($id);

    $services->name = request()->name;
    $services->description = request()->description;
    $services->default_price =request()->default_price;
    $services->service_type = request()->service_type;
    $services->service_category = request()->service_category;
    $services->document_list = request()->document_list;

    $services->save();

    return redirect("/services");
}
public function destroy($id)
{
    $services = Service::findOrFail($id);
    $services->delete();

    return redirect("/services");
}


public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,csv,xls'
    ]);

    Excel::import(new ServicesImport, $request->file('file'));

    return back()->with('success', 'Services imported successfully!');
}




}
