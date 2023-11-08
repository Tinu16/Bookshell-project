<?php 
    session_start();
    include("../dbcon.php");
    include("../includes/header.php");
    if(isset($_POST['add_book'])){

        $book = mysqli_real_escape_string($con, $_POST['book']);
        $author = mysqli_real_escape_string($con, $_POST['author']);
        $volume = mysqli_real_escape_string($con, $_POST['volume']);
        $edition = mysqli_real_escape_string($con, $_POST['edition']);
        $isbn = mysqli_real_escape_string($con, $_POST['isbn']);
        $category = mysqli_real_escape_string($con, $_POST['category']);
        $publisher = mysqli_real_escape_string($con, $_POST['publisher']);
        $page = mysqli_real_escape_string($con, $_POST['page']);
        $description = mysqli_real_escape_string($con, $_POST['description']);
        $price = mysqli_real_escape_string($con, $_POST['price']);
    
        $i=$_FILES["image"]["name"];
        $path=$_FILES["image"]["tmp_name"];
        move_uploaded_file($_FILES["image"]["tmp_name"],"../images/".$_FILES["image"]["name"]);
        
        $insert = "INSERT INTO `tbl_book`( `book_name`, `author_id`, `book_volume`, `book_edition`, `book_isbn`, `category_id`, `publisher_id`, `book_page`, `book_description`, `book_price`, `book_image`) VALUES ('$book','$author','$volume','$edition','$isbn','$category','$publisher','$page','$description','$price','$i')";
              mysqli_query($con, $insert);
              header('location:addbook.php');
    } 
        
     
?>

<body class="bg-gradient-primary">

    <div class="container">
    
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-7 col-lg-6 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-7" >
                        <!-- Nested Row within Card Body -->
                       
                        <form class="user" action="#" method="POST" enctype="multipart/form-data" >
                          
                            <div class="col-lg-7">
                                <div class="p-7">

                                    <div class="text-center">
                                    
                                        <h1 class="h4 text-gray-900 mb-4">ADD BOOK</h1>
                                        <?php
                                             include("../message.php");
                                        ?>  
                                    </div>
                                    
                                        <div class="form-group">
                                            <input type="book" name="book" class="form-control form-control-user"
                                                id="book" placeholder="Book">
                                        </div>
                                        <div class="form-control form-control-user">
                                        <label>Author</label>
                                    <select name="author" required>
                                        <?php
                                            $sql = mysqli_query($con,"SELECT author_id,author_name FROM tbl_author");

                                            while ($row = mysqli_fetch_array($sql)) 
                                                {
                                                    ?>
                                                    <option value="<?php echo $row["author_id"]?>"><?php echo $row["author_name"] ?></option>
                                               <?php
                                                    }
                                                ?>
                                    </select>
                                                </div>
                                                <br>
                                        <div class="form-group">
                                            <input type="volume" name="volume" class="form-control form-control-user"
                                                id="volume" placeholder="Volume">
                                        </div>
                                        <div class="form-group">
                                            <input type="edition" name="edition" class="form-control form-control-user"
                                                id="edition" placeholder="Edition">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="isbn" class="form-control form-control-user"
                                                id="isbn" placeholder="ISBN">
                                        </div>
                                        <div class="form-control form-control-user">
                                        <label>Category</label>
                                    <select name="category" required>
                                        <?php
                                            $sql = mysqli_query($con,"SELECT subcategory_id,subcategory_name FROM tbl_subcategory");

                                            while ($row = mysqli_fetch_array($sql)) 
                                                {
                                                    ?>
                                                    <option value="<?php echo $row["subcategory_id"]?>"><?php echo $row["subcategory_name"] ?></option>
                                               <?php
                                                    }
                                                ?>
                                    </select>
                                                </div>
                                                <br>
                                                <div class="form-control form-control-user">
                                    <label>Publisher</label>
                                    <select name="publisher" required>
                                        <?php
                                            $sql = mysqli_query($con,"SELECT publisher_id,publisher_name FROM tbl_publisher");

                                            while ($row = mysqli_fetch_array($sql)) 
                                                {
                                                    ?>
                                                    <option value="<?php echo $row["publisher_id"]?>"><?php echo $row["publisher_name"] ?></option>
                                               <?php
                                                    }
                                                ?>
                                    </select>
                                                </div>
                                                <br>
                                        <div class="form-group">
                                            <input type="page" name="page" class="form-control form-control-user"
                                                id="page" placeholder="Total Number of Pages">
                                        </div>
                                        <div class="form-group">
                                            <input type="description" name="description" class="form-control form-control-user"
                                                id="description" placeholder="Description">
                                        </div>
                                        <div class="form-group">
                                            <input type="price" name="price" class="form-control form-control-user"
                                                id="price" placeholder="Price">
                                        </div>
                                        <div class="col-sm-13">
                                        <input type="file" name="image" class="form-control form-control-user" id="image" value="ADD">
                                        </div>
                                        <br>
                                        <div class="col-sm-13">
                                        <input type="submit" name="add_book" class="btn btn-success btn-user btn-block" value="ADD">
                                        </div>
                                        
                                    </form>
                                       
                                    
                                    
                               
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
<script>

</script>
    <?php 
    include("../includes/script.php");
    
?>    