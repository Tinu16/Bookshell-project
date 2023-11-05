<?php 
session_start();
    include("../dbcon.php");
    include("../includes/header.php");
    include("../includes/admin_sidebar.php");
    include("../includes/topbar.php");
    include("../message.php");
?>
  <div class="container-fluid">

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold text-primary">Category</h3>
        <br>
        <form action="subcategory.php">
        <button type="submit"  class="close" margin-top="1" >
            <div class="btn btn-secondary">
                 Add Sub Categories
            </div>
        </button>
        
        </form>
        <form action="subcategory.php" >
        <button type="submit"  class="close"  >
            <div class="btn btn-secondary" margin-right="100">
                 Add Categories
            </div>
        </button>
        </form>
    </div></div>
    
    <div class="card-body">
        <div class="table-responsive">
        <?php
            $query = "SELECT * FROM tbl_category";
            $query_run = mysqli_query($con, $query);
        ?>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>SI No.</th>
                        <th>Category</th>
                        <th>Parent Category</th>
                        <th>EDIT</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(mysqli_num_rows($query_run) > 0)        
                    {
                        while($row = mysqli_fetch_assoc($query_run))
                        {
                    ?>
                        <tr>
                            <td><?php  echo $row['category_id']; ?></td>
                            <td><?php  echo $row['category_name']; ?></td>
                            <td><?php  echo $row['category_name']; ?></td>
                            <td>
                                <form action="edit.php" method="post">
                                    <input type="hidden" name="edit_id" value="<?php echo $row['category_id']; ?>">
                                    <button type="submit" name="edit_btn" class="btn btn-primary"> EDIT</button>
                                </form>
                            </td>
                            <td>
                                <form action="code.php" method="post">
                                    <input type="hidden" name="status_id" value="<?php echo $row['category_id']; ?>">
                                    <button type="submit" name="disable_category_btn" class="btn btn-danger">Disable</button>
                                </form>
                            </td>
                        </tr>
                    <?php
                        } 
                    }
                    else {
                        echo "No Record Found";
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

</div>  

       

        

<?php 
    include("../includes/script.php");
    include("../includes/footer.php");
?>    
    