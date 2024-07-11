<?php
error_reporting(0);
ini_set('display_errors', 0);
require_once('../../connect/server.php');
session_start();

// เช็คเซสชั่น
if (isset($_SESSION['member_id'])) {
    // รับค่ามาจากเซสชั่น
    $member_id = $_SESSION['member_id'];

    // เช็คค่าที่ส่งมาจากเซสชั่น
    $query = "SELECT * FROM tbl_member_db WHERE mb_url ='$member_id'";
    $result = mysqli_query($conn, $query);

    $query_bank = "SELECT * FROM tbl_member_db as m
                INNER JOIN tbl_bank_db as b ON m.bk_code=b.bk_code 
                WHERE mb_url ='$member_id'";
    $result_bank = mysqli_query($conn, $query_bank);

    if (mysqli_num_rows($result) == 1) {
        $acount = mysqli_fetch_array($result);
    }
    if (mysqli_num_rows($result_bank) == 1) {
        $acount_bank = mysqli_fetch_array($result_bank);
    }
}

$query_data = "SELECT * FROM tbl_member_db as m
            INNER JOIN tbl_bank_db as b ON m.bk_code=b.bk_code
            WHERE mb_level LIKE '%creditor%' ORDER BY mb_id ASC";
$result_data = mysqli_query($conn, $query_data);
$count_data = mysqli_num_rows($result_data);
$order = 1;

$query_data_m = "SELECT * FROM tbl_member_db as m
            INNER JOIN tbl_bank_db as b ON m.bk_code=b.bk_code
            WHERE mb_level LIKE '%creditor%' ORDER BY mb_id ASC";
$result_data_m = mysqli_query($conn, $query_data_m);
$count_data_m = mysqli_num_rows($result_data_m);
$order_m = 1;

// เพิ่มข้อมูลลูกค้า
if (isset($_REQUEST['btn_insert'])) {

    // รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร
    $mb_url_token = $_POST["mb_url_token"];

    $rp_url = getName($n);
    $mb_url_ = $acount['mb_url'];
    $mb_token = $acount['mb_url'];
    $rp_loan_amount = $_POST["rp_loan_amount"];
    $rp_status = "pending_loan"; // pending = รออนุมัติ, active = อนุมัติ
    $rp_time_add = datetime();

    // เช็คการป้อนข้อมูล
    if (empty($rp_loan_amount)) {
        $errorMsg = "กรุณากรอกข้อมูล ที่มีเครื่องหมาย (*) ให้ครบทุกช่อง";
    } else if ($rp_loan_amount < 2000) {
        $errorMsg = "จำนวนเงินที่สามารถขอกู้ขั้นต่ำ คือ 2,000.00 บาท กรุณาลองใหม่อีกครั้ง";
    }

    // บันทึกข้อมูล
    if (!isset($errorMsg)) {
        $sql1 = "UPDATE tbl_member_db SET 
                mb_url_token = '$mb_url_token' 
                WHERE mb_url = '$mb_url_'";

        $sql2 = "INSERT INTO tbl_report_db(rp_url, mb_url, mb_token, rp_loan_amount, rp_status, rp_time_add)
                VALUE('$rp_url', '$mb_url_', '$mb_token', '$rp_loan_amount', '$rp_status', '$rp_time_add')";

        // สั่งรันคำสั่ง sql
        $result1 = mysqli_query($conn, $sql1);
        $result2 = mysqli_query($conn, $sql2);

        if ($result1 && $result2) {
            $successMsg = "บันทึกข้อมูลสำเร็จ โปรดรอระบบบันทึกข้อมูล 3 วินาที";
            $redirect = $server['st_website_address'] . "page/debtor/report/" .$acount['mb_url'];
            header("refresh:3;$redirect");
        } else {
            echo mysqli_error($conn);
        }
    }

}

$regis_loan = $acount['mb_url_token'];
if (!empty($regis_loan)) {
    $redirect = $server['st_website_address'] . "page/debtor/report/" .$acount['mb_url'];
    header("location:$redirect");
}

// ออกจากระบบ
if (isset($_REQUEST['logout'])) {
    session_destroy();
    unset($_SESSION['member_id']);
    $redirect = $server['st_website_address'];
    header("location:$redirect");
}

// เช็กล็อคอิน
if (!isset($_SESSION['member_id']) || $_SESSION['member_level'] != "debtor") {
    session_destroy();
    unset($_SESSION['member_id']);
    $redirect = $server['st_website_address'];
    header("location:$redirect");
} else {
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <?php include('../../include/head.php'); ?>
</head>

<body class="bg-light">

    <!-- Box -->
    <div class="background-img">

        <!-- Wrapper -->
        <div class="wrapper">

            <!-- Navbar -->
            <?php include('../../include/navbar.php'); ?>
            <!-- End Navbar -->

            <!-- Content -->
            <form action="" method="post">
                <section class="login mb-3">
                    <div class="container">
                        <div class="login-wrapper">
                            <div class="login-info">
                                <div class="login-title">ยินดีต้อนรับ, คุณ<?php echo $acount['mb_firstname']; ?> <?php echo $acount['mb_lastname']; ?> เข้าสู่ระบบลูกหนี้<br><p class="text-muted">(เลือกเจ้าหนี้ด้านล่างนี้ เพื่อทำการสมัครกู้ยืมเงิน)</p></div>
                                <div class="login-content">
                                    <div class="row">
                                        <hr>
    
                                        <?php
                                        if (isset($errorMsg)) {
                                        ?>
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="mb-3">
                                                <div class="alert alert-danger" role="alert">
                                                    <div class="spinner-grow spinner-grow-sm text-danger" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                    <?php echo $errorMsg; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
    
                                        <?php
                                        if (isset($successMsg)) {
                                        ?>
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="mb-3">
                                                <div class="alert alert-success" role="alert">
                                                    <div class="spinner-grow spinner-grow-sm text-success" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                    <?php echo $successMsg; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>

                                        <div class="table-responsive-lg mb-2">
                                            <table class="table table-striped table-hover bg-light m-0">
                                                <caption class="pb-0">
                                                    <div class="d-flex justify-content-between">
                                                        <div>เร็คคอร์ดทั้งหมด <?php echo number_format($count_data) ?> เร็คคอร์ด</div>
                                                        <div>ข้อมูล ณ วันที่ <?php echo datetime(); ?></div>
                                                    </div>
                                                </caption>
                                                <thead class="">
                                                    <tr class="background-blue text-nowrap">
                                                        <th class="text-center">ลำดับที่</th>
                                                        <th>ชื่อจริง</th>
                                                        <th>นามสกุล</th>
                                                        <th>วัน/เดือน/ปี เวลาสมัคร</th>
                                                        <th>ระดับผู้ใช้</th>
                                                        <th>บัญชีธนาคารเจ้าหนี้</th>
                                                        <th>อัตราดอกเบี้ย</th>
                                                        <th class="text-center">สมัครกู้ยืมเงิน</th>
                                                    </tr>
                                                </thead>
                                                <tbody><?php while ($row = mysqli_fetch_assoc($result_data)) { ?>

                                                    <tr valign="middle" class="text-nowrap">
                                                        <td class="text-center"><?php echo number_format($order++) ?></td>
                                                        <td><?php echo $row['mb_firstname']; ?></td>
                                                        <td><?php echo $row['mb_lastname']; ?></td>
                                                        <td><?php echo $row['mb_timeinsert']; ?></td>
                                                        <td>เจ้าหนี้</td>
                                                        <td><?php echo $row['bk_name']; ?></td>
                                                        <td class="text-center"><?php echo $row['mb_interest']; ?>%</td>
                                                        <td class="text-center"><a data-bs-toggle="modal" data-bs-target="#loan_regis<?php echo $row['mb_url']; ?>" class="btn btn-sm btn-success">สมัครกู้ยืมเงิน</a></td>
                                                    </tr><?php } ?>

                                                </tbody>
                                                <tfoot class="">
                                                    <tr class="background-blue text-nowrap">
                                                        <th class="text-center">ลำดับที่</th>
                                                        <th>ชื่อจริง</th>
                                                        <th>นามสกุล</th>
                                                        <th>วัน/เดือน/ปี เวลาสมัคร</th>
                                                        <th>ระดับผู้ใช้</th>
                                                        <th>บัญชีธนาคารเจ้าหนี้</th>
                                                        <th>อัตราดอกเบี้ย</th>
                                                        <th class="text-center">สมัครกู้ยืมเงิน</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                        <form action="" method="post"><?php while ($row = mysqli_fetch_assoc($result_data_m)) { ?>
                                            <input type="hidden" name="mb_url_token" value="<?php echo $row['mb_url']; ?>">
                                            <div class="modal fade" id="loan_regis<?php echo $row['mb_url']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="loan_regis<?php echo $row['mb_url']; ?>Label" style="color: #4772f4;">สมัครกู้ยืมเงิน, กับคุณ<?php echo $row['mb_firstname']; ?> <?php echo $row['mb_lastname']; ?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <div class="col-sm-12">
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <label class="col-form-label">ชื่อจริง (เจ้าหนี้) : </label>
                                                                            <input type="text" class="form-control" value="<?php echo $row['mb_firstname']; ?>" disabled>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <label class="col-form-label">นามสกุล (เจ้าหนี้) : </label>
                                                                            <input type="text" class="form-control" value="<?php echo $row['mb_lastname']; ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="mb-3">
                                                                <div class="col-sm-12">
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <label class="col-form-label">ชื่อจริง (ลูกหนี้) : </label>
                                                                            <input type="text" class="form-control" value="<?php echo $acount['mb_firstname']; ?>" disabled>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <label class="col-form-label">นามสกุล (ลูกหนี้) : </label>
                                                                            <input type="text" class="form-control" value="<?php echo $acount['mb_lastname']; ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="rp_loan_amount" class="col-form-label">จำนวนเงินที่จะขอกู้ยืมเงิน (ขั้นต่ำ 2,000.00 บาท) : *</label>
                                                                <input type="text" id="rp_loan_amount" class="form-control" name="rp_loan_amount" placeholder="0.00" autocomplete="off" autofocus>
                                                            </div>
                                                            <div class="col-sm-12 p-2">เงื่อนไข และ ข้อตกลง :</div>
                                                            <div class="col-sm-12 text-muted p-2" style="background: #f7f7f7;font-size: 14px;">
                                                                1)&nbsp;&nbsp;โดย <span class="text-success">“ผู้กู้ยืมเงิน”</span> จะชำระเงินคืนให้แก่ <span class="text-success">“ผู้ให้กู้ยืม”</span> ทุกเดือน เดือนละ <span class="text-success">2,000.00</span> บาท<br>
                                                                2)&nbsp;&nbsp;โดย <span class="text-success">“ผู้ให้กู้ยืม”</span> จะไม่คิดดอกเบี้ย ใด ๆ ทั้งสิ้น หาก <span class="text-success">“ผู้กู้ยืมเงิน”</span> ทำตามข้อตกลง<br>
                                                                3)&nbsp;&nbsp;การคิดดอกเบี้ย เงินต้น 2,000 รวม ดอกเบี้ย ร้อยละ <span class="text-success"><?php echo $row['mb_interest']; ?></span> ต่อเดือน เท่ากับ <span class="text-success"><?php $it = 2000 * $row['mb_interest'] / 100; $it_total = 2000 + $it; echo number_format($it_total,2); ?></span> บาท
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="rp_time_add" class="col-form-label">วันที่ขอกู้ยืมเงิน : </label>
                                                                <input type="text" id="rp_time_add" class="form-control" name="rp_time_add" value="<?php echo datetime(); ?>" disabled>
                                                            </div>
                                                            <div class="d-flex justify-content-center">
                                                                <img src="<?php echo $server['st_website_address']; ?>assete/images/banner/banner_full.png" width="250">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" name="btn_insert" class="btn btn-blue">สมัครกู้ยืมเงิน</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><?php } ?>
                                        </form>
    
                                        <hr>
                                        <div class="d-flex justify-content-center">
                                            <img src="<?php echo $server['st_website_address']; ?>assete/images/banner/banner_full.png" width="250">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </form>

            
            
            <!-- Content -->

        </div>
        <!-- End Wrapper -->

    </div>
    <!-- End Box -->

    <!-- Footer -->
    <?php include('../../include/footer.php'); ?>
    <!-- End Footer -->
</body>

</html>
<?php } ?>