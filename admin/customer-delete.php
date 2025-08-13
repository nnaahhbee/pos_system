<?php 
 require '../config/function.php';


$paramResult = checkParamId('id');
if(is_numeric($paramResult)){
    $customerId = validate($paramResult);
    
    $customer = getById('customers', $customerId);

    if($customer['status']==200){
        $customerDelete = delete('customers', $customerId);
        if($customerDelete){
            redirect('customers.php', 'Customer Deleted Successfully');

        }else{
            redirect('customers.php', 'Something Went Wrong.');
        }

    }else{
        redirect('customers.php', $customer['message']);
    }


}else{
   redirect('customers.php', 'Something Went Wrong.');
}

?>