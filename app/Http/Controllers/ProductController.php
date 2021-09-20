<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        if(auth()->user()->hasRole('اداري')){
            return view('admin.products.index')->with('products',Product::get());
        }else{
            return view('admin.products.index')->with('products',Product::where('user_id',auth()->id())->get());

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
   
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
       
        $rules = [
            'name'=>'required',
            'stock'=>'required',
    ];
    if(auth()->user()->hasRole('اداري')){
       
        $rules = [ 'price'=>'required'];

    }
 
    $customMessages = [
         'name.required' => 'اسم المستخدم مطلوب',
         'price.required' => 'السعر  مطلوب',
         'stock.required' => 'الكمية  مطلوب',
    ];
 
    $this->validate($request, $rules, $customMessages);
    
    $request_all = $request->all();
    if($request->has('image')){
        $images = $request->image;
     
        $file = array();
        foreach($images as $key=>$image){
            $upload = $image->store('products');
            $file[$key] = $upload;
        }
        $request_all['image']= json_encode($file);
    }
    else{
        $request_all['image']= '["products/product.png"]';
    }
    $request_all['user_id'] = auth()->id();
    if(!auth()->user()->hasRole('اداري')){
        $request_all['price'] = 0;
    }
    // dd($request_all);
    Product::Create($request_all);
    if(!auth()->user()->hasRole('اداري')){
        return redirect()->route('all_item')->with(['success'=>'تم الاضافة  بنجاح']);
    }
    return redirect()->route('products.index')->with(['success'=>'تم الاضافة  بنجاح']);

    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function all_item(){
       $all_user = array();
       foreach(User::role('اداري')->get() as $key=>$user){
        array_push($all_user,$user->id);
       }
       array_push($all_user,auth()->id());

        if(auth()->user()->hasRole('اداري')){
            return view('admin.all_iteam')->with('products',Product::get());
        }else{
            return view('admin.all_iteam')->with('products',Product::whereIn('user_id',$all_user)->get());
        }
    }
    public function show($id)
    {
        $product = Product::find(decrypt($id));
        return view('admin.products.show')->with('product',$product);

    }
    public function create_product_fromuser(){
        return view('admin.products.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.products.edit')->with('product',Product::find(decrypt($id)));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
     
        $rules = [
            'name'=>'required',
            'price'=>'required',
            'stock'=>'required',
    ];
 
    $customMessages = [
         'name.required' => 'اسم المستخدم مطلوب',
         'price.required' => 'السعر  مطلوب',
         'stock.required' => 'الكمية  مطلوب',
        
    ];
 
    $this->validate($request, $rules, $customMessages);
    $request_all = $request->all();

    if($request->has('image')){
        $images = $request->image;
     
        $file = array();
        foreach($images as $key=>$image){
            $upload = $image->store('products');
            $file[$key] = $upload;
        }
        $request_all['image']= json_encode($file);
    }
    $request_all['user_id'] = auth()->id();
    $product->update($request_all);
    return redirect()->route('products.index')->with(['success'=>'تم التعديل  بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $cart = session()->get('cart');
            if(isset($cart[$product->id])) {
                unset($cart[$product->id]);
                session()->put('cart', $cart);
            }
        $product->delete();
        return redirect()->route('products.index')->with(['success'=>'تم الحذف  بنجاح']);
    }
}
