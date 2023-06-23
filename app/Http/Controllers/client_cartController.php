<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class client_cartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('pages.client.cart');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $id)
    {
        $requested_resource = Article::find($id);
        if ($request->session()->has('cart')) {
            $cart = $request->session()->get('cart');
            
            $index = false;
            
            foreach ($cart as $cur_index => $item) {
                if ($item['article']->id == $id) {
                    $index = $cur_index;
                    break;
                }
            }

            if ($index !== false) {
                // If the item already exists, update the quantity
                $cart[$index]['qte'] += intval($request->query('qte'));
            } else {
                // If the item does not exist, add it to the cart
                $cart[] = [
                    'article' => $requested_resource,
                    'qte' => intval($request->query('qte'))
                ];
            }

            $request->session()->put('cart', $cart);
            return response()->json(['cart' =>  $request->session()->get('cart')]);
        } else {
            // If the cart is empty, create a new cart with the item
            $cart = [
                [
                    'article' => $requested_resource,
                    'qte' => intval($request->query('qte'))
                ]
            ];

            $request->session()->put('cart', $cart);
            return response()->json(['cart' => $cart]);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        // $request->session()->forget('cart');
        return response()->json(['cart' => $request->session()->get('cart',[])],200);
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
    public function destroy(Request $request, string $id)
    {

        if ($request->session()->has('cart')) {
            $cart = $request->session()->get('cart');
            
            $index = false;
            
            foreach ($cart as $cur_index => $item) {
                if ($item['article']->id == $id) {
                    $index = $cur_index;
                    break;
                }
            }

            if ($index !== false) {
                // Remove the item from the cart

                unset($cart[$index]);
                $cart = array_values($cart);

                $request->session()->put('cart',$cart);
                
            }
        }

        return redirect()->route('client.cart');
        //     return response()->json([],201);
        // } else {
        //     return response()->json([],200);
        // }
    }

    /**
     * remove the entire Cart Session Variable.
     */
    public function clear(Request $request)
    {
        $request->session()->forget('cart');
        return redirect()->route('client.products');
    }

}
