<?php
if (! function_exists('getstatus')) {
    function getstatus($product_id) {
    if(@session()->get('cart')[$product_id] == null){
        return 0;
    }else{
        return 1;
    }   
}
}
if(! function_exists('getStatusForOrder')){
    function getStatusForOrder($order){
        $status = $order->status;
        if($status == 0){
            return   '<span class="label l-bg-cyan shadow-style">قيد الانتظار</span>';
        }elseif($status == 1){
            return   '<span class="label l-bg-purple shadow-style">جاري التوصيل </span>';
        }elseif($status == 2){
            return   '<span class="label l-bg-blue shadow-style">تم الاستلام  </span>';
        }
    }
}