<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\produk;
use DB;

class produkcontroller extends Controller
{
    public function index()
    {
        $products = produk::get();
        $genders = produk::select('gender')->groupBy('gender')->get();
        $brands = produk::select('brand')->groupBy('brand')->get();
        $categories = produk::select('category')->groupBy('category')->get();
        $maxPrice = produk::select('price')->max('price');
        $minPrice = produk::select('price')->min('price');
        return view('produk.index',compact(['brands','genders','categories','maxPrice','minPrice','products']));
        
    }

    public function filter(Request $request)
    {
        if($request->ajax())
        {
            $products= produk::where('quantity','>',0);
            $query = json_decode($request->get('query'));
            $price = json_decode($request->get('price'));
            $gender = json_decode($request->get('gender'));
            $brand = json_decode($request->get('brand'));
            
            if(!empty($query))
            {
                $products= $products->where('name','like','%'.$query.'%');        
            }
            if(!empty($price))
            {
                $products= $products->where('price','<=',$price);
            }
            if(!empty($gender))
            {
                $products= $products->whereIn('gender',$gender);
            }   
            if(!empty($brand))
            {
                $products= $products->whereIn('brand',$brand);
            }
            $products=$products->get();
            

            $total_row = $products->count();
            if($total_row>0)
            {
                $output ='';
                foreach($products as $product)
                {
                    $output .='
                    <div class="col-lg-4 col-md-6 col-sm-12 pt-3">
                        <div class="card">
                            <a href="product/'.$product->id.'">
                                <div class="card-body ">
                                    <div class="product-info">
                                    
                                    <div class="info-1"><img src="'.asset('/storage/'.$product->image).'" alt=""></div>
                                    <div class="info-4"><h5>'.$product->brand.'</h5></div>
                                    <div class="info-2"><h4>'.$product->name.'</h4></div>
                                    <div class="info-3"><h5>RM '.$product->price.'</h5></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                    </div>
                    ';
                }
            }
            else
            {
                $output='
                <div class="col-lg-4 col-md-6 col-sm-6 pt-3">
                    <h4>No Data Found</h4>
                </div>
                ';
            }
            $data = array(
                'table_data'    =>$output
            );
            echo json_encode($data);
        
        }
    }

    public function show(produk $produk)
    {   
               
        $produk = produk::where($produk->id)
        ->get([
               'name',
               'quantity',
               'image',
               'brand',
           ]);
            return view('produk.show',compact('produk'));    
        
    }

    public function upload(){
		$produk = produk::get();
		return view('produk.upload',['produk' => $produk]);
	}

	public function proses_upload(Request $request){
		$this->validate($request, [
			'image' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required',
            'brand' => 'required',
            'price' => 'required',
            'gender' => 'required',
            'category' => 'required',
            'quantity' => 'required',
		]);

		// menyimpan data file yang diupload ke variabel $file
		$file = $request->file('image');

		$nama_file = time()."_".$file->getClientOriginalName();

      	        // isi dengan nama folder tempat kemana file diupload
		$tujuan_upload = 'data_file';
		$file->move($tujuan_upload,$nama_file);

		produk::create([
			'image' => $nama_file,
            'name' => $request->name,
            'brand' => $request->brand,
            'price' => $request->price,
            'gender' => $request->gender,
            'category' => $request->category,
            'quantity' => $request->quantity,
		]);

		return redirect()->back();
	}
}
