<?php 
namespace App\Traits; 

use Intervention\Image\Facades\Image; 

trait GeneralTraits { 
    public function storeCompressImage($image, $path) { 
 
        $file_name = time().'.'.$image->getClientOriginalExtension();
        $destination = public_path($path); 
        $file_size = $image->getSize();   
        $actual_image = Image::make($image->getRealPath());
        
        if($file_size >  512000) { 
            $height = $actual_image->height()/2;		
            $width = $actual_image->width()/2;
            $actual_image->resize($width, $height)->save($destination . '/' . $file_name);

        } else { 
            $actual_image->save($destination . '/' . $file_name);
        }

        return $file_name; 

    }
}
?>