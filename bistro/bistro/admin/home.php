<?php 
$fileName = "";
if(isset($_POST['slideSubmit'])){/* slideSubmit Start */
  $sliderName = $_POST['sliderName'];
  $sliderImg = $_FILES['sliderImg'];

  $sliderImgName = $sliderImg['name'];
  $sliderImgTmpName = $_FILES['sliderImg']['tmp_name'];
  $sliderImgSize = $_FILES['sliderImg']['size'];
  $sliderImgError = $_FILES['sliderImg']['error'];
  $sliderImgType = $_FILES['sliderImg']['type'];

  $sliderImgExt = explode('.', $sliderImgName);
  $sliderActExt = strtolower(end($sliderImgExt));
  list($width, $height) = getimagesize($sliderImgTmpName);
  
  $allowed = array('jpg', 'jpeg' , 'png');

  if(in_array($sliderActExt, $allowed)){/* inarray Start */
    if($sliderImgError == 0){/* sliderImg Start */
      if($width != 1366 && $height != 768){
        echo "<script>alert('Pictures with height exactly 1366 &times; 768 can be uploaded.')</script>";
      }
      else{/* width start */
        $imgNameNew = uniqid('',true) . "." . $sliderActExt;
        $imgDestination = '../uploads/slides/' . $imgNameNew;
        $img_insert = "INSERT INTO slides(name,img) VALUES('$sliderName','$imgNameNew')";
        $tbl_select = "SELECT * from slides";
        $tbl = mysqli_query($con,$tbl_select);
        $count = mysqli_num_rows($tbl);
        if($count>=5){
          echo "<script>alert('Only 5 slides to upload at a time!');</script>";
        }
        else if(mysqli_query($con,$img_insert)){
          move_uploaded_file($sliderImgTmpName, $imgDestination);
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
}/* slideSubmit End */
if(isset($_POST['editSlide'])){
    $editId = $_POST['id'];
    $tbl_select = "SELECT * from slides WHERE id='$editId'";
    $tbl = mysqli_fetch_assoc(mysqli_query($con,$tbl_select));
    echo '<div class="card-body">
              <h3>Edit Slide</h3>
              <form method="post" enctype="multipart/form-data">
                <div class="form-group row">
                  <label for="sliderName" class="col-md-2 col-form-label">Slider Name</label>
                  <div class="col-md-10">
                    <input type="text" class="form-control" name="sliderName" required="required" value="' . $tbl['name'] . '">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="sliderImg" class="col-md-2 col-form-label">Slider Image</label>
                  <div class="col-md-10">
                    <input type="file" class="form-control" name="sliderImg">
                  </div>
                </div>
                <input type="hidden" name="edit_id" value="' . $editId . '">
              <button type="submit" name="editSlideSubmit" class="btn btn-primary">Edit</button>
              </form>
        </div><hr>';
}
if(isset($_POST['editSlideSubmit'])){
  $sliderName = $_POST['sliderName'];
  $editId = $_POST['edit_id'];
  
  if($_FILES['sliderImg']['name']==""){
    $txt_update = "UPDATE slides SET name='$sliderName' WHERE id='$editId'";
    if(mysqli_query($con,$txt_update)){
      echo "<script>alert('Updated.')</script>";
    }
    else
    {
      echo "Error";
    }
  }

  else{
    $sliderName = $_POST['sliderName'];
    $sliderImg = $_FILES['sliderImg'];

    $sliderImgName = $sliderImg['name'];
    $sliderImgTmpName = $_FILES['sliderImg']['tmp_name'];
    $sliderImgSize = $_FILES['sliderImg']['size'];
    $sliderImgError = $_FILES['sliderImg']['error'];
    $sliderImgType = $_FILES['sliderImg']['type'];

    $sliderImgExt = explode('.', $sliderImgName);
    $sliderActExt = strtolower(end($sliderImgExt));
    list($width, $height) = getimagesize($sliderImgTmpName);
    
    $allowed = array('jpg', 'jpeg' , 'png');

    if(in_array($sliderActExt, $allowed)){
        if($sliderImgError == 0){
          if($width != 1366 && $height != 768){
            echo "<script>alert('Pictures with height exactly 1366 &times; 768 can be uploaded.')</script>";
          }
          else{
              $imgNameNew = uniqid('',true) . "." . $sliderActExt;
              $imgDestination = '../uploads/slides/' . $imgNameNew;
              move_uploaded_file($sliderImgTmpName, $imgDestination);
              $img_update = "UPDATE slides SET name='$sliderName', img='$imgNameNew' WHERE id = '$editId'";
              $tbl_select = "SELECT * from slides WHERE id='$editId'";
              $tbl = mysqli_query($con,$tbl_select);
              $tbl = mysqli_fetch_assoc($tbl);
              $oldfileName = $tbl['img'];
              if(mysqli_query($con,$img_update)){
                $path = "../uploads/slides/" . $oldfileName;
                unlink($path);
                echo "<script>alert('Updated Successfully!');</script>";
              }
              else{
                echo "<script>alert('Database Upload Error!');</script>";
              }
          }
        }
        else{
          echo "<script>alert('There was an error uploading the file.')</script>";
        }
    }  
    else{
      echo "<script>alert('Only png, jpg & jpeg allowed to be uploaded.')</script>";
    }
  }
}
  if(isset($_POST['deleteSlide'])){
    $deleteId = $_POST['id'];
    $select = "SELECT * from slides WHERE id='$deleteId'";
    $select_res = mysqli_query($con,$select);
    $select_resr = mysqli_fetch_assoc($select_res);
    $fileName = $select_resr['img'];
    $delete = "DELETE from slides WHERE id='$deleteId'";
    if(mysqli_query($con,$delete)){
      $path = "../uploads/slides/" . $fileName;
      unlink($path);
      echo "<script>alert('Successfully deleted.')</script>";
    }
    else{
      echo "error";
    }
  }
 ?>
      <div class="container-fluid">
        <h1 class="mt-4"><i class="fas fa-home"></i> Home Page</h1>
        <div class="container">
          <br>
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#home"><i class="fas fa-fire-alt"></i> Offers</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#menu1"><i class="fas fa-layer-group"></i> Slider</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#menu2"><i class="fas fa-bolt"></i> Featured</a>
            </li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <div id="home" class="container tab-pane active"><br/>
              <p>Control your offers from here. There can be maximum 5 offers at a time. <span class="text-danger">Doesn't work yet.</span></p>
              <h4>Offer Title:</h4>
              <p>Dashain Maha Sales Offer</p>
              <form action="">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="New Title" aria-label="Recipient's username" aria-describedby="basic-addon2">
                  <div class="input-group-append">
                    <button type="button" class="btn btn-danger">Update Title</button>
                  </div>
                </div>
              </form>
              <form action="">
                <button type="button" class="btn btn-primary">Add Offer Item</button>
              </form><br/>
              <table class="table table-responsive  ">
              <thead>
                <tr>
                  <th scope="col">Offer no.</th>
                  <th scope="col">Percent (%)</th>
                  <th scope="col">Cuisine Id</th>
                  <th scope="col">Discount Amount</th>
                  <th scope="col">Amount</th>
                  <th scope="col" colspan="2" class="text-center">Options</th>
                </tr>
                <tr>
                  <td>1</td>
                  <td>5</td>
                  <td>12</td>
                  <td>12,000</td>
                  <td>14,000</td>
                  <td><button type="button" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Edit</button></td>
                  <td><button type="button" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button></td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>3</td>
                  <td>12</td>
                  <td>1,000</td>
                  <td>1,800</td>
                  <td><button type="button" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Edit</button></td>
                  <td><button type="button" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button></td>
                </tr>
              </thead>
            </table>
            </div>
            <div id="menu1" class="container tab-pane fade"><br>
              <p>Add, edit or delete slides from here. There can be maximum 5 slides at a time.</p>
              <div id="accordion">
                <div class="card">
                  <div class="card-header">
                    <a class="card-link" data-toggle="collapse" href="#collapseOne">
                      Insert Slide
                    </a>
                  </div>
                  <div id="collapseOne" class="collapse" data-parent="#accordion">
                    <div class="card-body">

                          <form method="post" enctype="multipart/form-data">
                            <div class="form-group row">
                              <label for="sliderName" class="col-md-2 col-form-label">Slider Name</label>
                              <div class="col-md-10">
                                <input type="text" class="form-control" name="sliderName" required="required">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="sliderImg" class="col-md-2 col-form-label">Slider Image</label>
                              <div class="col-md-10">
                                <input type="file" class="form-control" name="sliderImg" required="required">
                              </div>
                            </div>
                          <button type="submit" name="slideSubmit" class="btn btn-primary">Submit</button>
                          </form>
                    </div>
                  </div>
                </div><br>

                <div class="card">
                  <div class="card-header">
                    <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                      View Slides
                    </a>
                  </div>
                  <div id="collapseTwo" class="collapse show" data-parent="#accordion">
                    <div class="card-body row">
                      <?php 
                      $tbl_select = "SELECT * from slides";
                      $tbl = mysqli_query($con,$tbl_select);
                      while($tblrow = mysqli_fetch_assoc($tbl)){
                        echo 
                        '<form method="post"><div class="card border-secondary mb-3 mx-1" style="max-width: 18rem;">
                        <div class="card-header border-secondary text-center bg-primary text-white">' . $tblrow['name'] . '</div>
                        <div class="card-body">
                          <img src="../uploads/slides/' . $tblrow['img'] . '" class="img-thumbnail">
                        </div>
                        <div class="card-footer bg-transparent border-secondary">
                          <input type="hidden" name="id" value="' . $tblrow['id'] . '">
                          <button name="editSlide" type="submit" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i> Edit</button>
                          <button name="deleteSlide" type="submit" class="btn btn-danger btn-sm float-right"><i class="fas fa-trash"></i> Delete</button>
                        </div>
                      </div></form>';
                      }

                       ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div id="menu2" class="container tab-pane fade"><br>
              <p>Featured section features dishes & featured categories section features categories. <span class="text-danger">Doesn't work yet.</span></p>
              <h4>Featured Section</h4>
              <div id="accordion">
                <div class="card">
                  <div class="card-header">
                    <a class="card-link" data-toggle="collapse" href="#collapseOne">
                      Insert Item
                    </a>
                  </div>
                  <div id="collapseOne" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                          <form>
                            <div class="form-group row">
                              <label for="itemName" class="col-md-1 col-form-label">Item:</label>
                              <div class="col-md-11">
                                <select id="itemName" class="custom-select">
                                  <option selected="selected">Chowmein</option>
                                  <option>Momo</option>
                                  <option>Pizza</option>
                                  <option>Burger</option>
                                </select>
                              </div>
                            </div>
                          </form>
                          <a href="#" class="btn btn-primary">Submit</a>
                    </div>
                    </div>
                  </div>
                </div><br>

                <div class="card">
                  <div class="card-header">
                    <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                      View Items
                    </a>
                  </div>
                  <div id="collapseTwo" class="collapse show" data-parent="#accordion">
                    <div class="card-body row">
                      <div class="card border-secondary mb-3 mx-1" style="max-width: 18rem;">
                        <div class="card-header border-secondary text-center bg-primary text-white">Chowmein</div>
                        <div class="card-body">
                          <img src="slide1.jpg" class="img-thumbnail">
                        </div>
                        <div class="card-footer bg-transparent border-secondary">
                          <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                          <a href="#" class="btn btn-danger btn-sm float-right"><i class="fas fa-trash"></i> Delete</a>
                        </div>
                      </div>
                      <div class="card border-secondary mb-3 mx-1" style="max-width: 18rem;">
                        <div class="card-header border-secondary text-center bg-primary text-white">Momo</div>
                        <div class="card-body">
                          <img src="slide2.jpg" class="img-thumbnail">
                        </div>
                        <div class="card-footer bg-transparent border-secondary">
                          <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                          <a href="#" class="btn btn-danger btn-sm float-right"><i class="fas fa-trash"></i> Delete</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <br>
            <h4>Featured Categories Section</h4>
            <div id="accordion">
                <div class="card">
                  <div class="card-header">
                    <a class="card-link" data-toggle="collapse" href="#collapseOne1">
                      Insert Category
                    </a>
                  </div>
                  <div id="collapseOne1" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                          <form>
                            <div class="form-group row">
                              <label for="itemName" class="col-md-1 col-form-label">Item:</label>
                              <div class="col-md-11">
                                <select id="itemName"class="custom-select">
                                  <option selected="selected">Fast Food</option>
                                  <option>Nepali</option>
                                  <option>Continental</option>
                                  <option>Bakery</option>
                                </select>
                              </div>
                            </div>
                          </form>
                          <a href="#" class="btn btn-primary">Submit</a>
                    </div>
                    </div>
                  </div>
                </div><br>

                <div class="card">
                  <div class="card-header">
                    <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo2">
                      View Categories
                    </a>
                  </div>
                  <div id="collapseTwo2" class="collapse show" data-parent="#accordion">
                    <div class="card-body row">
                      <div class="card border-secondary mb-3 mx-1" style="max-width: 18rem;">
                        <div class="card-header border-secondary text-center bg-primary text-white">Fast Food</div>
                        <div class="card-body">
                          <img src="slide1.jpg" class="img-thumbnail">
                        </div>
                        <div class="card-footer bg-transparent border-secondary">
                          <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                          <a href="#" class="btn btn-danger btn-sm float-right"><i class="fas fa-trash"></i> Delete</a>
                        </div>
                      </div>
                      <div class="card border-secondary mb-3 mx-1" style="max-width: 18rem;">
                        <div class="card-header border-secondary text-center bg-primary text-white">Nepali</div>
                        <div class="card-body">
                          <img src="slide2.jpg" class="img-thumbnail">
                        </div>
                        <div class="card-footer bg-transparent border-secondary">
                          <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                          <a href="#" class="btn btn-danger btn-sm float-right"><i class="fas fa-trash"></i> Delete</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>  
            </div>  
            </div>
          </div>
        </div>

      </div>