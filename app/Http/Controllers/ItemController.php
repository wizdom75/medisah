<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role === 'Superadmin') {
            return view('items.index', [
                'items' => Item::orderBy('id', 'DESC')->paginate(10),
            ]); 
        }
        return view('items.index', [
            'items' => Item::where('merchant_id', auth()->user()->merchant_id)->orderBy('id', 'DESC')->paginate(10),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'integer',
            'description' => 'max:2550',
            'gtin' => 'max:255',
            'sku' => 'max:255',
            'unit' => 'max:255',
            'price' => 'numeric',
            'cost' => 'numeric',
            'stock' => 'integer',
        ]);
        $validated['merchant_id'] = auth()->user()->merchant_id ?? null;
        $validated['price'] = $request->input('price') * 100;
        $validated['cost'] = $request->input('cost') * 100;
        Item::create($validated);
        return back()->with('success', 'Item created');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'integer',
            'description' => 'max:2550',
            'gtin' => 'max:255',
            'sku' => 'max:255',
            'unit' => 'max:255',
            'price' => 'numeric',
            'cost' => 'numeric',
            'stock' => 'integer',
        ]);
        $validated['price'] = $request->input('price') * 100;
        $validated['cost'] = $request->input('cost') * 100;

        $item->update($validated);
        return back()->with('success', 'Item updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return back()->with('success', 'Item deleted');
    }

    public function search($term)
    {
        if ($term === 'default') {
            return Item::all();
        }
        return Item::where('name','LIKE','%'.$term.'%')
                ->orWhere('gtin','LIKE','%'.$term.'%')
                ->orWhere('sku','LIKE','%'.$term.'%')
                ->orWhere('description','LIKE','%'.$term.'%')
                ->get();
    }

    public function confirm(Request $request)
    {
        
        $data = json_decode(file_get_contents('php://input'));
        $items = json_decode($data->items);
        $user = json_decode($data->authUser);
        $value = 0;

        foreach ($items as $prod) {
            $value += $prod->price;
        }

        Sale::create([
                    'merchant_id' => $user->merchant_id,
                    'user_id' => $user->id,
                    'value' => $value,
                    'items' => serialize($items),
                    'status' => 'delivered'
        ]);
        try {
            foreach ($items as $item) {
                $item = Item::find($item->id);
               
                $item->stock = $item->stock - 1;
    
                $item->save();
            }

            return json_encode(['message' => 'Checkout successfully confirmed']);

        } catch (Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }

    }
}
