
<?php
if (!isset($_COOKIE["lang"])) {
    $lg = $lang;
} else {
    $lg = $_COOKIE["lang"];
}

if ($lg == 'thailand') {
    $sl = 'TH';
} else {
    $sl = 'EN';
}

?>
<style>
.open-button {
  background-color: #ff4d4d;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
  z-index: 20;
}
</style>

<!-- Footer -->
<footer class="page-footer font-small blue-grey lighten-5 mt-4 font-bg">

    <div style="background-color: #313A45;">
        <div class="container ">

            <!-- Grid row-->
            <div class="row py-4 d-flex align-items-center">

            </div>
            <!-- Grid row-->

        </div>
    </div>

    <!-- Footer Links -->
    <div class="container text-center text-md-left mt-5 font-bg">

        <!-- Grid row -->
        <div class="row mt-3 dark-grey-text">

            <!-- Grid column -->
            <div class="col-md-3 col-lg-4 col-xl-3 mb-4">

                <img src="<?php echo base_url(); ?>assets/img/logo2.png" alt="logo" style="width: 100%; height: auto; position: relative;">

            </div>
            <!-- Grid column -->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

                <!-- Links -->
                <h6 class="text-uppercase font-weight-bold"><?php echo $this->lang->line("contact"); ?></h6>
                <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                <p>
                    <img src="<?php echo base_url(); ?>assets/img/iconn-07.png" alt="logo" style="width:20px;">
                    </i><?php echo $this->lang->line("yotaka_adr"); ?></p>
                <p>
                    <img src="<?php echo base_url(); ?>assets/img/iconn-08.png" alt="logo" style="width:20px;">
                    02-9342720</p>
                <p>
                    <img src="<?php echo base_url(); ?>assets/img/iconn-05.png" alt="logo" style="width:20px;">
                    yotakagroup_hotel@hotmail.com</p>

            </div>
            <!-- Grid column -->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">

                <!-- Links -->
                <h6 class="text-uppercase font-weight-bold"><?php echo $this->lang->line("about"); ?></h6>
                <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                <p>
                    <a class="dark-grey-text" style="color: white"  href="<?php echo base_url(); ?>HomeControllers"><?php echo $this->lang->line("home"); ?></a>
                </p>
                <p>
                    <a class="dark-grey-text" style="color: white" href="<?php echo base_url(); ?>aboutas"><?php echo $this->lang->line("aboutas"); ?></a>
                </p>
                <!-- <p>
                    <a class="dark-grey-text" style="color: white" href="<?php echo base_url(); ?>promotions" ><?php echo $this->lang->line("promotions"); ?></a>
                </p> -->
                <p>
                    <a class="dark-grey-text" style="color: white" href="<?php echo base_url(); ?>booking" ><?php echo $this->lang->line("booking"); ?></a>
                </p>
                <p>
                    <a class="dark-grey-text" style="color: white" href="<?php echo base_url(); ?>gallery"><?php echo $this->lang->line("gallery"); ?></a>
                </p>
                <p>
                    <a class="dark-grey-text" style="color: white" href="<?php echo base_url(); ?>contactus"><?php echo $this->lang->line("contactus"); ?></a>
                </p>

            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

                <!-- Links -->
                <h6 class="text-uppercase font-weight-bold"><?php echo $this->lang->line("usefullinks"); ?></h6>
                <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                <p>
                    <a href="https://www.facebook.com/yotaka122/" class="dark-grey-text" style="color:white;">FACEBOOK</a>
                </p>
                <div class="dash12" id="dash12">

                                </div>
                <!-- <p>
                    <a href="https://www.traveloka.com" class="dark-grey-text">Traveloka</a>
                </p>
                <p>
                    <a href="https://www.expedia.co.th" class="dark-grey-text">Expedia</a>
                </p> -->
<!--                <p>
                    <a class="dark-grey-text">Help</a>
                </p>-->

            </div>
            <!-- Grid column -->

            <!-- Grid column -->

            <!-- Grid column -->

        </div>
        <!-- Grid row -->

    </div>
    <!-- Footer Links -->

    <!-- Copyright -->
    <div class="footer-copyright text-center text-white-50 py-6" >
        <div style="background-color: #000000; height: 80px; "><br>©2018 © YOTAKA GROUP.ALL RIGHT RESAVED.</div>
    </div>
    <!-- Copyright -->

</footer>

<script>
// function openForm() {
//     document.getElementById("myForm").style.display = "block";
// }

// function closeForm() {
//     document.getElementById("myForm").style.display = "none";
// }
</script>



