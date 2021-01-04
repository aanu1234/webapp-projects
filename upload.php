<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upload External Files</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      <div class="row">
        <?php
        if (isset($_POST['uploadnow'])) {
          $file  = isset($_FILES['docfile']) ? $_FILES['docfile'] : '';
          if ($file) {
            //file open and read
            $handle = fopen($file, "r");
            $c = 0;
            while(($filesop = fgetcsv($handle, 1000, ",")) !== false){
              $name = $filesop[0];
              $email = $filesop[1];
              $sql = mysql_query("INSERT INTO phpxlsupload (name, email) VALUES ('$name','$email')");
            }

            if($sql){
              $response = "Your has been uploaded successfully";
            }else{
              $response = "Sorry! There is a problem uploading your file";
            }
          }
        }
        ?>
        <div class="col-lg-8 col-md-8 col-sm-12">
          <div class="card">
            <div class="card-header">
              Make your upload here
            </div>
            <div class="card-body">
              <?php if (!empty($response)): ?>
                <div class="alert alert-info">
                  <?=$response?>
                </div>
              <?php endif; ?>
              <form class="form_upload" method="post" enctype="multipart/form-data">
                <div class="form-group mt-2">
                  <label for="docfile" class="col-md-3">Choose File to Upload<span class="text-danger">* </span></label>
                  <div class="col-md-9">
                    <input class="form-control" type="file" name="docfile" >
                  </div>
                </div>
                <div class="form-group mt-2">
                  <label for="description" class="col-md-3">Description (Optional)</label>
                  <div class="col-md-9">
                    <textarea class="form-control" name="description" ></textarea>
                  </div>
                </div>
                <div class="form-group mt-2">
                  <div class="col-md-9"></div>
                  <div class="col-md-3">
                    <button type="submit" class="btn btn-primary" name="uploadnow">Upload Now</button>
                  </div>
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script> -->
  </body>
</html>
