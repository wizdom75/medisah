<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    private $data;
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

    public function bulkStore(Request $request)
    {
        //Handle csv upload
        if($request->hasFile('csv_file')){
            $handle = fopen($request->file('csv_file'), 'r');

            $flag = true;
            while (($this->data = fgetcsv($handle, 0, ',')) !== FALSE){
                if($flag) { $flag = false; continue; }
    

                //Check if this exists in DB and update
                $item = Item::where('merchant_id', '=', auth()->user()->merchant_id)
                            ->where(function ($query) {
                                $query->where('gtin', '=', trim(@$this->data[2]))
                                ->orWhere('sku', '=', trim(@$this->data[3]));                            
                        })
                        ->first();

                if ($item) {
                    $item->price = trim(@$this->data[5]);
                    $item->cost = trim(@$this->data[6]);
                    $item->stock = trim(@$this->data[7]);
                    $item->price = @$item->price * 100;
                    $item->cost = @$item->cost * 100;
                    $item->save();
                } else {
                    $item = new Item;
                    $item->name = trim(@$this->data[0]);
                    $item->category_id = 0;
                    $item->merchant_id = auth()->user()->merchant_id;
                    $item->description = trim(@$this->data[1]);

                    $item->gtin = trim(@$this->data[2]);
                    $item->sku = trim(@$this->data[3]);
                    $item->unit = 'Item';

                    $item->price = (float) trim(@$this->data[5]);
                    $item->cost = (float) trim(@$this->data[6]);
                    $item->stock = trim(@$this->data[7]);

                    $item->price = $item->price * 100;
                    $item->cost = $item->cost * 100;

                    $item->save();
                }

                

            }
            fclose($handle);
           return back()->with('success', 'Items imported successfully');
        }
        return back()->with('error', 'No file to import');
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

    public function search($term, $auth_user)
    {
        $merchant_id = json_decode($auth_user)->merchant_id;
        if ($term === 'default') {
            return Item::where('merchant_id', $merchant_id)->limit(16)->get();
        }
        return Item::where('merchant_id', $merchant_id)
                ->where('name','LIKE','%'.$term.'%')
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
