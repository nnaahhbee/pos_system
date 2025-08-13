<?php include 'includes/header.php'; ?>

 <div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb=0">Edit Product</h4>
            <a href="products.php" class="btn btn-primary float-end">Back</a>
        </div>
        <div class="card-body">
            <?php alertMessage();?>

           <form action="action.php" method="POST" enctype="multipart/form-data">

           <?php 
             $paramValue = checkParamId('id');
             if(!is_numeric($paramValue)){
             echo '<h5>'.$paramValue.'</h5>';
             return false;
           }

           $product = getById('products', $paramValue);
           if($product){
             if($product['status'] == 200){
              ?>
              <input type="hidden" name="product_id" value="<?= $product['data']['id']; ?>"/>
              <div class="row">
                <div class="col-md-12 mb-3">
                    <label>Select Category</label>
                    <select name="category_id" class="form-control">
                        <option value="">Select Category</option>
                        <?php 
                        $categories = getAll('categories');
                        if($categories){
                            if(mysqli_num_rows($categories) > 0){
                                foreach($categories as $catItem){
                                  ?>
                                  <option value="<?= $catItem['id']; ?>" <?= $product['data']['category_id'] == $catItem['id'] ? 'selected' : ''; ?>>
                                    <?= $catItem['name']; ?>
                                  </option>
                                  <?php
                                }                          
                            }else{
                                echo "<option value=''>No Categories Found</option>";
                            }
                        } else {
                            echo "<option value=''>Something Went Wrong</option>";
                        }
                        ?>
                   </select>
                </div>
                <div class="col-md-12 mb-3">
                  <label for="">Product Name *</label>
                  <input type="text" name="name" value="<?= $product['data']['name']; ?>" required class="form-control"/>
                </div>
                <div class="col-md-12 mb-3">
                  <label for="">Description</label>
                  <textarea name="description" class="form-control" rows="3"><?= $product['data']['name']; ?></textarea>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="">Price *</label>
                  <input type="text" name="price" value="<?= $product['data']['price']; ?>"required class="form-control"/>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="">Quantity *</label>
                  <input type="text" name="quantity" value="<?= $product['data']['quantity']; ?>" required class="form-control"/>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="">Image *</label>
                  <input type="file" name="image" class="form-control"/>
                  <br/>
                  <img src="../<?= $product['data']['image']; ?>" style="width:40px; height:40px;" alt="Image"/>
                </div>
                <div class="col-md-6"><label>Status (UnChecked=Visible, Checked=Hidden)</label>
                <br/>
                <input type="checkbox" name="status" <?= $product['data']['status'] == true ? 'checked' : ''; ?> style="width:30px; height:30px;"/>
               </div>
                
                <div class="col-md-6 mb-3 text-end">
                    <br/>
                  <button type="submit" name="updateProduct" class="btn btn-primary">Update</button>
                </div>
            </div> 
              <?php
             }else{
              echo '<h5>'.$product['message'].'</h5>';
             }
           }else{
            echo '<h5>something Went Wrong.</h5>';
            return false;
           }
           ?>                       
           </form>
        </div>
    </div>
 </div>


<?php include 'includes/footer.php'; ?>