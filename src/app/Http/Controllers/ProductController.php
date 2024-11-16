<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Models\ProductSeason;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(6);
        return view('index', compact('products'));
    }
    
    public function search(Request $request)
    {
        $products = Product::Search($request->search)->paginate(6);
        return view('index', compact('products'));
    }
    public function register()
    {
        $seasons = Season::all();
        return view('register', compact('seasons'));
    }

    public function store(StoreRequest $request)
    {
        $image = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('image', $image, 'public');

        $product = [
            'name' => $request->name,
            'price' => $request->price,
            'image' => $image,
            'description' => $request->description,
        ];
        Product::create($product);

        foreach($request->input('seasons') as $season){
            $product_season = [
                'product_id' => Product::latest('id')->first()->id,
                'season_id' => $season,
            ];
            ProductSeason::create($product_season);
        }

        return redirect('/');
    }

    public function detail(Request $request)
    {
        $product = Product::with('season')->find($request->id);
        $seasons = Season::all();
        return view('detail', compact('product', 'seasons'));
    }

    public function update(UpdateRequest $request)
    {
        $image = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('image', $image, 'public');
        $update = [
                'name' => $request->name,
                'price' => $request->price,
                'image' => $image,
                'description' => $request->description,
            ];
        Product::find($request->id)->update($update);

        ProductSeason::where('product_id', $request->id)->delete();
        foreach($request->input('seasons') as $season){
            $product_season = [
                'product_id' => $request->id,
                'season_id' => $season,
            ];
            ProductSeason::create($product_season);
        }
        return redirect('/');
    }

    public function delete(Request $request)
    {
        Product::find($request->id)->delete();
        return redirect('/');
    }
}
