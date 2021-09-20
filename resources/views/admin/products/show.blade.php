@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    
    <div class="block-header">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <ul class="breadcrumb breadcrumb-style ">
                    <li class="breadcrumb-item">
                        <h4 class="page-title">معلومات المنتج</h4>
                    </li>
                    <li class="breadcrumb-item bcrumb-1">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-home"></i> الرئيسية</a>
                    </li>
                    <li class="breadcrumb-item bcrumb-2">
                        <a href="{{ route('all_item') }}" >المنتجات</a>
                    </li>
                    <li class="breadcrumb-item active">معلومات المنتج</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
                    
                    <div class="card-body ">
                        <div class="product-store">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                    <div class="product-gallery">
                                        <div class="product-gallery-thumbnails">
                                            <ol class="thumbnails-list list-unstyled">
                                             
                                                
                                                @foreach (json_decode($product->image) as $item)
                                                   
                                               
                                                <li><img src="{{ asset('uploads/'.$item) }}" alt=""></li>
                                                @endforeach
                                                
                                            </ol>
                                        </div>
                                        <div class="product-gallery-featured">
                                            @foreach (json_decode($product->image) as $item)
                                                   
                                            @if($loop->first)   
                                           
                                                <img src="{{ asset('uploads/'.$item) }}" alt="">
                                            
                                            @endif
                                            @endforeach                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                    <div class="product-payment-details">
                                        <h4 class="product-title mb-2">{{ $product->name }} </h4>
                                        @if(auth()->user()->hasRole('اداري'))
                                        <h2 class="product-price display-4">OM {{ $product->price }}</h2>
                                  
                                    
                                        <p><i class="fas fa-cart-plus"></i> الكمية المتوفرة : <strong>{{ $product->stock }}</strong> </p>
                                        @endif
                                    
                                        
                                        {{-- <a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a> --}}
                                        @if( getstatus( $product->id ) == 0 )
                                <input class="btn btn-warning addToCart"   type="button" product_id="{{ $product->id }}" value="اضف الى السلة" >
                                @else
                                <input class="btn btn-info addToCart" disabled  type="button" product_id="{{ $product->id }}" value="تمت الاضافة" >
                        @endif
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs tab-nav-right" role="tablist">
                   
                    <li role="presentation">
                        <a href="#profile" data-bs-toggle="tab">وصف العنصر</a>
                    </li>
                   
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                
                    <div role="tabpanel" class="tab-pane fade active show" id="profile">
                        <div class="product-description">
                         @if($product->description != null)
                            {!! $product->description !!}
                            @else
                            لا يوجد وصف لهذا العنصر
                            @endif
                        </div>
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection
@section('script')
<script src="{{ asset('assets/js/pages/ecommerce/product-detail.js') }}"></script>
@section('script')

<script>
    
        function updateNavCart(){
            $.post('{{ route('updateNavCart') }}', {"_token": "{{csrf_token()}}"}, function(data){
                $('#cart_items').html(data);
            });
        }
   
    $( document ).ready(function() {
        $(".addToCart").click(function(){
            var id = $(this).attr('product_id');
            var thisContext = this;

            $.ajax({
        type: "post",
        dataType: "json",
        url: '{{ route('add.to.cart') }}',
        data: { "_token": "{{csrf_token()}}",'product_id':id }, 
        success: function (data) {
                       $(thisContext).val("تمت الاضافة");  
                       $( thisContext ).removeClass( "btn-warning" ).addClass( "btn-info" );
                       $( thisContext ).attr('disabled', 'disabled');

                   

                 
                          
                        
            updateNavCart();
          }      
        
    });          
        });
       


        
});
</script>
@endsection
@endsection