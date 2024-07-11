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
    $mb_level = "admin";
    $mb_timeinsert = datetime();

    // เช็คที่อยู่อีเมลซ้ำ
    $check_id_card_number = "SELECT * FROM tbl_member_db WHERE mb_id_card_number ='$mb_id_card_number'";
    $result_c = mysqli_query($conn, $check_id_card_number);

    if (mysqli_num_rows($result_c) == 1) {
        $row = mysqli_fetch_array($result_c);

        $_SESSION['userid'] = $row['mb_id'];
        $_SESSION['id_card'] = $row['mb_id_card_number'];

        if ($mb_id_card_number == $_SESSION['id_card']) {
            $errorMsg = "เลขบัตรประจำตัวประชาชนมีอยู่แล้ว ไม่สามารถสมัครใหม่ได้";
        }
    }

    // เช็คการป้อนข้อมูล
    if (empty($mb_id_card_number) || empty($mb_phone) || empty($mb_firstname) || empty($mb_lastname)) {
        $errorMsg = "กรุณากรอกข้อมูล ที่มีเครื่องหมาย (*) ให้ครบทุกช่อง";
    }

    // เข้ารหัสพาสเวิร์ด
    $id_card_number_enc = md5($mb_id_card_number);
    $mb_phone_enc = md5($mb_phone);

    // บันทึกข้อมูล
    if (!isset($errorMsg)) {
        $sql = "INSERT INTO tbl_member_db(mb_url, mb_id_card_number, mb_phone, mb_firstname, mb_lastname, mb_level, mb_timeinsert)
                VALUE('$mb_url', '$id_card_number_enc', '$mb_phone_enc', '$mb_firstname', '$mb_lastname', '$mb_level', '$mb_timeinsert')";

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
            <?php include('include/register-admin.php');?>
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