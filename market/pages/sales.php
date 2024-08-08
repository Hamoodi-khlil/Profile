<?php

$page_title = 'المبيعات';
require '../includes/header.php';
require '../includes/sidebar.php';
require '../includes/navbar.php';

?>




<section class="main">
    <div class="container-fluid">

        <div class="row border bg-white rounded shadow-sm m-4">

            <div class="col-12 d-flex p-2 justify-content-end">


             <a class="btn btn-m btn-primary mb-2"  href="sales_order_details.php"><i class="bi bi-plus-circle"></i>طلبيه جديده</a>
                

            </div>

            <div class="col-12">
                <div class="table-responsive vh-85 overflow-auto">
                    <table class="table table-bordered table-hover text-center align-middle" id="clickable_table">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">رقم الفاتورة</th>
                                <th scope="col">الاجمالي</th>
                                <th scope="col">الصافي</th>
                                <th scope="col">وقت وتاريخ الطلبية</th>
                                <th scope="col">-</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                        require '../includes/config.php';

                        $statement = $conn->prepare("SELECT * FROM `orders` WHERE `order_type` = 'sales'");
                        $statement->execute();

                        $result = $statement->fetchAll();

                        $total_row = $statement->rowCount();

                        if ($total_row > 0) {

                            $row_counter = 0;
                            foreach ($result as $row) {
                                echo '<tr>
                                <td>'.++$row_counter .'</td>
                                    <td>'.$row['invoice_number'].'</td>
                                    <td>'.$row['total_amount'].'</td>
                                    <td>'.$row['grand_total'].'</td>
                                    <td>'.$row['created_at'].'</td>

                                    <td><a class="btn btn-warning" href="sales_order_details.php?id='.$row['order_id'].'">View</a></td>

                                </tr>';
                            }
                        }
                        
                        
                        ?>


                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</section>










<?php

require '../includes/footer.php';


?>