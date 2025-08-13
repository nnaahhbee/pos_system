<?php include 'includes/header.php'; ?>

 <div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Customers</h4>
            <a href="customer-create.php" class="btn btn-primary float-end">Add Customers</a>
        </div>
        <div class="card-body">
            <?php alertMessage();?>

            <?php $customers = getAll('customers'); 
            if(!$customers){
                echo '<h4>Something Went Wrong</h4>';
            }
            if(mysqli_num_rows($customers) > 0) {?>

            <div class="table-responsive">
                <table class="table table-stripped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>                       
                         <?php foreach($customers as $item) : ?>
                      <tr>
                        <td><?= $item['id'] ?></td>
                        <td><?= $item['name'] ?></td>
                        <td><?= $item['email'] ?></td>
                        <td><?= $item['phone'] ?></td>
                        <td>
                            <?php if($item['status'] == 1){
                                echo '<span class="badge bg-danger">Hidden</span>';
                            }else{
                                 echo '<span class="badge bg-primary">Visible</span>';
                            }?>
                        </td>
                        <td>
                            <a href="customer-edit.php?id=<?= $item['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                            <a href="customer-delete.php?id=<?=$item['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this data?')">Delete</a>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                      <?php }
                    else{
                        ?>
                        <tr>
                            <td colspan="4">No record found</td>
                        </tr>
                        <?php
                       }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

 </div>


<?php include 'includes/footer.php'; ?>