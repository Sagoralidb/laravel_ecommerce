<?php

use App\Models\PurchasedProduct;

if(! function_exists('countTotalItems')){

    function countTotalItems(){
       
        $itemCounts  =0;

        if(auth()->check() ){
          
         $itemCounts =   PurchasedProduct::where('user_id', auth()->id())->count();
        
        }

        return $itemCounts;
    }

}