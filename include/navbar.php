<canvas class="snow" id="snow" width="1848" height="515"></canvas>
<script>
    (function () {

    var canvas, ctx;
    var points = [];
    var maxDist = 100;

    function init() {
        //Add on load scripts
        canvas = document.getElementById("snow");
        ctx = canvas.getContext("2d");
        resizeCanvas();
        pointFun();
        setInterval(pointFun, 20);
        window.addEventListener('resize', resizeCanvas, false);
    }
    //Particle constructor
    function point() {
        this.x = Math.random() * (canvas.width + maxDist) - (maxDist / 2);
        this.y = Math.random() * (canvas.height + maxDist) - (maxDist / 2);
        this.z = (Math.random() * 0.5) + 0.5;
        this.vx = ((Math.random() * 2) - 0.5) * this.z;
        this.vy = ((Math.random() * 1.5) + 1.5) * this.z;
        this.fill = "rgba(255,255,255," + ((0.4 * Math.random()) + 0.5) + ")";
        this.dia = ((Math.random() * 2.5) + 1.5) * this.z;
        points.push(this);
    }
    //Point generator
    function generatePoints(amount) {
        var temp;
        for (var i = 0; i < amount; i++) {
            temp = new point();
        };
        // console.log(points);
    }
    //Point drawer
    function draw(obj) {
        ctx.beginPath();
        ctx.strokeStyle = "transparent";
        ctx.fillStyle = obj.fill;
        ctx.arc(obj.x, obj.y, obj.dia, 0, 2 * Math.PI);
        ctx.closePath();
        ctx.stroke();
        ctx.fill();
    }
    //Updates point position values
    function update(obj) {
        obj.x += obj.vx;
        obj.y += obj.vy;
        if (obj.x > canvas.width + (maxDist / 2)) {
            obj.x = -(maxDist / 2);
        }
        else if (obj.xpos < -(maxDist / 2)) {
            obj.x = canvas.width + (maxDist / 2);
        }
        if (obj.y > canvas.height + (maxDist / 2)) {
            obj.y = -(maxDist / 2);
        }
        else if (obj.y < -(maxDist / 2)) {
            obj.y = canvas.height + (maxDist / 2);
        }
    }
    //
    function pointFun() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        for (var i = 0; i < points.length; i++) {
            draw(points[i]);
            update(points[i]);
        };
    }

    function resizeCanvas() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        points = [];
        generatePoints(window.innerWidth / 3);
        pointFun();
    }

    //Execute when DOM has loaded
    document.addEventListener('DOMContentLoaded', init, false);
    })();
</script>

<div class="container-fluid px-2 py-2" style="background-color: #f7f7f7;">
    <div class="text-center m-0 p-0">
        <p class="m-0 p-0">
            <i class="fas fa-exclamation-circle"></i>
            ยุติการให้บริการอย่างเป็นทางการ<span class="txt_d"></span>
            <span class="allTime_al text-success">
                <span class="days_al"></span>
                <span class="hrs_al"></span>
                <span class="min_al"></span>
                <span class="sec_al"></span>
            </span>
        </p>
    </div>
</div>
<script>
    let txt_d = document.querySelector(".txt_d");
    let daysBox_al = document.querySelector(".days_al");
    let hrsBox_al = document.querySelector(".hrs_al");
    let minBox_al = document.querySelector(".min_al");
    let secBox_al = document.querySelector(".sec_al");
    let countDownDate_al = new Date("Nov 13, 2023 23:59:59").getTime();
    // let countDownDate_al = new Date("Aug 3, 2023 16:51:59").getTime();
    let x_al = setInterval(function() {
        let now_al = new Date().getTime();
        let distance_al = countDownDate_al - now_al;
        let days_al = Math.floor(distance_al / (1000 * 60 * 60 * 24));
        let hours_al = Math.floor((distance_al % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let minutes_al = Math.floor((distance_al % (1000 * 60 * 60)) / (1000 * 60));
        let seconds_al = Math.floor((distance_al % (1000 * 60)) / 1000);
        daysBox_al.innerHTML = days_al + " วัน";
        hrsBox_al.innerHTML = hours_al + " ชั่วโมง";
        minBox_al.innerHTML = minutes_al + " นาที";
        secBox_al.innerHTML = seconds_al + " วินาที";
        if (distance_al > 0) {
            txt_d.innerHTML = "<span>ในอีก : </span>";
        } else if (distance_al < 0) {
            daysBox_al.innerHTML = " ";
            hrsBox_al.innerHTML = " ";
            minBox_al.innerHTML = " ";
            secBox_al.innerHTML = " ";
            txt_d.innerHTML = "<span>เรียบร้อยแล้ว ขอขอบคุณที่ใช้บริการ</span>";
        }
    }, 1000);
</script>

<nav class="navbar-shadow navbar navbar-expand-lg navbar-light mb-3" style="background-color: #ffffff;">
                <div class="container">
                    <a class="navbar-brand">
                        <img src="<?php echo $server['0']['st_website_address']; ?>assete/images/banner/banner_full.png" width="250">
                    </a>
                    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar1">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div id="navbar1" class="collapse navbar-collapse">
                        <ul class="navbar-nav ms-auto text-center">
                            <hr style="color: #000;">
                            <li class="nav-item">
                                <a href="<?php echo $server['0']['st_website_address']; ?>" class="nav-link">หน้าหลัก</a>
                            </li>
                            <div class="topbar-divider d-none d-sm-block"></div>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    เกี่ยวกับเรา
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#about" href="<?php echo $server['st_website_address']; ?>">เกี่ยวกับเรา</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a style="cursor: pointer;" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#terms_of_service" href="<?php echo $server['st_website_address']; ?>">เงื่อนไขการใช้บริการ</a></li>
                                    <li><a style="cursor: pointer;" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#privacy_policy" href="<?php echo $server['st_website_address']; ?>">นโยบายคุ้มครองข้อมูลส่วนบุคคล</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#developer" href="<?php echo $server['st_website_address']; ?>">ทีมงานผู้พัฒนา</a></li>
                                </ul>
                            </li>
                            <div class="topbar-divider d-none d-sm-block"></div>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    บริการของเรา
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="<?php echo $server['0']['st_website_address']; ?>">ล็อกอินเข้าสู่ระบบ</a></li>
                                    <li><a class="dropdown-item" href="<?php echo $server['0']['st_website_address']; ?>">สมัครสมาชิกเจ้าหนี้</a></li>
                                    <li><a class="dropdown-item" href="<?php echo $server['0']['st_website_address']; ?>">สมัครสมาชิกลูกหนี้</a></li>
                                </ul>
                            </li>
                            <div class="topbar-divider d-none d-sm-block"></div>
                            <li class="nav-item">
                                <a style="cursor: pointer;" class="nav-link" data-bs-toggle="modal" data-bs-target="#message5">มีอะไรใหม่บ้าง ?</a>
                            </li>
                            <div class="topbar-divider d-none d-sm-block"></div>
                            <li class="nav-item">
                                <div class="d-grid">
                                    <a class="<?php if (isset($member_id)) { ?> nav-link <?php } else { ?> btn btn-blue <?php } ?>"><i class="fas fa-mail-bulk"></i> ติดต่อเรา</a>
                                </div>
                            </li>
                            <?php if (isset($member_id)) { ?>
                            <div class="topbar-divider d-none d-sm-block"></div>
                            <li class="nav-item">
                                <form action="" method="post">
                                    <div class="d-grid">
                                        <button type="submit" name="logout" class="btn btn-blue"><i class="fas fa-sign-in-alt"></i> ออกจากระบบ</button>
                                    </div>
                                </form>
                            </li>
                            <?php } else { ?>

                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </nav>