<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Partner;
use App\Models\Service;
use App\Models\Detail;
use Illuminate\Http\Request;
use App\Imports\OrdersImport;
use Maatwebsite\Excel\Facades\Excel;

use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{   

  //  public function index(){
        
   //     $orders = Order::simplePaginate(7);
   //     return view('order_header.index', compact('orders'));

    //}

    public function index(){
    $orders = Order::with('details.service')->simplePaginate(7);
    return view('order_header.index', compact('orders'));
     }
     



    public function create()
{
    $partners = Partner::all();
    $services = Service::all();
    return view('order_header.create', compact('partners','services'));
}

  /* public function store()
{
    $order = Order::create([
        "order_date"     => request()->order_date,
        "partner_id"     => request()->partner_id, 
        "partner_name"   =>  request()->partnername,
        "amount_total"   => request()->amount_total,
        "invoice_status" => request()->invoice_status,
        "order_number"   => request()->order_number,
        "user_id"        => request()->user_id,     
    ]);

    $orderId = $order->id; 

    // Fetch arrays with correct names
    $services   = request()->input('service_id', []);
    $quantities = request()->input('quantities', []);
    $prices     = request()->input('prices', []);
    $totals     = request()->input('total', []);
    $remarks    = request()->input('remarks', []);

    for ($i = 0; $i < count($services); $i++) {
        if (!empty($services[$i])) {
            Detail::create([
                'order_id'   => $orderId, 
                'service_id' => $services[$i],
                'quantity'   => $quantities[$i] ?? 0,
                'price'      => $prices[$i] ?? 0,
                'total'      => $totals[$i] ?? (($quantities[$i] ?? 0) * ($prices[$i] ?? 0)),
                'remarks'    => $remarks[$i] ?? null,
            ]);
        }
    }

    return redirect("/order_header")->with('success', 'Order saved successfully!');   
}*/
public function store(Request $request)
{
    $partner = Partner::find($request->partner_id);

    $order = Order::create([
        "order_date"     => $request->order_date,
        "partner_id"     => $partner->id,
        "partnername"    => $partner->name, // now storing name too
        "amount_total"   => $request->amount_total,
        "invoice_status" => $request->invoice_status,
        "order_number"   => $request->order_number,
        "user_id"        => $request->user_id,     
    ]);

    $orderId = $order->id; 

    // Details insert loop
    $services   = $request->input('service_id', []);
    $quantities = $request->input('quantities', []);
    $prices     = $request->input('prices', []);
    $totals     = $request->input('total', []);
    $remarks    = $request->input('remarks', []);

    for ($i = 0; $i < count($services); $i++) {
        if (!empty($services[$i])) {
            Detail::create([
                'order_id'   => $orderId, 
                'service_id' => $services[$i],
                'quantity'   => $quantities[$i] ?? 0,
                'price'      => $prices[$i] ?? 0,
                'total'      => $totals[$i] ?? (($quantities[$i] ?? 0) * ($prices[$i] ?? 0)),
                'remarks'    => $remarks[$i] ?? null,
            ]);
        }
    }

    return redirect("/order_header")->with('success', 'Order saved successfully!');   
}




    public function edit($id)
{   
    $partners = Partner::all();
    $services = Service::all();
    $orders = Order::findOrFail($id); // Fetch the company
    return view('order_header.edit', compact('orders','partners','services'));
}


 public function update($id, Request $request) 
{  
    $orders = Order::findOrFail($id);

    $orders->order_date = $request->order_date;
    $orders->partner_id = $request->partner_id;
    $orders->amount_total = $request->amount_total;
    $orders->invoice_status = $request->invoice_status;
    $orders->order_number = $request->order_number;
    $orders->user_id = $request->user_id;
    $orders->save();

   
    \DB::table('order_details')->where('order_id', $id)->delete();

    $partnerIds = $request->input('partner_id_detail', []);
    $serviceIds = $request->input('service_id_detail', []);
    $quantity = $request->input('quantities', []);
    $price = $request->input('prices', []);
    $remarks = $request->input('remarks', []);

    for ($i = 0; $i < count($partnerIds); $i++) {
        \DB::table('order_details')->insert([
            'order_id'   => $id,  
            'partner_id' => $partnerIds[$i],
            'service_id' => $serviceIds[$i],
            'quantity'   => $quantities[$i] ?? 0,
            'price'      => $prices[$i] ?? 0,
            'total'      => ($quantities[$i] ?? 0) * ($prices[$i] ?? 0),
            'remarks'    => $remarks[$i] ?? null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    return redirect("/order_header");
}


public function destroy($id)
{
    $orders = Order::findOrFail($id);
    $orders->delete();

    return redirect("/order_header");
}

public function show($id)
    {
        
        $order = Order::with('details')->findOrFail($id);

        return view('order_header.show', compact('order'));
    }


     public function downloadPDF($id)
    {
        $order = Order::with('details')->findOrFail($id);

        $pdf = Pdf::loadView('order_header.pdf', compact('order'));

       
        return $pdf->download('order_'.$order->id.'.pdf');

    }


public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,csv,xls'
    ]);

    Excel::import(new OrdersImport, $request->file('file'));

    return back()->with('success', 'Orders imported successfully!');
}


}
