<?php 

session_start();

require 'dbcon.php';

//input field validation 
function validate($inputData){
    global $conn;
    $validatedData = mysqli_real_escape_string($conn, $inputData);
    return trim ($validatedData);
}


// redirect from one page to another page 
function redirect($url, $status){
    $_SESSION['status'] = $status;
    header('Location:' .$url);
    exit(0);
}

//Display messages or status after process
function alertMessage(){
    if(isset($_SESSION['status'])){      
       echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
       <h6> '.$_SESSION['status'].' </h6>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['status']);
    }
}

//insert record 
function insert($tableName, $data){
    global $conn;

    $table = validate($tableName);

    $columns = array_keys($data);
    $values = array_values($data);

    $finalColumn = implode(',', $columns);
    $finalValue = "'".implode("', '", $values)."'";

    $query = "INSERT INTO $table ($finalColumn) VALUES ($finalValue)";
    $result = mysqli_query($conn, $query);
    return $result;
}

//update data
function update($tableName, $id, $data){
    global $conn;

    $table = validate($tableName);
    $id = validate($id);
    
    $inputDataString = "";

    foreach($data as $column => $value){
        $updateDataString .= $column.'='."'$value',";
    }

    $finalUpdateData = substr(trim($updateDataString),0,-1);

    $query = "UPDATE $table SET $finalUpdateData WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    return $result;
}

//getting all the data
function getAll($tableName, $status = NULL){
    global $conn;

    $table = validate($tableName);
    $status = validate($status);

    if($status == 'status'){
        $query = "SELECT * FROM $table WHERE $status='0'";
    }
    else{
        $query = "SELECT * FROM $table";
    }
    return mysqli_query($conn, $query);
}

//get each record
function getById($tableName, $id){
    global $conn;

    $table = validate($tableName);
    $id = validate($id);

    $query = "SELECT * FROM $table WHERE id='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if($result){
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);

            $response = [
                'status' => 404,
                'data' => $row,
                'message' => 'Record Found' 
            ];
            return $response;

        }else{
            $response = [
                'status' => 404,
                'message' => 'No Data Found' 
            ];
            return $response;
        }
        
    }else{
        $response = [
            'status' => 500,
            'message' => 'Something Went Wrong'
        ];
        return $response;
    }

}

//delete data
function delete($tableName, $id) {
    global $conn;

    $table = validate($tableName);
    $id = validate($id);

    $query = "DELETE FROM $table WHERE id='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    return $result;
}


?>