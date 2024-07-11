<?php
require_once('connect/server.php');
session_start();

// เช็คเซสชั่น
if (isset($_SESSION['member_id'])) {
    // รับค่ามาจากเซสชั่น
    $member_id = $_SESSION['member_id'];

    // เช็คค่าที่ส่งมาจากเซสชั่น
    $query = "SELECT * FROM tbl_member_db WHERE mb_url ='$member_id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $acount = mysqli_fetch_array($result);
    }
}

// ล็อกอินเข้าสู่ระบบ[แอดมิน]
if (isset($_REQUEST['btn_login_admin'])) {

    // รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร
    $login_id_card_number = mysqli_real_escape_string($conn, $_POST['id_card_number']);
    $login_phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $id_card_number_enc = md5($login_id_card_number);
    $phone_enc = md5($login_phone);

    $query = "SELECT * FROM tbl_member_db WHERE mb_id_card_number ='$id_card_number_enc' AND mb_phone ='$phone_enc'";
    $result = mysqli_query($conn, $query);

    // เช็คการป้อนข้อมูล
    if (empty($login_id_card_number) || empty($login_phone)) {
        $errorMsg = "กรุณากรอกข้อมูล ที่มีเครื่องหมาย (*) ให้ครบทุกช่อง";
    }

    // เช็คล็อคอิน
    if (!isset($errorMsg)) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);

            $_SESSION['member_id'] = $row['mb_url'];
            $_SESSION['member_level'] = $row['mb_level'];

            if ($_SESSION['member_level'] != "admin") {
                $errorMsg = "ขออภัย [แอดมิน] คุณไม่มีสิทธิ์เข้าถึงระบบนี้";
            } else {
                $successMsg = "เข้าสู่ระบบสำเร็จ [แอดมิน] โปรดรอระบบเปลี่ยนเส้นทาง 3 วินาที";
                $redirect = $server['st_website_address'] . "page/admin/dashboard";
                header("refresh:3;$redirect");
            }
        } else {
            $errorMsg = "เลขบัตรประจำตัวประชาชนหรือเบอร์โทรศัพท์ไม่ถูกต้อง";
        }
    }
}

// ล็อกอินเข้าสู่ระบบ[เจ้าหนี้]
if (isset($_REQUEST['btn_login_creditor'])) {

    // รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร
    $login_id_card_number = mysqli_real_escape_string($conn, $_POST['id_card_number']);
    $login_phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $id_card_number_enc = md5($login_id_card_number);
    $phone_enc = md5($login_phone);

    $query = "SELECT * FROM tbl_member_db WHERE mb_id_card_number ='$id_card_number_enc' AND mb_phone ='$phone_enc'";
    $result = mysqli_query($conn, $query);

    // เช็คการป้อนข้อมูล
    if (empty($login_id_card_number) || empty($login_phone)) {
        $errorMsg = "กรุณากรอกข้อมูล ที่มีเครื่องหมาย (*) ให้ครบทุกช่อง";
    }

    // เช็คล็อคอิน
    if (!isset($errorMsg)) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);

            $_SESSION['member_id'] = $row['mb_url'];
            $_SESSION['member_level'] = $row['mb_level'];

            if ($_SESSION['member_level'] != "creditor") {
                $errorMsg = "ขออภัย [เจ้าหนี้] คุณไม่มีสิทธิ์เข้าถึงระบบนี้";
            } else {
                $successMsg = "เข้าสู่ระบบสำเร็จ [เจ้าหนี้] โปรดรอระบบเปลี่ยนเส้นทาง 3 วินาที";
                $redirect = $server['st_website_address'] . "page/creditor/dashboard";
                header("refresh:3;$redirect");
            }
        } else {
            $errorMsg = "เลขบัตรประจำตัวประชาชนหรือเบอร์โทรศัพท์ไม่ถูกต้อง";
        }
    }
}

// ล็อกอินเข้าสู่ระบบ[ลูกหนี้]
if (isset($_REQUEST['btn_login_debtor'])) {

    // รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร
    $login_id_card_number = mysqli_real_escape_string($conn, $_POST['id_card_number']);
    $login_phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $id_card_number_enc = md5($login_id_card_number);
    $phone_enc = md5($login_phone);

    $query = "SELECT * FROM tbl_member_db WHERE mb_id_card_number ='$id_card_number_enc' AND mb_phone ='$phone_enc'";
    $result = mysqli_query($conn, $query);

    // เช็คการป้อนข้อมูล
    if (empty($login_id_card_number) || empty($login_phone)) {
        $errorMsg = "กรุณากรอกข้อมูล ที่มีเครื่องหมาย (*) ให้ครบทุกช่อง";
    }

    // เช็คล็อคอิน
    if (!isset($errorMsg)) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);

            $_SESSION['member_id'] = $row['mb_url'];
            $_SESSION['member_level'] = $row['mb_level'];

            if ($_SESSION['member_level'] != "debtor") {
                $errorMsg = "ขออภัย [ลูกหนี้] คุณไม่มีสิทธิ์เข้าถึงระบบนี้";
            } else {
                $successMsg = "เข้าสู่ระบบสำเร็จ [ลูกหนี้] โปรดรอระบบเปลี่ยนเส้นทาง 3 วินาที";
                $rpl = $_SESSION['member_id'];
                $redirect = $server['st_website_address'] . "page/debtor/report/" . $rpl;
                header("refresh:3;$redirect");
            }
        } else {
            $errorMsg = "เลขบัตรประจำตัวประชาชนหรือเบอร์โทรศัพท์ไม่ถูกต้อง";
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

// ออกจากระบบ
if (isset($_REQUEST['logout'])) {
    session_destroy();
    unset($_SESSION['member_id']);
    $redirect = $server['st_website_address'];
    header("location:$redirect");
}
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <?php include('include/head.php'); ?>
</head>

<body class="bg-light">
    <?php 
    if ($server['st_btn_level_1'] != "1" || $server['st_btn_level_2'] != "1") {
        echo "<div class='text-center m-2' style='font-size: 14px;'><i class='fas fa-exclamation-triangle me-1'></i>ปิดระบบชั่วคราว เพื่อพัฒนาระบบ ขออภัยในความไม่สะดวก</div>";
    }
    ?>
    <!-- Box -->
    <div class="background-img">

        <!-- Wrapper -->
        <div class="wrapper">

            <!-- Navbar -->
            <?php include('include/navbar.php'); ?>
            <!-- End Navbar -->

            <!-- Content -->
            <?php include('include/login.php');?>
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