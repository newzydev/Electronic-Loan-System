<form action="" method="post">
    <section class="login mb-3">
        <div class="container">
            <div class="login-wrapper">
                <div class="login-info">
                    <div class="login-title">ล็อกอินเข้าสู่ระบบ</div>
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

                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="mb-3">
                                    <?php if ($server['2']['st_btn_level_1'] == "1" || $server['3']['st_btn_level_2'] == "1") { ?>
                                    <?php } else { ?>
                                        <div class="text-center" style="font-size: 14px;">ปิดระบบชั่วคราว เพื่อพัฒนาระบบ<br>ขออภัยในความไม่สะดวก</div>
                                    <?php } ?>
                                    <label for="idCardNumber" class="form-label">เลขบัตรประจำตัวประชาชน : *</label>
                                    <input oninput="validateNumberInput1(this)" type="text" class="form-control" name="id_card_number" id="idCardNumber" placeholder="ID Card Number" autocomplete="off" disabled>
                                    <div class="mt-1">
                                        <span class="text-danger" id="errorText1"></span>
                                    </div>
                                </div>
                                <script>
                                    function validateNumberInput1(inputElement) {
                                        var inputValue = inputElement.value;
                                        var errorTextElement = document.getElementById("errorText1");

                                        if (!/^\d*$/.test(inputValue)) {
                                            errorTextElement.textContent = "(กรุณากรอกเฉพาะตัวเลขเท่านั้น)";
                                            inputElement.classList.add("error-input"); // เพิ่มคลาสสำหรับเปลี่ยนสีขอบ
                                            inputElement.value = ""; // ล้างค่าที่ป้อนไป
                                        } else {
                                            errorTextElement.textContent = "";
                                            inputElement.classList.remove("error-input"); // ลบคลาสสำหรับเปลี่ยนสีขอบ
                                        }
                                    }
                                </script>
                                <div class="mb-3">
                                    <?php if ($server['2']['st_btn_level_1'] == "1" || $server['3']['st_btn_level_2'] == "1") { ?>
                                    <?php } else { ?>
                                        <div class="text-center" style="font-size: 14px;">ปิดระบบชั่วคราว เพื่อพัฒนาระบบ<br>ขออภัยในความไม่สะดวก</div>
                                    <?php } ?>
                                    <label for="phone" class="form-label">โทรศัพท์ : *</label>
                                    <input oninput="validateNumberInput2(this)" type="tel" class="form-control" name="phone" id="phone" placeholder="Phone Number" autocomplete="off" disabled>
                                    <div class="mt-1">
                                        <span class="text-danger" id="errorText2"></span>
                                    </div>
                                </div>
                                <script>
                                    function validateNumberInput2(inputElement) {
                                        var inputValue = inputElement.value;
                                        var errorTextElement = document.getElementById("errorText2");

                                        if (!/^\d*$/.test(inputValue)) {
                                            errorTextElement.textContent = "(กรุณากรอกเฉพาะตัวเลขเท่านั้น)";
                                            inputElement.classList.add("error-input"); // เพิ่มคลาสสำหรับเปลี่ยนสีขอบ
                                            inputElement.value = ""; // ล้างค่าที่ป้อนไป
                                        } else {
                                            errorTextElement.textContent = "";
                                            inputElement.classList.remove("error-input"); // ลบคลาสสำหรับเปลี่ยนสีขอบ
                                        }
                                    }
                                </script>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="mb-3 mt-2">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-6" style="text-align: center;">
                                            <img src="<?php echo $server['0']['st_website_address']; ?>assete/images/banner/banner_full.png" width="60%">
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-6" style="text-align: center;">
                                            <img src="<?php echo $server['0']['st_website_address']; ?>assete/images/banner/banner_full.png" width="60%">
                                        </div>
                                        <!-- <div class="col-sm-12 col-md-12 col-lg-6">
                                            <div class="d-grid">
                                                <button type="submit" name="btn_login_admin" class="btn btn-primary" <?php if (isset($member_id)) { ?> disabled <?php } else { ?> <?php } ?>>ล็อกอินเข้าสู่ระบบแอดมิน</button>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-6">
                                            <?php if ($server['st_btn_level_1'] == "1") { ?>
                                                <div class="d-grid">
                                                    <a href="<?php echo $server['st_website_address']; ?>register-creditor" class="btn btn-outline-warning">สมัครสมาชิกระบบเจ้าหนี้</a>
                                                </div>
                                            <?php } else { ?>
                                                <div class="text-center" style="font-size: 14px;">ปิดระบบชั่วคราว เพื่อพัฒนาระบบ<br>ขออภัยในความไม่สะดวก</div>
                                                <div class="d-grid">
                                                    <button type="button" class="btn btn-outline-warning" disabled>สมัครสมาชิกระบบเจ้าหนี้</button>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-6">
                                            <?php if ($server['st_btn_level_1'] == "1") { ?>
                                                <div class="d-grid">
                                                    <button type="submit" name="btn_login_creditor" class="btn btn-warning" <?php if (isset($member_id)) { ?> disabled <?php } else { ?> <?php } ?>>ล็อกอินเข้าสู่ระบบเจ้าหนี้</button>
                                                </div>
                                            <?php } else { ?>
                                                <div class="text-center" style="font-size: 14px;">ปิดระบบชั่วคราว เพื่อพัฒนาระบบ<br>ขออภัยในความไม่สะดวก</div>
                                                <div class="d-grid">
                                                    <button type="submit" name="btn_login_creditor" class="btn btn-warning" disabled>ล็อกอินเข้าสู่ระบบเจ้าหนี้</button>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-6">
                                            <?php if ($server['st_btn_level_2'] == "1") { ?>
                                                <div class="d-grid">
                                                    <a href="<?php echo $server['st_website_address']; ?>register-debtor" class="btn btn-outline-success">สมัครสมาชิกระบบลูกหนี้</a>
                                                </div>
                                            <?php } else { ?>
                                                <div class="text-center" style="font-size: 14px;">ปิดระบบชั่วคราว เพื่อพัฒนาระบบ<br>ขออภัยในความไม่สะดวก</div>
                                                <div class="d-grid">
                                                    <button type="button" class="btn btn-outline-success" disabled>สมัครสมาชิกระบบลูกหนี้</button>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-6">
                                            <?php if ($server['st_btn_level_2'] == "1") { ?>
                                                <div class="d-grid">
                                                    <button type="submit" name="btn_login_debtor" class="btn btn-success" <?php if (isset($member_id)) { ?> disabled <?php } else { ?> <?php } ?>>ล็อกอินเข้าสู่ระบบลูกหนี้</button>
                                                </div>
                                            <?php } else { ?>
                                                <div class="text-center" style="font-size: 14px;">ปิดระบบชั่วคราว เพื่อพัฒนาระบบ<br>ขออภัยในความไม่สะดวก</div>
                                                <div class="d-grid">
                                                    <button type="submit" name="btn_login_debtor" class="btn btn-success" disabled>ล็อกอินเข้าสู่ระบบลูกหนี้</button>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-center">
                                <img src="assete/images/banner/banner_full.png" width="250">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>