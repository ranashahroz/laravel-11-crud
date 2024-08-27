<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(){

        $products = Product::orderBy('created_at', 'DESC')->get();

            return view('products.list', [
                'products' => $products
            ]);
    }

    public function create(){
        return view('products.create');

    }

    public function store(Request $request){

        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'numeric'

        ];

        if($request->image != ""){
            $rules['image'] = 'image';
        }


         $validator = Validator::make($request->all(),$rules);

         if($validator->fails()){

            return redirect()->route('products.create')->withInput()->withErrors( $validator );
         }

         $product = new Product();
         $product->name = $request->name;
         $product->sku = $request->sku;
         $product->price = $request->price;
         $product->description = $request->description;
         $product->save();

         if($request->image != ""){
           

         $image = $request->image;
         $ext = $image->getClientOriginalExtension();
         $imageName = time().'.'.$ext;

         $image->move(public_path('uploads/products'), $imageName);

         $product->image = $imageName;
         $product->save();
         
        }



         return redirect()->route('products.index')->with('success','Product added successfully.');
    }

    public function edit($id){
        $product = Product::findOrFail($id);
        return view('products.edit', [
            'product' => $product
        ]);        

    }

    public function update($id, Request $request){
        $product = Product::findOrFail($id);

        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'numeric'

        ];

        if($request->image != ""){
            $rules['image'] = 'image';
        }


         $validator = Validator::make($request->all(),$rules);

         if($validator->fails()){

            return redirect()->route('products.edit', $product->id )->withInput()->withErrors( $validator );
         }

         $product->name = $request->name;
         $product->sku = $request->sku;
         $product->price = $request->price;
         $product->description = $request->description;
         $product->save();

         if($request->image != ""){
            
            File::delete(public_path('uploads/products/'.$product->image));

         $image = $request->image;
         $ext = $image->getClientOriginalExtension();
         $imageName = time().'.'.$ext;

         $image->move(public_path('uploads/products'), $imageName);

         $product->image = $imageName;
         $product->save();
         
        }



         return redirect()->route('products.index')->with('success','Product updated successfully.');

    }

    public function destroy($id){

        $product = Product::findOrFail($id);


        File::delete(public_path('uploads/products/'.$product->image));

        $product->delete();

         return redirect()->route('products.index')->with('success','Product deleted successfully.');


    }
}