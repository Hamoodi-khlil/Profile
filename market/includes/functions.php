<?php

session_start();
require 'config.php';


$timezone = new DateTimeZone('Asia/Baghdad');
$date = new DateTime('now', $timezone);
$created_at = $updated_at = $date->format('Y-m-d h:i:s');

// معلومات اليوزر 
// اذا رح تجي من طلب يحتوي على كلمة لوكن 
if (isset($_POST['login'])) {




    // تعيين متغيرات الي رح تجي من الفورم 
    $email = $_POST['user_email'];
    $password = $_POST['user_password'];


    // تحضير الكويري او جلب المعلومات من الداتابس
    $statment = $conn->prepare("SELECT `user_id`, `user_name`, `user_email`, `user_password`, `is_active` FROM `users` WHERE user_email = '$email' ");


    // تنفيذ الكود 
    $statment->execute();

    // جلب عدد السطور بعد عملية التنفيذ
    $row_count = $statment->rowCount();


    // اذا كان اكبر من صفر معناها اليوزر موجود اذا لاء معناها مو موجود
    if ($row_count > 0) {


        // جيب كل معلومات اليوزر وافتر عليهم 
        $userInfo = $statment->fetchAll();
        foreach ($userInfo as $row) {


            // جيك اذا اليوزر حالته فعالة لو لاء
            if ($row['is_active'] == 0) {
                $_SESSION['error_msg'] = 'لايمكنك تسجيل الدخول بهذا الحساب';
                header('Location: ../index.php');
            } else {

                // جيك الباسوورد اذا صح او لاء
                if ($row['user_password'] == $password) {


                    setcookie('login_status', 'true', time() + 3600, '/');
                    setcookie('user_name', $row['user_name'], time() + 3600, '/');
                    header('Location: ../pages/dashboard.php');
                } else {

                    $_SESSION['error_msg'] = 'كلمة مرور خاطئة';
                    header('Location: ../index.php');
                }
            }
        }
    } else {
        $_SESSION['error_msg'] = 'هذا المستخدم غير موجود';
        header('Location: ../index.php');
    }
}


//============================//
//=========== insert_user ==========//
//============================//


elseif (isset($_POST['insert_user'])) {



    $statment = $conn->prepare("INSERT INTO `users`(
        
        `user_name`,
        `user_email`,
        `user_password`,
        `is_active`
    )
    VALUES(
        
        '$_POST[user_name]',
        '$_POST[user_email]',
        '$_POST[user_password]',
        '$_POST[is_active]'
    )");

    $statment->execute();

    header("Location: ../pages/Users.php");
}


//============================//
//=========== get_user_info ==========//
//============================//
if (isset($_POST['get_user_info'])) {



    $statement = $conn->prepare("SELECT * FROM `users` WHERE `user_id` = '$_POST[user_id]' ");
    $statement->execute();
    $result = $statement->fetchAll();
    $total_row = $statement->rowCount();
    if ($total_row > 0) {
        foreach ($result as $row) {

            echo '

                    <input type="hidden" name="update_user" value="' . $row['user_id'] . '">
        
                    <div class="form-floating mb-1">
                        <input type="text" class="form-control" name="user_name" id="user_name" value="' . $row['user_name'] . '" required>
                        <label for="user_name">اسم المستخدم</label>
                    </div>


                    <div class="form-floating mb-1">
                        <input type="email" class="form-control" name="user_email" id="user_email" value="' . $row['user_email'] . '" required>
                        <label for="user_email">البريد الالكتروني</label>
                    </div>


                    <div class="form-floating mb-1">
                        <input type="text" class="form-control" name="user_password" id="user_password" value="' . $row['user_password'] . '" required>
                        <label for="user_password">كلمة المرور</label>
                    </div>

                    <div class="form-floating mb-1">
                        <select class="form-select" id="is_active" name="is_active">
                            <option ' . ($row['is_active'] == 1 ? ' selected ' : '') . ' value="1">نشط</option>
                            <option ' . ($row['is_active'] == 0 ? ' selected ' : '') . ' value="0">معلق</option>
                        </select>
                        <label for="is_active">حالة الحساب</label>
                    </div>
        
        ';
        }
    }
}

//============================//
//=========== update_user=========//
//============================//
if (isset($_POST['update_user'])) {



    $statement = $conn->prepare("UPDATE
 `users`
 SET

 `user_name` = '$_POST[user_name]',
 `user_email` = '$_POST[user_email]',
 `user_password` = '$_POST[user_password]',
 `is_active` = '$_POST[is_active]'
 WHERE
 `user_id`= '$_POST[update_user]'
 ");


    $statement->execute();

    header("Location: ../pages/Users.php");
}

//============================//
//=========== delete_user ==========//
//============================//
if (isset($_POST['delete_user'])) {



    $statement = $conn->prepare("DELETE FROM users WHERE user_id = '$_POST[delete_user]'");


    $statement->execute();

    header("Location: ../pages/Users.php");
}





//============================//
//=========== insert_category ==========//
//============================//
if (isset($_POST['insert_category'])) {

    require "../includes/config.php";

    $statement = $conn->prepare("INSERT INTO `categories`(`category_name`)
    VALUES('$_POST[category_name]')");

    $statement->execute();

    header("Location: ../pages/categories.php");
}


//============================//
//=========== get_category_info ==========//
//============================//
if (isset($_POST['get_category_info'])) {

    require '../includes/config.php';

    $statement = $conn->prepare("SELECT * FROM `categories` WHERE `category_id` = '$_POST[category_id]' ");

    $statement->execute();
    $result = $statement->fetchAll();
    $total_row = $statement->rowCount();

    if ($total_row > 0) {
        foreach ($result as $row) {

            echo '

                    <input type="hidden" name="update_category" value="' . $row['category_id'] . '">
        
                    <div class="form-floating mb-1">
                        <input type="text" class="form-control" name="category_name" id="category_name" value="' . $row['category_name'] . '" required>
                        <label for="category_name">اسم التصنيف</label>
                    </div>


                   



                    
        ';
        }
    }
}



//============================//
//=========== update_category ==========//
//============================//
if (isset($_POST['update_category'])) {






    require '../includes/config.php';

    $statement = $conn->prepare("UPDATE
    `categories`
  SET
   
     `category_name` = '$_POST[category_name]'
 WHERE
 `category_id`= '$_POST[update_category]'");

    $statement->execute();

    header("Location: ../pages/categories.php");
}



//============================//
//=========== delete_category ==========//
//============================//
if (isset($_POST["delete_category"])) {
    require '../includes/config.php';

    $statement = $conn->prepare("DELETE FROM `categories` WHERE  `category_id`= '$_POST[delete_category]' ");


    $statement->execute();


    header("Location: ../pages/categories.php");
}




//============================//
//=========== insert_supplier ==========//
//============================//
if (isset($_POST['insert_supplier'])) {
    require '../includes/config.php';

    $statement = $conn->prepare("INSERT INTO `suppliers`(
       
        `supplier_name`,
        `supplier_phone`,
        `supplier_address`,
        `pricing_method`,
        `payment_method`,
        `supplier_notes`,
        `products_type`,
        `is_active`
    )
    VALUES(
        
        '$_POST[supplier_name]',
        '$_POST[supplier_phone]',
        '$_POST[supplier_address]',
        '$_POST[pricing_method]',
        '$_POST[supplier_notes]',
        '$_POST[supplier_notes]',
        '$_POST[products_type]',
        '$_POST[is_active]'
    )");

    $statement->execute();

    header("Location: ../pages/supliers.php");
}




//============================//
//=========== get_supplier_info ==========//
//============================//
if (isset($_POST['get_supplier_info'])) {

    require '../includes/config.php';

    $statement = $conn->prepare("SELECT * FROM `suppliers` WHERE  `supplier_id` = '$_POST[supplier_id]' ");


    $statement->execute();
    $result = $statement->fetchAll();
    $total_row = $statement->rowCount();

    if ($total_row > 0) {
        foreach ($result as $row) {

            echo '
                   
            
                <input type="hidden" name="update_supplier" value="' . $row['supplier_id'] . '">
    
                <div class="modal-body">

                    <div class="row">


                        <div class="col-6">
                            <div class="form-floating mb-1">
                                <input type="text" class="form-control" name="supplier_name" id="supplier_name" value="' . $row['supplier_name'] . '">
                                <label for="supplier_name">اسم المورد</label>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-floating mb-1">
                                <input type="text" class="form-control" name="supplier_phone" id="supplier_phone" value="' . $row['supplier_phone'] . '">
                                <label for="supplier_phone">رقم الهاتف</label>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-floating mb-1">
                                <input type="text" class="form-control" name="supplier_address" id="supplier_address" value="' . $row['supplier_address'] . '">
                                <label for="supplier_address">العنوان</label>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-floating mb-1">
                                <select class="form-select" id="is_active" name="is_active">
                                    <option ' . ($row['is_active'] == 1 ? ' selected ' : '') . ' value="1">نشط</option>
                                    <option ' . ($row['is_active'] == 0 ? ' selected ' : '') . ' value="0">معلق</option>
                                </select>
                                <label for="is_active">حالة الحساب</label>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-floating mb-1">
                                <select class="form-select" id="pricing_method" name="pricing_method">
                                    <option value="">--</option>
                       <option ' . ($row['pricing_method'] == 'retail' ? ' selected ' : '') . ' value="مفرد">مفرد</option>
                      <option  ' . ($row['pricing_method'] == 'wholsale' ? ' selected ' : '') . 'value="جمله">جملة</option>
                                </select>
                                <label for="pricing_method">الية التسعير</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-1">
                                <input type="text" class="form-control" name="payment_method" id="payment_method" value="' . $row['payment_method'] . '">
                                <label for="payment_method">الية الدفع</label>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-floating mb-1">
                                <input type="text" class="form-control" name="products_type" id="products_type" value="' . $row['products_type'] . '">
                                <label for="products_type">نوع المنتجات</label>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-floating mb-1">
                                <textarea class="form-control" name="supplier_notes" cols="30" rows="10">' . $row['supplier_notes'] . '</textarea>
                                <label for="supplier_notes">ملاحظات</label>
                            </div>
                        </div>



                    </div>

                </div>
     
    ';
        }
    }
}

//============================//
//=========== update_supplier ==========//
//============================//
if (isset($_POST['update_supplier'])) {

    require '../includes/config.php';

    $statement = $conn->prepare("UPDATE
    `suppliers`
  SET
   
    `supplier_name` = '$_POST[supplier_name]',
    `supplier_phone` = '$_POST[supplier_phone]',
    `supplier_address` = '$_POST[supplier_address]',
    `pricing_method` = '$_POST[pricing_method]',
    `payment_method` = '$_POST[payment_method]',
    `supplier_notes` = '$_POST[supplier_notes]',
    `products_type` = '$_POST[products_type]',
    `is_active` = '$_POST[is_active]'
  WHERE
   `supplier_id` = '$_POST[update_supplier]'");

    $statement->execute();

    header("Location:../pages/supliers.php");
}

//============================//
//=========== delete_supplier ==========//
//============================//
if (isset($_POST['delete_supplier'])) {
    require '../includes/config.php';

    $statement = $conn->prepare("DELETE FROM `suppliers` WHERE `supplier_id`= '$_POST[delete_supplier]'");

    $statement->execute();

    header("Location: ../pages/supliers.php");
}


// معلومات المنتجات 
//============================//
//=========== insert_product ==========//
//============================//
if (isset($_POST['insert_product'])) {

    require '../includes/config.php';

    $statement = $conn->prepare("INSERT INTO `products`(
    
    `product_code`,
    `product_name`,
    `category_name`,
    `supplier_name`,
    `purchase_price`,
    `sell_price`,
    `is_active`,
    `product_notes`
   )
  VALUES(
    
    '$_POST[product_code]',
    '$_POST[product_name]',
    '$_POST[category_name]',
    '$_POST[supplier_name]',
    '$_POST[purchase_price]',
    '$_POST[sell_price]',
    '$_POST[is_active]',
    '$_POST[product_notes]'
   )");

    $statement->execute();


    header("Location:../pages/products.php");
}

//============================//
//=========== get_product_info ==========//
//============================//
if (isset($_POST['get_product_info'])) {

    require '../includes/config.php';

    $statement = $conn->prepare("SELECT * FROM `products` WHERE `product_id` = '$_POST[product_id]'");

    $statement->execute();

    $result = $statement->fetchAll();
    $total_row = $statement->rowCount();

    if ($total_row > 0) {
        foreach ($result as $row) {

            $product_id = $row['product_id'];
            $product_code = $row['product_code'];
            $supplier_name = $row['supplier_name'];
            $product_name = $row['product_name'];
            $category_name = $row['category_name'];
            $purchase_price = $row['purchase_price'];
            $sell_price = $row['sell_price'];
            $product_notes = $row['product_notes'];



            echo '

                  <input type="hidden" name="update_product" value="' . $product_id . '">
      
                  <div class="modal-body">

                    <div class="row">


                        <div class="col-6">
                            <div class="form-floating mb-1">
                                <input type="text" class="form-control" name="product_code" id="product_code" value="' . $product_code . '" required>
                                <label for="product_code">كود المنتج </label>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-floating mb-1">
                                <input type="text" class="form-control" name="product_name" id="product_name"  value="' . $product_name . '" >
                                <label for="product_name">اسم المنتج</label>
                            </div>
                        </div>

                        <div class="col-6">
                        <div class="form-floating mb-1 fw-bolder">
                        <select class="form-select" id="category_name" name="category_name">
                          <option selected>--</option>';



            $statment = $conn->prepare("SELECT * FROM `categories` WHERE 1");

            $statment->execute();

            $rami = $statment->fetchAll();

            $total_row = $statment->rowCount();

            if ($total_row > 0) {
                foreach ($rami as $row) {
                    echo '<option ';
                    echo $category_name == $row['category_name'] ? ' selected ' : '';
                    echo ' value="' . $row['category_name'] . '">' . $row['category_name'] . '</option>';
                }
            }

            echo '
                        </select>
                        <label for="category_name">اسم الصنف </label>
                        </div>

                    </div>



                        <div class="col-6">
                        <div class="form-floating mb-1 fw-bolder">
                        <select class="form-select" id="supplier_name" name="supplier_name">
                          <option selected>--</option>';



            $statment = $conn->prepare("SELECT * FROM `suppliers` WHERE 1");

            $statment->execute();

            $rami = $statment->fetchAll();

            $total_row = $statment->rowCount();

            if ($total_row > 0) {
                foreach ($rami as $row) {
                    echo '<option ';
                    echo $supplier_name == $row['supplier_name'] ? ' selected ' : '';
                    echo ' value="' . $row['supplier_name'] . '">' . $row['supplier_name'] . '</option>';
                }
            }

            echo '
                        </select>
                        <label for="supplier_name">اسم المورد </label>
                        </div>

                    </div>

                        <div class="col-6">
                            <div class="form-floating mb-1">
                                <select class="form-select" id="is_active" name="is_active">
                                    <option  ' . ($row['is_active'] == 1 ? ' selected ' : '') . ' value="1">نشط</option>
                                    <option  ' . ($row['is_active'] == 0 ? ' selected ' : '') . ' value="0">معلق</option>
                                </select>
                                <label for="is_active">حالة المنتج</label>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-floating mb-1">
                                <input type="text" class="form-control" name="purchase_price" id="purchase_price"  value="' . $purchase_price . '">
                                <label for="purchase_price">سعر الشراء</label>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-floating mb-1">
                                <input type="text" class="form-control" name="sell_price" id="sell_price"  value="' . $sell_price . '"> 
                                <label for="sell_price">سعر البيع</label>
                            </div>
                        </div>



                        <div class="col-12">
                            <div class="form-floating mb-1">
                                <textarea class="form-control" name="product_notes" cols="30" rows="10">' . $product_notes . '</textarea>
                                <label for="product_notes">ملاحظات</label>
                            </div>
                        </div>



                    </div>

                </div>
            
      ';
        }
    }
}

//============================//
//=========== update_product ==========//
//============================//
if (isset($_POST['update_product'])) {

    require '../includes/config.php';

    $statement = $conn->prepare("UPDATE
    `products`
   SET
    
    `product_code` = '$_POST[product_code]',
    `product_name` = '$_POST[product_name]',
    `supplier_name` = '$_POST[supplier_name]',
    `purchase_price` = '$_POST[purchase_price]',
    `sell_price` = '$_POST[sell_price]',
    `is_active` = '$_POST[is_active]',
    `product_notes` = '$_POST[product_notes]'
   WHERE
  `product_id` = '$_POST[update_product]'");

    $statement->execute();

    header("Location: ../pages/products.php");
}

//============================//
//=========== delete_product ==========//
//============================//
if (isset($_POST['delete_product'])) {

    require '../includes/config.php';

    $statement = $conn->prepare("DELETE FROM `products` WHERE  `product_id`= '$_POST[delete_product]' ");


    $statement->execute();

    header("Location: ../pages/products.php");
}


//============================//
//=========== get_category_products ==========//
//============================//
if (isset($_POST['get_category_products'])) {

    require '../includes/config.php';

    $statment = $conn->prepare("SELECT * FROM `products`WHERE category_name = '$_POST[category_name]' ");
    $statment->execute();

    if ($statment->rowCount() > 0) {
        $result = $statment->fetchAll();

        foreach ($result as $row) {

            echo '<button rami="' . $row['sell_price'] . '"  type="button" class="btn btn-primary m-1">' . $row['product_name'] . '</button>';
        }
    } else {
        echo '<h3>لايوجد منتجات</h3>';
    }
}



//============================//
//=========== get_product_by_barcode ==========//
//============================//
if (isset($_POST['get_product_by_barcode'])) {

    require '../includes/config.php';

    $statment = $conn->prepare("SELECT * FROM `products`WHERE product_code = '$_POST[barcode_value]' ");
    $statment->execute();

    if ($statment->rowCount() > 0) {
        $result = $statment->fetchAll();

        foreach ($result as $row) {

            echo '<tr >
                            <td><input type="text" class="form-control" value="' . $row['product_name'] . '"></td>
                            <td><input type="text" class="form-control" value="' . $row['purchase_price'] . '"></td>
                            <td><input type="text" class="form-control" value="1"></td>
                            <td><input type="text" class="form-control" value="' . $row['purchase_price'] . '"></td>
                            <td><input type="text" class="form-control" value=""></td>
                            <td><button class="btn btn-sm btn-danger remove_item">X</button></td>
                        </tr>';
        }
    } else {
        echo "no_data";
    }
}

//============================//
//=========== get_product_barcode ==========//
//============================//
if (isset($_POST['get_product_barcode'])) {



    require '../includes/config.php';

    $statment = $conn->prepare("SELECT * FROM `products`WHERE product_code = '$_POST[barcode_value]' ");
    $statment->execute();

    if ($statment->rowCount() > 0) {
        $result = $statment->fetchAll();

        foreach ($result as $row) {

            echo '<tr >
                            <td><input type="text" class="form-control" value="' . $row['product_name'] . '"></td>
                            <td><input type="text" class="form-control" value="' . $row['sell_price'] . '"></td>
                            <td><input type="text" class="form-control" value="1"></td>
                            <td><input type="text" class="form-control" value="' . $row['sell_price'] . '"></td>
                            <td><input type="text" class="form-control" value=""></td>
                            <td><button class="btn btn-sm btn-danger remove_item">X</button></td>
                        </tr>';
        }
    } else {
        echo "no_data";
    }
}


//============================//
//=========== insert_purchase_order ==========//
//============================//
elseif (isset($_POST['insert_purchase_order'])) {



    $statment = $conn->prepare("SELECT `purchase_invoice_number` FROM `settings`WHERE 1");
    $statment->execute();
    if ($statment->rowCount() > 0) {
        $result = $statment->fetchAll();
        foreach ($result as $row) {
            $purchase_invoice_number = $row['purchase_invoice_number'];
        }
    }




    $total_amount = str_replace(",", "", $_POST['total_amount']);
    $discount_value = str_replace(",", "", $_POST['discount_value']);
    $total_after_discount = str_replace(",", "", $_POST['total_after_discount']);
    $grand_total = str_replace(",", "", $_POST['grand_total']);


    $query = "INSERT INTO `orders`(`invoice_number` , `order_type` , `supplier_id` , `supplier_name` , `order_notes`, `total_amount`, `discount_percentage`, `discount_value`, `total_after_discount`, `grand_total`, `created_at`) 
    VALUES ('$purchase_invoice_number' , 'purchases' , '$_POST[supplier_id]' , '$_POST[supplier_name]' , '$_POST[order_notes]' , '$total_amount' , '$_POST[discount_percentage]' , '$discount_value' , '$total_after_discount' , '$grand_total' , '$created_at')";

    $statment = $conn->prepare($query);
    $statment->execute();

    
    $lastInsertedId = $conn->lastInsertId();

  
    



    for ($count = 0; $count < count($_POST["item_name"]); $count++) {


        $item_name = $_POST['item_name'][$count];
        $item_quantity = $_POST['item_quantity'][$count];
        $item_price = $_POST['item_price'][$count];
        $item_total_amount = $_POST['item_total_amount'][$count];

        $statment = $conn->prepare("INSERT INTO `order_items`(
            `item_name`,
            `item_quantity`,
            `item_price`,
            `item_total_amount`,
            `order_id`
        )
        VALUES(
            '$item_name',
            '$item_quantity',
            '$item_price' , 
            '$item_total_amount',
            '$lastInsertedId'
        )");
        $statment->execute();
    }


    $statment = $conn->prepare("UPDATE `settings` SET `purchase_invoice_number` = `purchase_invoice_number` + 1");
    $statment->execute();
     
    header("Location: ../pages/purchase_order_details.php");
    
}


//============================//
//=========== insert_sales_order ==========//
//============================//

if (isset($_POST['insert_sales_order'])) {



    $statment = $conn->prepare("SELECT `sales_invoice_number` FROM `settings`WHERE 1");
    $statment->execute();
    if ($statment->rowCount() > 0) {
        $result = $statment->fetchAll();
        foreach ($result as $row) {
            $sales_invoice_number = $row['sales_invoice_number'];
        }
    }


    $total_amount = str_replace(",", "", $_POST['total_amount']);
    $discount_value = str_replace(",", "", $_POST['discount_value']);
   
    $grand_total = str_replace(",", "", $_POST['grand_total']);



    $query = "INSERT INTO `orders`(`invoice_number` , `order_type` , `order_notes`, `total_amount`, `discount_percentage`, `discount_value`, `total_after_discount`, `grand_total`, `created_at`) 
    VALUES ('$sales_invoice_number' , 'sales' , '$_POST[order_notes]' , '$total_amount' , '$_POST[discount_percentage]' , '$discount_value' , '$total_after_discount' , '$grand_total' , '$created_at')";

    $statment = $conn->prepare($query);
    $statment->execute();

    
    $lastInsertedId = $conn->lastInsertId();

    for ($count = 0; $count < count($_POST["item_name"]); $count++) {


        $item_name = $_POST['item_name'][$count];
        $item_quantity = $_POST['item_quantity'][$count];
        $item_price = $_POST['item_price'][$count];
        $item_total_amount = $_POST['item_total_amount'][$count];

        $statment = $conn->prepare("INSERT INTO `order_items`(
            `item_name`,
            `item_quantity`,
            `item_price`,
            `item_total_amount`,
            `order_id`
        )
        VALUES(
            '$item_name',
            '$item_quantity',
            '$item_price' , 
            '$item_total_amount',
            '$lastInsertedId'
        )");
        $statment->execute();
    }


    $statment = $conn->prepare("UPDATE `settings` SET `sales_invoice_number` = `sales_invoice_number` + 1");
    $statment->execute();

    header("Location: ../pages/sales_order_details.php");
}

