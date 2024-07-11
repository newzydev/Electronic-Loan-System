<form action="" method="post">
    <section class="login mb-3">
        <div class="container">
            <div class="login-wrapper">
                <div class="login-info">
                    <div class="login-title">สมัครสมาชิกแอดมิน</div>
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
                                    <label for="idCardNumber" class="form-label">เลขบัตรประจำตัวประชาชน : *</label>
                                    <input type="text" class="form-control" name="idCardNumber" id="idCardNumber" placeholder="ID Card Number" autocomplete="off" autofocus>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">หมายเลขโทรศัพท์ : *</label>
                                    <input type="tel" class="form-control" name="phone" id="phone" placeholder="Phone Number" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="mb-3">
                                    <label for="firstName" class="form-label">ชื่อจริง : *</label>
                                    <input type="text" class="form-control" name="firstName" id="firstName" placeholder="Firstname" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="mb-3">
                                    <label for="lastName" class="form-label">นามสกุล : *</label>
                                    <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Lastname" autocomplete="off">
                                </div>
                            </div>
                            <hr>
                            <p class="text-center">เมื่อสมัครสมาชิก จะถือว่าคุณยอมรับ "เงื่อนไขการใช้บริการ", "นโยบายความเป็นส่วนตัว", "นโยบายคุ้มครองข้อมูลส่วนบุคคล"</p>
                            <div class="col-sm-4 mx-auto">
                                <div class="mb-3">
                                    <div class="d-grid">
                                        <button type="submit" name="btn_insert" class="btn btn-primary">สมัครสมาชิก</button>
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