<?php
include("partials/header.php")
?>

<div class="main-content">
    <div class="wrapper">
        <h1 class='admin'>Add Services</h1>
        <br> <br>
        <?php
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <div class="admin-form">
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-form">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Product Title">
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="text" name="price" placeholder="Product Price">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description"  cols="50" rows="5" placeholder="Product Description"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes &nbsp;&nbsp;
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes &nbsp;&nbsp;
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                        <td colspan='2'>
                            <input type="submit" name='submit' value="Add Product" class='add-admin'>
                        </td>
                    </tr>
            </table>
        </form>
        
        
        
        <?php
            //check whether the button is clicked or not
            if(isset($_POST['submit'])){
                //add product in database
                //get the data from form
                $title = $_POST['title'];
                $price = $_POST['price'];
                $description = $_POST['description'];
                //check whether radio button for featured and active are checked or not 
                if(isset($_POST['featured'])){
                    $featured = $_POST['featured'];
                }
                else{
                    $featured = 'No'; //setting default value 
                }

                if(isset($_POST['active'])){
                    $active = $_POST['active'];
                }
                else{
                    $active = 'No'; //setting default value 
                }

                //upload the image if selected
                //check whether the select image is clicked or not and upload the image only if the image is selected
                if(isset($_FILES['image']['name'])){
                    //get the details of the selected image
                    $image_name = $_FILES['image']['name']; 
                    //check whether the image is selected or not and upload the image only if the image is selected 
                    if($image_name!=""){
                        //image is selected
                        //rename the image
                        //get the extension of selected image (jpg,png,gif)
                        $ext = end(explode('.',$image_name));
                        //create new name for image 
                        $image_name = "product".rand(0000,9999).".".$ext; //new image name like 'product1423423425.jpg'

                        //upload the image
                        //get the source and destination path 
                        //source path is the current location of the image 
                        $source_path = $_FILES['image']['tmp_name'];
                        //destination path is the location of the image to be uploaded
                        $destination_path = "../images/services/".$image_name;
                        //then upload the image
                        $upload = move_uploaded_file($source_path,$destination_path);
                        //check whether image uploaded or not
                        if($upload==false){
                            //failed to upload the image 
                            //redirect to add service page with error message
                            $_SESSION['upload']="<div class='error'>Failed to Upload Image.</div>";
                            header('location:'.SITE_URL.'admin/add-services.php');
                            //stop the process
                            die();
                        }
                    }
                }
                else{
                    $image_name =  ""; //setting default value as blank 
                }
                //insert into database
                //create a sql query to save or add services
                $sql = "INSERT INTO tbl_products SET
                title = '$title',
                price = '$price',
                description = '$description',
                image_name = '$image_name',
                featured = '$featured',
                active = '$active'
                ";
                //execute the query 
                $res =mysqli_query($con, $sql);
                //check whether data inserted into database or not 
                //redirect with message to manage services page
                if($res==true){
                    //data inserted successfully
                    $_SESSION['add']= "<div class='success'>Products Added Successfully.</div>";
                    header('location:'.SITE_URL.'admin/manage-services.php');
                }
                else{
                    //failed to insert data 
                    $_SESSION['add']= "<div class='error'>Failed to Add Products.</div>";
                    header('location:'.SITE_URL.'admin/manage-services.php');
                }
            }
        ?>
        </div>
    </div>
</div>

<?php
include("partials/footer.php");
?>