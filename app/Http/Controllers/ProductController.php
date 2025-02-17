<?php

namespace App\Http\Controllers;
use App\Models\CategoryProduct;
use App\Models\Products;
use App\Models\StatusProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function index(){
        $products = Products::with('CategoryProduct')->inRandomOrder();

        if(request('search')){
            $products->where('nm_products', 'like', '%'. request('search') . '%' )
            ->orWhere('price', 'like', '%' . request('search'));
        }
        return view('products.products', ['title' => 'All products', 'products' => $products->paginate('12')]);
    }

    public function show(Products $product){
        // $product = Products::get

        return view('products.post',
        ['title' => $product->nm_products,
        'product' => $product]);
    }

    public function detail($id){
        if(auth()->guest()){
            return redirect('/');
        }
        if(auth()->user()->is_admin == 0){
            abort(404);
        }
        $product = Products::findOrFail($id);
        $title = $product->nm_products;
        return view('d.products.show', compact('title', 'product'));
    }

    public function dashboardindex(){
        if(auth()->guest()){
            return redirect('/');
        }
        if(auth()->user()->is_admin == 0){
            abort(404);
        }
        $products = Products::with('CategoryProduct')->orderby('id', 'desc')->get();

        if(request('search')){
            $products->where('nm_products', 'like', '%'. request('search') . '%' )
            ->orWhere('price', 'like', '%' . request('search'))->orWhere('id', 'like' , '%' . request('search'));
        }
// dd($products);
        return view('d.products.index', ['products' => $products, 'title' => 'Product']);
    }

    public function create(Request $request)
    {
        if(auth()->guest()){
            return redirect('/');
        }
        if(auth()->user()->is_admin == 0){
            abort(404);
        }
        $categoryproduct = CategoryProduct::all();
        $products = Products::all();
        return view('d.products.create', ['products' => $products,  'title' => 'Buat data Products', 'categoryproduct' => $categoryproduct]);
        products::create($request->all());
        return redirect('/dashboard/product')->with('success', 'Data products Berhasil Dibuat');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nm_products' => 'required',
            'category_products_id' => 'required',
            'quantity' => 'required',
            'deskripsi' => 'nullable',
            'price' => 'required',
            'slug' => 'nullable',
            'image' => 'nullable|image|file|max:3072'
        ]);

        if($request->file('image')){
            $image = $validatedData['image'] = $request->file('image')->store('product-images', 'public');
        }

        Products::create([
            'nm_products' => $request->nm_products,
            'category_products_id' => $request->category_products_id,
            'quantity' => $request->quantity,
            'deskripsi' => $request->deskripsi,
            'price' => $request->price,
            'slug' => Str::slug($request->nm_products),
            'image' => $image
        ]);
        return redirect('/dashboard/product')->with('success', 'Data products Berhasil Dibuat');
    }

    public function edit($id)
    {
        if(auth()->guest()){
            return redirect('/');
        }
        if(auth()->user()->is_admin == 0){
            abort(404);
        }
        $product = Products::findOrFail($id);
    return view('d.products.edit', ['product'=> $product, 'title' => 'Edit data products', 'categoryproduct' => CategoryProduct::all()]);

    }
    public function update(Request $request, $id)
    {
        $product = Products::findOrFail($id);
        $product->update($request->all());
        return redirect('/dashboard/product')->with('success','Product  Berhasil di Perbarui');
    }

    public function delete($id){
        $product = Products::findOrFail($id);
        $product->delete($product);
        return redirect('/dashboard/product')->with('success','Product Sukses Di Dihapus');
    }

    public function updatequantity(Request $request){
        $status = new StatusProduct;
        // dd($status);
        $status->users_id = Auth::user()->id;
        $product = Products::where('id',$request->id)->first();
        $p = $request->id;
        $status->products_id = $p;
        $waktu = Carbon::now();
        $status->waktu = $waktu;
        // dd($waktu);
        // dd($status->waktu->diffForHumans());
        $sblm = $product->quantity;
        if($request->quantity > $sblm){
            $status->status = "Masuk";
            $ssdh = $product->quantity = $request->quantity;
            $status->jumlah = $ssdh - $sblm;
            $status->desc = "Update";
            $status->save();
            $product->update();
            // dd($status->waktu->diffForHumans());
        }
        elseif($request->quantity < $sblm){
            $status->status = "Barang keluar";
            $ssdh = $product->quantity = $request->quantity;
            $status->jumlah = $sblm - $ssdh;
            $status->save();
            $product->update();
        }
        else{
            return back();
        }
        return back()->with('success', 'Stock berhasil di update');
    }

}
