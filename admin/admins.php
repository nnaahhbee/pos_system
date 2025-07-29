<?php include 'includes/header.php'; ?>

 <div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Admin/Staff</h4>
            <a href="admin-create.php" class="btn btn-primary float-end">Add</a>
        </div>
        <div class="card-body">
            <?php alertMessage();?>

            <?php $admins = getAll('admins'); 
            if(!$admins){
                echo '<h4>Something Went Wrong</h4>';
            }
                if(mysqli_num_rows($admins) > 0) {?>

            <div class="table-responsive">
                <table class="table table-stripped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                         <?php foreach($admins as $adminItem) : ?>
                      <tr>
                        <td><?= $adminItem['id'] ?></td>
                        <td><?= $adminItem['name'] ?></td>
                        <td><?= $adminItem['email'] ?></td>
                        <td>
                            <?php if($adminItem['is_ban'] == 1){
                                echo '<span class="badge bg-danger">Banned</span>';
                            }else{
                                 echo '<span class="badge bg-primary">Active</span>';
                            }?>
                        </td>
                        <td>
                            <a href="admin-edit.php?id=<?= $adminItem['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                            <a href="admin-delete.php?id=<?=$adminItem['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
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