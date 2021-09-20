<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use App\Product;
use Illuminate\Http\Request;
use PDF;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->hasRole('اداري')){
            return view('admin.orders.index')->with('orders',Order::orderBy('id', 'DESC')->get());
        }else{
            return view('admin.orders.index')->with('orders',Order::where('user_id',auth()->id())->orderBy('id', 'DESC')->get());
        }

    }
    

    public function generate_pdf($id)
	{
        $order = Order::find(decrypt($id));
		$data = [
			'id' => $order->id
		];
		$pdf = PDF::loadView('admin.pdf.invoise', $data);
        
		return $pdf->stream('document.pdf');
	}
    
    
    public function update_order_detle(Request $request){
        $orders = OrderDetail::whereIn('id',explode(",",$request->ids))->get();
        
        foreach($orders as $order ){
            $order->status = 1 ;
            $changeO=Order::find($order->order_id);
            $changeO->status=1;
            $changeO->save();
           $product = Product::find($order->product_id);
           $product->stock -= $order->qty;
           $product->save();
            $order->save();
        }

        return response()->json(['status'=>true,'message'=>"تم تغير الحالة بنجاح"]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       if(count(session('cart')) > 0){
           
           $order = new Order();
           $order->code = date('Ymd-His').rand(10,99);
           $order->user_id = auth()->id();
           $order->save();
        foreach(session('cart') as $id => $details){
            $orderDet = new OrderDetail();
            $orderDet->order_id = $order->id;
            $orderDet->product_id = $id;
            $orderDet->qty = $details['quantity'];
            $orderDet->note = $details['note'];

        if($orderDet->save()){
            Session()->forget('cart');
        }
        session()->flash('success', 'تم إرسال الطلبية بنجاح');
    }
    }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order=Order::find(decrypt($id));
        if(auth()->user()->hasRole('اداري')){
            $order->view = 1;
            $order->save();
        }
        return view('admin.orders.show')->with('order',$order);
    }
    public function update_delevry(Request $request)
    {
        $id = $request->id;
        $order=Order::find($id);
        // if(auth()->user()->hasRole('اداري')){
            $order->status = 2;
            $order->save();
        // }
        return response()->json(['status'=>true,'message'=>"تم تغير الحالة بنجاح"]);
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }
    public function updatetable($id){
        $order=Order::find($id);
        return view('admin.orders._show')->with('order',$order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
