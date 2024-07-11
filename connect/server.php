<?php
// $conn = mysqli_connect("localhost", "root", "", "las_database") or die("เกิดข้อผิดพลาดเกิดขึ้น ไม่สามารถเชื่อมต่อฐานข้อมูลได้");
// $conn = mysqli_connect("localhost", "cp009141_dbt", "Sakdar39814", "cp009141_las") or die("เกิดข้อผิดพลาดเกิดขึ้น ไม่สามารถเชื่อมต่อฐานข้อมูลได้ T-T");

// $servername = "els.dbtlearning.com";
// $username = "cp009141_dbt";
// $password = "Sakdar39814";
// $dbname = "cp009141_las";
// $conn = mysqli_connect($servername, $username, $password, $dbname);

// $conn->set_charset("utf8");

// ดึงข้อมูลจากฐานข้อมูล
// $server_query = "SELECT * FROM tbl_setting_db";
// $result = mysqli_query($conn, $server_query);
// $server = mysqli_fetch_assoc($result);

$server = [
    ['st_website_address' => 'https://els.dbtlearning.com/'],
    ['st_website_title' => 'Electronic Money Transactions - การทำธุรกรรมการเงินอิเล็กทรอนิกส์'],
    ['st_btn_level_1' => '2'],
    ['st_btn_level_2' => '2'],
    ['st_website_description' => 'โครงงาน นวัตกรรมดิจิทัล การทำธุรกรรมการเงินอิเล็กทรอนิกส์ (Electronic Money Transactions)'],
    ['st_version' => 'v1.2.17'],
    ['st_description_version' => '1) สร้างและพัฒนาระบบ<br>
    2) เพิ่มเติมระบบให้สมบูรณ์มากขึ้น<br>
    3) เพิ่มฟังก์ชั่นการทำงาน<br>
    4) แก้ไขข้อผิดพลาดของระบบ<br>
    5) เพิ่มเอฟเฟคเกร็ดหิมะ เพื่อความสวยงาม<br>
    6) เพิ่มระบบรักษาความปลอดภัย'],
    ['st_terms_of_service' => '1) โดย “ผู้กู้ยืมเงิน” จะชำระเงินคืนให้แก่ “ผู้ให้กู้ยืม” ทุกเดือน เดือนละ 2,000.00 บาท<br>
    2) โดย “ผู้ให้กู้ยืม” จะไม่คิดดอกเบี้ย ใด ๆ ทั้งสิ้น หาก “ผู้กู้ยืมเงิน” ทำตามข้อตกลง<br>
    3) การคิดดอกเบี้ย เงินต้น 2,000 รวม ดอกเบี้ย ร้อยละ 2 (ตัวอย่างอัตราดอกเบี้ย ขึ้นอยู่กับเจ้าหนี้แต่คนจะกำหนด) ต่อเดือน เท่ากับ 2,040.00 (ตัวอย่างผลลัภธ์) บาท<br>
    4) โดย “ผู้กู้ยืมเงิน” จะต้องมีอายุ 18 ปีขึ้นไป ถึงจะกู้ยืมเงินได้<br>
    5) อัตราดอกเบี้ยสูงสุดที่ “ผู้ให้กู้ยืม” กำหนดได้คือ ไม่เกิน 10% ต่อเดือน'],
    ['st_privacy_policy' => 'ประกาศ!  อัพเดทระบบความปลอดภัย  ของเว็บไซต์ https://els.dbtlearning.com/<br><br>
    1)  ป้องกันการกดดูซอร์สโค้ดของหน้าเว็บ  (Ctrl + U)<br>
    2)  ป้องกันการเปิดเครื่องมือผู้พัฒนา  DevTool  (F12)<br>
    3)  ป้องกันการกดบันทึกหน้าเว็บ  (Ctrl + S)<br>
    4)  ป้องกันการกดรีเฟรชหน้าเว็บ  (F5)<br>
    5)  ป้องกันการคลิกขวา<br>
    6)  ป้องกันการบันทึกรูปภาพ<br>
    ฯลฯ  ระบบความปลอดภัยอื่น ๆ<br><br>
    ทั้งนี้เราอัพเดทระบบความปลอดภัยอยู่เสมอ  เพื่อผู้ใช้จะได้ใช้งานได้อย่างปลอดภัย
    <br><br>
    --  ทีมงาน ELS TEAM.  --']
];

// วัน/เดือน/ปี ภาษาไทย
function datetime()
{
    // เดือนภาษาไทย
    $ThaiMonth = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");

    // กำหนดคุณสมบัติ
    $months = date("m") - 1; // ค่าเดือน (1-12)
    $day = date("d"); // ค่าวันที่(1-31)
    $years = date("Y") + 543; // ค่า ค.ศ.บวก 543 ทำให้เป็น พ.ศ.

    return "$day $ThaiMonth[$months] $years";
}

// Generating Random
date_default_timezone_set('Asia/Bangkok');
$date1 = date("Ymd-His");
$numrand = (mt_rand());

$n = 10;
function getName($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}

$cr_years = date("Y");
?>