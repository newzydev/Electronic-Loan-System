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

// ดึงข้อมูลจากฐานข้อมูลมาแสดงทั้งหมด
$search = isset($_POST['search_query']) ? $_POST['search_query'] : '';
$token = $acount['mb_url'];
$query_data = "SELECT * FROM tbl_member_db WHERE mb_level LIKE '%debtor%' AND mb_url_token LIKE '%$token%' AND mb_timeinsert LIKE '%$search%' ORDER BY mb_id ASC";
$result_data = mysqli_query($conn, $query_data);
$count_data = mysqli_num_rows($result_data);
$order = 1;

// ออกจากระบบ
if (isset($_REQUEST['logout'])) {
    session_destroy();
    unset($_SESSION['member_id']);
    $redirect = $server['st_website_address'];
    header("location:$redirect");
}

// เช็กล็อคอิน
if (!isset($_SESSION['member_id']) || $_SESSION['member_level'] != "creditor") {
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
            <section class="login mb-3">
                <div class="container">
                    <div class="login-wrapper">
                        <div class="login-info">
                            <div class="login-title">ข้อมูลบัญชีผู้ใช้</div>
                            <div class="login-content">
                                <div class="row">
                                    <hr>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <div class="d-flex justify-content-between one-text">
                                            <div class="text-left">ชื่อจริง :</div>
                                            <div class="text-right text-muted"><?php echo $acount['mb_firstname']; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <div class="d-flex justify-content-between one-text">
                                            <div class="text-left">นามสกุล :</div>
                                            <div class="text-right text-muted"><?php echo $acount['mb_lastname']; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <div class="d-flex justify-content-between one-text">
                                            <div class="text-left">ระดับผู้ใช้งาน :</div>
                                            <div class="text-right text-muted">เจ้าหนี้</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <div class="d-flex justify-content-between one-text">
                                            <div class="text-left">สมัครสมาชิก :</div>
                                            <div class="text-right text-muted"><?php echo $acount['mb_timeinsert']; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <div class="d-flex justify-content-between one-text">
                                            <div class="text-left">เลขบัญชีธนาคาร :</div>
                                            <div class="text-right text-muted"><?php echo $acount['mb_account_number']; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <div class="d-flex justify-content-between one-text">
                                            <div class="text-left">ชื่อธนาคาร :</div>
                                            <div class="text-right text-muted"><?php echo $acount_bank['bk_name']; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <div class="d-flex justify-content-between one-text">
                                            <div class="text-left">เอกสารสำเนาบัตรประชาชน :</div>
                                            <div class="text-right text-muted"><a href="<?php echo $server['st_website_address']; ?>assete/citizen_file/<?php echo $acount['mb_citizen_id_file']; ?>" target="_blank">ดูเอกสาร</a></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <div class="d-flex justify-content-between one-text">
                                            <div class="text-left">เอกสารสำเนาบัญชีธนาคาร :</div>
                                            <div class="text-right text-muted"><a href="<?php echo $server['st_website_address']; ?>assete/bookbank_file/<?php echo $acount['mb_book_bank_file']; ?>" target="_blank"">ดูเอกสาร</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <form action="" method="post">
                <section class="login mb-3">
                    <div class="container">
                        <div class="login-wrapper">
                            <div class="login-info">
                                <div class="login-title">ยินดีต้อนรับ, คุณ<?php echo $acount['mb_firstname']; ?> <?php echo $acount['mb_lastname']; ?> เข้าสู่ระบบเจ้าหนี้</div>
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

                                        <div class="col-sm-12 col-md-12 col-lg-9 mb-3">
                                            <input type="search" class="form-control" name="search_query" placeholder="ค้นหาจากวันที่สมัครสมาชิก" value="<?php echo isset($search) ? $search : '' ?>" required autocomplete="off" autofocus>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-1 mb-3">
                                            <div class="d-grid">
                                                <a href="<?php echo $server['st_website_address']; ?>page/creditor/dashboard" class="btn btn-blue">รีเฟรช</a>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-2 mb-3">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-blue"><i class="fas fa-search"></i> ค้นหารายการ</button>
                                            </div>
                                        </div>

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
                                                        <th>สมัครสมาชิก</th>
                                                        <th>รายการบัญชีล่าสุด</th>
                                                        <th>จำนวนเงินคงเหลือ</th>
                                                        <th class="text-center">สถานะ</th>
                                                        <th class="text-center">ดูรายการบัญชี</th>
                                                    </tr>
                                                </thead>
                                                <tbody><?php while ($row = mysqli_fetch_assoc($result_data)) { ?>

                                                    <tr valign="middle" class="text-nowrap">
                                                        <td class="text-center"><?php echo number_format($order++) ?></td>
                                                        <td class=""><?php echo $row['mb_firstname']; ?></td>
                                                        <td class=""><?php echo $row['mb_lastname']; ?></td>
                                                        <td class=""><?php echo $row['mb_timeinsert']; ?></td>
                                                        <td class=""><?php
                                                            $mb_url = $row['mb_url'];
                                                            $query_data_con_info = "SELECT * FROM tbl_report_db as r
                                                            INNER JOIN tbl_member_db as m ON r.mb_url=m.mb_url 
                                                            WHERE mb_token LIKE '%$mb_url%'
                                                            ORDER BY r.rp_id DESC LIMIT 1";
                                                            $result_data_con_display = mysqli_query($conn, $query_data_con_info);
                                                            $result_latest = mysqli_fetch_assoc($result_data_con_display);
                                                            if (!empty($result_latest['rp_time_add'])) {
                                                                echo $result_latest['rp_time_add'];
                                                            } else {
                                                                echo "-";
                                                            }
                                                            ?></td>
                                                        <td class=""><?php
                                                            $mb_url = $row['mb_url'];
                                                            $query_data_con_p1 = "SELECT * FROM tbl_report_db as r
                                                                                INNER JOIN tbl_member_db as m ON r.mb_url=m.mb_url 
                                                                                WHERE mb_token LIKE '%$mb_url%'
                                                                                ORDER BY r.rp_id ASC";
                                                            $result_data_con_re = mysqli_query($conn, $query_data_con_p1);
                                                            $rp_loan_amount = 0;
                                                            while( $f = mysqli_fetch_assoc($result_data_con_re)) {
                                                                $rp_loan_amount += $f['rp_loan_amount'];
                                                            }

                                                            $query_data_con_p1 = "SELECT * FROM tbl_report_db as r
                                                                                INNER JOIN tbl_member_db as m ON r.mb_url=m.mb_url 
                                                                                WHERE mb_token LIKE '%$mb_url%'
                                                                                ORDER BY r.rp_id ASC";
                                                            $result_data_con_re = mysqli_query($conn, $query_data_con_p1);
                                                            $rp_number_1 = 0;
                                                            while( $f = mysqli_fetch_assoc($result_data_con_re)) {
                                                                $rp_number_1 += $f['rp_number_1'];
                                                            }

                                                            $query_data_con_p2 = "SELECT * FROM tbl_report_db as r
                                                                                INNER JOIN tbl_member_db as m ON r.mb_url=m.mb_url 
                                                                                WHERE mb_token LIKE '%$mb_url%'
                                                                                ORDER BY r.rp_id ASC";
                                                            $result_data_con_re = mysqli_query($conn, $query_data_con_p2);
                                                            $rp_number_2 = 0;
                                                            while( $f = mysqli_fetch_assoc($result_data_con_re)) {
                                                                $rp_number_2 += $f['rp_number_2'];
                                                            }

                                                            $query_data_con_p3 = "SELECT * FROM tbl_report_db as r
                                                                                INNER JOIN tbl_member_db as m ON r.mb_url=m.mb_url 
                                                                                WHERE mb_token LIKE '%$mb_url%'
                                                                                ORDER BY r.rp_id ASC";
                                                            $result_data_con_re = mysqli_query($conn, $query_data_con_p3);
                                                            $rp_number_3 = 0;
                                                            while( $f = mysqli_fetch_assoc($result_data_con_re)) {
                                                                $rp_number_3 += $f['rp_number_3'];
                                                            }

                                                            $total = ($rp_loan_amount + $rp_number_2) - $rp_number_1;
                                                            if ($total < 1) {
                                                                $total = 0;
                                                            }
                                                            echo "฿". number_format($total,2) ." บาท";
                                                            ?></td>
                                                        <td class="text-center">
                                                        <?php if ($total < 1) { ?>
                                                            <div class="d-grid">
                                                                <a class="btn btn-sm btn-danger">ชำระหนี้ดอกเบี้ยครบแล้ว</a>
                                                            </div>
                                                        <?php } else { ?>
                                                            <?php
                                                            $mb_url = $row['mb_url'];
                                                            $query_data_status = "SELECT * FROM tbl_report_db as r
                                                            INNER JOIN tbl_member_db as m ON r.mb_url=m.mb_url 
                                                            WHERE mb_token LIKE '%$mb_url%'
                                                            ORDER BY r.rp_id DESC";
                                                            $result_data_status = mysqli_query($conn, $query_data_status);
                                                            $result_status = mysqli_fetch_assoc($result_data_status);

                                                            $status = $result_status['rp_status']; if ($status == "pending" || $status == "pending_loan") { ?>
                                                                <div class="d-grid">
                                                                    <a class="btn btn-sm btn-warning">มีรายการที่รออนุมัติ</a>
                                                                </div>
                                                            <?php } else if ($status == "active" || $status == "active_loan" ) { ?>
                                                                <div class="d-grid">
                                                                    <a class="btn btn-sm btn-success">อนุมัติทุกรายการแล้ว</a>
                                                                </div>
                                                            <?php } ?>
                                                        <?php } ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="d-grid">
                                                                <a href="<?php echo $server['st_website_address']; ?>page/debtor/report/<?php echo $row['mb_url']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-desktop"></i> ดูรายการบัญชี</a>
                                                            </div>
                                                        </td>
                                                    </tr><?php } ?>

                                                </tbody>
                                                <tfoot class="">
                                                    <tr class="background-blue text-nowrap">
                                                        <th class="text-center">ลำดับที่</th>
                                                        <th>ชื่อจริง</th>
                                                        <th>นามสกุล</th>
                                                        <th>สมัครสมาชิก</th>
                                                        <th>รายการบัญชีล่าสุด</th>
                                                        <th>จำนวนเงินคงเหลือ</th>
                                                        <th class="text-center">สถานะ</th>
                                                        <th class="text-center">ดูรายการบัญชี</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
    
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