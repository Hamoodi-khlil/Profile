<?php

$page_title = 'التصنيفات';
$backend_keyword = 'category';
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
                                <th>اسم التصنيف</th>
                                <th>-</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require '../includes/config.php';

                            $statment = $conn->prepare("SELECT
                        *
                    FROM
                        `categories`
                    WHERE
                        1");

                            $statment->execute();

                            if ($statment->rowCount() > 0) {
                                $result = $statment->fetchAll();

                                foreach ($result as $row) {

                                    echo '<tr>
                        
                        
                        <td>' . $row['category_id'] . '</td>
                        <td>' . $row['category_name'] . '</td>
                        <td>
                          <button category_id="' . $row['category_id'] . '" class="btn btn-sm btn-warning edit_category"><i class="bi bi-pencil-square"></i></button>

                          <button category_id="' . $row['category_id'] . '" class="btn btn-sm btn-danger delete_category"><i class="bi bi-trash3-fill"></i></button>
                        </td>
                       
                       
                        </tr>';
                                }
                            } else echo '<tr>
                              <td colspan="4">لايوجد نتائج</td>
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


                    <div class="form-floating mb-1">
                        <input type="text" class="form-control" name="category_name" id="category_name" required>
                        <label for="category_name">اسم التصنيف</label>
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
                    <input type="hidden" id="category_id" name="delete_<?php echo $backend_keyword; ?>" value="">
                    <button type="button" class="btn btn-secondary bi bi-x-lg" data-bs-dismiss="modal">رجوع</button>
                    <button type="submit" class="btn btn-danger bi bi-trash">حذف</button>
                </div>
            </form>

        </div>
    </div>
</div>



<script>
    $(document).on('click', '.edit_category', function() {


        var category_id = $(this).attr("category_id");

        $("#editModal").modal('show');



        $.ajax({

            url: '../includes/functions.php',

            type: "POST",

            data: ({

                get_category_info: 1,

                category_id: category_id
            }),

            success: function(data) {
                $("#editModal .modal-body").html(data);
            }
        });

    });


    $(document).on('click', '.delete_category', function() {


        // جيب اي دي اليوزر الي دسنه عليه من البتن
        var category_id = $(this).attr("category_id");


        // أفتح المودل مال تعديل
        $("#deletemodel").modal('show');


        $('#deletemodel  #category_id').val(category_id);

    });
</script>




<?php


require '../includes/footer.php';


?>