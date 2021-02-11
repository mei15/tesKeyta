@extends('layouts.app')

@section ('content')
@foreach ($produk as $object)
<div class="container p-0 show">
   <div class="row sixtyvh">
        
       <div class="col-lg-8 col-sm-12 mb-3 show-picture">
       
            <img src="{{ url('/data_file/'.$object->image) }}" alt="">
        
       </div>
       
       <div class="col-lg-4 col-sm-12 pl-5 pr-5">
        <h6><strong>{{ $object-> brand}}</strong></h6>
        <h5>{{ $object->name }}</h5>
            <div class="card">
                <div class="card-body">
                    <div class="show-info">
                        <div class="info-1">
                            <h6>BUY NEW</h6>
                        </div>
                        <div class="info-2">
                            <select id="size-dropdown">
                                <option selected="true" value="nothing" disabled hidden>Pilih Ukuran</option>
                                
                            </select>
                        </div>
                        <div class="info-3">
                            <p>This product is pre-verified, and will be ready to ship instantly. Expedited shipping options will be available in checkout.
                            </p>
                        </div>
                        <a href="" id="add-to-cart" class="add-to-cart disabled">
                            <div class="info-4">
                                ADD TO CART
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
   </div>
</div>
@endforeach
@endsection