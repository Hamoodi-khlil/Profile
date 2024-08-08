<?php


$backend_keyword = 'product';
$page_title = 'المنتجات';
require '../includes/header.php';
require '../includes/sidebar.php';
require '../includes/navbar.php';

?>



<section class="main">
    <div class="container-fluid">

        <div class="row border bg-white rounded shadow-sm m-4">

            <div class="col-12 d-flex p-2 justify-content-end">

                <button class="btn btn-secondary ms-2" type="button" onClick="window.location.reload();"><i class="bi bi-arrow-clockwise"></i> تحديث الصفحة</button>

                <button class="btn btn-primary ms-2" type="button" data-bs-toggle="modal" data-bs-target="#insertModal">
                    <i class="bi bi-plus-circle"></i> اضافة</button>

            </div>

            <div class="col-12">
                <div class="table-responsive vh-85 overflow-auto">
                    <table class="table table-bordered table-hover text-center align-middle" id="clickable_table">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>كود المنتج</th>
                                <th>اسم المنتج</th>
                                <th>اسم الصنف</th>
                                <th>اسم المورد</th>
                                <th>سعر الشراء</th>
                                <th>سعر البيع</th>
                                <th>حالة المنتج</th>
                                <th>الملاحضات</th>
                                <th>-</th>


                            </tr>
                        </thead>
                        <tbody>

                            <?php


                            require '../includes/config.php';

                            $statment = $conn->prepare("SELECT * FROM `products` WHERE 1");


                            $statment->execute();

                            if ($statment->rowCount() > 0) {

                                $result = $statment->fetchAll();
                                $rows_counter = 0;

                                foreach ($result as $row) {
                                    $rows_counter = $rows_counter + 1;

                                    switch ($row['is_active']) {
                                        case 0:
                                            $row['is_active'] = '<span class="badge rounded-pill text-bg-danger">معلق</span>';
                                            break;
                                        case 1:
                                            $row['is_active'] = '<span class="badge rounded-pill text-bg-success">نشط</span>';
                                            break;
                                    }

                                    echo '<tr>
                
                                    <td>' . $rows_counter . '</td>
                                    <td>' . $row['product_code'] . '</td>
                                     <td>' . $row['product_name'] . '</td>
                                     <td>' . $row['category_name'] . '</td>
                                    <td>' . $row['supplier_name'] . '</td>
                                    <td>' . number_format($row['purchase_price'], 0) . '</td>
                                    <td>' . number_format($row['sell_price'], 0) . '</td>
                                    <td>' . $row['is_active'] . '</td>
                                    <td>' . $row['product_notes'] . '</td>
                                    <td>
                                    <button product_id="' . $row['product_id'] . '" class="btn btn-sm btn-warning edit_product"><i class="bi bi-pencil-square"></i></button>

                                    <button product_id="' . $row['product_id'] . '" class="btn btn-sm btn-danger delete_product"><i class="bi bi-trash3-fill"></i></button>
                                </td>
                                
                                
                               
                               
                                </tr>';
                                }
                            } else echo '<tr>
                                      <td colspan="11">لايوجد نتائج</td>
                                   </tr>';

                            ?>


                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</section>



<div class="modal fade" id="insertModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">اضافة</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="insert_form" action="../includes/functions.php" method="POST">
                <div class="modal-body">

                    <div class="row">


                        <div class="col-6">
                            <div class="form-floating mb-1">
                                <input type="text" class="form-control" name="product_code" id="product_code" required>
                                <label for="product_code">كود المنتج </label>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-floating mb-1">
                                <input type="text" class="form-control" name="product_name" id="product_name">
                                <label for="product_name">اسم المنتج</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-1 fw-bolder">
                            <select class="form-select" id="category_name" name="category_name">
                              <option selected>--</option>
                              <?php
                              require '../includes/config.php';

                              $statment = $conn->prepare("SELECT * FROM `categories` WHERE 1");

                              $statment->execute();

                              $rami = $statment->fetchAll();

                              $total_row = $statment->rowCount();

                              if($total_row > 0) {
                                foreach($rami as $row) {
                                  echo '<option value="' . $row['category_name'] . '">' . $row['category_name'] . '</option>';
                                }
                              }
                              
                              ?>
                            </select>
                            <label for="category_name">اسم الصنف </label>
                            </div>

                        </div>

                        <div class="col-6">
                            <div class="form-floating mb-1 fw-bolder">
                            <select class="form-select" id="supplier_name" name="supplier_name">
                              <option selected>--</option>
                              <?php
                              require '../includes/config.php';

                              $statment = $conn->prepare("SELECT * FROM `suppliers` WHERE 1");

                              $statment->execute();

                              $rami = $statment->fetchAll();

                              $total_row = $statment->rowCount();

                              if($total_row > 0) {
                                foreach($rami as $row) {
                                  echo '<option value="' . $row['supplier_name'] . '">' . $row['supplier_name'] . '</option>';
                                }
                              }
                              
                              ?>
                            </select>
                            <label for="supplier_name">اسم المورد </label>
                            </div>

                        </div>

                        <div class="col-6">
                            <div class="form-floating mb-1">
                                <select class="form-select" id="is_active" name="is_active">
                                    <option value="1">نشط</option>
                                    <option value="0">معلق</option>
                                </select>
                                <label for="is_active">حالة المنتج</label>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-floating mb-1">
                                <input type="text" class="form-control" name="purchase_price" id="purchase_price">
                                <label for="purchase_price">سعر الشراء</label>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-floating mb-1">
                                <input type="text" class="form-control" name="sell_price" id="sell_price">
                                <label for="sell_price">سعر البيع</label>
                            </div>
                        </div>



                        <div class="col-12">
                            <div class="form-floating mb-1">
                                <textarea class="form-control" name="product_notes" cols="30" rows="10"></textarea>
                                <label for="product_notes">ملاحظات</label>
                            </div>
                        </div>



                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="insert_<?php echo $backend_keyword; ?>" value="1">
                    <button type="submit" class="btn btn-success"><i class="bi bi-check-lg"></i> حفظ</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i>
                        اغلاق</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade text-end" id="editModal" fetch_val="fetch_<?php echo $backend_keyword; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">تعديل</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../includes/functions.php" method="POST">
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning"><i class="bi bi-arrow-repeat"></i> تحديث</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i>
                        اغلاق </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" id="deletemodel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">هل انت متأكد ؟</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="../includes/functions.php">
                <div class="modal-body">
                    <p>لا يمكنك تراجع على هذه الخطوة لاحقأ</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="product_id" name="delete_<?php echo $backend_keyword; ?>" value="">
                    <button type="button" class="btn btn-secondary bi bi-x-lg" data-bs-dismiss="modal">رجوع</button>
                    <button type="submit" class="btn btn-danger bi bi-trash">حذف</button>
                </div>
            </form>

        </div>
    </div>
</div>


<script>
    $(document).on('click', '.edit_product', function() {

        var product_id = $(this).attr("product_id");

        $("#editModal").modal('show');

        $.ajax({

            url: '../includes/functions.php',

            type: "POST",

            data: ({

                get_product_info: 1,

                product_id: product_id
            }),

            success: function(data) {
                $("#editModal .modal-body").html(data);
            }
        });




    });


    $(document).on('click', '.delete_product', function() {



var product_id = $(this).attr("product_id");


$("#deletemodel").modal('show');


$('#deletemodel  #product_id').val(product_id);

});
</script>







<?php

require '../includes/footer.php';


?>