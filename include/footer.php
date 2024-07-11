<div class="footer">
    <div class="footer_copy">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
                            เกี่ยวกับเรา
                            <hr>
                            <a style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#about" href="<?php echo $server['0']['st_website_address']; ?>">เกี่ยวกับเรา</a><br>
                            <a style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#terms_of_service" href="<?php echo $server['0']['st_website_address']; ?>">เงื่อนไขการใช้บริการ</a><br>
                            <a style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#privacy_policy" href="<?php echo $server['0']['st_website_address']; ?>">นโยบายคุ้มครองข้อมูลส่วนบุคคล</a>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
                            บริการของเรา
                            <hr>
                            <a href="<?php echo $server['0']['st_website_address']; ?>">ล็อกอินเข้าสู่ระบบ</a><br>
                            <a href="<?php echo $server['0']['st_website_address']; ?>">สมัครสมาชิกเจ้าหนี้</a><br>
                            <a href="<?php echo $server['0']['st_website_address']; ?>">สมัครสมาชิกลูกหนี้</a>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-12 mb-3">
                            Copyright &copy; <?php echo $cr_years; ?>. <a style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#developer" href="<?php echo $server['st_website_address']; ?>">ELS TEAM.</a> All rights reserved.
                            <hr>
                            <div class="allTime">
                                <span>เซิร์ฟเวอร์หมดอายุใน : </span>
                                <span class="days text-success"></span>
                                <span class="hrs text-success"></span>
                                <span class="min text-success"></span>
                                <span class="sec text-success"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
                            ธนาคารที่มีให้เลือก
                            <hr>
                            <div class="row">
                                <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
                                    <img src="<?php echo $server['0']['st_website_address']; ?>assete/images/bank_img/BBL.png" width="100%">
                                </div>
                                <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
                                    <img src="<?php echo $server['0']['st_website_address']; ?>assete/images/bank_img/KTB.png" width="100%">
                                </div>
                                <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
                                    <img src="<?php echo $server['0']['st_website_address']; ?>assete/images/bank_img/BAY.png" width="100%">
                                </div>
                                <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
                                    <img src="<?php echo $server['0']['st_website_address']; ?>assete/images/bank_img/KBANK.png" width="100%">
                                </div>
                                <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
                                    <img src="<?php echo $server['0']['st_website_address']; ?>assete/images/bank_img/TTB.png" width="100%">
                                </div>
                                <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
                                    <img src="<?php echo $server['0']['st_website_address']; ?>assete/images/bank_img/SCB.png" width="100%">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 mb-3">
                            ติดต่อเรา
                            <hr>
                            <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.9291931977978!2d100.48931981525142!3d7.017609219167564!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x304d29a9dbcb41a1%3A0xe2494563659f4bbb!2z4Lin4Li04LiX4Lii4Liy4Lil4Lix4Lii4LmA4LiX4LiE4LmC4LiZ4LmC4Lil4Lii4Li14Lie4LiT4Li04LiK4Lii4LiB4Liy4Lij4Lir4Liy4LiU4LmD4Lir4LiN4LmI!5e0!3m2!1sen!2sth!4v1641389638823!5m2!1sen!2sth" width="100%" height="175" style="border:0;" allowfullscreen="" loading="lazy"></iframe> -->
                            <iframe  width="100%" height="175" style="border:0;background:#f7f7f7" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-alert">
    <div class="modal fade" id="saveimg" tabindex="-1" aria-labelledby="saveimgLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="saveimgLabel" style="color: #4772f4;">แจ้งเตือนจากระบบ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center">" อ๊ะ! อย่า Save ภาพสิคะ "</h5>
                    <hr>
                    <div class="d-flex justify-content-center">
                        <img src="<?php echo $server['0']['st_website_address']; ?>assete/images/banner/banner_full.png" width="250">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="message" tabindex="-1" aria-labelledby="messageLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageLabel" style="color: #4772f4;">แจ้งเตือนจากระบบ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center">" อ๊ะ! อย่าคลิกขวา สิคะ "</h5>
                    <hr>
                    <div class="d-flex justify-content-center">
                        <img src="<?php echo $server['0']['st_website_address']; ?>assete/images/banner/banner_full.png" width="250">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="message1" tabindex="-1" aria-labelledby="message1Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="message1Label" style="color: #4772f4;">แจ้งเตือนจากระบบ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center">" อ๊ะ! อย่ากด Ctrl + U สิคะ "</h5>
                    <hr>
                    <div class="d-flex justify-content-center">
                        <img src="<?php echo $server['0']['st_website_address']; ?>assete/images/banner/banner_full.png" width="250">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="message2" tabindex="-1" aria-labelledby="message2Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="message2Label" style="color: #4772f4;">แจ้งเตือนจากระบบ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center">" อ๊ะ! อย่ากด F12 สิคะ "</h5>
                    <hr>
                    <div class="d-flex justify-content-center">
                        <img src="<?php echo $server['0']['st_website_address']; ?>assete/images/banner/banner_full.png" width="250">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="message3" tabindex="-1" aria-labelledby="message3Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="message3Label" style="color: #4772f4;">แจ้งเตือนจากระบบ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center">" อ๊ะ! อย่ากด Ctrl + S สิคะ "</h5>
                    <hr>
                    <div class="d-flex justify-content-center">
                        <img src="<?php echo $server['0']['st_website_address']; ?>assete/images/banner/banner_full.png" width="250">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="message4" tabindex="-1" aria-labelledby="message4Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="message4Label" style="color: #4772f4;">แจ้งเตือนจากระบบ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center">" อ๊ะ! อย่ากด F5 สิคะ "</h5>
                    <hr>
                    <div class="d-flex justify-content-center">
                        <img src="<?php echo $server['0']['st_website_address']; ?>assete/images/banner/banner_full.png" width="250">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="message6" tabindex="-1" aria-labelledby="message5Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="message5Label" style="color: #4772f4;">แจ้งเตือนจากระบบ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center">" อ๊ะ! อย่ากด Ctrl+ Shift + i สิคะ "</h5>
                    <hr>
                    <div class="d-flex justify-content-center">
                        <img src="<?php echo $server['0']['st_website_address']; ?>assete/images/banner/banner_full.png" width="250">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="message5" tabindex="-1" aria-labelledby="message5Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="message5Label" style="color: #4772f4;">[<?php echo $server['5']['st_version']; ?>] มีอะไรใหม่บ้าง ?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><?php echo $server['6']['st_description_version']; ?></p>
                    <hr>
                    <div class="d-flex justify-content-center">
                        <img src="<?php echo $server['0']['st_website_address']; ?>assete/images/banner/banner_full.png" width="250">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="terms_of_service" tabindex="-1" aria-labelledby="terms_of_serviceLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="terms_of_serviceLabel" style="color: #4772f4;">เงื่อนไขการใช้บริการ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><?php echo $server['7']['st_terms_of_service']; ?></p>
                    <hr>
                    <div class="d-flex justify-content-center">
                        <img src="<?php echo $server['0']['st_website_address']; ?>assete/images/banner/banner_full.png" width="250">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="privacy_policy" tabindex="-1" aria-labelledby="privacy_policyLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="privacy_policyLabel" style="color: #4772f4;">นโยบายคุ้มครองข้อมูลส่วนบุคคล</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><?php echo $server['8']['st_privacy_policy']; ?></p>
                    <hr>
                    <div class="d-flex justify-content-center">
                        <img src="<?php echo $server['0']['st_website_address']; ?>assete/images/banner/banner_full.png" width="250">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="developer" tabindex="-1" aria-labelledby="developerLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="developerLabel" style="color: #4772f4;">ผู้พัฒนาระบบ (ELS TEAM.)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th class="text-center">ลำดับ</th>
                                    <th>คำนำหน้า</th>
                                    <th>ชื่อจริง</th>
                                    <th>นามสกุล</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="text-center">1</th>
                                    <td>นาย</td>
                                    <td>ศักดา</td>
                                    <td>สุขขวัญ</td>
                                </tr>
                                <tr>
                                    <th class="text-center">2</th>
                                    <td>นางสาว</td>
                                    <td>กนิษฐา</td>
                                    <td>ศิริวัฒน์</td>
                                </tr>
                                <tr>
                                    <th class="text-center">3</th>
                                    <td>นางสาว</td>
                                    <td>บัวชมพู</td>
                                    <td>รัตนา</td>
                                </tr>
                                <tr>
                                    <th class="text-center">4</th>
                                    <td>นางสาว</td>
                                    <td>ศิริพรรณ</td>
                                    <td>ศรีนวล</td>
                                </tr>
                                <tr>
                                    <th class="text-center">5</th>
                                    <td>นางสาว</td>
                                    <td>พจนีย์</td>
                                    <td>สังขประดิษฐ์</td>
                                </tr>
                                <tr>
                                    <th class="text-center">6</th>
                                    <td>นางสาว</td>
                                    <td>พรประภา</td>
                                    <td>กำจัดภัย</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-center">
                        <img src="<?php echo $server['0']['st_website_address']; ?>assete/images/banner/banner_full.png" width="250">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="about" tabindex="-1" aria-labelledby="aboutLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="aboutLabel" style="color: #4772f4;">เกี่ยวกับเรา</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        ระบบเงินกู้ยืมอีเล็กทรอนิกส์ - Electronic Loan System<br><br>
                        Copyright &copy; <?php echo $cr_years; ?> ELS TEAMS. All rights reserved.
                    </div>
                    <hr>
                    <div class="d-flex justify-content-center">
                        <img src="<?php echo $server['0']['st_website_address']; ?>assete/images/banner/banner_full.png" width="250">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Count down -->
<script>
    let countDownBox = document.querySelector(".allTime");
    let daysBox = document.querySelector(".days");
    let hrsBox = document.querySelector(".hrs");
    let minBox = document.querySelector(".min");
    let secBox = document.querySelector(".sec");
    let countDownDate = new Date("Nov 20, 2023 23:59:59").getTime();
    // let countDownDate = new Date("Nov 13, 2023 23:59:59").getTime();
    let x = setInterval(function() {
        let now = new Date().getTime();
        let distance = countDownDate - now;
        let days = Math.floor(distance / (1000 * 60 * 60 * 24));
        let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((distance % (1000 * 60)) / 1000);
        daysBox.innerHTML = days + " วัน";
        hrsBox.innerHTML = hours + " ชั่วโมง";
        minBox.innerHTML = minutes + " นาที";
        secBox.innerHTML = seconds + " วินาที";
        if (distance < 0) {
            clearInterval(x);
            countDownBox.innerHTML = "<span class='text-danger'>เซิร์ฟเวอร์ได้หมดอายุ และขอยุติการให้บริการ ขออภัยในความไม่สะดวก ...</span>";
        }
    }, 1000);
</script>