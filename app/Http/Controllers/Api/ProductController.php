<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Transformers\ProductTransformer;
use App\Transformers\TransformerManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
class ProductController extends Controller
{

    protected $response = [];
	protected $response_code;
	// protected $guard = 'products';
    // protected $format;


    public function __construct(Product $product){
		$this->response = array(
			"msg" => "Bad Request.",
			"status" => FALSE,
			'status_code' => "BAD_REQUEST"
			);
		$this->response_code = 400;
		$this->transformer = new TransformerManager;
        $this->products = $product;
	}
    
    public function index(Request $request , $format = null){

        $per_page = $request->get('per_page',10);
        $this->data['keyword'] = addslashes($request->keyword);
        $this->data['price'] = $request->price;

        $query = Product::where(function($query){
                                        if(strlen($this->data['keyword']) > 0){
                                            return $query->whereRaw("LOWER(name) LIKE '%{$this->data['keyword']}%'")
                                                        ->orWhereRaw("LOWER(description) LIKE '%{$this->data['keyword']}%'");

                                        }
                                    });

                if(!empty($this->data['price']) || $this->data['price'] != null)
                {
                $record = $query->orderByRaw('CAST(price as DECIMAL(8,2))'. $this->data['price'])->paginate($per_page);
                }else{
                $record = $query->paginate($per_page);
                }

        $this->response['status'] = TRUE;
        $this->response['status_code'] = "201";
        $this->response['msg'] = "List of products.";
        $this->response['has_morepages'] = $record->hasMorePages();
        $this->response['total'] = $record->total();
        $this->response['total_page'] = $record->lastPage();
        $this->response['data'] = $this->transformer->transform($record, new ProductTransformer,'collection');
        $this->response_code = 200;


        switch(Str::lower($format)){
            case 'json' :
                return response()->json($this->response, $this->response_code);
            break;
            case 'xml' :
                return response()->xml($this->response, $this->response_code);
            break;
        }
    }

    public function show(Request $request , $format = null){
        $product = Product::where('id',$request->id)->first();
            if(isset($product)){
                $this->response['status'] = TRUE;
                $this->response['status_code'] = "201";
                $this->response['msg'] = "Product information.";
                $this->response['data'] = $this->transformer->transform($product,new ProductTransformer,'item');
                $this->response_code = 200;
   
                goto callback;
            }

            $this->response['status'] = FALSE;
            $this->response['status_code'] = "404";
            $this->response['msg'] = "Error there is no product";
            $this->response_code = 404;
            callback:
        switch(Str::lower($format)){
            case 'json' :
                return response()->json($this->response, $this->response_code);
            break;
            case 'xml' :
                return response()->xml($this->response, $this->response_code);
            break;
        }
    }

    public function store(ProductRequest $request , $format = null){
   
        DB::beginTransaction();
        try{
     
         $data = [
             'name' => $request->name,
             'description' => $request->description,
             'price' => $request->price,
         ];
    
      
         $data = Product::create($data);
            
            DB::commit();
     
            $this->response['status'] = TRUE;
            $this->response['status_code'] = "201";
            $this->response['msg'] = "Your Product was successfully submitted.";
            $this->response_code = 201;
       
        }catch(\Exception $e){
            DB::rollback();
            Log::info("ERROR: ", array($e));
            $this->response['status'] = FALSE;
            $this->response['status_code'] = "SERVER_ERROR";
            $this->response['msg'] = "Server error : {$e->getMessage()}";
            $this->response_code = 500;
          
         
        }
 
        switch(Str::lower($format)){
            case 'json' :
                return response()->json($this->response, $this->response_code);
            break;
            case 'xml' :
                return response()->xml($this->response, $this->response_code);
            break;
        }
    }

    public function destroy(Request $request, $format = null){
        DB::beginTransaction();
        try{
     
            $product = Product::findOrFail($request->id);
            $product->delete();

            DB::commit();
     
            $this->response['status'] = TRUE;
            $this->response['status_code'] = "201";
            $this->response['msg'] = "Your Product was successfully Deleted.";
            $this->response_code = 201;
       
        }catch(\Exception $e){
            DB::rollback();
            Log::info("ERROR: ", array($e));
            $this->response['status'] = FALSE;
            $this->response['status_code'] = "SERVER_ERROR";
            $this->response['msg'] = "Server error : {$e->getMessage()}";
            $this->response_code = 500;
          
         
        }
 
        switch(Str::lower($format)){
            case 'json' :
                return response()->json($this->response, $this->response_code);
            break;
            case 'xml' :
                return response()->xml($this->response, $this->response_code);
            break;
        }
    }
}
