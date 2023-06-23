<?php

namespace App\Http\Controllers;

use App\Events\commandeAdded;
use App\Models\Cart;
use App\Models\Cart_Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class client_commandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $new_cart = new Cart();
        $new_cart->status = "unprocessed";
        $new_cart->user_id = Auth::user()->id;
        $new_cart->save();

        foreach(request()->session()->get('cart',[]) as $Cart_Item){
            Cart_Item::create([
                "cart_id" => $new_cart->id,
                "article_id" => $Cart_Item['article']->id,
                "quantity" => $Cart_Item['qte']
            ]);
        }

        event(new commandeAdded('notification','A New Commande !'));

        request()->session()->forget('cart');
        return redirect()->route('client.products');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
