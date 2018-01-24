<?php

namespace Farris27\Cart;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public static function getPrice($slug){

        $cart=Cart::getAllPanier();

        $test =$cart[$slug];
        return $test->price;
    }

    public static function getPriceProduct($slug){

        $cart=Cart::getAllPanier();

        $test =$cart[$slug];
        return $test->price*$test->quantity;
    }

    public static function countQuantity(){
        $cart=[];
        if(!\Session::has('panier'))\Session::put('panier',$cart);
        $cartItems= \Session::get('panier');
        $quantityPanier=0;

        foreach ($cartItems as $item){

            $quantityPanier+=$item->quantity;
        }

        return $quantityPanier;
    }

    public static function countPromo(){
        $cart=[];
        if(!\Session::has('panier'))\Session::put('panier',$cart);
        $cartItems= \Session::get('panier');
        $quantityPanier=0;

        foreach ($cartItems as $item){

            $quantityPanier+=$item->quantite;
        }

        return $quantityPanier;
    }

    public static function total(){
        $cart=[];
        if(!\Session::has('panier'))\Session::put('panier',$cart);
        $cartItems= \Session::get('panier');
        $total=0;

        foreach ($cartItems as $item){

            $total+=$item->prix_ttc*$item->quantity;
        }

        return $total;
    }

    public static function getAllPanier(){
        $cartItems= \Session::get('panier');

        return $cartItems;

    }

    public static function  removeOne($slug){
        $panier = Cart::getAllPanier();


        unset($panier[$slug]);

        //Update Session
        \Session::put('panier',$panier);

    }

    public static function add($model,$quantity,$slug){
        $oldCart = \Session::has('panier') ? Cart::getAllPanier() : null;

        if ($oldCart == null) {
            $cart = Cart::getAllPanier();
            $model->quantity = $quantity;
            $cart[$slug] = $model;


            \Session::put('panier', $cart);
        } else {


            $cart = \Session::get('panier');
            if (isset($cart[$model->slug])) {
                $cart = Livres::getAllPanier();

                \Session::put('panier', $cart, $cart[$model->slug]->quantity += $quantity);
            } else {
                $cart = Livres::getAllPanier();
                $model->quantity = $quantity;
                $cart[$model->slug] = $model;
                \Session::put('panier', $cart);
            }


        }
    }

    public static function updateCart($slug,$quantity){


        $panier = Cart::getAllPanier();

        $quantite=$quantity;



        $panier[$slug]->quantity = $quantite;

        if($panier[$slug]->quantity==0){
            unset($panier[$slug]);
        }
        //dd($panier);

        //On actualise notre variable de session
        \Session::put('panier',$panier);
    }

    public static function removeAll(){
        \Session::forget('panier');

    }
}
