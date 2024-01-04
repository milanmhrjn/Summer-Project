<?php
include ("partials/header.php");
?>

<?php

    //check whether the id  is set or not 
    if(isset($_GET['id'])){
        //get all the details
        $id= $_GET['id'];
        //sql query to get selected products
        $sql = "SELECT * FROM tbl_products Where id = $id";
        //execute the query
        $res = mysqli_query($con, $sql);

        //get the value based on query executed
        $row = mysqli_fetch_assoc($res);

        //get the individual value of selected products 
        $title = $row['title'];
        $price = $row['price'];
        $description = $row['description'];
       $current_image = $row['image_name'];
        $featured =  $row['featured'];
        $active = $row['active'];

    }
    else{
        //redirect to manage service page
         header("location:".SITE_URL.'admin/manage-services.php');
    }
?>


<div class="main-content">
    <div class="wrapper">
        <h1 class="updateAdmin">Update Services</h1>
        <br><br>    
        <div class="admin-form">
        <form action="" method="POST" enctype = "multipart/form-data">
            <table class='tbl-form'>
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" value = "<?php echo $title;?>"></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="text" name="price" value = "<?php echo $price;?>"></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><textarea name="description"  cols="50" rows="5"><?php echo $description;?></textarea></td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                    <?php
                        if($current_image==""){
                        //image not available
                        echo "<div class='error'>Image not Available.</div>";

                        }   
                        else{
                        //image available
                    ?>
                        <img src="<?php echo SITE_URL;?>images/services/<?php echo $current_image?>"width="250px" height="250px">
                        <?php
                    }
                   ?>
                </td>
            </tr>
            <tr>
                <td>Select New Image:</td>
                <td>
                    <input type="file" name='image' >
                </td>
            </tr>
            <tr>
                <td>Featured: </td>
                <td>
                    <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes &nbsp;&nbsp;
                    <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
                </td>
            </tr>
            <tr>
                <td>Active: </td>
                <td>
                    <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes &nbsp;&nbsp;
                    <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
                </td>
            </tr>
            <tr>
            <td colspan ="2">
                <input type="hidden" name="id" value=<?php echo $id;?>> 
                <input type="hidden" name='current_image' value=<?php echo $current_image;?>>
                <input type="submit" name="submit" value="Update Product" class="add-admin"></td>
            </tr>
            </table>
        </form>   
        </div>
        <?php
            
            if(isset($_POST['submit'])){
                //get all the details from the form 
                $id = $_POST['id'];
                $title = $_POST['title']; 
                $price = $_POST['price'];
                $description = $_POST['description'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //upload the image if selected
                //check whether upload button is clicked or not
                if(isset($_FILES['image']['name'])){
                    //upload button clicked
                    $image_name = $_FILES['image']['name']; //new image name 

                    //check whether the file is available or not 
                    if($image_name!=""){
                        //image is available
                        //uploading new image
                        //rename the image 
                        $ext = end(explode('.',$image_name)); //gets the extension of the image 
                        $image_name = "product".rand(0000,9999).".".$ext;//renamed the image
                        //get the source and destination path to upload the image 
                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path="../images/services/".$image_name;
                        //upload the image
                        $upload = move_uploaded_file($source_path,$destination_path);
                        //check whether the image is uploaded or not
                        if($upload==false){
                            //failed to upload the image 
                            //redirect to add service page with error message
                            $_SESSION['upload']="<div class='error'>Failed to Upload Image.</div>";
                            header('location:'.SITE_URL.'admin/add-services.php');
                            //stop the process
                            die();
                        }
                        //remove the current image if new image is uploaded and current image exists
                        //remove current image if available
                        if($current_image!=""){
                            //current is available
                            //remove the image
                            $remove_path = '../images/services/'.$current_image;

                            $remove = unlink($remove_path);

                            //check whether the image is removed or not
                            if($remove==false){
                                //failed to remove current image
                                $_SESSION['remove-failed']="<div class='error'>Failed to Remove Image</div>";
                                //redirect to manage service page 
                                header('location:'.SITE_URL.'admin/manage-services.php');
                                //stop the process
                                die();
                            }
                        }
                    }
                }
                else{
                    $image_name = $current_image;
                }

                //update the product in database
                $sql2 = "UPDATE tbl_products SET 
                    title = '$title',
                    price = '$price',
                    description = '$description',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                    WHERE id = $id
                ";
                //execute the sql query
                $res2 = mysqli_query($con, $sql2);
                //check whether the query is executed or not 
                if($res2==true){
                    //query is executed and product is updated
                    $_SESSION['update']='<div class="success">Product Updated Successfully.</div>';
                    header('location:'.SITE_URL.'admin/manage-services.php');
                }
                else{
                    //failed to update the product
                    $_SESSION['update']='<div class="error">Failed to Update Product.</div>';
                    header('location:'.SITE_URL.'admin/manage-services.php');
                }

                //redirect to manage services with session message


            }
        ?>

    </div>
<div>


<?php
include ("partials/footer.php");
?>