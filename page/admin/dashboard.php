<?php
require_once('../../connect/server.php');
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

// ดึงข้อมูลจากฐานข้อมูลหมวดหมู่มาแสดง
$query_data = "SELECT * FROM tbl_setting_db";
$result_data = mysqli_query($conn, $query_data);
$data = mysqli_fetch_assoc($result_data);

// แก้ไขข้อมูล
if (isset($_REQUEST['btn_save'])) {

    // รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร
    $st_website_address = $_POST["website_address"];
    $st_website_title = $_POST["website_title"];
    $st_btn_level_1 = $_POST["btn_level_1"];
    $st_btn_level_2 = $_POST["btn_level_2"];
    $st_website_description = $_POST["website_description"];
    $st_version = $_POST["version"];
    $st_description_version = $_POST["description_version"];
    $st_terms_of_service = $_POST["terms_of_service"];
    $st_privacy_policy = $_POST["privacy_policy"];

    // เช็คการป้อนข้อมูล
    if (empty($st_website_address) || empty($st_website_title) || empty($st_website_description) || empty($st_version) || empty($st_description_version) || empty($st_terms_of_service) || empty($st_privacy_policy)) {
        $errorMsg = "กรุณากรอกข้อมูล ที่มีเครื่องหมาย (*) ให้ครบทุกช่อง";
    }

    // บันทึกข้อมูล
    if (!isset($errorMsg)) {
        $sql = "UPDATE tbl_setting_db SET 
        st_website_address = '$st_website_address',
        st_website_title = '$st_website_title',
        st_btn_level_1 = '$st_btn_level_1',
        st_btn_level_2 = '$st_btn_level_2',
        st_website_description = '$st_website_description',
        st_version = '$st_version',
        st_description_version = '$st_description_version',
        st_terms_of_service = '$st_terms_of_service',
        st_privacy_policy = '$st_privacy_policy'";

        // สั่งรันคำสั่ง sql
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $successMsg = "บันทึกข้อมูลสำเร็จ โปรดรอระบบบันทึกข้อมูล 3 วินาที";
            $redirect = $server['st_website_address'] . "/page/admin/dashboard";
            header("refresh:3;$redirect");
        } else {
            echo mysqli_error($conn);
        }
    }
}

// นับจำนวนผู้ใช้งาน
$query_count_admin = "SELECT * FROM tbl_member_db WHERE mb_level LIKE '%admin%'";
$result_count_admin = mysqli_query($conn, $query_count_admin);
$count_data_admin = mysqli_num_rows($result_count_admin);
$order = 1;

$query_count_creditor = "SELECT * FROM tbl_member_db WHERE mb_level LIKE '%creditor%'";
$result_count_creditor = mysqli_query($conn, $query_count_creditor);
$count_data_creditor = mysqli_num_rows($result_count_creditor);
$order = 1;

$query_count_debtor = "SELECT * FROM tbl_member_db WHERE mb_level LIKE '%debtor%'";
$result_count_debtor = mysqli_query($conn, $query_count_debtor);
$count_data_debtor = mysqli_num_rows($result_count_debtor);
$order = 1;

// ออกจากระบบ
if (isset($_REQUEST['logout'])) {
    session_destroy();
    unset($_SESSION['member_id']);
    $redirect = $server['st_website_address'];
    header("location:$redirect");
}

// เช็กล็อคอิน
if (!isset($_SESSION['member_id']) || $_SESSION['member_level'] != "admin") {
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
                                        <div class="d-flex justify-content-between">
                                            <div class="text-left">ชื่อจริง :</div>
                                            <div class="text-right text-muted"><?php echo $acount['mb_firstname']; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <div class="d-flex justify-content-between">
                                            <div class="text-left">นามสกุล :</div>
                                            <div class="text-right text-muted"><?php echo $acount['mb_lastname']; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <div class="d-flex justify-content-between">
                                            <div class="text-left">ระดับผู้ใช้งาน :</div>
                                            <div class="text-right text-muted">แอดมิน</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <div class="d-flex justify-content-between">
                                            <div class="text-left">สมัครสมาชิก :</div>
                                            <div class="text-right text-muted"><?php echo $acount['mb_timeinsert']; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="container">
                    <div class="row">
                        <section class="col-sm-12 col-md-12 col-lg-4 mb-3">
                            <div class="login-wrapper">
                                <div class="login-info">
                                    <div class="login-title">จำนวนแอดมิน</div>
                                    <div class="login-content">
                                        <div class="text-center">
                                            ทั้งหมด <span class="text-muted"><?php echo number_format($count_data_admin) ?></span> คน
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="col-sm-12 col-md-12 col-lg-4 mb-3">
                            <div class="login-wrapper">
                                <div class="login-info">
                                    <div class="login-title">จำนวนเจ้าหนี้</div>
                                    <div class="login-content">
                                        <div class="text-center">
                                            ทั้งหมด <span class="text-muted"><?php echo number_format($count_data_creditor) ?></span> คน
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="col-sm-12 col-md-12 col-lg-4 mb-3">
                            <div class="login-wrapper">
                                <div class="login-info">
                                    <div class="login-title">จำนวนเลูกหนี้</div>
                                    <div class="login-content">
                                        <div class="text-center">
                                            ทั้งหมด <span class="text-muted"><?php echo number_format($count_data_debtor) ?></span> คน
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>

            <form action="" method="post">
                <section class="login mb-3">
                    <div class="container">
                        <div class="login-wrapper">
                            <div class="login-info">
                                <div class="login-title">ยินดีต้อนรับ, คุณ<?php echo $acount['mb_firstname']; ?> <?php echo $acount['mb_lastname']; ?> เข้าสู่ระบบแอดมิน</div>
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
    
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="mb-3">
                                                <label for="website_address" class="form-label">ที่อยู่เว็บไซต์ : *</label>
                                                <input type="text" class="form-control" name="website_address" id="website_address" value="<?php echo $data['st_website_address']; ?>" placeholder="Website Address" autocomplete="off" autofocus>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="mb-3">
                                                <label for="website_title" class="form-label">ชื่อเว็บไซต์ : *</label>
                                                <input type="text" class="form-control" name="website_title" id="website_title" value="<?php echo $data['st_website_title']; ?>" placeholder="Website Title" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="mb-3">
                                                <label for="btn_level_1" class="form-label">เปิด/ปิด ปุ่มสมัครสมาชิกระบบเจ้าหนี้ : *</label>
                                                <select class="form-select" aria-label="Default select example" name="btn_level_1" id="btn_level_1">
                                                    <?php if ($server['st_btn_level_1'] == "1") { ?>
                                                        <option value="1" selected>เปิดปุ่ม</option>
                                                        <option value="2">ปิดปุ่ม</option>
                                                    <?php } else { ?>
                                                        <option value="1">เปิดปุ่ม</option>
                                                        <option value="2" selected>ปิดปุ่ม</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="mb-3">
                                                <label for="btn_level_2" class="form-label">เปิด/ปิด ปุ่มสมัครสมาชิกระบบลูกหนี้ : *</label>
                                                <select class="form-select" aria-label="Default select example" name="btn_level_2" id="btn_level_2">
                                                    <?php if ($server['st_btn_level_2'] == "1") { ?>
                                                        <option value="1" selected>เปิดปุ่ม</option>
                                                        <option value="2">ปิดปุ่ม</option>
                                                    <?php } else { ?>
                                                        <option value="1">เปิดปุ่ม</option>
                                                        <option value="2" selected>ปิดปุ่ม</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="mb-3">
                                                <label for="btn_level_2" class="form-label">เปิด/ปิด ปุ่มสมัครสมาชิกระบบลูกหนี้ : *</label>
                                                <select class="form-select" aria-label="Default select example" name="btn_level_2" id="btn_level_2">
                                                    <?php if ($server['st_btn_level_2'] == "1") { ?>
                                                        <option value="1" selected>เปิดปุ่ม</option>
                                                        <option value="2">ปิดปุ่ม</option>
                                                    <?php } else { ?>
                                                        <option value="1">เปิดปุ่ม</option>
                                                        <option value="2" selected>ปิดปุ่ม</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div> -->
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="mb-3">
                                                <label for="website_description" class="form-label">คำอธิบาย : *</label>
                                                <input type="text" class="form-control" name="website_description" id="website_description" value="<?php echo $data['st_website_description']; ?>" placeholder="Website Description" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="mb-3">
                                                <label for="version" class="form-label">เวอร์ชั่น : *</label>
                                                <input type="text" class="form-control" name="version" id="version" value="<?php echo $data['st_version']; ?>" placeholder="Version" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="mb-3">
                                                <label for="description_version" class="form-label">คำอธิบายเวอร์ชั่น : *</label>
                                                <textarea class="form-control" rows="5" name="description_version" id="description_version" placeholder="Description Version" autocomplete="off"><?php echo $data['st_description_version']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="mb-3">
                                                <label for="terms_of_service" class="form-label">เงื่อนไขการใช้บริการ : *</label>
                                                <textarea class="form-control" rows="5" name="terms_of_service" id="terms_of_service" placeholder="Terms of Service" autocomplete="off"><?php echo $data['st_terms_of_service']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="mb-3">
                                                <label for="privacy_policy" class="form-label">นโยบายคุ้มครองข้อมูลส่วนบุคคล : *</label>
                                                <textarea class="form-control" rows="5" name="privacy_policy" id="privacy_policy" placeholder="Privacy Policy" autocomplete="off"><?php echo $data['st_privacy_policy']; ?></textarea>
                                            </div>
                                        </div>
                                        <hr>
                                        <p class="text-center">เมื่อบันทึกข้อมูล จะถือว่าคุณยอมรับ "เงื่อนไขการใช้บริการ", "นโยบายความเป็นส่วนตัว", "นโยบายคุ้มครองข้อมูลส่วนบุคคล"</p>
                                        <div class="col-sm-4 mx-auto">
                                            <div class="mb-3">
                                                <div class="d-grid">
                                                    <button type="submit" name="btn_save" class="btn btn-success">บันทึกข้อมูล</button>
                                                </div>
                                            </div>
                                        </div>
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