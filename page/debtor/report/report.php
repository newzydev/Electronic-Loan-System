<?php
// error_reporting(0);
// ini_set('display_errors', 0);
require_once('../../../connect/server.php');
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

// ดึงข้อมูลจากฐานข้อมูลมาแสดง
$mb_url = $_GET['mb_url'];
$query_data_con = "SELECT * FROM tbl_member_db as m
                INNER JOIN tbl_bank_db as b ON m.bk_code=b.bk_code 
                WHERE mb_url ='$mb_url'";
$result_data_con = mysqli_query($conn, $query_data_con);
$result_report = mysqli_fetch_assoc($result_data_con);

$mb_url_token = $acount['mb_url_token'];
$query_data_con_2 = "SELECT * FROM tbl_member_db as m
                INNER JOIN tbl_bank_db as b ON m.bk_code=b.bk_code 
                WHERE mb_url ='$mb_url_token'";
$result_data_con_2 = mysqli_query($conn, $query_data_con_2);
$result_report_2 = mysqli_fetch_assoc($result_data_con_2);

$mb_url_token_3 = $acount['mb_url_token'];
$query_data_con_3 = "SELECT * FROM tbl_member_db as m
                INNER JOIN tbl_bank_db as b ON m.bk_code=b.bk_code 
                WHERE mb_url_token ='$mb_url_token'";
$result_data_con_3 = mysqli_query($conn, $query_data_con_3);
$result_report_3 = mysqli_fetch_assoc($result_data_con_3);

if (isset($_REQUEST['approve'])) {

    // รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร
    $rp_url = $_POST["rp_url"];

    $rp_status = "active";

    // บันทึกข้อมูล
    if (!isset($errorMsg)) {
        $sql = "UPDATE tbl_report_db SET 
        rp_status = '$rp_status'
        WHERE rp_url = '$rp_url'";
        
        // สั่งรันคำสั่ง sql
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $successMsg = "บันทึกข้อมูลสำเร็จ โปรดรอระบบบันทึกข้อมูล 3 วินาที";
            $redirect = $server['st_website_address'] . "page/debtor/report/" .$result_report['mb_url'];
            header("refresh:3;$redirect");
        } else {
            echo mysqli_error($conn);
        }
    }

}

if (isset($_REQUEST['btn_interest'])) {

    // รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร
    $rp_url = $_POST["rp_url"];
    $rp_number_2 = $_POST["rp_number_2"];

    // บันทึกข้อมูล
    if (!isset($errorMsg)) {
        $sql = "UPDATE tbl_report_db SET 
        rp_number_2 = '$rp_number_2'
        WHERE rp_url = '$rp_url'";
        
        // สั่งรันคำสั่ง sql
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $successMsg = "บันทึกข้อมูลสำเร็จ โปรดรอระบบบันทึกข้อมูล 3 วินาที";
            $redirect = $server['st_website_address'] . "page/debtor/report/" .$result_report['mb_url'];
            header("refresh:3;$redirect");
        } else {
            echo mysqli_error($conn);
        }
    }

}

// ทำรายการโอนเงินให้ลูกหนี้
if (isset($_REQUEST['btn_confirm_loan'])) {

    // รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร
    $rp_url = $_POST["rp_url"];

    $rp_status = "active_loan";
    $rp_time_add = $_POST["datetime"];

    $ymd = date('Ymd-His');

    $rp_cash_img_enc = strrchr($_FILES['cash_img']['name'], ".");
    $newname1 = $numrand . $date1 . "-" . $ymd . $rp_cash_img_enc;
    $type1 = $_FILES['cash_img']['type'];
    $size1 = $_FILES['cash_img']['size'];
    $temp1 = $_FILES['cash_img']['tmp_name'];

    $path1 = "../../../assete/images/payment_slip/". $newname1;

    // เช็คการป้อนข้อมูล
    if (empty($rp_time_add)) {
        $errorMsg = "กรุณากรอกข้อมูล ที่มีเครื่องหมาย (*) ให้ครบทุกช่อง";
    } else if (empty($rp_cash_img_enc)) {
        $errorMsg = "กรุณาเลือกรูปภาพ";
    } else if ($type1 == "image/jpg" || $type1 == 'image/jpeg' || $type1 == "image/png") {
        if (!file_exists($path1)) {
            if ($size1 < 5000000) {
                move_uploaded_file($temp1, '../../../assete/images/payment_slip/' . $newname1);
            } else {
                $errorMsg = "ไฟล์ของคุณใหญ่เกินไป โปรดอัปโหลดขนาด 5MB";
            }
        } else {
            $errorMsg = "ไฟล์มีอยู่แล้ว... ตรวจสอบโฟลเดอร์อัพโหลด";
        }
    } else {
        $errorMsg = "อนุญาตให้อัปโหลดรูปแบบไฟล์ JPG, JPEG และ PNG เท่านั้น";
    }

    // บันทึกข้อมูล
    if (!isset($errorMsg)) {
        $sql = "UPDATE tbl_report_db SET 
        rp_cash_img = '$newname1',
        rp_status = '$rp_status',
        rp_time_add = '$rp_time_add'
        WHERE rp_url = '$rp_url'";
        
        // สั่งรันคำสั่ง sql
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $successMsg = "บันทึกข้อมูลสำเร็จ โปรดรอระบบบันทึกข้อมูล 3 วินาที";
            $redirect = $server['st_website_address'] . "page/debtor/report/" .$result_report['mb_url'];
            header("refresh:3;$redirect");
        } else {
            echo mysqli_error($conn);
        }
    }

}

// ทำรายการชำระเงินกู้ยืม
if (isset($_REQUEST['btn_payment'])) {

    // รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร
    $rp_url = $_POST["rp_url"];
    $rp_number_1 = $_POST["rp_number_1"];

    $rp_status = "pending";
    $rp_time_add = $_POST["datetime"];

    $ymd = date('Ymd-His');

    $rp_cash_img_enc = strrchr($_FILES['cash_img']['name'], ".");
    $newname1 = $numrand . $date1 . "-" . $ymd . $rp_cash_img_enc;
    $type1 = $_FILES['cash_img']['type'];
    $size1 = $_FILES['cash_img']['size'];
    $temp1 = $_FILES['cash_img']['tmp_name'];

    $path1 = "../../../assete/images/payment_slip/". $newname1;

    // เช็คการป้อนข้อมูล
    if (empty($rp_time_add)) {
        $errorMsg = "กรุณากรอกข้อมูล ที่มีเครื่องหมาย (*) ให้ครบทุกช่อง";
    } else if (empty($rp_cash_img_enc)) {
        $errorMsg = "กรุณาเลือกรูปภาพ";
    } else if ($type1 == "image/jpg" || $type1 == 'image/jpeg' || $type1 == "image/png") {
        if (!file_exists($path1)) {
            if ($size1 < 5000000) {
                move_uploaded_file($temp1, '../../../assete/images/payment_slip/' . $newname1);
            } else {
                $errorMsg = "ไฟล์ของคุณใหญ่เกินไป โปรดอัปโหลดขนาด 5MB";
            }
        } else {
            $errorMsg = "ไฟล์มีอยู่แล้ว... ตรวจสอบโฟลเดอร์อัพโหลด";
        }
    } else {
        $errorMsg = "อนุญาตให้อัปโหลดรูปแบบไฟล์ JPG, JPEG และ PNG เท่านั้น";
    }

    // บันทึกข้อมูล
    if (!isset($errorMsg)) {
        $sql = "UPDATE tbl_report_db SET 
        rp_number_1 = '$rp_number_1',
        rp_cash_img = '$newname1',
        rp_status = '$rp_status',
        rp_time_add = '$rp_time_add'
        WHERE rp_url = '$rp_url'";
        
        // สั่งรันคำสั่ง sql
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $successMsg = "บันทึกข้อมูลสำเร็จ โปรดรอระบบบันทึกข้อมูล 3 วินาที";
            $redirect = $server['st_website_address'] . "page/debtor/report/" .$result_report['mb_url'];
            header("refresh:3;$redirect");
        } else {
            echo mysqli_error($conn);
        }
    }

}

// ขอกู้ยืมเงินเพิ่ม
if (isset($_REQUEST['btn_insert_3'])) {

    // รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร
    $rp_url = getName($n);
    $mb_url_ = $mb_url;
    $mb_token = $mb_url;
    $rp_loan_amount = $_POST["rp_cash_out"];
    $rp_status = "pending_loan";
    $rp_time_add = datetime();
    // เช็คการป้อนข้อมูล
    if (empty($rp_loan_amount)) {
        $errorMsg = "กรุณากรอกข้อมูล ที่มีเครื่องหมาย (*) ให้ครบทุกช่อง";
    }

    // บันทึกข้อมูล
    if (!isset($errorMsg)) {
        $sql = "INSERT INTO tbl_report_db(rp_url, mb_url, mb_token, rp_loan_amount, rp_status, rp_time_add)
                VALUE('$rp_url', '$mb_url_', '$mb_token', '$rp_loan_amount', '$rp_status', '$rp_time_add')";

        // สั่งรันคำสั่ง sql
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $successMsg = "บันทึกข้อมูลสำเร็จ โปรดรอระบบบันทึกข้อมูล 3 วินาที";
            $redirect = $server['st_website_address'] . "page/debtor/report/" .$result_report['mb_url'];
            header("refresh:3;$redirect");
        } else {
            echo mysqli_error($conn);
        }
    }

}

if (isset($_REQUEST['notify_loan_payment'])) {

    // รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร
    $rp_url = getName($n);
    $mb_url_ = $mb_url;
    $mb_token = $mb_url;
    $txt_installment = $_POST["txt_installment"];
    $txt_month_1 = $_POST["txt_month_1"];
    $txt_year_1 = $_POST["txt_year_1"];
    $txt_between_1 = $_POST["txt_between_1"];
    $txt_between_2 = $_POST["txt_between_2"];
    $txt_month_2 = $_POST["txt_month_2"];
    $txt_year_2 = $_POST["txt_year_2"];
    $rp_time_add = datetime();

    // $txt_loan_amount = $_POST["rp_loan_amount"]; // จำนวนเงิน
    // $txt_number_1 = $_POST["txt_number_1"]; // จำนวนเงิน
    $txt_number_2 = $_POST["txt_number_2"]; // จำนวนดอกเบี้ย
    $txt_number_3 = $_POST["txt_number_3"]; // จำนวนงวดละ
    $rp_status = "pending";

    $txt_full_list = "แจ้งชำระเงินกู้ยืม งวดที่ ".$txt_installment." ประจำเดือน ".$txt_month_1." ปี ".$txt_year_1;
    $txt_date = $txt_between_1."-".$txt_between_2." ".$txt_month_2." ".$txt_year_2;

    // เช็คการป้อนข้อมูล
    if (empty($txt_installment) || empty($txt_month_1) || empty($txt_year_1) || empty($txt_between_1) ||
    empty($txt_between_2) || empty($txt_month_2) || empty($txt_year_2) || empty($txt_number_3)) {
        $errorMsg = "กรุณากรอกข้อมูล ที่มีเครื่องหมาย (*) ให้ครบทุกช่อง";
    }

    if (empty($txt_number_2)) {
        $txt_number_2 = 0;
    }

    // บันทึกข้อมูล
    if (!isset($errorMsg)) {
        $sql = "INSERT INTO tbl_report_db(rp_url, mb_url, mb_token, rp_list_name, rp_list_date, rp_number_2, rp_number_3, rp_status, rp_time_add)
                VALUE('$rp_url', '$mb_url_', '$mb_token', '$txt_full_list', '$txt_date', '$txt_number_2', '$txt_number_3', '$rp_status', '$rp_time_add')";

        // สั่งรันคำสั่ง sql
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $successMsg = "บันทึกข้อมูลสำเร็จ โปรดรอระบบบันทึกข้อมูล 3 วินาที";
            $redirect = $server['st_website_address'] . "page/debtor/report/" .$result_report['mb_url'];
            header("refresh:3;$redirect");
        } else {
            echo mysqli_error($conn);
        }
    }

}

$search = isset($_POST['search_query']) ? $_POST['search_query'] : '';
$query_data_con_q = "SELECT * FROM tbl_report_db as r
                    INNER JOIN tbl_member_db as m ON r.mb_url=m.mb_url 
                    WHERE mb_token LIKE '%$mb_url%' AND rp_list_name LIKE '%$search%'
                    ORDER BY r.rp_id ASC";
$result_data_con_q = mysqli_query($conn, $query_data_con_q);
$count_data = mysqli_num_rows($result_data_con_q);
$order = 1;

$query_data_con_q_modal = "SELECT * FROM tbl_report_db as r
                    INNER JOIN tbl_member_db as m ON r.mb_url=m.mb_url 
                    WHERE mb_token LIKE '%$mb_url%' AND rp_time_add LIKE '%$search%'
                    ORDER BY r.rp_id DESC";
$result_data_con_q_modal = mysqli_query($conn, $query_data_con_q_modal);

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

$query_data_con_info = "SELECT * FROM tbl_report_db as r
                    INNER JOIN tbl_member_db as m ON r.mb_url=m.mb_url 
                    WHERE mb_token LIKE '%$mb_url%'
                    ORDER BY r.rp_id DESC LIMIT 1";
$result_data_con_display = mysqli_query($conn, $query_data_con_info);
$result_latest = mysqli_fetch_assoc($result_data_con_display);

$regis_loan = $result_report['mb_url_token'];
if (empty($regis_loan)) {
    $redirect = $server['st_website_address'] . "page/debtor/select_creditor";
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
if (!isset($_SESSION['member_id']) || $_SESSION['member_level'] != "creditor" && $_SESSION['member_level'] != "debtor") {
    session_destroy();
    unset($_SESSION['member_id']);
    $redirect = $server['st_website_address'];
    header("location:$redirect");
} else {
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <?php include('../../../include/head.php'); ?>
</head>

<body class="bg-light">

    <!-- Box -->
    <div class="background-img">

        <!-- Wrapper -->
        <div class="wrapper">

            <!-- Navbar -->
            <?php include('../../../include/navbar.php'); ?>
            <!-- End Navbar -->

            <!-- Content -->
            <section class="login mb-3">
                <div class="container-fluid">
                    <div class="login-wrapper">
                        <div class="login-info">
                            <div class="login-title">ข้อมูลบัญชีผู้ใช้</div>
                            <div class="login-content">
                                <div class="row">
                                    <hr>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <div class="d-flex justify-content-between one-text">
                                            <div class="text-left">ชื่อจริง :</div>
                                            <div class="text-right text-muted"><?php echo $result_report['mb_firstname']; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <div class="d-flex justify-content-between one-text">
                                            <div class="text-left">นามสกุล :</div>
                                            <div class="text-right text-muted"><?php echo $result_report['mb_lastname']; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <div class="d-flex justify-content-between one-text">
                                            <div class="text-left">ระดับผู้ใช้งาน :</div>
                                            <div class="text-right text-muted">ลูกหนี้</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <div class="d-flex justify-content-between one-text">
                                            <div class="text-left">สมัครสมาชิก :</div>
                                            <div class="text-right text-muted"><?php echo $result_report['mb_timeinsert']; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <div class="d-flex justify-content-between one-text">
                                            <div class="text-left">รหัสบัญชีลูกหนี้ :</div>
                                            <div class="text-right text-muted"><?php echo $result_report['mb_url']; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <div class="d-flex justify-content-between one-text">
                                            <div class="text-left">รายการบัญชีล่าสุด :</div>
                                            <div class="text-right text-muted"><?php $rlt = $result_latest['rp_time_add']; if (empty($rlt)) { echo "-"; } else { echo $rlt; } ?></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <div class="d-flex justify-content-between one-text">
                                            <div class="text-left">รายการเงินกู้ยืมล่าสุด :</div>
                                            <!-- <div class="text-right text-muted"><?php echo number_format($result_latest['rp_loan_amount'],2); ?> บาท</div> -->
                                            <div class="text-right text-muted">N\A บาท</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <div class="d-flex justify-content-between one-text">
                                            <div class="text-left">รายการเงินคืนล่าสุด :</div>
                                            <!-- <div class="text-right text-muted"><?php echo number_format($result_latest['rp_number_2'],2); ?> บาท</div> -->
                                            <div class="text-right text-muted">N\A บาท</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <div class="d-flex justify-content-between one-text">
                                            <div class="text-left">เลขบัญชีธนาคาร :</div>
                                            <div class="text-right text-muted"><?php echo $result_report['mb_account_number']; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <div class="d-flex justify-content-between one-text">
                                            <div class="text-left">ชื่อธนาคาร :</div>
                                            <div class="text-right text-muted"><?php echo $result_report['bk_name']; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <div class="d-flex justify-content-between one-text">
                                            <div class="text-left">เอกสารสำเนาบัตรประชาชน :</div>
                                            <div class="text-right text-muted"><a href="<?php echo $server['st_website_address']; ?>assete/citizen_file/<?php echo $result_report['mb_citizen_id_file']; ?>" target="_blank">ดูเอกสาร</a></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <div class="d-flex justify-content-between one-text">
                                            <div class="text-left">เอกสารสำเนาบัญชีธนาคาร :</div>
                                            <div class="text-right text-muted"><a href="<?php echo $server['st_website_address']; ?>assete/bookbank_file/<?php echo $result_report['mb_book_bank_file']; ?>" target="_blank">ดูเอกสาร</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="container-fluid">
                    <div class="row">
                        <section class="col-sm-12 col-md-12 col-lg-8 mb-3">
                            <div class="login-wrapper">
                                <div class="login-info">

                                <?php if ($_SESSION['member_level'] == "creditor") { ?>
                                    <div class="login-title">ยอดดอกเบี้ย ร้อยละ <?php echo $result_report_3['mb_interest']; ?> ต่อเดือน</div>
                                        <div class="login-content">
                                            <div class="col-sm-12 mt-2 mb-3">
                                                <div class="row">
                                                    <hr>
                                                    <div class="col-sm-3 p-2">เงื่อนไข และ ข้อตกลง :</div>
                                                    <div class="col-sm-9 text-muted p-2" style="background: #f7f7f7;">
                                                        1)&nbsp;&nbsp;โดย <span class="text-success">“ผู้กู้ยืมเงิน”</span> จะชำระเงินคืนให้แก่ <span class="text-success">“ผู้ให้กู้ยืม”</span> ทุกเดือน เดือนละ <span class="text-success">2,000.00</span> บาท<br>
                                                        2)&nbsp;&nbsp;โดย <span class="text-success">“ผู้ให้กู้ยืม”</span> จะไม่คิดดอกเบี้ย ใด ๆ ทั้งสิ้น หาก <span class="text-success">“ผู้กู้ยืมเงิน”</span> ทำตามข้อตกลง<br>
                                                        3)&nbsp;&nbsp;การคิดดอกเบี้ย เงินต้น <span class="text-success">2,000</span> รวม ดอกเบี้ย ร้อยละ <span class="text-success"><?php echo $result_report_3['mb_interest']; ?></span> ต่อเดือน เท่ากับ <span class="text-success"><?php $it = 2000 * $result_report_3['mb_interest'] / 100; $it_total = 2000 + $it; echo number_format($it_total,2); ?></span> บาท
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } else if ($_SESSION['member_level'] == "debtor") { ?>
                                    <div class="login-title">ยอดดอกเบี้ย ร้อยละ <?php echo $result_report_2['mb_interest']; ?> ต่อเดือน</div>
                                        <div class="login-content">
                                            <div class="col-sm-12 mt-2 mb-3">
                                                <div class="row">
                                                    <hr>
                                                    <div class="col-sm-3 p-2">เงื่อนไข และ ข้อตกลง :</div>
                                                    <div class="col-sm-9 text-muted p-2" style="background: #f7f7f7;">
                                                        1)&nbsp;&nbsp;โดย <span class="text-success">“ผู้กู้ยืมเงิน”</span> จะชำระเงินคืนให้แก่ <span class="text-success">“ผู้ให้กู้ยืม”</span> ทุกเดือน เดือนละ <span class="text-success">2,000.00</span> บาท<br>
                                                        2)&nbsp;&nbsp;โดย <span class="text-success">“ผู้ให้กู้ยืม”</span> จะไม่คิดดอกเบี้ย ใด ๆ ทั้งสิ้น หาก <span class="text-success">“ผู้กู้ยืมเงิน”</span> ทำตามข้อตกลง<br>
                                                        3)&nbsp;&nbsp;การคิดดอกเบี้ย เงินต้น <span class="text-success">2,000</span> รวม ดอกเบี้ย ร้อยละ <span class="text-success"><?php echo $result_report_2['mb_interest']; ?></span> ต่อเดือน เท่ากับ <span class="text-success"><?php $it = 2000 * $result_report_2['mb_interest'] / 100; $it_total = 2000 + $it; echo number_format($it_total,2); ?></span> บาท
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>
                        </section>
                        <section class="col-sm-12 col-md-12 col-lg-4 mb-3">
                            <div class="login-wrapper">
                                <div class="login-info">
                                    <div class="login-title">ข้อมูลสรุป</div>
                                    <div class="login-content">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-5">จำนวนเงินกู้ : </div>
                                                <div class="col-sm-7 text-right" style="background: #f7f7f7;" > ฿&nbsp; <?php echo number_format($rp_loan_amount,2); ?> &nbsp;&nbsp;&nbsp;บาท</div>
                                                
                                                <div class="col-sm-5">จำนวนดอกเบี้ย : </div>
                                                <div class="col-sm-7 text-right" style="background: #f7f7f7;" > ฿&nbsp; <?php echo number_format($rp_number_2,2); ?> &nbsp;&nbsp;&nbsp;บาท</div>

                                                <div class="col-sm-5">ยอดรวม : </div>
                                                <div class="col-sm-7 text-right" style="background: #f7f7f7;" > ฿&nbsp; <?php $total = $rp_loan_amount + $rp_number_2; echo number_format($total,2); ?> &nbsp;&nbsp;&nbsp;บาท</div>

                                                <div class="col-sm-5">จำนวนเงินคืน : </div>
                                                <div class="col-sm-7 text-right" style="background: #f7f7f7;" > ฿&nbsp; <?php echo number_format($rp_number_1,2); ?> &nbsp;&nbsp;&nbsp;บาท</div>

                                                <div class="col-sm-5">เงินกู้ที่ต้องชำระ : </div>
                                                <div class="col-sm-7 text-right" style="background: #f7f7f7;" > ฿&nbsp; <?php $total = ($rp_loan_amount + $rp_number_2) - $rp_number_1; echo number_format($total,2); ?> &nbsp;&nbsp;&nbsp;บาท</div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>

            <section class="login mb-3">
                <div class="container-fluid">
                    <div class="login-wrapper">
                        <div class="login-info">
                            <?php if ($_SESSION['member_level'] == "creditor") { ?>
                            <div class="login-title">ยินดีต้อนรับ, คุณ<?php echo $result_report_3['mb_firstname']; ?> <?php echo $result_report_3['mb_lastname']; ?> เข้าสู่ระบบเจ้าหนี้</div>
                            <?php } else if ($_SESSION['member_level'] == "debtor") { ?>
                            <div class="login-title">ยินดีต้อนรับ, คุณ<?php echo $acount['mb_firstname']; ?> <?php echo $acount['mb_lastname']; ?> เข้าสู่ระบบลูกหนี้</div>
                            <?php } ?>
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

                                    <form action="" method="post">
                                        <div class="row">

                                            <?php if ($_SESSION['member_level'] == "creditor") { ?>
                                            <div class="col-sm-12 col-md-12 col-lg-5 mb-3">
                                                <input type="search" class="form-control" name="search_query" placeholder="ค้นหาจากรายการ" value="<?php echo isset($search) ? $search : '' ?>" required autocomplete="off">
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-1 mb-3">
                                                <div class="d-grid">
                                                    <a href="<?php echo $server['st_website_address']; ?>page/debtor/report/<?php echo $result_report['mb_url']; ?>" class="btn btn-blue">รีเฟรช</a>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-2 mb-3">
                                                <div class="d-grid">
                                                    <a href="<?php echo $server['st_website_address']; ?>page/creditor/dashboard" class="btn btn-blue">ย้อนกลับ</a>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-2 mb-3">
                                                <div class="d-grid">
                                                    <a class="btn btn-blue" data-bs-toggle="modal" data-bs-target="#notify_loan_payment">แจ้งชำระเงินกู้ยืม</a>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-2 mb-3">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-blue"><i class="fas fa-search"></i> ค้นหารายการ</button>
                                                </div>
                                            </div>
                                            <?php } else if ($_SESSION['member_level'] == "debtor") { ?>
                                            <div class="col-sm-12 col-md-12 col-lg-7 mb-3">
                                                <input type="search" class="form-control" name="search_query" placeholder="ค้นหาจากรายการ" value="<?php echo isset($search) ? $search : '' ?>" required autocomplete="off">
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-1 mb-3">
                                                <div class="d-grid">
                                                    <a href="<?php echo $server['st_website_address']; ?>page/debtor/report/<?php echo $result_report['mb_url']; ?>" class="btn btn-blue">รีเฟรช</a>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-2 mb-3">
                                                <div class="d-grid">
                                                    <a class="btn btn-blue" data-bs-toggle="modal" data-bs-target="#add_insert_1">ขอกู้ยืมเงินเพิ่ม</a>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-2 mb-3">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-blue"><i class="fas fa-search"></i> ค้นหารายการ</button>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </form>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="modal fade" id="notify_loan_payment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="addListModalLabel" style="color: #4772f4;">ฟอร์มแจ้งชำระเงินกู้ยืม</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div>แจ้งชำระเงินกู้ยืม</div>
                                                        <div class="mb-3">
                                                            <div class="col-sm-12">
                                                                <div class="row">
                                                                    <div class="col-sm-3">
                                                                        <label for="txt_installment" class="col-form-label">งวดที่ : </label>
                                                                        <input type="number" class="form-control" name="txt_installment" id="txt_installment" value="1">
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <label for="txt_month_1" class="col-form-label">ประจำเดือน : </label>
                                                                        <select class="form-select" name="txt_month_1" id="txt_month_1" aria-label="Default select example">
                                                                            <?php
                                                                            $ThaiMonth = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
                                                                            foreach ($ThaiMonth as $m) {
                                                                                
                                                                                echo "<option value='$m'>$m</option>";
                                                                                
                                                                            }
                                                                            ?>

                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <label for="txt_year_1" class="col-form-label">ปี พุทธศักราช : </label>
                                                                        <select class="form-select" name="txt_year_1" id="txt_year_1" aria-label="Default select example">
                                                                            <?php
                                                                            for ($y = date('Y') + 531; $y <= date('Y') + 543; $y++) {
                                                                                
                                                                                if ($y == date('Y') + 543) {
                                                                                $selecteds = 'selected';
                                                                                }
                                                                                echo "<option $selecteds value='$y'>$y</option>";
                                                                                
                                                                            }
                                                                            ?>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="mb-3">
                                                            <div class="col-sm-12">
                                                                <label for="txt_between" class="col-form-label">วันที่ชำระต่องวด (เริ่มวันที่ - ถึงวันที่) : </label>
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <input type="number" class="form-control" name="txt_between_1" id="txt_between" value="1">
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="number" class="form-control" name="txt_between_2" id="txt_between" value="15">
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <label for="txt_month_2" class="col-form-label">ประจำเดือน : </label>
                                                                        <select class="form-select" name="txt_month_2" id="txt_month_2" aria-label="Default select example">
                                                                            <?php
                                                                            $ThaiMonth = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
                                                                            foreach ($ThaiMonth as $m) {
                                                                                
                                                                                echo "<option value='$m'>$m</option>";
                                                                                
                                                                            }
                                                                            ?>

                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <label for="txt_year_2" class="col-form-label">ปี พุทธศักราช : </label>
                                                                        <select class="form-select" name="txt_year_2" id="txt_year_2" aria-label="Default select example">
                                                                            <?php
                                                                            for ($y = date('Y') + 531; $y <= date('Y') + 543; $y++) {
                                                                                
                                                                                if ($y == date('Y') + 543) {
                                                                                $selecteds = 'selected';
                                                                                }
                                                                                echo "<option $selecteds value='$y'>$y</option>";
                                                                                
                                                                            }
                                                                            ?>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="mb-3">
                                                            <div class="col-sm-12">
                                                                <label for="txt_number_3" class="col-form-label">จำนวนเงินงวดนี้ : </label>
                                                                <input type="text" class="form-control" name="txt_number_3" id="txt_number_3" placeholder="0.00" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-center">
                                                            <img src="<?php echo $server['st_website_address']; ?>assete/images/banner/banner_full.png" width="250">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="notify_loan_payment" class="btn btn-blue">แจ้งชำระเงินกู้ยืม</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="table-responsive-lg mb-2">
                                        <table class="table bg-light m-0">
                                            <caption class="pb-0">
                                                <div class="d-flex justify-content-between">
                                                    <div>เร็คคอร์ดทั้งหมด <?php echo number_format($count_data) ?> เร็คคอร์ด</div>
                                                    <div>ข้อมูล ณ วันที่ <?php echo datetime(); ?></div>
                                                </div>
                                            </caption>
                                            <thead class="">
                                                <tr class="background-blue text-nowrap">
                                                    <th class="text-center">ลำดับที่</th>
                                                    <th class="text-center">รายการ</th>
                                                    <th class="text-center">วันที่ต้องชำระ</th>
                                                    <th class="text-center">จำนวนเงินที่ชำระ</th>
                                                    <th class="text-center">จำนวนดอกเบี้ย</th>
                                                    <th class="text-center">จำนวนงวดละ</th>
                                                    <th class="text-center">สถานะ</th>
                                                    <th class="text-center">หลักฐานการโอนเงิน</th>
                                                </tr>
                                            </thead>
                                            <tbody><?php while ($row = mysqli_fetch_assoc($result_data_con_q)) { ?>

                                                <tr valign="middle" class="text-nowrap">
                                                    <td class="text-center"><?php echo number_format($order++) ?></td>
                                                    <td>
                                                        <?php 
                                                        $t1 = $row['rp_list_name'];
                                                        if (empty($t1)) {
                                                            echo "แจ้งโอนเงินกู้ยืมให้ลูกหนี้ จำนวน ฿".number_format($row['rp_loan_amount'],2)." บาท"; 
                                                        } else {
                                                            echo $t1;
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                        $t2 = $row['rp_list_date'];
                                                        $ta = $row['rp_time_add'];
                                                        if (empty($t2)) {
                                                            echo $ta; 
                                                        } else {
                                                            echo $t2;
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><div class="text-right"><?php echo number_format($row['rp_number_1'],2); ?></div></td>
                                                    <td>
                                                        <?php $status = $row['rp_status']; if ($status == "pending") { ?>

                                                            <?php $cash_img = $row['rp_cash_img']; if (empty($cash_img)) { ?>
                                                                
                                                                <?php if ($_SESSION['member_level'] == "creditor") { ?>

                                                                    <?php if ($row['rp_number_2'] <= 0) { ?>
                                                                        <div class="text-right">
                                                                            <a data-bs-toggle="modal" data-bs-target="#interest<?php echo $row['rp_url']; ?>" class="btn btn-outline-success btn-sm"><i class="fas fa-plus-circle"></i> <?php $mtt = $row['rp_number_3'] * $result_report_3['mb_interest']/100; echo number_format($mtt,2); ?></a>
                                                                        </div>
                                                                    <?php } else { ?>
                                                                        <div class="text-right"><?php echo number_format($row['rp_number_2'],2); ?></div>
                                                                    <?php } ?>

                                                                <?php } else if ($_SESSION['member_level'] == "debtor") { ?>
                                                                    <div class="text-right"><?php echo number_format($row['rp_number_2'],2); ?></div>
                                                                <?php } ?>

                                                            <?php } else { ?>
                                                                <div class="text-right"><?php echo number_format($row['rp_number_2'],2); ?></div>
                                                            <?php } ?>

                                                        <?php } else if ($status == "pending_loan") { ?>

                                                            <?php if ($_SESSION['member_level'] == "creditor") { ?>
                                                                <div class="text-right"><?php echo number_format(0,2); ?></div>
                                                            <?php } else if ($_SESSION['member_level'] == "debtor") { ?>
                                                                <div class="text-right"><?php echo number_format(0,2); ?></div>
                                                            <?php } ?>

                                                        <?php } else if ($status == "active_loan") { ?>
                                                            <div class="text-right"><?php echo number_format(0,2); ?></div>
                                                        <?php } else { ?>
                                                            <div class="text-right"><?php echo number_format($row['rp_number_2'],2); ?></div>
                                                        <?php } ?>
                                                    </td>
                                                    <td><div class="text-right"><?php echo number_format($row['rp_number_3'],2); ?></div></td>
                                                    <td class="text-center">
                                                        <?php $status = $row['rp_status']; if ($status == "pending") { ?>

                                                            <?php if ($_SESSION['member_level'] == "creditor") { ?>

                                                                <?php $cash_img = $row['rp_cash_img']; if (empty($cash_img)) { ?>
                                                                <div class="d-grid">
                                                                    <a class="btn btn-sm btn-warning">รอลูกหนี้ชำระเงินกู้ยืม</a>
                                                                </div>    
                                                                <?php } else { ?>
                                                                <div class="d-grid">
                                                                    <a data-bs-toggle="modal" data-bs-target="#approve<?php echo $row['rp_url']; ?>" class="btn btn-sm btn-danger">ตรวจสอบและอนุมัติเงินที่ชำระ</a>
                                                                </div>
                                                                <?php } ?>
                                                            
                                                            <?php } else if ($_SESSION['member_level'] == "debtor") { ?>
                                                                
                                                                <?php $cash_img = $row['rp_cash_img']; if (empty($cash_img)) { ?>
                                                                <div class="d-grid">
                                                                    <a data-bs-toggle="modal" data-bs-target="#payment<?php echo $row['rp_url']; ?>" class="btn btn-sm btn-danger">ชำระเงินกู้ยืม</a>
                                                                </div>
                                                                <?php } else { ?>
                                                                <div class="d-grid">
                                                                    <a class="btn btn-sm btn-warning">รอเจ้าหนี้ตรวจสอบและอนุมัติ</a>
                                                                </div>
                                                                <?php } ?>

                                                            <?php } ?>

                                                        <?php } else if ($status == "pending_loan") { ?>

                                                            <?php if ($_SESSION['member_level'] == "creditor") { ?>

                                                                <div class="d-grid">
                                                                    <a data-bs-toggle="modal" data-bs-target="#confirm_loan<?php echo $row['rp_url']; ?>" class="btn btn-sm btn-success">ทำรายการโอนเงินให้ลูกหนี้</a>
                                                                </div>
                                                            
                                                            <?php } else if ($_SESSION['member_level'] == "debtor") { ?>
                                                                
                                                                <div class="d-grid">
                                                                    <a class="btn btn-sm btn-warning">รอเจ้าหนี้อนุมัติและโอนเงิน</a>
                                                                </div>

                                                            <?php } ?>

                                                        <?php } else if ($status == "active_loan") { ?>
                                                            <div class="d-grid">
                                                                <a class="btn btn-sm btn-success">โอนเงินให้ลูกหนี้สำเร็จ</a>
                                                            </div>
                                                        <?php } else { ?>
                                                            <div class="d-grid">
                                                                <a class="btn btn-sm btn-success">ตรวจสอบและอนุมัติเรียบร้อย</a>
                                                            </div>
                                                        <?php } ?>
                                                        
                                                    </td>
                                                    <td class="text-center">
                                                        <?php $cash_img = $row['rp_cash_img']; if (empty($cash_img)) { ?>
                                                            <div class="d-grid">
                                                                <button class="btn btn-sm btn-primary" disabled>ดูหลักฐานการโอนเงิน</button>
                                                            </div>
                                                        <?php } else { ?>
                                                            <div class="d-grid">
                                                                <a data-bs-toggle="modal" data-bs-target="#payment_slip<?php echo $row['rp_url']; ?>" class="btn btn-sm btn-primary">ดูหลักฐานการโอนเงิน</a>
                                                            </div>
                                                        <?php } ?>
                                                    </td>
                                                </tr>    

                                            <?php } ?>

                                            </tbody>
                                            <tfoot class="">
                                                <tr class="background-blue text-nowrap">
                                                    <th class="text-center">ลำดับที่</th>
                                                    <th class="text-center">รายการ</th>
                                                    <th class="text-center">วันที่ต้องชำระ</th>
                                                    <th class="text-center">จำนวนเงินที่ชำระ</th>
                                                    <th class="text-center">จำนวนดอกเบี้ย</th>
                                                    <th class="text-center">จำนวนงวดละ</th>
                                                    <th class="text-center">สถานะ</th>
                                                    <th class="text-center">หลักฐานการโอนเงิน</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <?php while ($row = mysqli_fetch_assoc($result_data_con_q_modal)) { ?>
                                    <form action="" method="post">
                                        <input type="hidden" name="rp_url" value="<?php echo $row['rp_url']; ?>">
                                        <div class="modal fade" id="approve<?php echo $row['rp_url']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="approve<?php echo $row['rp_url']; ?>Label" style="color: #4772f4;">อนุมัติยอดเงินที่ได้ชำระ</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <p class="text-center">
                                                                    คุณ<?php echo $result_report['mb_firstname']; ?> <?php echo $result_report['mb_lastname']; ?> [ลูกหนี้] ได้ทำการโอนเงินคืน จำนวน <?php echo number_format($row['rp_number_1'],2); ?> บาท ให้กับคุณ<?php echo $acount['mb_firstname']; ?> <?php echo $acount['mb_lastname']; ?> [เจ้าหนี้] กดปุ่มด้านล่างนี้เพื่อทำการอนุมัติยอดเงินที่ได้ชำระ
                                                                </p>
                                                                <div class="d-flex justify-content-center">
                                                                    <img src="<?php echo $server['st_website_address']; ?>assete/images/banner/banner_full.png" width="250">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="approve" class="btn btn-blue"><i class="fas fa-save"></i> อนุมัติเงินที่ชำระ</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <form action="" method="post">
                                        <input type="hidden" name="rp_url" value="<?php echo $row['rp_url']; ?>">
                                        <input type="hidden" name="rp_number_2" value="<?php $n3 = $row['rp_number_3']; $interest = $n3 * $result_report_3['mb_interest']/100; echo number_format($interest,2); ?>">
                                        <div class="modal fade" id="interest<?php echo $row['rp_url']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="interest<?php echo $row['rp_url']; ?>Label" style="color: #4772f4;">คิดดอกเบี้ย</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <p class="text-center">
                                                                    คิดดอกเบี่ย จำนวน <?php $n3 = $row['rp_number_3']; $interest = $n3 * $result_report_3['mb_interest']/100; echo number_format($interest,2); ?> บาท เนื่องจากเลยระยะเวลาชำระเงินกู้ยืมที่กำหนดไว้ กดปุ่มด้านล่างนี้เพื่อทำการคิดดอกเบี้ยเพิ่ม
                                                                </p>
                                                                <div class="d-flex justify-content-center">
                                                                    <img src="<?php echo $server['st_website_address']; ?>assete/images/banner/banner_full.png" width="250">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="btn_interest" class="btn btn-blue"><i class="fas fa-save"></i> คิดดอกเบี่ย</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="rp_url" value="<?php echo $row['rp_url']; ?>">
                                        <div class="modal fade" id="confirm_loan<?php echo $row['rp_url']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirm_loan<?php echo $row['rp_url']; ?>Label" style="color: #4772f4;">ฟอร์มโอนเงินให้บัญชีลูกหนี้</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="mb-3 text-center">
                                                                    <img src="<?php echo $server['st_website_address']; ?>assete/images/bank_img/<?php echo $acount_bank['bk_img']; ?> " width="25%" title="บัญชีธนาคารของคุณ" alt="บัญชีธนาคารของคุณ">
                                                                    <img src="<?php echo $server['st_website_address']; ?>assete/images/bank_img/<?php echo $result_report['bk_img']; ?> " width="25%" title="บัญชีธนาคารของลูกหนี้" alt="บัญชีธนาคารของลูกหนี้">
                                                                    <br><br>
                                                                    <p>
                                                                        <?php echo $acount['mb_firstname']; ?> <?php echo $acount['mb_lastname']; ?> [เจ้าหนี้ - <?php echo $acount['bk_code']; ?>]<br><i class="fas fa-arrow-down"></i><br><?php echo $result_report['mb_firstname']; ?> <?php echo $result_report['mb_lastname']; ?> [ลูกหนี้ - <?php echo $result_report['bk_code']; ?>]
                                                                    </p>
                                                                </div>
                                                                <hr>
                                                                <div class="mb-3">
                                                                    <label class="col-form-label">เลขบัญชีธนาคารลูกหนี้ : </label>
                                                                    <input type="text" class="form-control" value="<?php echo $result_report['mb_account_number']; ?>" disabled>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="col-form-label">ชื่อบัญชีธนาคารลูกหนี้ : </label>
                                                                    <input type="text" class="form-control" value="<?php echo $result_report['mb_firstname']; ?> <?php echo $result_report['mb_lastname']; ?>" disabled>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="col-form-label">ชื่อธนาคารลูกหนี้ : </label>
                                                                    <input type="text" class="form-control" value="<?php echo $result_report['bk_name']; ?>" disabled>
                                                                </div>
                                                                <hr>
                                                                <div class="mb-3">
                                                                    <label for="cash_img" class="col-form-label">แนบสลิปโอนเงิน : </label>
                                                                    <input type="file" class="form-control" name="cash_img" id="cash_img" accept=".jpeg,.jpg,.png">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="cash_out" class="col-form-label">จำนวนเงินกู้ยืม : </label>
                                                                    <input type="text" class="form-control" name="cash_out" id="cash_out" value="<?php echo number_format($row['rp_loan_amount'],2); ?>" disabled>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="datetime" class="col-form-label">วัน/เดือน/ปี เวลาโอน (ตัวอย่าง 09 กันยายน 2565) : </label>
                                                                    <input type="text" class="form-control" name="datetime" id="datetime" placeholder="Date Time" value="<?php echo datetime(); ?>" autocomplete="off">
                                                                </div>
                                                                <div class="d-flex justify-content-center">
                                                                    <img src="<?php echo $server['st_website_address']; ?>assete/images/banner/banner_full.png" width="250">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="btn_confirm_loan" class="btn btn-blue"><i class="fas fa-save"></i> บันทึกรายการ</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="modal fade" id="payment_slip<?php echo $row['rp_url']; ?>" tabindex="-1" aria-labelledby="payment_slip<?php echo $row['rp_url']; ?>Label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="payment_slip<?php echo $row['rp_url']; ?>Label" style="color: #4772f4;">หลักฐานการโอนเงิน</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="<?php echo $server['st_website_address']; ?>assete/images/payment_slip/<?php echo $row['rp_cash_img']; ?>" width="100%">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="rp_url" value="<?php echo $row['rp_url']; ?>">
                                        <input type="hidden" name="rp_number_1" value="<?php $n3 = $row['rp_number_3']; $n2 = $row['rp_number_2']; $pay = $n3 + $n2; echo $pay; ?>">
                                        <div class="modal fade" id="payment<?php echo $row['rp_url']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="payment<?php echo $row['rp_url']; ?>Label" style="color: #4772f4;">ฟอร์มแจ้งชำระเงินกู้ยืม</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="mb-3 text-center">
                                                                    <img src="<?php echo $server['st_website_address']; ?>assete/images/bank_img/<?php echo $acount_bank['bk_img']; ?> " width="25%" title="บัญชีธนาคารของคุณ" alt="บัญชีธนาคารของคุณ">
                                                                    <img src="<?php echo $server['st_website_address']; ?>assete/images/bank_img/<?php echo $result_report_2['bk_img']; ?> " width="25%" title="บัญชีธนาคารของเจ้าหนี้" alt="บัญชีธนาคารของเจ้าหนี้">
                                                                    <br><br>
                                                                    <p>
                                                                    <?php echo $acount['mb_firstname']; ?> <?php echo $acount['mb_lastname']; ?> [ลูกหนี้ - <?php echo $acount['bk_code']; ?>]<br><i class="fas fa-arrow-down"></i><br><?php echo $result_report_2['mb_firstname']; ?> <?php echo $result_report_2['mb_lastname']; ?> [เจ้าหนี้ - <?php echo $result_report_2['bk_code']; ?>]
                                                                    </p>
                                                                </div>
                                                                <hr>
                                                                <div class="mb-3">
                                                                    <label class="col-form-label">เลขบัญชีธนาคารเจ้าหนี้ : </label>
                                                                    <input type="text" class="form-control" value="<?php echo $result_report_2['mb_account_number']; ?>" disabled>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="col-form-label">ชื่อบัญชีธนาคารเจ้าหนี้ : </label>
                                                                    <input type="text" class="form-control" value="<?php echo $result_report_2['mb_firstname']; ?> <?php echo $result_report_2['mb_lastname']; ?>" disabled>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="col-form-label">ชื่อธนาคารเจ้าหนี้ : </label>
                                                                    <input type="text" class="form-control" value="<?php echo $result_report_2['bk_name']; ?>" disabled>
                                                                </div>
                                                                <hr>
                                                                <div class="mb-3">
                                                                    <label for="cash_img" class="col-form-label">แนบสลิปโอนเงิน : </label>
                                                                    <input type="file" class="form-control" name="cash_img" id="cash_img" accept=".jpeg,.jpg,.png">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="cash_in" class="col-form-label">จำนวนเงินที่คืน : </label>
                                                                    <input type="text" class="form-control" name="cash_in" id="cash_in" value="<?php $n3 = $row['rp_number_3']; $n2 = $row['rp_number_2']; $pay = $n3 + $n2; echo number_format($pay,2); ?>" disabled>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="datetime" class="col-form-label">วัน/เดือน/ปี เวลาโอน (ตัวอย่าง 09 กันยายน 2565) : </label>
                                                                    <input type="text" class="form-control" name="datetime" id="datetime" placeholder="Date Time" value="<?php echo datetime(); ?>" autocomplete="off">
                                                                </div>
                                                                <div class="d-flex justify-content-center">
                                                                    <img src="<?php echo $server['st_website_address']; ?>assete/images/banner/banner_full.png" width="250">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="btn_payment" class="btn btn-blue"><i class="fas fa-save"></i> บันทึกรายการ</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form><?php } ?>


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

            <?php if ($_SESSION['member_level'] == "debtor") { ?>
                <form action="" method="post" enctype="multipart/form-data">
                <div class="modal fade" id="add_insert_1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addListModalLabel" style="color: #4772f4;">ฟอร์มขอกู้ยืมเงินเพิ่ม</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <div class="col-sm-12">
                                        <label class="col-form-label">ชื่อจริง นามสกุล (เจ้าหนี้) : </label>
                                        <input type="text" class="form-control" value="<?php echo $result_report_2['mb_firstname']; ?> <?php echo $result_report_2['mb_lastname']; ?>" disabled>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <div class="col-sm-12">
                                        <label class="col-form-label">ชื่อจริง นามสกุล (ลูกหนี้) : </label>
                                        <input type="text" class="form-control" value="<?php echo $acount['mb_firstname']; ?> <?php echo $acount['mb_lastname']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="rp_cash_out" class="col-form-label">จำนวนเงินที่จะขอกู้ยืมเงิน : *</label>
                                    <input type="text" id="rp_cash_out" class="form-control" name="rp_cash_out" placeholder="0.00" autocomplete="off" autofocus>
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
                                <button type="submit" name="btn_insert_3" class="btn btn-blue">ขอกู้ยืมเงินเพิ่ม</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <?php } ?>
            
            <!-- Content -->

        </div>
        <!-- End Wrapper -->

    </div>
    <!-- End Box -->

    <!-- Footer -->
    <?php include('../../../include/footer.php'); ?>
    <!-- End Footer -->
</body>

</html>
<?php } ?>