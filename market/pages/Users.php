<?php

$page_title = 'المستخدمين';
$backend_keyword = 'user';
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
                                <th>اسم المستخدم</th>
                                <th>البريد الالكتروني</th>
                                <th>كلمة المرور</th>
                                <th>حالة الحساب</th>
                                <th>
                                    -
                                </th>
                                

                            </tr>
                        </thead>
                        <tbody>
                            <?php


                            $statement = $conn->prepare("SELECT * FROM `users` WHERE 1");
                            $statement->execute();
                            $result = $statement->fetchAll();
                            $total_row = $statement->rowCount();
                            if ($total_row > 0) {
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
                                                   <td>' . $row['user_name'] . '</td>
                                                   <td>' . $row['user_email'] . '</td>
                                                   <td>' . $row['user_password'] . '</td>
                                                   <td>' . $row['is_active'] . '</td>
                                                   <td>
                                                    <button user_id="' . $row['user_id'] . '" class="btn btn-sm btn-warning edit_user"><i class="bi bi-pencil-square"></i></button>
                                                    <button user_id="' . $row['user_id'] . '" class="btn btn-sm btn-danger delete_user"><i class="bi bi-trash3-fill"></i></button>
                                                   </td>
                                                  
                                                  
                                           </tr>';
                                }
                            } else {
                                echo '<tr>
                                           <td colspan="6">لايوجد نتائج</td>
                                        </tr>';
                            }
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
            <form action="../includes/functions.php" method="POST">
                <div class="modal-body">


                    <div class="form-floating mb-1">
                        <input type="text" class="form-control" name="user_name" id="user_name" required>
                        <label for="user_name">اسم المستخدم</label>
                    </div>


                    <div class="form-floating mb-1">
                        <input type="email" class="form-control" name="user_email" id="user_email" required>
                        <label for="user_email">البريد الالكتروني</label>
                    </div>


                    <div class="form-floating mb-1">
                        <input type="text" class="form-control" name="user_password" id="user_password" required>
                        <label for="user_password">كلمة المرور</label>
                    </div>

                    <div class="form-floating mb-1">
                        <select class="form-select" id="is_active" name="is_active">
                            <option value="1">نشط</option>
                            <option value="0">معلق</option>
                        </select>
                        <label for="is_active">حالة الحساب</label>
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
                <h5 class="modal-title">هل انت متأكد؟</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="../includes/functions.php">
                <div class="modal-body">
                    <p>لا يمكنك تراجع على هذه الخطوة لاحقأ</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="user_id" name="delete_<?php echo $backend_keyword; ?>" value="">
            
                    <button type="button" class="btn btn-secondary bi bi-x-lg" data-bs-dismiss="modal">رجوع</button>
                    <button type="submit" class="btn btn-danger bi bi-trash">حذف</button>
                </div>
            </form>

        </div>
    </div>
</div>


<script>
    // راقب من ندوس على كلاس اسمه ايدت يوزر
    $(document).on('click', '.edit_user', function() {


        // جيب اي دي اليوزر الي دسنه عليه من البتن
        var user_id = $(this).attr("user_id");


        // أفتح المودل مال تعديل
        $("#editModal").modal('show');


        // دز طلب على ملف الفنكشن حتة يجيب معلومات اليوزر ويعرضها داخل المودل
        $.ajax({
            //الاكشن
            url: '../includes/functions.php',
            //الماثود
            type: "POST",
            data: ({
                //value
                get_user_info: 1,
                //name
                user_id: user_id
            }),
            //عندما ياتي الداتا من الفنكشن يعرضها في المودل 
            success: function(data) {
                $("#editModal .modal-body").html(data);
            }
        });

    });

    $(document).on('click', '.delete_user', function() {

        var user_id = $(this).attr("user_id");

        $("#deletemodel").modal('show');

        $('#deletemodel #user_id').val(user_id);

    });
</script>




<?php

require '../includes/footer.php';

?>