<form action="" method="post" enctype="multipart/form-data">
    <section class="login mb-3">
        <div class="container">
            <div class="login-wrapper">
                <div class="login-info">
                    <div class="login-title">สมัครสมาชิกเจ้าหนี้</div>
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
    
                            <div class="col-sm-12">
                                <div class="mb-3" style="background: #f7f7f7;border: 1px solid #ced4da;border-radius: 0.25rem;">
                                    <div class="row m-1">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="mb-3 mt-3 text-center">
                                                <label class="form-label"><span>เลขบัตรประจำตัวประชาชน และ หมายเลขโทรศัพท์<br>*** จะใช้ในการล็อกอินเข้าสู่ระบบ ***</span></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="mb-3">
                                                <label for="idCardNumber" class="form-label">เลขบัตรประจำตัวประชาชน : *</label>
                                                <input type="text" class="form-control" name="idCardNumber" id="idCardNumber" placeholder="ID Card Number" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">หมายเลขโทรศัพท์ : *</label>
                                                <input type="tel" class="form-control" name="phone" id="phone" placeholder="Phone Number" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="mb-3" style="background: #f7f7f7;border: 1px solid #ced4da;border-radius: 0.25rem;">
                                    <div class="row m-1">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="mb-3 mt-3 text-center">
                                                <label class="form-label"><span>ชื่อจริง และ นามสกุล</label>
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
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="mb-3" style="background: #f7f7f7;border: 1px solid #ced4da;border-radius: 0.25rem;">
                                    <div class="row m-1">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="mb-3 mt-3 text-center">
                                                <label class="form-label"><span>เลขบัญชีธนาคาร และ ชื่อธนาคาร</span></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="mb-3">
                                                <label for="account_number" class="form-label">เลขบัญชีธนาคาร : *<br><span class="text-muted">ระบบจะแสดงข้อมูลนี้ให้ลูกหนี้เห็น เพื่อให้ชำระหนี้คืนได้</span></label>
                                                <input type="text" class="form-control" name="account_number" id="account_number" placeholder="Account Number" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="mb-3">
                                                <label for="bank_code" class="form-label">ชื่อธนาคาร : *<br><span class="text-muted">ระบบจะแสดงข้อมูลนี้ให้ลูกหนี้เห็น เพื่อให้ชำระหนี้คืนได้</span></label>
                                                <select class="form-select" aria-label="Default select example" name="bank_code" id="bank_code">
                                                    <option selected>เลือกธนาคาร</option><?php while ($row = mysqli_fetch_assoc($result_data_bank)) { ?>
            
                                                    <option value="<?php echo $row['bk_code'] ?>"><?php echo $row['bk_name'] ?></option><?php } ?>
            
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="mb-3" style="background: #f7f7f7;border: 1px solid #ced4da;border-radius: 0.25rem;">
                                    <div class="row m-1">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="mb-3 mt-3 text-center">
                                                <label class="form-label"><span>อัตราดอกเบี้ยแบบกำหนดเอง และ อัตราดอกเบี้ยแบบที่มีให้เลือก<br>*** เลือกอันใดอันหนึ่ง ***</span></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="mb-3">
                                                <label for="mb_interest_1" class="form-label">อัตราดอกเบี้ยแบบกำหนดเอง : <br><span class="text-muted">แนะนำดอกเบี้ยอยู่ที่ 2%</span><br><span class="text-danger">(อนุญาตให้ใส่จำนวนตัวเลขเท่านั้น)</span>
                                                </label>
                                                <input type="text" class="form-control" name="mb_interest_1" id="mb_interest_1" placeholder="ตัวอย่าง (1.7)" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="mb-3">
                                                <label for="mb_interest_2" class="form-label">อัตราดอกเบี้ยแบบที่มีให้เลือก : <br><span class="text-muted">แนะนำดอกเบี้ยอยู่ที่ 2%</span><br><span style="color: #f7f7f7;" >#</span></label>
                                                <select class="form-select" aria-label="Default select example" name="mb_interest_2" id="mb_interest_2">
                                                    <option value="0.5">ดอกเบี้ย 0.5%</option>
                                                    <option value="1">ดอกเบี้ย 1%</option>
                                                    <option value="1.5">ดอกเบี้ย 1.5%</option>
                                                    <option selected value="2">ดอกเบี้ย 2% (แนะนำ)</option>
                                                    <option value="2.5">ดอกเบี้ย 2.5%</option>
                                                    <option value="3">ดอกเบี้ย 3%</option>
                                                    <option value="3.5">ดอกเบี้ย 3.5%</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="mb-3" style="background: #f7f7f7;border: 1px solid #ced4da;border-radius: 0.25rem;">
                                    <div class="row m-1">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="mb-3 mt-3 text-center">
                                                <label class="form-label"><span>อัพโหลดสำเนาบัตรประชาชน และ อัพโหลดสำเนาบัญชีธนาคาร</span></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="mb-3">
                                                <label for="citizen_id_file" class="form-label">อัพโหลดสำเนาบัตรประชาชน : *<br><span class="text-danger">(อนุญาตให้อัพโหลดใฟล์ pdf, .jpeg, .jpg และ .png เท่านั้น)</span><br><a href="<?php echo $server['st_website_address']; ?>assete/citizen_file/citizen_file_ex.pdf" target="_blank">ตัวอย่างไฟล์ที่ใช้ในการอัพโหลด</a></label>
                                                <input type="file" class="form-control" name="citizen_id_file" id="citizen_id_file" accept=".pdf,.jpeg,.jpg,.png">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="mb-3">
                                                <label for="book_bank_file" class="form-label">อัพโหลดสำเนาบัญชีธนาคาร : *<br><span class="text-danger">(อนุญาตให้อัพโหลดใฟล์ pdf, .jpeg, .jpg และ .png เท่านั้น)</span><br><a href="<?php echo $server['st_website_address']; ?>assete/bookbank_file/bookbank_file_ex.pdf" target="_blank">ตัวอย่างไฟล์ที่ใช้ในการอัพโหลด</a></label>
                                                <input type="file" class="form-control" name="book_bank_file" id="book_bank_file" accept=".pdf,.jpeg,.jpg,.png">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <p class="text-center">เมื่อสมัครสมาชิก จะถือว่าคุณยอมรับ "เงื่อนไขการใช้บริการ", "นโยบายความเป็นส่วนตัว", "นโยบายคุ้มครองข้อมูลส่วนบุคคล"</p>
                            <div class="col-sm-4 mx-auto">
                                <div class="mb-3">
                                    <div class="d-grid">
                                        <button type="submit" name="btn_insert" class="btn btn-warning">สมัครสมาชิก</button>
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