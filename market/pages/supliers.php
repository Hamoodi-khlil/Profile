<?php

$page_title = 'الموردين';
$backend_keyword = 'supplier';
require '../includes/header.php';
require '../includes/sidebar.php';
require '../includes/navbar.php';
require '../includes/config.php';

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
                                <th>اسم المورد</th>
                                <th>رقم الهاتف</th>
                                <th>العنوان</th>
                                <th>الية التسعير</th>
                                <th>الية الدفع</th>
                                <th>ملاحظات</th>
                                <th>نوع المنتجات</th>
                                <th>حالة الحساب</th>
                                <th>التعديلات</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            require '../includes/config.php';

                            $statment = $conn->prepare("SELECT * FROM `suppliers` WHERE 1");

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
                                <td>' . $row['supplier_name'] . '</td>
                                <td>' . $row['supplier_phone'] . '</td>
                                <td>' . $row['supplier_address'] . '</td>
                                <td>' . $row['pricing_method'] . '</td>
                                <td>' . $row['payment_method'] . '</td>
                                <td>' . $row['supplier_notes'] . '</td>
                                <td>' . $row['products_type'] . '</td>
                                <td>' . $row['is_active'] . '</td>
                                <td>
                                <button supplier_id="' . $row['supplier_id'] . '" class="btn btn-sm btn-warning edit_supplier"><i class="bi bi-pencil-square"></i></button>

                                 <button supplier_id="' . $row['supplier_id'] . '" class="btn btn-sm btn-danger delete_supplier"><i class="bi bi-trash3-fill"></i></button>
                                </td>
                                
                               
                               
                                </tr>';
                                }
                            } else echo '<tr>
                                      <td colspan="10">لايوجد نتائج</td>
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
                                <input type="text" class="form-control" name="supplier_name" id="supplier_name" required>
                                <label for="supplier_name">اسم المورد</label>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-floating mb-1">
                                <input type="text" class="form-control" name="supplier_phone" id="supplier_phone">
                                <label for="supplier_phone">رقم الهاتف</label>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-floating mb-1">
                                <input type="text" class="form-control" name="supplier_address" id="supplier_address">
                                <label for="supplier_address">العنوان</label>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-floating mb-1">
                                <select class="form-select" id="is_active" name="is_active">
                                    <option value="1">نشط</option>
                                    <option value="0">معلق</option>
                                </select>
                                <label for="is_active">حالة الحساب</label>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-floating mb-1">
                                <select class="form-select" id="pricing_method" name="pricing_method">
                                    <option value="">--</option>
                                    <option value="مفرد">مفرد</option>
                                    <option value="جملة">جملة</option>
                                    <option value="نسبة">نسبة</option>
                                </select>
                                <label for="pricing_method">الية التسعير</label>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-floating mb-1">
                                <input type="text" class="form-control" name="payment_method" id="payment_method">
                                <label for="payment_method">الية الدفع</label>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-floating mb-1">
                                <input type="text" class="form-control" name="products_type" id="products_type">
                                <label for="products_type">نوع المنتجات</label>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-floating mb-1">
                                <textarea class="form-control" name="supplier_notes" cols="30" rows="10"></textarea>
                                <label for="supplier_notes">ملاحظات</label>
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
                    <p class="">لا يمكنك تراجع على هذه الخطوة لاحقأ</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="supplier_id" name="delete_<?php echo $backend_keyword; ?>" value="">
                    <button type="button" class="btn btn-secondary bi bi-x-lg" data-bs-dismiss="modal">رجوع</button>
                    <button type="submit" class="btn btn-danger bi bi-trash">حذف</button>
                </div>
            </form>

        </div>
    </div>
</div>



<script>
    $(document).on('click', '.edit_supplier', function() {


        var supplier_id = $(this).attr("supplier_id");

        $("#editModal").modal('show');



        $.ajax({

            url: '../includes/functions.php',

            type: "POST",

            data: ({

                get_supplier_info: 1,

                supplier_id: supplier_id
            }),

            success: function(data) {
                $("#editModal .modal-body").html(data);
            }
        });

    });


    $(document).on('click', '.delete_supplier', function() {

        var supplier_id = $(this).attr("supplier_id");

        $("#deletemodel").modal('show');

        $('#deletemodel #supplier_id').val(supplier_id);



    });
</script>







<?php

require '../includes/footer.php';

?>