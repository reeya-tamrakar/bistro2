<?php 
$cuiName="";
$cuiDescription="";
$cuiToFDc="";
if(isset($_POST['cuiUpload'])){ 
  $cuiName = $_POST['cuiName'];
  $cuiDescription = $_POST['cuiDescription'];
  $cuiCat = $_POST['cuiCat'];
  $cuiIdQ = "SELECT id from cuisinecats WHERE name='$cuiCat'";
  $cuiIdQRes = mysqli_fetch_assoc(mysqli_query($con,  $cuiIdQ));
  $cuiId = $cuiIdQRes['id'];
  $cuiToQ = $_POST['cuiToQ'];
  $cuiImg = $_FILES['cuiImg'];
  $cuiImg2 = $_FILES['cuiImg2'];
  $cuiImg3 = $_FILES['cuiImg3'];
  $cuiWar = $_POST['cuiWar'];
  $cuiToFD = $_POST['cuiToFD'];
  $cuiToFDc .= implode(",", $cuiToFD);


  $cuiImgName = $cuiImg['name'];
  $cuiImgTmpName = $_FILES['cuiImg']['tmp_name'];
  $cuiImgSize = $_FILES['cuiImg']['size'];
  $cuiImgError = $_FILES['cuiImg']['error'];
  $cuiImgType = $_FILES['cuiImg']['type'];
  $cuiImgExt = explode('.', $cuiImgName);
  $cuiActExt = strtolower(end($cuiImgExt));
  list($width, $height) = getimagesize($cuiImgTmpName);

  $cuiImg2Name = $cuiImg2['name'];
  $cuiImg2TmpName = $_FILES['cuiImg2']['tmp_name'];
  $cuiImg2Size = $_FILES['cuiImg2']['size'];
  $cuiImg2Error = $_FILES['cuiImg2']['error'];
  $cuiImg2Type = $_FILES['cuiImg2']['type'];
  $cuiImg2Ext = explode('.', $cuiImg2Name);
  $cuiAct2Ext = strtolower(end($cuiImg2Ext));
  list($width2, $height2) = getimagesize($cuiImg2TmpName);

  $cuiImg3Name = $cuiImg3['name'];
  $cuiImg3TmpName = $_FILES['cuiImg3']['tmp_name'];
  $cuiImg3Size = $_FILES['cuiImg3']['size'];
  $cuiImg3Error = $_FILES['cuiImg3']['error'];
  $cuiImg3Type = $_FILES['cuiImg3']['type'];
  $cuiImg3Ext = explode('.', $cuiImg3Name);
  $cuiAct3Ext = strtolower(end($cuiImg3Ext));
  list($width3, $height3) = getimagesize($cuiImg3TmpName);

  $allowed = array('jpg', 'jpeg' , 'png');

    if(in_array($cuiActExt, $allowed) && in_array($cuiAct2Ext, $allowed) && in_array($cuiAct3Ext, $allowed)){/* inarray Start */
      if($cuiImgError == 0 && $cuiImg2Error == 0 && $cuiImg3Error == 0){/* sliderImg Start */
        if($width != 1366 && $height != 768 && $width3 > 1024 && $height3 > 600 && $width2 > 1024 && $height2 > 600){
          echo "<script>alert('Pictures with height exactly 1366*768 can be uploaded.')</script>";
        }
        else{/* width start */
          $imgNameNew = uniqid('',true) . "." . $cuiActExt;
          $imgNameNew2 = uniqid('',true) . "." . $cuiAct2Ext;
          $imgNameNew3 = uniqid('',true) . "." . $cuiAct3Ext;
          $imgDestination = '../uploads/cuisines/' . $imgNameNew;
          $imgDestination2 = '../uploads/cuisines/' . $imgNameNew2;
          $imgDestination3 = '../uploads/cuisines/' . $imgNameNew3;
          $cui_insert = "INSERT INTO cuisines(name,category,cat_id,type_of_qty,description,img1,img2,img3,warmth,type) VALUES('$cuiName','$cuiCat','$cuiId','$cuiToQ','$cuiDescription','$imgNameNew','$imgNameNew2','$imgNameNew3','$cuiWar','$cuiToFDc')";
          if(mysqli_query($con,$cui_insert)){
            move_uploaded_file($cuiImgTmpName, $imgDestination);
            move_uploaded_file($cuiImg2TmpName, $imgDestination2);
            move_uploaded_file($cuiImg3TmpName, $imgDestination3);
            $cuiName = "";
            $cuiDescription = "";
            $cuiCat = "";
            $cuiToQ = "";
            $cuiImg = "";
            $cuiImg2 = "";
            $cuiImg3 = "";
            $cuiWar = "";
            $cuiToFD = "";
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
if(isset($_POST['cuiDelete'])){
  $deleteId = $_POST['id'];
  $tbl_select = "SELECT * FROM cuisines WHERE id='$deleteId'";
  $tbl = mysqli_fetch_assoc(mysqli_query($con,$tbl_select));
  $oldDest = "../uploads/cuisines/" . $tbl['img1']; 
  $oldDest2 = "../uploads/cuisines/" . $tbl['img2']; 
  $oldDest3 = "../uploads/cuisines/" . $tbl['img3']; 
  $cuiDelete = "DELETE FROM cuisines WHERE id='$deleteId'";
  if(mysqli_query($con,$cuiDelete)){
    unlink($oldDest);
    unlink($oldDest2);
    unlink($oldDest3);
    echo "<script>alert('Deleted Successfully!');</script>";
  }
  else{
    echo "error";
  }
}
if(isset($_POST['cuiEdit'])){
  $editId = $_POST['id'];
  echo '';
}
 ?>
<div class="container-fluid"><!-- Content -->
        <h1 class="mt-4"><i class="fas fa-utensils"></i> Cuisines</h1>
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
              <p>Insert cuisine items from here.</p>
              <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="cuiName">Cuisine Name</label>
                  <input type="text" class="form-control" name="cuiName" required="required" value="<?php echo $cuiName ?>">
                  <small id="nameHelpBlock" class="form-text text-muted">
                    Your name must be 10-25 characters long, not more.
                  </small>
                </div>
                <div class="form-group">
                  <label for="cuiDescription">Cuisine Category</label>
                  <div class="input-group mb-3">
                    <select class="custom-select" name="cuiCat" required="required">
                      <option selected disabled>Choose...</option>
                      <?php 
                      $tbl_select = "SELECT * from cuisinecats";
                      $tbl = mysqli_query($con,$tbl_select);
                      while($tblrow = mysqli_fetch_assoc($tbl)){
                        echo "<option value='" . $tblrow['name'] . "'"; if(isset($_POST['cuiUpload']) && $tblrow['name'] == $_POST['cuiCat']){echo "selected";} echo ">" . $tblrow['name'] . "</option>";
                      }
                       ?>
                    </select>
                  </div>
                  <small id="descHelpBlock" class="form-text text-muted">
                    Categories already present can be used here. Add more from <a href="index.php?action=cuisinecats">here</a>.
                  </small>
                </div>
                <div class="form-group">
                  <label for="cuiToQ">Type of Quantity</label>
                  <div class="input-group mb-3">
                    <select class="custom-select" name="cuiToQ" required="required">
                      <option selected disabled>Choose...</option>
                      <optgroup label="Food">
                        <option value="plate" <?php if(isset($_POST['cuiUpload']) && $_POST['cuiToQ']=="plate"){echo "selected";} ?>>plate</option>
                        <option value="stick" <?php if(isset($_POST['cuiUpload']) && $_POST['cuiToQ']=="stick"){echo "selected";} ?>>stick</option>
                        <option value="piece" <?php if(isset($_POST['cuiUpload']) && $_POST['cuiToQ']=="piece"){echo "selected";} ?>>piece</option>
                        <option value="bowl" <?php if(isset($_POST['cuiUpload']) && $_POST['cuiToQ']=="bowl"){echo "selected";} ?>>bowl</option>
                      </optgroup>
                      <optgroup label="Drink">
                        <option value="cup" <?php if(isset($_POST['cuiUpload']) && $_POST['cuiToQ']=="cup"){echo "selected";} ?>>cup</option>
                        <option value="glass" <?php if(isset($_POST['cuiUpload']) && $_POST['cuiToQ']=="glass"){echo "selected";} ?>>glass</option>
                        <option value="bottle" <?php if(isset($_POST['cuiUpload']) && $_POST['cuiToQ']=="bottle"){echo "selected";} ?>>bottle</option>
                      </optgroup>
                      <option value="n/a">N/A</option>
                    </select>
                  </div>
                  <small id="descHelpBlock" class="form-text text-muted">
                    Some food items are in plates, some are in sticks or pieces, drinks are in cups, glasses etc. Choose suitable type of quantity for your cuisine.
                  </small>
                </div>
                <div class="form-group">
                  <label for="cuiDescription">Cuisine Description</label>
                  <textarea class="form-control" name="cuiDescription" rows="3" required="required"><?php echo $cuiDescription ?></textarea>
                  <small id="descHelpBlock" class="form-text text-muted">
                    Description is about 200 characters long.
                  </small>
                </div>
                <div class="form-group">
                  <label for="cuiImg">Cuisine Thumbnail Picture</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="cuiImg" required="required">
                    <label class="custom-file-label" for="cuiImg">Choose Img 1</label>
                    <small id="descHelpBlock" class="form-text text-muted">
                    Thumbnail image to be exactly 1366 &times; 768.
                  </small>
                  </div><br><br>
                  <label>Other Pictures (2)</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="cuiImg2" required="required">
                    <label class="custom-file-label" for="cuiImg2">Choose Img 2</label>
                  </div>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="cuiImg3" required="required">
                    <label class="custom-file-label" for="cuiImg3">Choose Img 3</label>
                  </div>
                  <small id="picHelpBlock" class="form-text text-muted">
                    Select png, jpg.
                  </small>
                </div>
                <div class="form-group">
                  <label for="cuiWar">Food/Drink Warmth</label>
                  <div class="input-group mb-3">
                    <select class="custom-select" name="cuiWar" required="required">
                      <option selected disabled>Choose...</option>
                      <option value="not applicable" <?php if(isset($_POST['cuiUpload']) && $_POST['cuiWar']=="not applicable"){echo "selected";} ?>>not applicable</option>
                      <option value="hot" <?php if(isset($_POST['cuiUpload']) && $_POST['cuiWar']=="hot"){echo "selected";} ?>>hot/cold</option>
                       ?>
                    </select>
                  </div>
                  <small id="descHelpBlock" class="form-text text-muted">
                    Applies to those cuisines where it is implied.
                  </small>
                </div>
                <div class="form-group">
                  <label for="cuiToFD">Type of Food/Drink (Ctrl + Click to Select Mulitple)</label>
                  <select class="custom-select" name="cuiToFD[]" required="required" multiple="multiple">
                    <option>Choose...</option>
                    <optgroup label="Food">
                      <option value="sour" <?php if(isset($_POST['cuiUpload']) && in_array("sour", $_POST['cuiToFD'])){echo "selected";} ?>>sour</option>
                      <option value="veg" <?php if(isset($_POST['cuiUpload']) && in_array("veg", $_POST['cuiToFD'])){echo "selected";} ?>>veg</option>
                      <option value="non-veg" <?php if(isset($_POST['cuiUpload']) && in_array("non-veg", $_POST['cuiToFD'])){echo "selected";} ?>>non-veg</option>
                      <option value="non-egg" <?php if(isset($_POST['cuiUpload']) && in_array("non-egg", $_POST['cuiToFD'])){echo "selected";} ?>>non-egg</option>
                      <option value="sweet" <?php if(isset($_POST['cuiUpload']) && in_array("sweet", $_POST['cuiToFD'])){echo "selected";} ?>>sweet</option>
                      <option value="spicy" <?php if(isset($_POST['cuiUpload']) && in_array("spicy", $_POST['cuiToFD'])){echo "selected";} ?>>spicy</option>
                    </optgroup>
                    <optgroup label="Drink">
                      <option value="soft" <?php if(isset($_POST['cuiUpload']) && in_array("soft", $_POST['cuiToFD'])){echo "selected";} ?>>soft</option>
                      <option value="medium" <?php if(isset($_POST['cuiUpload']) && in_array("medium", $_POST['cuiToFD'])){echo "selected";} ?>>medium</option>
                      <option value="hard" <?php if(isset($_POST['cuiUpload']) && in_array("hard", $_POST['cuiToFD'])){echo "selected";} ?>>hard</option>
                    </optgroup>
                    <option value="n/a" <?php if(isset($_POST['cuiUpload']) && in_array("n/a", $_POST['cuiToFD'])){echo "selected";} ?>>N/A</option>
                  </select>
                  <small id="descHelpBlock" class="form-text text-muted">
                    Applies to those cuisines where it is implied.
                  </small>
                </div>
                  <button type="submit" name="cuiUpload" class="btn btn-primary">Submit</button>
              </form>
            </div><!-- Tab1 content wrapper -->
          <div id="menu1" class="container tab-pane fade"><br>
            <p>These are list of all the cuisine items present in the website. <span class="text-danger">Edit doesn't work yet.</span></p>
            <table class="table table-striped table-responsive">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Type of Qty</th>
                  <th>Description</th>
                  <th>Thumbnail pic</th>
                  <th>Pic 2</th>
                  <th>Pic 3</th>
                  <th>Warmth</th>
                  <th>Type</th>
                  <th colspan="2">Options</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $cat_select = "SELECT * FROM cuisinecats";
                $cat_res = mysqli_query($con,$cat_select);
                while($cat_res_row = mysqli_fetch_assoc($cat_res)){
                  $cat_id = $cat_res_row['id'];
                  $cat_name = $cat_res_row['name'];

                  echo '<tr><th colspan="10">' . $cat_name . '</th></tr>';
                  $cui_select = "SELECT * FROM cuisines WHERE cat_id='$cat_id'";
                  $cui_res = mysqli_query($con,$cui_select);
                  while($cui_res_row = mysqli_fetch_assoc($cui_res)){
                    echo '<tr><form method="post">
                  <td scope="col">' . $cui_res_row['name'] . '</td>
                  <td scope="col">' . $cui_res_row['type_of_qty'] . '</td>
                  <td scope="col">' . $cui_res_row['description'] . '</td>
                  <td scope="col"><img class="img-thumbnail" src="../uploads/cuisines/' . $cui_res_row['img1'] . '"></td>
                  <td scope="col"><img class="img-thumbnail" src="../uploads/cuisines/' . $cui_res_row['img2'] . '"></td>
                  <td scope="col"><img class="img-thumbnail" src="../uploads/cuisines/' . $cui_res_row['img3'] . '"></td>
                  <td scope="col">' . $cui_res_row['warmth'] . '</td>
                  <td scope="col">' . $cui_res_row['type'] . '</td>
                  <input type="hidden" name="id" value="' . $cui_res_row['id'] . '">
                  <td scope="col"><button type="submit" class="btn btn-sm btn-primary" name="cuiEdit"><i class="fas fa-pencil-alt"></i> Edit</button><br><br>
                  </td><td scope="col"><button type="submit" class="btn btn-sm btn-danger" name="cuiDelete"><i class="fas fa-trash"></i> Delete</button>
                  </td></form>
                </tr>';
                  }
                }
                 ?>
              </tbody>
            </table>
          </div><!-- Tab2 content wrapper -->
          <div id="menu2" class="container tab-pane fade"><br>
            <p>Insert the cuisine item you want to insert in menu.</p><p>Each category can contain 5 items. Categories already chosen from cuisine categories will only be selectable from here. <span class="text-danger">Doesn't work yet.</span></p>
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
              <div class="form-group row">
                <label for="itemName" class="col-md-1 col-form-label">Item:</label>
                <div class="col-md-11">
                  <select id="itemName" class="custom-select">
                    <option selected="selected">Momo</option>
                    <option>Samay Baji</option>
                    <option>Yomari</option>
                    <option>Dal Bhat</option>
                  </select>
                </div>
              </div>
              <a href="#" class="btn btn-success">Submit</a>
            </form>
          </div><!-- Tab3 content wrapper -->
            <div id="menu3" class="container tab-pane fade"><br>
              <p>View all the cuisines in the menu according to respective categories. Each category can contain 5 items.  <span class="text-danger">Doesn't work yet.</span></p><a href="admin_theme4.html#menu3">Delete Category</a><br><br>
              <div class="row">
                <table class="table table-striped table-responsive col-md-4">
                  <thead>
                    <tr>
                      <td colspan="3" class="bg-primary text-white">Nepali</td>
                    </tr>
                    <tr>
                      <th scope="col">Cuisine Id</th>
                      <th scope="col">Name</th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">12</th>
                      <td>Dal Bhat</td>
                      <td><button type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button></td>
                    </tr>
                    <tr>
                      <th scope="row">14</th>
                      <td>Momo</td>
                      <td><button type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button></td>
                    </tr>
                    <tr>
                      <th scope="row">17</th>
                      <td>Samay Baji</td>
                      <td><button type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button></td>
                    </tr>
                  </tbody>
                </table>
                <table class="table table-striped table-responsive col-md-4">
                  <thead>
                    <tr>
                      <td colspan="3" class="bg-primary text-white">Indian</td>
                    </tr>
                    <tr>
                      <th scope="col">Cuisine Id</th>
                      <th scope="col">Name</th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">68</th>
                      <td>Poha</td>
                      <td><button type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button></td>
                    </tr>
                    <tr>
                      <th scope="row">65</th>
                      <td>Sukto</td>
                      <td><button type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button></td>
                    </tr>
                    <tr>
                      <th scope="row">73</th>
                      <td>Jalevi Phapda</td>
                      <td><button type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button></td>
                    </tr>
                    <tr>
                      <th scope="row">58</th>
                      <td>Idli Dosa</td>
                      <td><button type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button></td>
                    </tr>
                  </tbody>
                </table>
                <table class="table table-striped table-responsive col-md-4">
                  <thead>
                    <tr>
                      <td colspan="3" class="bg-primary text-white">Continental</td>
                    </tr>
                    <tr>
                      <th scope="col">Cuisine Id</th>
                      <th scope="col">Name</th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">39</th>
                      <td>Fish Curry</td>
                      <td><button type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button></td>
                    </tr>
                    <tr>
                      <th scope="row">26</th>
                      <td>Salad</td>
                      <td><button type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button></td>
                    </tr>
                    <tr>
                      <th scope="row">45</th>
                      <td>Pizza</td>
                      <td><button type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button></td>
                    </tr>
                    <tr>
                      <th scope="row">32</th>
                      <td>Burger</td>
                      <td><button type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div><!-- Tab4 content wrapper -->
          </div><!-- Tab Content Wrapper -->
        </div><!-- Container Wrapper -->
      </div><!-- Content wrapper -->