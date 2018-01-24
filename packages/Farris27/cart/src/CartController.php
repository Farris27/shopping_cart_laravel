<?php

namespace Farris27\Cart;

use Farris27\Cart\Cart;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class CartController extends Controller
{
    public function __construct()
    {
        $cart=[];
        if(!\Session::has('panier'))\Session::put('panier',$cart);

    }

    public function index()
    {
        $cartItems=Cart::getAllPanier();


       // $date= Carbon::now();

        return $cartItems;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    public function addCart($slug,Request $request)
    {

        $model = Cart::where('slug', $slug)->first();

        Cart::add($model,$request->quantity,$slug);


        flash('Produit ajoute au panier')->success();
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {

        Cart::updateCart($slug,$request->qty);

        flash('Produit mis à jour')->info();
        return back();
    }

    /*
    *Not dev for the moment..
   */
    /*
    public function updateAjax(Request $request)
    {

        $model = Cart::where('slug', $request->slug)->first();
        Cart::add($model,$request->quantite,$request->slug);



        return $model;
    }

    public function updateAjaxGlobale(Request $request)
    {

        $cat = tags::where('slug', $request->slug)->first();

        foreach ($cat->livres as $livre){
            $model= Cart::where('slug',$livre->slug)->first();
            Cart::add($model,$request->quantite,$model->slug);
        }

        return $cat;
    } */
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        Cart::removeOne($slug);
        return back();
    }

    /* NOT DEV
    public function check(){


        $cartItems=Cart::getAllPanier();
        return view('panier.commande_valide',compact('cartItems'));


    }

    public function pdf_commande(){

        $cartItems=Cart::getAllPanier();

        $pdf= PDF::loadView('panier.recap',compact('cartItems'));

        \Session::forget('panier');
        return $pdf->download('recap.pdf');


    }*/
}
