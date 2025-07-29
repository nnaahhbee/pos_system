<?php 
 include '../config/function.php';

 
 //functions for admin

 if(isset($_POST['saveAdmin']))
 {
     $name = validate($_POST['name']);
     $email = validate($_POST['email']);
     $password = validate($_POST['password']);
     $phone = validate($_POST['phone']);
     $is_ban = isset($_POST['is_ban']) == true ? 1 : 0;

     if($name != '' && $email != '' && $password != ''){
        $emailCheck = mysqli_query($conn,"SELECT * FROM admins WHERE email='$email'");
        if($emailCheck){
           if(mysqli_num_rows($emailCheck) > 0){
            redirect('admin-create.php', 'Email already exists');
           }
        }

        $bycrypt_password = password_hash($password, PASSWORD_BCRYPT);

        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $bycrypt_password,
            'phone' => $phone,
            'is_ban' => $is_ban,	
        ];

        $result = insert('admins', $data);
        if($result){
            redirect('admins.php', 'Admin Added Successfully');

        }else{
            redirect('admin-create.php', 'Something went wrong');
        }

     }else{
        redirect('admin-create.php', 'All fields are required');
     }
 }


 if(isset($_POST['updateAdmin'])){
     $adminId = validate($_POST['adminId']);
     
     $adminData = getById('admins', $adminId);
     if($adminData['status'] != 200){
         redirect('admin-edit.php?id='.$adminId, 'Please fill required fields.');
     }  
     $name = validate($_POST['name']);
     $email = validate($_POST['email']);
     $password = validate($_POST['password']);
     $phone = validate($_POST['phone']);
     $is_ban = isset($_POST['is_ban']) == true ? 1 : 0;

     $EmailCheckQuery = "SELECT * FROM admins WHERE email='$email' AND id!='$adminId'";
     $checkResult = mysqli_query($conn, $EmailCheckQuery);
     if($checkResult){
        if(mysqli_num_rows($checkResult) > 0){
            redirect('admin-dedit.php?='.$adminId, 'Email Already used by another user');
        }       
     }     
     
     if($password != ''){
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

     }else{
        $hashedPassword = $adminData['data']['password'];
     }
     
     if($name != '' && $email != ''){
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            'phone' => $phone,
            'is_ban' => $is_ban,	
        ];

        $result = update('admins', $adminId, $data);
        if($result){
            redirect('admin-edit.php?id='.$adminId, 'Admin Updated Successfully');

        }else{
            redirect('admin-edit.php?id='.$adminId, 'Something went wrong');
        }


     }else{
        redirect('admin-create.php', 'All fields are required');
     } 
    
    }


    //functions for category

    if(isset($_POST['saveCategory'])){
        $name = validate($_POST['name']);
        $description = validate($_POST['description']);
        $status = isset($_POST['status']) == true ? 1 : 0;

         $data = [
            'name' => $name,
            'description' => $description,
            'status' => $status,	
        ];

        $result = insert('categories', $data);
        if($result){
            redirect('categories.php', 'Category Created Successfully');

        }else{
            redirect('categories-create.php', 'Something went wrong');
        }
    }


   if(isset($_POST['updateCategory'])){
        $categoryId = validate($_POST['categoryId']);
        $name = validate($_POST['name']);
        $description = validate($_POST['description']);
        $status = isset($_POST['status']) == true ? 1 : 0;

         $data = [
            'name' => $name,
            'description' => $description,
            'status' => $status,	
        ];

        $result = update('categories', $categoryId, $data);
        if($result){
            redirect('category-edit.php?id='.$categoryId, 'Category Updated  Successfully.');

        }else{
            redirect('category-edit.php?id='.$categoryId, 'Something went wrong');
        }

   }
?>