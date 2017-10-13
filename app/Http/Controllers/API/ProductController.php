<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product;

class ProductController extends Controller
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->product->all();

        return response()->json(['data' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validate = validator($data, $this->product->rules());
        if($validate->fails()){
            $messages = $validate->messages();
            return response()->json(['validate.error', $messages]);
        }

        $insert = $this->product->create($data);
        if(!$insert)
            return response()->json(['error' => 'error_insert'], 500);

        return response()->json($insert);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->product->find($id);
        if(!$product)
            return response()->json(['error' => 'product_not_found']);

        return response()->json(['data' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validate = validator($data, $this->product->rules($id));
        if($validate->fails()){
            $messages = $validate->messages();
            return response()->json(['validate.error', $messages]);
        }

        $product = $this->product->find($id);
        if(!$product)
            return response()->json(['error' => 'product_not_found']);

        $update = $product->update($data);
        if(!$update)
            return response()->json(['error' => 'product_not_updated'], 500);

        return response()->json(['response' => $update]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->product->find($id);
        if(!$product)
            return response()->json(['error' => 'product_not_found']);

        $delete = $product->delete();
        if(!$delete)
            return response()->json(['error' => 'product_not_deleted'], 500);

        return response()->json(['response' => $delete]);
    }
}
