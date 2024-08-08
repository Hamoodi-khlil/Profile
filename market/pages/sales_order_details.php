<?php


$page_title = 'طلبيه جديده';
require '../includes/header.php';
require '../includes/sidebar.php';
require '../includes/navbar.php';
require '../includes/config.php';



if (isset($_GET["id"])) {

    $statment = $conn->prepare("SELECT * FROM `orders` WHERE order_id = $_GET[id]");
    $statment->execute();
    $row = $statment->fetch(PDO::FETCH_ASSOC);
    extract($row);
}


?>

<section class="main h-100 p-4" style="background-color: #3f4d5e;">
    <div class="container-fluid">

        <form action="../includes/functions.php" method="POST">

            <div class="row border bg-white rounded shadow-sm m-4 " style="height: 83vh;">


                <div class="col-7 border-end h-100">
                    <div class="h-75 border-bottom overflow-auto">

                        <table class="table table-bordered table-hover text-center align-middle mt-2" id="clickable_table">
                            <thead class="table-dark">
                                <tr>

                                    <th>اسم المادة</th>
                                    <th>السعر</th>
                                    <th>الكمية</th>
                                    <th>الاجمالي</th>
                                    <th>الملاحضات</th>
                                    <th>-</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                if (isset($order_id)) {

                                    $statement = $conn->prepare("SELECT * FROM `order_items` WHERE `order_id` = '$order_id'");

                                    $statement->execute();

                                    $result = $statement->fetchAll();
                                    $total_row = $statement->rowCount();

                                    if ($total_row > 0) {
                                        foreach ($result as $row) {

                                            echo '
            
                                         <tr>
   
                                          <td><input type="text" class="form-control" name="item_name[]" value="' . $row['item_name'] . '"></td>
                                          <td><input type="text" class="form-control" name="item_price[]" value="' . $row['item_price'] . '"></td>
                                          <td><input type="text" class="form-control" name="item_quantity[]" value="' . $row['item_quantity'] . '"></td>
                                          <td><input type="text" class="form-control" name="item_total_amount[]" value="' . $row['item_total_amount'] . '"></td>
                                         <td><input type="text" class="form-control" name="order_notes"></td>
                                          <td><button class="btn btn-sm btn-danger remove_item">X</button></td>
             
                                         </tr>
            
                                             ';
                                        }
                                    }
                                }

                                ?>


                            </tbody>
                        </table>
                    </div>

                    <div class="h-25 bg-light">

                        <div class="row p-2 text-center h-100 align-items-center overflow-auto">


                            <div class="col-3 ">
                                <div class="form-floating mb-1">
                                    <input type="text" class="form-control form-control-lg" id="total_amount" name="total_amount" value="<?php echo isset($total_amount) ? number_format($total_amount, 0) : '0' ?>" readonly>
                                    <label for=" total_amount">الاجمالي</label>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-floating mb-1">
                                    <input type="number" class="form-control form-control-lg" id="discount_percentage" name="discount_percentage" value="<?php echo isset($discount_percentage) ? number_format($discount_percentage, 0) : '0' ?>">
                                    <label for="discount_percentage"> % الخصم</label>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-floating mb-1">
                                    <input type="text" class="form-control form-control-lg" id="discount_value" name="discount_value" value="<?php echo isset($discount_value) ? number_format($discount_value, 0) : '0' ?>" readonly>
                                    <label for="discount_value">مبلغ الخصم</label>
                                </div>
                            </div>


                            <div class="col-3">
                                <div class="form-floating mb-1">
                                    <input type="text" class="form-control form-control-lg" id="total_after_discount" name="total_after_discount" value="<?php echo isset($total_after_discount) ? number_format($total_after_discount, 0) : '0' ?>" readonly>
                                    <label for="total_after_discount">الاجمالي بعد الخصم</label>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-floating mb-1">
                                    <input type="text" class="form-control form-control-lg text-danger" id="grand_total" name="grand_total" value="<?php echo isset($grand_total) ? number_format($grand_total, 0) : '0' ?>" readonly>
                                    <label for="grand_total">الصافي</label>
                                </div>
                            </div>




                        </div>

                    </div>

                </div>

                <div class="col-3 text-center border-end h-100" style="background-color: #3f4d5e;">
                    <div class="categories border h-25 p-2 overflow-auto " style="background-color: #3f4d5e;">

                        <?php

                        $statment = $conn->prepare("SELECT * FROM `categories`WHERE 1");
                        $statment->execute();

                        if ($statment->rowCount() > 0) {
                            $result = $statment->fetchAll();

                            foreach ($result as $row) {

                                echo '<button type="button" class="btn btn-warning m-1">' . $row['category_name'] . '</button>';
                            }
                        }

                        ?>

                    </div>
                    <div class="products border h-75 overflow-auto" style="background-color: #3f4d5e;">
                        <?php


                        $statment = $conn->prepare("SELECT * FROM `products`WHERE 1");
                        $statment->execute();

                        if ($statment->rowCount() > 0) {
                            $result = $statment->fetchAll();

                            foreach ($result as $row) {

                                echo '<button rami="' . $row['sell_price'] . '"  type="button" class="btn btn-primary m-1">' . $row['product_name'] . '</button>';
                            }
                        }


                        ?>
                    </div>
                </div>

                <div class="col-2  border-start" style="background-color: #3f4d5e;">
                    <div class="form-floating mb-1 mt-3 fw-bolder">
                        <input type="text" class="form-control" id="barcode" value="">
                        <label for="barcode">باركود</label>
                    </div>

                    <div class="form-floating mb-1">
                        <input type="text" class="form-control" id="invoice_number" name="invoice_number" value="<?php echo isset($invoice_number) ? $invoice_number : '' ?>" readonly>
                        <label for="invoice_number" class="fw-bold">رقم الفاتورة</label>
                    </div>


                    <div class="form-floating mb-1 fw-bolder">
                        <input type="text" class="form-control" id="order_notes" name="order_notes" value="<?php echo isset($order_notes) ? $order_notes : '' ?>">
                        <label for="order_notes">ملاحظات</label>
                    </div>


                    <div class="form-floating mb-1 fw-bolder">
                        <div class="form-floating mb-1">
                            <input type="text" class="form-control" id="created_at" name="created_at" value="<?php echo isset($created_at) ? $created_at : '' ?>" readonly>
                            <label for="created_at">وقت وتاريخ الفاتورة</label>
                        </div>
                    </div>



                    <div class="d-grid gap-1">



                        <button type="submit" class="btn btn-sm btn-success"><i class="bi bi-check-all float-start pe-2"></i>حفظ</button>

                        <input type="hidden" name="insert_sales_order" value="1">

                        <input type="hidden" name="order_id" id="order_id" value="<?php echo isset($order_id) ? $order_id : '' ?>">


                        <button type="button" class="btn btn-info"><i class="bi bi-printer float-start pe-2"></i>طباعة الفاتورة</button>

                        <button type="button" class="btn btn-secondary"><i class="bi bi-wallet2 float-start pe-2 "></i>ترحيل الفاتورة</button>

                        <button type="button" class="btn btn-danger"><i class="bi bi-trash float-start pe-2"></i>حذف الفاتورة</button>

                        <button type="button" class="btn btn-dark"><i class="bi bi-reply float-start pe-2 "></i>رجوع</button>

                    </div>

                </div>

            </div>
        </form>
    </div>
</section>

<script>
    $(document).ready(function() {
        $(window).keydown(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });

    $('#barcode').bind("enterKey", function(e) {
        barcode_value = $(this).val();

        $.ajax({
            //الاكشن
            url: '../includes/functions.php',
            //الماثود
            type: "POST",
            data: ({
                //value
                get_product_barcode: 1,
                //name
                barcode_value: barcode_value
            }),
            //عندما ياتي الداتا من الفنكشن يعرضها في المودل 
            success: function(data) {
                if (data == 'no_data') {
                    alert("هذا المنتج غير معرف");
                } else {

                    $('#clickable_table tbody').append(data);
                    count_total_amount();
                    count_discount_value();
                    count_total_after_discount();
                    count_grand_total();
                    count_total();
                }
            }
        });
    });



    $('#barcode').keyup(function(e) {
        if (e.keyCode == 13) {
            $(this).trigger("enterKey");
        }
    });




    $(document).on('click', '.categories button', function() {

        category_name = $(this).text();

        $.ajax({
            //الاكشن
            url: '../includes/functions.php',
            //الماثود
            type: "POST",
            data: ({
                //value
                get_category_products: 1,
                //name
                category_name: category_name
            }),
            //عندما ياتي الداتا من الفنكشن يعرضها في المودل 
            success: function(data) {
                $('.products').html(data);
            }
        });

    });

    $(document).on('click', '.products  button', function() {

        product_name = $(this).text();
        product_price = $(this).attr("rami");
        is_exist = false;

        $(document).find('#clickable_table tbody tr').each(function() {

            var firstColumnContent = $(this).find('td:nth-child(1) input').val();


            if (firstColumnContent == product_name) {

                old_qty = parseInt($(this).find('td:nth-child(3) input').val());
                new_qty = old_qty + 1;
                $(this).find('td:nth-child(3) input').val(new_qty);
                count_total = new_qty * product_price;
                $(this).find('td:nth-child(4) input').val(count_total);

                is_exist = true;
            }



        });

        if (is_exist == false) {
            new_tr = `

            <tr overflow-auto >
        <td><input type="text" class="form-control" name="item_name[]" value="${product_name}"></td>
        <td><input type="text" class="form-control" name="item_price[]" value="${product_price}"></td>
        <td><input type="text" class="form-control" name="item_quantity[]" value="1"></td>
        <td><input type="text" class="form-control" name="item_total_amount[]" value="${product_price}"></td>
        <td><input type="text" class="form-control" value=""></td>
        <td>
       <button class="btn btn-sm btn-danger remove_item">X</button>
       
      </td>
        
     </tr>
            
            `;

            $('#clickable_table tbody').append(new_tr);
        }
        update_item_total();
        count_total_amount();
        count_discount_value();
        count_total_after_discount();
        count_grand_total();
        count_total()

    });

    $(document).on('click', '.remove_item', function() {

        $(this).closest('tr').remove();
        count_total_amount();
        count_discount_value();
        count_total_after_discount();

        count_grand_total();

    });



    function count_total_amount() {
        total_amount = 0;
        $('#clickable_table tbody tr').each(function() {
            item_total_amount = $(this).find('td:nth-child(2) input').val();
            item_quantity = $(this).find('td:nth-child(3) input').val();
            total_amount = total_amount + (item_total_amount * item_quantity);
        });
        $('#total_amount').val(total_amount.toLocaleString('en-US'));
    }

    function count_discount_value() {
        total_amount = parseFloat($('#total_amount').val().replace(/,/g, ''));
        discount_percentage = $('#discount_percentage').val();
        discount_value = total_amount * (discount_percentage / 100);
        $('#discount_value').val(discount_value.toLocaleString('en-US'));
    }

    function count_total_after_discount() {

        total_amount = parseFloat($('#total_amount').val().replace(/,/g, ''));
        discount_value = parseFloat($('#discount_value').val().replace(/,/g, ''));
        total_after_discount = total_amount - discount_value;
        $('#total_after_discount').val(total_after_discount.toLocaleString('en-US'));
    }

    function count_grand_total() {

        total_after_discount = parseFloat($('#total_after_discount').val().replace(/,/g, ''));
        grand_total = total_after_discount;
        $('#grand_total').val(grand_total.toLocaleString('en-US'));
    }

    function count_total() {

        $('#clickable_table tbody tr').each(function() {


            old_qty = parseInt($(this).find('td:nth-child(3) input').val());
            item_price = parseInt($(this).find('td:nth-child(4) input').val());
            item_total_before_discount = old_qty * item_price;




        });


    }

    function update_item_total() {


        $(document).find('#clickable_table tbody tr').each(function() {
            item_total_amount = $(this).find('td:nth-child(2) input').val();
            item_quantity = $(this).find('td:nth-child(3) input').val();
            total_amount = item_total_amount * item_quantity;
            $(this).find('td:nth-child(4) input').val(total_amount);
        });

    }


    $(document).on('keyup', '#clickable_table input', function() {
        update_item_total();
        count_total_amount();
        count_discount_value();
        count_total_after_discount();
        count_grand_total();
    });

    $('#discount_percentage,#count_grand_total').on('keyup', function() {
        count_total_amount();
        count_discount_value();
        count_total_after_discount();
        count_grand_total();
    });
</script>
<?php

require '../includes/footer.php';

?>