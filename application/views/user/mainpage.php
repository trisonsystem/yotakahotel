<!doctype html>
<html lang="en">

    <head>
        <?php echo $startpage; ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/cards-gallery.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/yotaka_style.css">

    </head>

    <body style="padding-top: unset">

        <?php echo $topmenu; ?>

        <!-- Alert Message -->
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <?php
                $error = $this->session->flashdata('error');
                if ($error) {
                    ?>
                    <div class="alert alert-warning" style="margin-top: 25px " role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="alert-heading"> Error ! </h4>
                        <p><?php echo $error; ?></p>
                        <hr>
                        <p class="mb-0">Message from system.</p>
                    </div>
                    <?php
                }
                $success = $this->session->flashdata('success');
                if ($success) {
                    ?>
                    <div class="alert alert-success" style="margin-top: 25px " role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="alert-heading"> Success ! </h4>
                        <?php echo $success; ?>
                        <hr>
                        <p class="mb-0">Message from system.</p>
                    </div>
                <?php } ?>
            </div>
        </div>

        <?php echo $slideshow; ?>

        <?php // echo $navbar; ?>

        <main role="main">
            <div class="jumbotron font-bg" style="border-radius: 0rem">
                <h1 class="display-5">WELCOME TO YOTAKA GROUP</h1>
                <p>" โรงแรมในเครือโยทะกา กรุ๊ปของเรามีทั้งหมด 6 ที่ (รายละเอียดด้านในเว็ปไซต์) มีการตกแต่ง ได้อย่างมีเอกลักษณ์ในตัว มีสไตล์ แตกต่างกันไป ไม่ว่าจะเป็นไทย-ล้านนา ไทย-โมเดิร์น และ Loft เพื่อให้ลูกค้าได้เลือกตามไลฟ์สไตล์ของลูกค้าเอง เราใส่ใจทุกรายละเอียดทั้งด้านการตกแต่งและด้านบริการ เพื่อให้ลูกค้าที่เข้าพักประทับใจ โรงแรมของเราตั้งอยู่ที่อยู่ใจกลางเมืองแต่ให้ความสงบ ร่มรื่นเหมาะแก่การพักผ่อนจริงๆค่ะ และสุดท้ายนี้ ทางโยทะกา กรุ้ปขอขอบคุณลูกค้าที่เข้ามาเยี่ยมชมเว็บไซต์ของเรา และหวังเป็นอย่างยิ่งว่า จะมีโอกาสได้ให้บริการลูกค้าทุกท่านค่ะ "</p>
            </div>
        </main>

        <div class="col-md-12" style="text-align: center; margin-bottom: 25px">
            <h1 class="h1-responsive" style="color: #313A45">OUR SERVICE</h1>
        </div>

        <div class="container-fluid" style="text-align: center">
            <!--                        <div class="row" style="margin-bottom: 25px">
                                        <div class="col-md-2" ></div>
                                        <div class="col-md-2" ><img src="<?php echo base_url(); ?>assets/img/service1.png" style="width: 100%; height: auto; position: relative;"  ></div>
                                        <div class="col-md-2" ><img src="<?php echo base_url(); ?>assets/img/service2.png" style="width: 100%; height: auto; position: relative;"  ></div>
                                        <div class="col-md-2" ><img src="<?php echo base_url(); ?>assets/img/service3.png" style="width: 100%; height: auto; position: relative;"  ></div>
                                        <div class="col-md-2" ><img src="<?php echo base_url(); ?>assets/img/service4.png" style="width: 100%; height: auto; position: relative;"  ></div>
                                        <div class="col-md-2" ></div>
                                    </div>-->
            <div class="album py-5 bg-white">
                <div class="container">
                    <table>
                        <div class="row">
                        <tr>
                            <th>
                                <div class="xcontainer" style="height: auto; width: auto;margin-right:20px;">
                                    <p class="round2"><img src="<?php echo base_url(); ?>assets/img/service001.png" alt="Avatar" class="ximage"></p>
                                    <div class="xoverlay">
                                        <img src="<?php echo base_url(); ?>assets/img/servicepic1.png" alt="Avatar" class="ximage rounded">
                                        <div class="xtext">ROOM</div>
                                    </div>
                                </div>
                            </th>
                            <th>
                                <div class="xcontainer" style="height: auto; width: auto;margin-right:20px;">
                                    <p class="round2"><img src="<?php echo base_url(); ?>assets/img/service002.png" alt="Avatar" class="ximage"></p>
                                    <div class="xoverlay">
                                        <img src="<?php echo base_url(); ?>assets/img/servicepic2.png" alt="Avatar" class="ximage rounded">
                                        <div class="xtext">FREE Wi-Fi</div>
                                    </div>
                                </div>
                            </th>
                            <th>
                               <div class="xcontainer" style="height: auto; width: auto;margin-right:20px;">
                                    <p class="round2"><img src="<?php echo base_url(); ?>assets/img/service003.png" alt="Avatar" class="ximage"></p>
                                    <div class="xoverlay">
                                        <img src="<?php echo base_url(); ?>assets/img/servicepic3.png" alt="Avatar" class="ximage rounded">
                                        <div class="xtext">
                                            BREAKFAST
                                        </div>
                                    </div>
                                </div>
                            </th>
                            <th>
                                <div class="xcontainer" style="height: auto; width: auto;margin-right:20px;">
                                    <p class="round2"><img src="<?php echo base_url(); ?>assets/img/service004.png" alt="Avatar" class="ximage round2"></p>
                                    <div class="xoverlay">
                                        <img src="<?php echo base_url(); ?>assets/img/servicepic4.png" alt="Avatar" class="ximage rounded">
                                        <div class="xtext"> SWIMMING <br>POOL</div>
                                    </div>
                                    </p>
                                </div>
                            </th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <hr class="style11">

        <?php // echo $navbar; ?>

<!--        <div class="container-fluid carousel-inner img" style="background-image: url('<?php echo base_url(); ?>assets/img/bg.png')">
            <div class="row"  >
                <div class="col-sm-12" >
                    <div class="row" style="margin-top: 50px; margin-bottom: 25px; margin-left: auto; margin-right: auto">
                        <div class="col-sm-4" >11111<img src="<?php echo base_url(); ?>assets/img/branch1.png" style="width: 100%; height: auto; position: relative;"></div>
                        <div class="col-sm-4" ><img src="<?php echo base_url(); ?>assets/img/branch2.png" style="width: 100%; height: auto; position: relative;"></div>
                        <div class="col-sm-4" ><img src="<?php echo base_url(); ?>assets/img/branch3.png" style="width: 100%; height: auto; position: relative;"></div>
                    </div>
                    <div class="row" style="margin-top: 50px; margin-bottom: 25px; margin-left: auto; margin-right: auto">
                        <div class="col-sm-4" ><img src="<?php echo base_url(); ?>assets/img/branch4.png" style="width: 100%; height: auto; position: relative;"></div>
                        <div class="col-sm-4" ><img src="<?php echo base_url(); ?>assets/img/branch5.png" style="width: 100%; height: auto; position: relative;"></div>
                        <div class="col-sm-4" ><img src="<?php echo base_url(); ?>assets/img/branch6.png" style="width: 100%; height: auto; position: relative;"></div>
                    </div>
                </div>
            </div>
        </div>-->
        <section class="gallery-block cards-gallery">
            <div class="container">
                <div class="heading">
                    <h1 class="h1-responsive" style="color: #313A45">OUR BRANCH</h1>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 transform-on-hover">
                            <a class="lightbox" href="<?php echo base_url(); ?>assets/img/pic1.png">
                                <img src="<?php echo base_url(); ?>assets/img/pic1.png" alt="Card Image" class="card-img-top">
                            </a>
                            <div class="card-body" style="height:50%">
                                <h6>YOTAKA RESIDENCE</h6>
                                <div class="ex3">สาขานี้ตั้งอยู่ที่ซอยมหาดไทย (รามคำแหง 65 / ลาดพร้าว 122) เป็นโรงแรมที่มีกลิ่นไอความเป็นไทย-ล้านนา ผสมผสานความเป็นโมเดิร์นให้เข้ากับยุคสมัยที่เปลี่ยนไป สงบ สะอาด เหมาะกับการพักผ่อน มีพนักงานให้บริการตลอด 24 ชม. /มีบริการนวดแผนไทย / Free WiFi ให้ทุกท่านได้ใช้บริการตามอัธยาศัย</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 transform-on-hover">
                            <a class="lightbox" href="<?php echo base_url(); ?>assets/img/pic2.png">
                                <img src="<?php echo base_url(); ?>assets/img/pic2.png" alt="Card Image" class="card-img-top">
                            </a>
                            <div class="card-body">
                                <h6>YOTAKA BOUTIQUE HOTEL</h6>
                                <div class="ex3">สาขานี้ตั้งอยู่ที่ซอยมหาดไทย (รามคำแหง 65 / ลาดพร้าว 122) เป็นโรงแรมที่มีกลิ่นไอความเป็นไทย-ล้านนา ผสมผสานความเป็นโมเดิร์นให้เข้ากับยุคสมัยที่เปลี่ยนไป สงบ สะอาด เหมาะกับการพักผ่อน มีพนักงานให้บริการตลอด 24 ชม. /มีบริการนวดแผนไทย / Free WiFi ให้ทุกท่านได้ใช้บริการตามอัธยาศัย</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 transform-on-hover">
                            <a class="lightbox" href="<?php echo base_url(); ?>assets/img/pic3.png">
                                <img src="<?php echo base_url(); ?>assets/img/pic3.png" alt="Card Image" class="card-img-top">
                            </a>
                            <div class="card-body">
                                <h6>YOTAKA HOSTEL</h6>
                                <div class="ex3">สาขานี้ตั้งอยู่ที่ซอยมหาดไทย (รามคำแหง 65 / ลาดพร้าว 122) เป็นโรงแรมที่มีกลิ่นไอความเป็นไทย-ล้านนา ผสมผสานความเป็นโมเดิร์นให้เข้ากับยุคสมัยที่เปลี่ยนไป สงบ สะอาด เหมาะกับการพักผ่อน มีพนักงานให้บริการตลอด 24 ชม. /มีบริการนวดแผนไทย / Free WiFi ให้ทุกท่านได้ใช้บริการตามอัธยาศัย</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 transform-on-hover">
                            <a class="lightbox" href="<?php echo base_url(); ?>assets/img/pic4.png">
                                <img src="<?php echo base_url(); ?>assets/img/pic4.png" alt="Card Image" class="card-img-top">
                            </a>
                            <div class="card-body">
                                <h6>YOTAKA @PAI</h6>
                                <div class="ex3">สาขานี้ตั้งอยู่ที่ซอยมหาดไทย (รามคำแหง 65 / ลาดพร้าว 122) เป็นโรงแรมที่มีกลิ่นไอความเป็นไทย-ล้านนา ผสมผสานความเป็นโมเดิร์นให้เข้ากับยุคสมัยที่เปลี่ยนไป สงบ สะอาด เหมาะกับการพักผ่อน มีพนักงานให้บริการตลอด 24 ชม. /มีบริการนวดแผนไทย / Free WiFi ให้ทุกท่านได้ใช้บริการตามอัธยาศัย</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 transform-on-hover">
                            <a class="lightbox" href="<?php echo base_url(); ?>assets/img/pic5.png">
                                <img src="<?php echo base_url(); ?>assets/img/pic5.png" alt="Card Image" class="card-img-top">
                            </a>
                            <div class="card-body">
                                <h6>YOTAKA @SONGKLA</h6>
                                <div class="ex3">สาขานี้ตั้งอยู่ที่ซอยมหาดไทย (รามคำแหง 65 / ลาดพร้าว 122) เป็นโรงแรมที่มีกลิ่นไอความเป็นไทย-ล้านนา ผสมผสานความเป็นโมเดิร์นให้เข้ากับยุคสมัยที่เปลี่ยนไป สงบ สะอาด เหมาะกับการพักผ่อน มีพนักงานให้บริการตลอด 24 ชม. /มีบริการนวดแผนไทย / Free WiFi ให้ทุกท่านได้ใช้บริการตามอัธยาศัย</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 transform-on-hover">
                            <a class="lightbox" href="<?php echo base_url(); ?>assets/img/pic6.png">
                                <img src="<?php echo base_url(); ?>assets/img/pic6.png" alt="Card Image" class="card-img-top">
                            </a>
                            <div class="card-body">
                                <h6>GOLDEN TRIANGLE @TACHILEIK</h6>
                                <div class="ex3">สาขานี้ตั้งอยู่ที่ซอยมหาดไทย (รามคำแหง 65 / ลาดพร้าว 122) เป็นโรงแรมที่มีกลิ่นไอความเป็นไทย-ล้านนา ผสมผสานความเป็นโมเดิร์นให้เข้ากับยุคสมัยที่เปลี่ยนไป สงบ สะอาด เหมาะกับการพักผ่อน มีพนักงานให้บริการตลอด 24 ชม. /มีบริการนวดแผนไทย / Free WiFi ให้ทุกท่านได้ใช้บริการตามอัธยาศัย</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <hr class="style11">
        <div class="col-md-12" style="text-align: center; margin-bottom: 25px" >
            <h1 class="h1-responsive" style="color: #313A45">GALLERY</h1>
        </div>
        <div class="container">
            <div class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-sm"><img class="d-block w-100" src="<?php echo base_url(); ?>assets/img/pic1.png" alt="2 slide"></div>
                            <div class="col-sm"><img class="d-block w-100" src="<?php echo base_url(); ?>assets/img/pic2.png" alt="2 slide"></div>
                            <div class="col-sm"><img class="d-block w-100" src="<?php echo base_url(); ?>assets/img/pic3.png" alt="3 slide"></div>
                            <div class="col-sm"><img class="d-block w-100" src="<?php echo base_url(); ?>assets/img/pic4.png" alt="4 slide"></div>
                            <div class="col-sm"><img class="d-block w-100" src="<?php echo base_url(); ?>assets/img/pic5.png" alt="5 slide"></div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row">
                            <div class="col-sm"><img class="d-block w-100" src="<?php echo base_url(); ?>assets/img/pic5.png" alt="4 slide"></div>
                            <div class="col-sm"><img class="d-block w-100" src="<?php echo base_url(); ?>assets/img/pic4.png" alt="5 slide"></div>
                            <div class="col-sm"><img class="d-block w-100" src="<?php echo base_url(); ?>assets/img/pic3.png" alt="6 slide"></div>
                            <div class="col-sm"><img class="d-block w-100" src="<?php echo base_url(); ?>assets/img/pic2.png" alt="4 slide"></div>
                            <div class="col-sm"><img class="d-block w-100" src="<?php echo base_url(); ?>assets/img/pic1.png" alt="5 slide"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php echo $footer; ?>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
        <script>
            baguetteBox.run('.cards-gallery', {animation: 'slideIn'});
        </script>

        <script>
          function chk_booking(){
            var test = <?php echo (isset($_SESSION['isLoggedIn']))?$_SESSION['isLoggedIn']:'0'?>;

            if (test == 1) {                
                var CBKbdaterange = document.getElementById("CBKbdaterange").value;
                var CBKbrhid = document.getElementById("CBKbrhid").value;
                var CBKdode = document.getElementById("CBKdode").value;
                var CBKnote = document.getElementById("CBKnote").value;
                var dtstart = CBKbdaterange.substring(0, 10);
                var dtend = CBKbdaterange.substring(13, 23);
                
                if (CBKbrhid == '' || CBKbrhid == null) {
                    alert("Please select branch");
                    return false;
                }
                
                if (dtstart.localeCompare(dtend) == 0) {
                    alert("Date is compare");
                    return false;
                }

                var CBKromtype = document.getElementById("CBKromtype").value;                
                
                if (CBKromtype != 99) {
                    $.ajax({
                        type: "GET",
                        url: "<?php echo base_url(); ?>chkpromotion",
                        data:{POMpcode:CBKdode, POMstartDT:dtstart, POMendDT:dtend, POMbrhid:CBKbrhid},
                        success: function (data) {
                            var x = JSON.parse(data);
                            // console.log(x.POMid);                            
                            if (x.POMid != null) {
                                // alert("This code is compatible.");
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url(); ?>sbookingbycus",
                                    data:{
                                        CBKbdaterange:CBKbdaterange,
                                        CBKbrhid:CBKbrhid,
                                        CBKdode:CBKdode,
                                        CBKromtype:CBKromtype,
                                        CBKnote:CBKnote,
                                        CBKpomid:x.POMid
                                        },
                                    success: function (data) {
                                        console.log(data);
                                        window.open('<?php echo base_url(); ?>sbookingbycuspdf/'  + data);
                                        window.location.reload(true);
                                    },
                                    error: function (err) {
                                        console.log(err);
                                        console.log('ccccccccccccc');
                                    } 
                                });
                            } else {                                
                                if (confirm("This code is not compatible. Want to check again?")) {
                                    return false;
                                } else {
                                    $.ajax({
                                        type: "GET",
                                        url: "<?php echo base_url(); ?>sbookingbycus",
                                        data:{
                                            CBKbdaterange:CBKbdaterange,
                                            CBKbrhid:CBKbrhid,
                                            CBKdode:CBKdode,
                                            CBKromtype:CBKromtype,
                                            CBKnote:CBKnote,
                                            CBKpomid:''
                                            },
                                        success: function (data) {
                                            console.log(data);
                                            window.open('<?php echo base_url(); ?>sbookingbycuspdf/'  + data);
                                            window.location.reload(true);
                                        },
                                        error: function (err) {
                                            console.log(err);
                                            console.log('ccccccccccccc');
                                        } 
                                    });
                                }
                            }
                        },
                        error: function (err) {
                            console.log(err);
                            console.log('ccccccccccccc');
                        } 
                    });
                } else {
                    alert("No room available");
                }

            }else {
              $("#myModalLogin").modal("show");
            }
          }

          //onkeypress="return numberOnly(event);"
              function numberOnly(evt){
                  var charCode = (evt.which) ? evt.which : evt.keyCode
                  return !(charCode > 31 && (charCode < 48 || charCode > 57));
              }

        </script>

        <?php echo $endpage; ?>

    </body>
</html>
