<?php 
 require '../config/function.php';


$paramResult = checkParamId('id');
if(is_numeric($paramResult)){
    $productId = validate($paramResult);
    
    $product = getById('products', $productId);

    if($product['status']==200){
        $productDelete = delete('products', $productId);
        if($productDelete){
            $deleteImage = "../".$product['data']
            ['image'];
            if(file_exists($deleteImage)){
                unlink($deleteImage);
            }

            redirect('products.php', 'Product Deleted Successfully');

        }else{
            redirect('products.php', 'Something Went Wrong.');
        }

    }else{
        redirect('products.php', $product['message']);
    }


}else{
   redirect('products.php', 'Something Went Wrong.');
}

?>