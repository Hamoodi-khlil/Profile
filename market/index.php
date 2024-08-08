<?php
$page_title = 'تسجيل الدخول';
session_start();
require './includes/header.php';

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $page_title; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <link rel="stylesheet" href="<?php echo $directory; ?>/assets/css/style.css">
  <link href="assets/imgs/favicon.png" rel="icon">

</head>

<body>
  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.php" class="logo d-flex align-items-center w-auto">
                  <img src="./assets/imgs/sidebar.png" style="height: 70px;  width: 80px;" alt="">
                  
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4"><i class="bi bi-person"></i>تسجيل الدخول لحسابك</h5>

                  </div>

                  <form class="row g-3 needs-validation" novalidate method="POST" action="includes/functions.php">

                    <div class="col-12">
                      <label for="yourUsername" class="form-label fs-5">البريد الالكتروني</label>
                      <div class="input-group has-validation">

                        <input type="text" name="user_email" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>



                    <div class="col-12">
                      <label for="yourPassword" class="form-label fs-5">كلمه المرور </label>
                      <input type="password" name="user_password" class="form-control" id="yourPassword" required>

                    </div>



             
                    <div class="d-grid gap-2 mt-5 mb-1 col-12">
                        <button type="submit" name="login" value="1" class="btn btn-dark btn-lg"><i class="bi bi-box-arrow-in-left"></i> تسجيل الدخول</button>
                    </div>

                </form>

                
                <p class="vv"><?php echo isset($_SESSION['error_msg']) ? $_SESSION['error_msg'] : '' ; ?></p>
                
                

              </div>
            </div>



          </div>
        </div>
    </div>

    </section>

    </div>
  </main><!-- End #main -->


  <script>


    $(document).ready(function() {

      $(".vv").keydown(function(){  

        $(this).css('color' , 'red');



      });



    });


    
  </script>
</body>

</html>