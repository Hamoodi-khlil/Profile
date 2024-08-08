<?php

$page_title = 'الصفحه الرئيسيه';
require '../includes/header.php';
require '../includes/sidebar.php';
require '../includes/navbar.php';


?>


<!--------dashboard------->

<section class="midde_cont h-100 " id="main">

    <div class="contener p-5 overflow-hidden h-100">
        <div class="row h-100 align-content-center justify-content-center  p-5 pt-0">



           




            <div class="col-md-2 col-6 mb-4 text-center">
                <div class="card text-center m-auto shadow" style="background-color: #202934;">
                    <div class="card-body d-flex align-items-center justify-content-center flex-column">
                        <h5 class="card-title mb-3">
                            <a href="sales.php">
                                <span style="color: #dc3545;border:1px solid">
                                    <i class="bi bi-cart"></i>
                                </span>
                            </a>
                        </h5>
                        <h5 class="card-subtitle text-white font-weight-bold">المبيعات</h5>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-6 mb-4 text-center">
                <div class="card text-center m-auto shadow" style="background-color: #202934;">
                    <div class="card-body d-flex align-items-center justify-content-center flex-column">
                        <h5 class="card-title mb-3">
                            <a href="sales_order_details.php?new=1">
                                <span style="color: #dc3545;border:1px solid">
                                    <i class="bi bi-cart"></i>
                                </span>
                            </a>
                        </h5>
                        <h5 class="card-subtitle text-white font-weight-bold">فاتورة المبيعات</h5>
                    </div>
                </div>
            </div>




            <div class="col-md-2 col-6 mb-4 ">
                <div class="card text-center m-auto shadow" style="background-color: #202934;">
                    <div class="card-body d-flex align-items-center justify-content-center flex-column">
                        <h4 class="card-title mb-3">
                            <a href="purchases.php">
                                <span style="color: #198754;border:1px solid">
                                    <i class="bi bi-cart-plus"></i>
                                </span>
                            </a>
                        </h4>
                        <h5 class="card-subtitle text-white font-weight-bold">المشتريات</h5>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-6 mb-4 ">
                <div class="card text-center m-auto shadow" style="background-color: #202934;">
                    <div class="card-body d-flex align-items-center justify-content-center flex-column">
                        <h4 class="card-title mb-3">
                            <a href="purchase_order_details.php?new=1">
                                <span style="color: #198754;border:1px solid">
                                    <i class="bi bi-cart-plus"></i>
                                </span>
                            </a>
                        </h4>
                        <h5 class="card-subtitle text-white font-weight-bold">فاتورة المشتريات</h5>
                    </div>
                </div>
            </div>

            <div class="col-2 mb-4">
                <div class="card text-center m-auto" style="background-color: #202934;">
                    <div class="card-body d-flex align-items-center justify-content-center flex-column">
                        <h5 class="card-title mb-3"><a href="expenses.php">
                                <span style="color: #ffc107;border:1px solid">
                                    <i class="bi bi-currency-dollar"></i>
                                </span>
                            </a></h5>
                        <h5 class="card-subtitle text-white font-weight-bold">المصاريف</h5>
                    </div>
                </div>
            </div>

            <div class="col-2 mb-4">
                <div class="card text-center m-auto" style="background-color: #202934;">
                    <div class="card-body d-flex align-items-center justify-content-center flex-column">
                        <h5 class="card-title mb-3"><a href="wallet.php">
                                <span style="color: #0d6efd;border:1px solid">
                                    <i class="bi bi-wallet2"></i>
                                </span>
                            </a></h5>
                        <h6 class="card-subtitle text-white font-weight-bold">الموقف المالي</h6>
                    </div>
                </div>
            </div>


            <div class="col-12">

            </div>

            <div class="col-md-2 col-6 mb-4 text-center">
                <div class="card text-center m-auto shadow" style="background-color: #202934;">
                    <div class="card-body d-flex align-items-center justify-content-center flex-column">
                        <h5 class="card-title mb-3">
                            <a href="supliers.php">
                                <span style="color: #8BC34A;border:1px solid">
                                    <i class="bi bi-truck"></i>
                                </span>
                            </a>
                        </h5>
                        <h5 class="card-subtitle text-white font-weight-bold">الموردين</h5>
                    </div>
                </div>
            </div>



            <div class="col-md-2 col-6 mb-4">
                <div class="card text-center m-auto" style="background-color: #202934;">
                    <div class="card-body d-flex align-items-center justify-content-center flex-column">
                        <h5 class="card-title mb-3">
                            <a href="categories.php">
                                <span style="color: #ffc107;border:1px solid">
                                    <i class="bi bi-grid"></i>
                                </span>
                            </a>
                        </h5>
                        <h6 class="card-subtitle text-white font-weight-bold">التصنيفات</h6>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-6 mb-4">
                <div class="card text-center m-auto" style="background-color: #202934;">
                    <div class="card-body d-flex align-items-center justify-content-center flex-column">
                        <h5 class="card-title mb-3"><a href="products.php">
                                <span style="color: #007bffc2; border:1px solid">
                                    <i class="bi bi-bag"></i>
                                </span>
                            </a></h5>
                        <h6 class="card-subtitle text-white font-weight-bold">المنتجات</h6>
                    </div>
                </div>
            </div>

            <div class="col-2 mb-4">
                <div class="card text-center m-auto" style="background-color: #202934;">
                    <div class="card-body d-flex align-items-center justify-content-center flex-column">
                        <h5 class="card-title mb-3"><a href="stock.php">
                                <span style="color: #8BC34A;border:1px solid">
                                    <i class="bi bi-boxes"></i>
                                </span>
                            </a></h5>
                        <h6 class="card-subtitle text-white font-weight-bold">المخزن</h6>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-6 mb-4">
                <div class="card text-center m-auto" style="background-color: #202934;">
                    <div class="card-body d-flex align-items-center justify-content-center flex-column">
                        <h5 class="card-title mb-3"><a href="../pages/Users.php">
                                <span style="color: #ff5722eb;border:1px solid">
                                    <i class="bi bi-person"></i>
                                </span>
                            </a></h5>
                        <h6 class="card-subtitle text-white font-weight-bold">المستخدمين</h6>
                    </div>
                </div>
            </div>








        </div>
    </div>


    <div class="modal" tabindex="-1" id="openmodel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

</section>

<script>



</script>

<?php

require '../includes/footer.php';


?>