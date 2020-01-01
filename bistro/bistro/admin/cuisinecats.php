<?php 
$catName="";
$catDescription="";
 if(isset($_POST['catUpload'])){
  $catName = $_POST['catName'];
  $catDescription = $_POST['catDescription'];
  $catImg = $_FILES['catImg'];

  $imgName = $catImg['name'];
  $imgTmpName = $_FILES['catImg']['tmp_name'];
  $imgSize = $_FILES['catImg']['size'];
  $imgError = $_FILES['catImg']['error'];
  $imgType = $_FILES['catImg']['type'];

  $imgExt = explode('.', $imgName);
  $imgActExt = strtolower(end($imgExt));
  list($width, $height) = getimagesize($imgTmpName);
  
  $allowed = array('jpg', 'jpeg' , 'png');

  if(in_array($imgActExt, $allowed)){/* inarray Start */
    if($imgError == 0){/* sliderImg Start */
      if($width < 1024 || $height < 600){
        echo "<script>alert('Pictures with w/h greater than 1024 * 600 can be uploaded.')</script>";
      }
      else{/* width start */
        $imgNameNew = uniqid('',true) . "." . $imgActExt;
        $imgDestination = '../uploads/cuisinecats/' . $imgNameNew;
        $img_insert = "INSERT INTO cuisinecats(name,description,img) VALUES('$catName','$catDescription','$imgNameNew')";
        if($nepal = mysqli_query($con,$img_insert)){
          move_uploaded_file($imgTmpName, $imgDestination);
          echo "<script>alert('Uploaded Successfully!');</script>";
        }
        else{
          echo "<script>alert('Database Upload Error!');</script>";
        }
      }/* width end */
    }/* slider img eng*/
    else{
      echo "<script>alert('There was an error uploading the file.')</script>";
    }
  }/* inarray end */
  else{
    echo "<script>alert('Only png, jpg & jpeg allowed to be uploaded.')</script>";
  }
 }
 if(isset($_POST['delete_cat'])){
   $deleteId = $_POST['id'];
   $select = "SELECT * from cuisinecats WHERE id='$deleteId'";
   $select_res = mysqli_query($con,$select);
   $select_resr = mysqli_fetch_assoc($select_res);
   $fileName = $select_resr['img'];
   $delete = "DELETE from cuisinecats WHERE id='$deleteId'";
   if(mysqli_query($con,$delete)){
     $path = "../uploads/cuisinecats/" . $fileName;
     unlink($path);
     echo "<script>alert('Successfully deleted.')</script>";
   }
   else{
     echo "error";
   }
 }
 if(isset($_POST['edit_cat'])){
     $editId = $_POST['id'];
     $tbl_select = "SELECT * from cuisinecats WHERE id='$editId'";
     $tbl = mysqli_fetch_assoc(mysqli_query($con,$tbl_select));
     echo '<div class="card-body">
               <h3>Edit Slide</h3>
               <form method="post" enctype="multipart/form-data">
                 <div class="form-group">
                   <label for="catName">Category Name</label>
                   <input type="text" class="form-control" name="catName" required="required" value="' . $tbl['name'] . '">
                   <small id="nameHelpBlock" class="form-text text-muted">
                     Your name must be 10-25 characters long, not more.
                   </small>
                 </div>
                 <div class="form-group">
                   <label for="catDescription">Category Description</label>
                   <textarea class="form-control" name="catDescription" rows="3" required="required">' . $tbl['description'] . '</textarea>
                   <small id="descHelpBlock" class="form-text text-muted">
                     Description is about 200 characters long.
                   </small>
                 </div>
                 <div class="form-group">
                   <label for="catimg">Category Thumbnail Picture</label>
                   <div class="custom-file">
                     <input type="file" class="custom-file-input" name="catImg">
                     <label class="custom-file-label" for="catImg">Choose Img</label>
                   </div>
                   <small id="picHelpBlock" class="form-text text-muted">
                     Select png, jpg.
                   </small>
                 </div>
                    <input type="hidden" name="edit_id" value="' . $editId . '">
                   <button type="submit" name="editCatSubmit" class="btn btn-primary">Edit</button>
               </form><hr>';
 }
 if(isset($_POST['editCatSubmit'])){
   $catName = $_POST['catName'];
   $editId = $_POST['edit_id'];
   
   $catDescription = $_POST['catDescription'];
   
   if($_FILES['catImg']['name']==""){
     $txt_update = "UPDATE cuisinecats SET name='$catName',description='$catDescription' WHERE id='$editId'";
     if(mysqli_query($con,$txt_update)){
       echo "<script>alert('Updated.')</script>";
       $catName="";
       $catDescription="";
     }
     else
     {
       echo "Error";
     }
   }
   else{
     $catImg = $_FILES['catImg'];

     $imgName = $catImg['name'];
     $imgTmpName = $_FILES['catImg']['tmp_name'];
     $imgSize = $_FILES['catImg']['size'];
     $imgError = $_FILES['catImg']['error'];
     $imgType = $_FILES['catImg']['type'];


     $imgExt = explode('.', $imgName);
     $imgActExt = strtolower(end($imgExt));
     list($width, $height) = getimagesize($imgTmpName);
     
     $allowed = array('jpg', 'jpeg' , 'png');

     if(in_array($imgActExt, $allowed)){/* inarray Start */
       if($imgError == 0){/* sliderImg Start */
         if($width < 1024 || $height < 600){
           echo "<script>alert('Pictures with w/h greater than 1024 * 600 can be uploaded.')</script>";
         }
         else{/* width start */
           $imgNameNew = uniqid('',true) . "." . $imgActExt;
           $imgDestination = '../uploads/cuisinecats/' . $imgNameNew;
           move_uploaded_file($imgTmpName, $imgDestination);
           $img_update = "UPDATE cuisinecats SET name='$catName', description='$catDescription', img='$imgNameNew' WHERE id='$editId'";
           $tbl_select = "SELECT * from cuisinecats WHERE id='$editId'";
           $tbl = mysqli_query($con,$tbl_select);
           $tbl = mysqli_fetch_assoc($tbl);
           $oldfileName = $tbl['img'];
           if(mysqli_query($con,$img_update)){
             $path = "../uploads/cuisinecats/" . $oldfileName;
             unlink($path);
             echo "<script>alert('Updated Successfully!');</script>";
             $catName="";
             $catDescription="";
           }
           else{
             echo "<script>alert('Database Upload Error!');</script>";
           }
         }/* width end */
       }/* slider img eng*/
       else{
         echo "<script>alert('There was an error uploading the file.')</script>";
       }
     }/* inarray end */
     else{
       echo "<script>alert('Only png, jpg & jpeg allowed to be uploaded.')</script>";
     }
  }
 }
 ?>
<div class="container-fluid"><!-- Content -->
        <h1 class="mt-4"><i class="fas fa-cog"></i> Cuisine Categories</h1>
        <div class="container"><!-- Container Wrapper -->
          <br>
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#home"><i class="fas fa-file-import"></i> Insert</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#menu1"><i class="fas fa-eye"></i> View</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#menu2"><i class="fas fa-upload"></i> Insert in Menu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#menu3"><i class="fas fa-glasses"></i> View in Menu</a>
            </li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <div id="home" class="container tab-pane active"><br/>
                <p>Insert cuisine categories from here.</p>
                <form method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="catName">Category Name</label>
                    <input type="text" class="form-control" name="catName" required="required" value="<?php echo $catName ?>">
                    <small id="nameHelpBlock" class="form-text text-muted">
                      Your name must be 10-25 characters long, not more.
                    </small>
                  </div>
                  <div class="form-group">
                    <label for="catDescription">Category Description</label>
                    <textarea class="form-control" name="catDescription" rows="3" required="required"><?php echo $catDescription ?></textarea>
                    <small id="descHelpBlock" class="form-text text-muted">
                      Description is about 200 characters long.
                    </small>
                  </div>
                  <div class="form-group">
                    <label for="catimg">Category Thumbnail Picture</label>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="catImg" required="required">
                      <label class="custom-file-label" for="catImg">Choose Img</label>
                    </div>
                    <small id="picHelpBlock" class="form-text text-muted">
                      Select png, jpg.
                    </small>
                  </div>
                    <button type="submit" name="catUpload" class="btn btn-primary">Submit</button>
                </form>
            </div><!-- Tab1 content wrapper -->
          <div id="menu1" class="container tab-pane fade"><br>
            <p>These are list of all the cuisine categories present in the website. <span class="text-primary">Hover over 3 dots (...) to read full description.</span></p>
            <div class="row">
              <?php 
              $tbl_select = "SELECT * from cuisinecats";
              $tbl = mysqli_query($con,$tbl_select);
              while($tblrow = mysqli_fetch_assoc($tbl)){
                echo '<div class="card col-md-3 mx-4 my-2">
                <form method="post"><img src="../uploads/cuisinecats/' . $tblrow['img'] . '" class="img-thumbnail card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">' . $tblrow['name'] . '</h5>
                  <p class="card-text">' . substr($tblrow['description'],0,120) . '<span style="cursor:pointer;" title="' . $tblrow['description'] . '">...' . '</p>
                </div>
                <div class="card-footer">
                  <input type="hidden" name="id" value="' . $tblrow['id'] . '">
                  <button type="submit" name="edit_cat" class="btn btn-sm btn-primary"><i class="fas fa-pencil-alt"></i> Edit</button>
                  <button type="submit" name="delete_cat" class="btn btn-sm btn-danger float-right"><i class="fas fa-trash"></i> Delete</button>
                </div></form>
              </div>';
              }
              
               ?>
            </div>  
          </div><!-- Tab2 content wrapper -->
          <div id="menu2" class="container tab-pane fade"><br>
            <p>Insert the cuisine category you want to insert in menu. Categories already chosen may be inserted in menu. <span class="text-danger">Doesn't work yet.</span></p><a href="admin_theme3.html#menu2">Insert Cuisine Item</a><br><br>
            <form>
              <div class="form-group row">
                <label for="itemName" class="col-md-1 col-form-label">Category:</label>
                <div class="col-md-11">
                  <select id="itemName" class="custom-select">
                    <option selected="selected">Nepali</option>
                    <option>Continental</option>
                    <option>Fast Food</option>
                    <option>Bakery</option>
                  </select>
                </div>
              </div>
              <a href="#" class="btn btn-success">Submit</a>
            </form>
          </div><!-- Tab3 content wrapper -->
            <div id="menu3" class="container tab-pane fade"><br>
              <p>Cuisine categories list inside Menu. <span class="text-danger">Doesn't work yet.</span></p><a href="admin_theme3.html#menu3">Delete Category Items</a><br><br>
              <div class="card-deck">
                <div class="card" style="width: 250px; border-radius: 20px;">
                  <div class="card-body">
                    <strong>Nepali</strong><button type="button" class="btn btn-sm btn-danger float-right"><i class="fas fa-trash"></i> Delete</button>
                  </div>
                </div>
                <div class="card" style="width: 250px; border-radius: 20px;">
                  <div class="card-body">
                    <strong>Indian</strong><button type="button" class="btn btn-sm btn-danger float-right"><i class="fas fa-trash"></i> Delete</button>
                  </div>
                </div>
                <div class="card" style="width: 250px; border-radius: 20px;">
                  <div class="card-body">
                    <strong>Continental</strong><button type="button" class="btn btn-sm btn-danger float-right"><i class="fas fa-trash"></i> Delete</button>
                  </div>
                </div>
                <div class="card" style="width: 250px; border-radius: 20px;">
                  <div class="card-body">
                    <strong>Chinese</strong><button type="button" class="btn btn-sm btn-danger float-right"><i class="fas fa-trash"></i> Delete</button>
                  </div>
                </div>
              </div>
            </div><!-- Tab4 content wrapper -->
          </div><!-- Tab Content Wrapper -->
        </div><!-- Container Wrapper -->
      </div><!-- Content wrapper -->