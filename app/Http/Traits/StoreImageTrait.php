<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;

trait StoreImageTrait{

    public function verifyAndStoreImage( Request $request, $fieldname, $directory ) {
 
        if( $request->hasFile('avatar') ) {
 
            $path = $request->file($fieldname)->storeAs(
                'imgs/'.$directory,
                $request->file($fieldname)->getClientOriginalName(),
                'public'
            );
 
            return $path;
 
        }
        
    }
}
