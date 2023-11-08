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
        <h3 class="m-0 font-weight-bold text-primary">Books</h3>
        <form action="addbook.php">
        <button type="submit"  class="close" margin-top="1" >
            <div class="btn btn-secondary">
                 Add Book
            </div>
        </button>
        </form>
    </div></div>
    
    <div class="card-body">
        <div class="table-responsive">
        <?php
            $query = "SELECT b.book_id,b.book_name,a.author_name, b.book_volume, b.book_edition, b.book_isbn, sc.subcategory_name, p.publisher_name,  b.book_image, b.book_price, b.book_status FROM tbl_book b INNER JOIN
            tbl_publisher p ON  p.publisher_id = b.publisher_id
            INNER JOIN
            tbl_author a  ON a.author_id = b.author_id
            INNER JOIN 
            tbl_subcategory sc  ON sc.subcategory_id = b.category_id";
    
            $query_run = mysqli_query($con, $query);
            $row_number = 1;
        ?>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>SI No.</th>
                        <th>Book</th>
                        <th>Image</th>
                        <th>Author</th>
                        <th>Publisher</th>
                        <th>Volume</th>
                        <th>Edition</th>
                        <th>ISBN</th>
                        <th>Category</th>
                        <th>Price</th>
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
                            <td><?php  echo $row_number; ?></td>
                            <td><?php  echo $row['book_name']; ?></td>
                            <td><img src="../images/<?php echo $row["book_image"]; ?>" height="100px" width="100px"></td>
                            <td><?php  echo $row['author_name']; ?></td>
                            <td><?php  echo $row['publisher_name']; ?></td>
                            <td><?php  echo $row['book_volume']; ?></td>
                            <td><?php  echo $row['book_edition']; ?></td>
                            <td><?php  echo $row['book_isbn']; ?></td>
                            <td><?php  echo $row['subcategory_name']; ?></td>
                            <td><?php  echo $row['book_price']; ?></td>
                            <td>
                                <form action="edit_author.php" method="post">
                                    <input type="hidden" name="edit_book_id" value="<?php echo $row['book_id']; ?>">
                                    <button type="submit" name="edit_book_btn" class="btn btn-primary"> EDIT</button>
                                </form>
                            </td>
                            <td>
                                <form action="code.php" method="post">
                                    <input type="hidden" name="status_id" value="<?php echo $row['book_id']; ?>">
                                    <button type="submit" name="disable_author_btn" class="btn btn-success">Active</button>
                                </form>
                            </td>
                        </tr>
                    <?php
                    $row_number++;
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
    