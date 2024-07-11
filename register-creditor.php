<?php
require_once('connect/server.php');
session_start();

// เพิ่มข้อมูล
if (isset($_REQUEST['btn_insert'])) {

    // รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร
    $mb_url = getName($n);
    $mb_id_card_number = $_POST["idCardNumber"];
    $mb_phone = $_POST["phone"];
    $mb_firstname = $_POST["firstName"];
    $mb_lastname = $_POST["lastName"];
    $mb_level = "creditor";
    $mb_account_number = $_POST["account_number"];
    $bk_code = $_POST["bank_code"];
    $mb_timeinsert = datetime();

    $mb_interest_1 = $_POST["mb_interest_1"];
    $mb_interest_2 = $_POST["mb_interest_2"];

    if (empty($mb_interest_1)) {
        $mb_interest = $mb_interest_2;
    } else {
        $mb_interest = $mb_interest_1;
    }

    $ymd = date('Ymd-His');

    $mb_citizen_id_file_enc = strrchr($_FILES['citizen_id_file']['name'], ".");
    $newname1 = $numrand . $date1 . "-" . $ymd . $mb_citizen_id_file_enc;
    $type1 = $_FILES['citizen_id_file']['type'];
    $size1 = $_FILES['citizen_id_file']['size'];
    $temp1 = $_FILES['citizen_id_file']['tmp_name'];
    $path1 = "assete/citizen_file/". $newname1;

    $mb_book_bank_file_enc = strrchr($_FILES['book_bank_file']['name'], ".");
    $newname2 = $numrand . $date1 . "-" . $ymd . $mb_book_bank_file_enc;
    $type2 = $_FILES['book_bank_file']['type'];
    $size2 = $_FILES['book_bank_file']['size'];
    $temp2 = $_FILES['book_bank_file']['tmp_name'];
    $path2 = "assete/bookbank_file/". $newname2;

    // เช็คที่อยู่อีเมลซ้ำ
    $check_id_card_number = "SELECT * FROM tbl_member_db WHERE mb_id_card_number ='$mb_id_card_number'";
    $result_c = mysqli_query($conn, $check_id_card_number);

    if (mysqli_num_rows($result_c) == 1) {
        $row = mysqli_fetch_array($result_c);

        $_SESSION['userid'] = $row['mb_id'];
        $_SESSION['id_card'] = $row['mb_id_card_number'];

        if ($id_card_number_enc = md5($mb_id_card_number) == $_SESSION['id_card']) {
            $errorMsg = "เลขบัตรประจำตัวประชาชนมีอยู่แล้ว ไม่สามารถสมัครใหม่ได้";
        }
    }

    // เช็คการป้อนข้อมูล
    if (empty($mb_id_card_number) || empty($mb_phone) || empty($mb_firstname) || empty($mb_lastname) || empty($mb_account_number) || empty($bk_code) || empty($mb_citizen_id_file_enc) || empty($mb_book_bank_file_enc)) {
        $errorMsg = "กรุณากรอกข้อมูล ที่มีเครื่องหมาย (*) ให้ครบทุกช่อง";
    }
    
    if (!file_exists($path1)) {
        if ($size1 < 5000000) {
            move_uploaded_file($temp1, 'assete/citizen_file/' . $newname1);
        } else {
            $errorMsg = "ไฟล์ของคุณใหญ่เกินไป โปรดอัปโหลดขนาด 5MB";
        }
    } else {
        $errorMsg = "ไฟล์มีอยู่แล้ว... ตรวจสอบโฟลเดอร์อัพโหลด";
    }
    
    if (!file_exists($path2)) {
        if ($size2 < 5000000) {
            move_uploaded_file($temp2, 'assete/bookbank_file/' . $newname2);
        } else {
            $errorMsg = "ไฟล์ของคุณใหญ่เกินไป โปรดอัปโหลดขนาด 5MB";
        }
    } else {
        $errorMsg = "ไฟล์มีอยู่แล้ว... ตรวจสอบโฟลเดอร์อัพโหลด";
    }

    // เข้ารหัสพาสเวิร์ด
    $id_card_number_enc = md5($mb_id_card_number);
    $mb_phone_enc = md5($mb_phone);

    // บันทึกข้อมูล
    if (!isset($errorMsg)) {
        $sql = "INSERT INTO tbl_member_db(mb_url, mb_id_card_number, mb_phone, mb_firstname, mb_lastname, mb_level, mb_account_number, mb_interest, bk_code, mb_citizen_id_file, mb_book_bank_file, mb_timeinsert)
                VALUE('$mb_url', '$id_card_number_enc', '$mb_phone_enc', '$mb_firstname', '$mb_lastname', '$mb_level', '$mb_account_number', '$mb_interest', '$bk_code', '$newname1', '$newname2', '$mb_timeinsert')";

        // สั่งรันคำสั่ง sql
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $successMsg = "บันทึกข้อมูลสำเร็จ โปรดรอระบบบันทึกข้อมูล 3 วินาที";
            $redirect = $server['st_website_address'];
            header("refresh:3;$redirect");
        } else {
            echo mysqli_error($conn);
        }
    }
}

// ดึงข้อมูลจากฐานข้อมูลหมวดหมู่มาแสดง
$query_data_bank = "SELECT * FROM tbl_bank_db ORDER BY bk_id ASC";
$result_data_bank = mysqli_query($conn, $query_data_bank);

if ($server['st_btn_level_1'] != "1") {
    $redirect = $server['st_website_address'];
    header("location:$redirect");
}

// เช็กสิทธิ์ผู้ใช้งาน
if (isset($_SESSION['member_id'])) {

    if ($_SESSION['member_level'] == "admin") {
        $successMsg = "เข้าสู่ระบบสำเร็จ [แอดมิน] โปรดรอระบบเปลี่ยนเส้นทาง 3 วินาที";
        $redirect = $server['st_website_address'] . "page/admin/dashboard";
        header("refresh:3;$redirect");
    }
    if ($_SESSION['member_level'] == "creditor") {
        $successMsg = "เข้าสู่ระบบสำเร็จ [เจ้าหนี้] โปรดรอระบบเปลี่ยนเส้นทาง 3 วินาที";
        $redirect = $server['st_website_address'] . "page/creditor/dashboard";
        header("refresh:3;$redirect");
    }
    if ($_SESSION['member_level'] == "debtor") {
        $successMsg = "เข้าสู่ระบบสำเร็จ [ลูกหนี้] โปรดรอระบบเปลี่ยนเส้นทาง 3 วินาที";
        $rpl = $_SESSION['member_id'];
        $redirect = $server['st_website_address'] . "page/debtor/report/" . $rpl;
        header("refresh:3;$redirect");
    }

}
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <?php include('include/head.php'); ?>
</head>

<body class="bg-light">

    <!-- Box -->
    <div class="background-img">

        <!-- Wrapper -->
        <div class="wrapper">

            <!-- Navbar -->
            <?php include('include/navbar.php'); ?>
            <!-- End Navbar -->

            <!-- Content -->
            <?php include('include/register-creditor.php');?>
            <!-- Content -->

        </div>
        <!-- End Wrapper -->

    </div>
    <!-- End Box -->

    <!-- Footer -->
    <?php include('include/footer.php');?>
    <!-- End Footer -->
</body>

</html>