<?php

namespace Kajifat\SampleProducts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('SampleProducts::index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Product::class);
        return view('SampleProducts::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Product::class);

        $this->validate($request, [
            'art' => 'required|unique:products|regex:/^[[:alnum:]]+$/',
            'name' => 'required|min:10'
        ]);

        $product = new Product();
        $product->name = $request->get('name');
        $product->art = $request->get('art');
        $product->save();

        return redirect('products');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', Product::class);
        
        $product = Product::findOrFail($id);
        return view('SampleProducts::edit', compact('product'));
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
        $this->authorize('update', Product::class);
        if (Auth::user()->can('update_art', Product::class)){
            $this->validate($request, [
                'art' => 'required|regex:/^[0-9a-zA-Z]+$/|unique:products,art,'.$id,
                'name' => 'required|min:10'
            ]);
            $this->updateProduct($request->all(), $id);
        }else{
            $this->validate($request, [
                'name' => 'required|min:10'
            ]);
            $this->updateProduct($request->only('name'), $id);
        }

        return redirect(route('products.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Product::class);
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect(route('products.index'));
    }

    /**
     * Update product in storage
     *
     * @param array $data
     * @param $id
     */
    protected function updateProduct(array $data, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($data);
    }
}
