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
// $ci =& get_instance();
// $ci->lang->load($_COOKIE['lang'], $_COOKIE['lang']);
//echo '<pre>';
//print_r($_SESSION);
//
//echo '</pre>';
//exit();
?>

<style>
.vertical-menu {
  width: auto;
  /* height: 150px; */
  overflow-y: auto;
}

/* .vertical-menu a {
  background-color: #eee;
  color: black;
  display: block;
  padding: 12px;
  text-decoration: none;
}

.vertical-menu a:hover {
  background-color: #ccc;
}

.vertical-menu a.active {
  background-color: #4CAF50;
  color: white;
} */
</style>

<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="<?php echo base_url(); ?>empmain/M1101">Yotaka System</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse " id="navbarResponsive">

        <ul class="navbar-nav navbar-sidenav vertical-menu" id="exampleAccordion">

        <?php echo $this->lang->line("testt"); ?>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExampleBasic" data-parent="#exampleAccordion">
                    <i class="fa fa-cog" style="font-size:24px"></i>
                    <span class="nav-link-text"><?php echo $this->lang->line("basicinfo"); ?></span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseExampleBasic">
                    <li>
                        <a href="<?php echo base_url(); ?>empmain/M1001"><?php echo $this->lang->line("M1001"); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>empmain/M9001"><?php echo $this->lang->line("M9001"); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>empmain/M2001"><?php echo $this->lang->line("M2001"); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>empmain/M8001"><?php echo $this->lang->line("M8001"); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>empmain/M4001"><?php echo $this->lang->line("M4001"); ?></a>
                    </li>
                </ul>
            </li>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExampleRoomservice" data-parent="#exampleAccordion">
                    <i class="fa fa-cog" style="font-size:24px"></i>
                    <span class="nav-link-text"><?php echo $this->lang->line("roominfo"); ?></span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseExampleRoomservice">
                    <li>
                        <a href="<?php echo base_url(); ?>empmain/M3001"><?php echo $this->lang->line("M3001"); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>empmain/M3002"><?php echo $this->lang->line("M3002"); ?></a>
                    </li>                   
                </ul>
            </li>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExampleMyWeb" data-parent="#exampleAccordion">
                    <i class="fa fa-cog" style="font-size:24px"></i>
                    <span class="nav-link-text"><?php echo $this->lang->line("pageinfo"); ?></span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseExampleMyWeb">
                    <li>
                        <a href="<?php echo base_url(); ?>empmain/M0001"><?php echo $this->lang->line("M0001"); ?></a>
                    </li>            
                    <li>
                        <a href="<?php echo base_url(); ?>empmain/M6001"><?php echo $this->lang->line("M6001"); ?></a>
                    </li>   
                    <li>
                        <a href="<?php echo base_url(); ?>empmain/M5002"><?php echo $this->lang->line("M5002"); ?></a>
                    </li>   
                    <li>
                        <a href="<?php echo base_url(); ?>empmain/M5001"><?php echo $this->lang->line("M5001"); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>empmain/M7001"><?php echo $this->lang->line("M7001"); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>empmain/M7002"><?php echo $this->lang->line("M7002"); ?></a>
                    </li>                    
                </ul>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExampleFront" data-parent="#exampleAccordion">
                    <i class="fa fa-external-link"></i>
                    <span class="nav-link-text"><?php echo $this->lang->line("frontoffice"); ?></span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseExampleFront">
                    <li>
                        <a href="<?php echo base_url(); ?>empmain/M1101"><?php echo $this->lang->line("M1101"); ?></a>
                    </li>
                    <!-- <li>
                        <a href="<?php echo base_url(); ?>empmain/M1102"><?php echo $this->lang->line("M1102"); ?></a>
                    </li> -->
                </ul>
            </li>





            
            <!--  ------------------------------------------------------- Branch Information --------------------------------------------------------------  -->
            <!-- <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePagesSystem" data-parent="#exampleAccordion">
                    <i class="fa fa-cog" style="font-size:24px"></i>
                    <span class="nav-link-text">System Information</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseExamplePagesSystem">
                    <li>
                        <a href="<?php echo base_url(); ?>empmain/M0000">System management</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>empmain/M0001">Slide management</a>
                    </li>
                </ul>
            </li> -->

            <!--  ------------------------------------------------------- Branch Information --------------------------------------------------------------  -->
            <!-- <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePagesBranch" data-parent="#exampleAccordion">
                    <i class="fa fa-bank "></i>
                    <span class="nav-link-text">Branch Information</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseExamplePagesBranch">
                    <li>
                        <a href="<?php echo base_url(); ?>empmain/M1001">Branch management</a>
                    </li>
                </ul>
            </li> -->
            <!--  ------------------------------------------------------- Branch Information --------------------------------------------------------------  -->

            <!--  ------------------------------------------------------- Branch Information --------------------------------------------------------------  -->
            <!-- <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePagesCustomer" data-parent="#exampleAccordion">
                    <i class="fa fa-address-card"></i>
                    <span class="nav-link-text">Customer Information</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseExamplePagesCustomer">
                    <li>
                        <a href="<?php echo base_url(); ?>empmain/M2001">Customer management</a>
                    </li>
                </ul>
            </li> -->
            <!--  ------------------------------------------------------- Branch Information --------------------------------------------------------------  -->

            <!--  ------------------------------------------------------- Room Information --------------------------------------------------------------  -->
            <!-- <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePagesRoom" data-parent="#exampleAccordion">
                    <i class="fa fa-bed"></i>
                    <span class="nav-link-text">Room Information</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseExamplePagesRoom">
                    <li>
                        <a href="<?php echo base_url(); ?>empmain/M3001">Room management</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>empmain/M3002">Accessories management</a>
                    </li>
                </ul>
            </li> -->
            <!--  ------------------------------------------------------- Room Information --------------------------------------------------------------  -->

            <!--  ------------------------------------------------------- Comment Information --------------------------------------------------------------  -->
            <!-- <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePagesComment" data-parent="#exampleAccordion">
                    <i class="fa fa-commenting"></i>
                    <span class="nav-link-text">Comment Information</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseExamplePagesComment">
                    <li>
                        <a href="<?php echo base_url(); ?>empmain/M4001">Comment management</a>
                    </li>
                </ul>
            </li> -->
            <!--  ------------------------------------------------------- Comment Information --------------------------------------------------------------  -->

            <!--  ------------------------------------------------------- Booking Information --------------------------------------------------------------  -->
            <!-- <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePagesBooking" data-parent="#exampleAccordion">
                    <i class="fa fa-object-group"></i>
                    <span class="nav-link-text">Booking Information</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseExamplePagesBooking">
                    <li>
                        <a href="<?php echo base_url(); ?>empmain/M5001">Picture</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>empmain/M5002">Booking user page</a>
                    </li>
                </ul>
            </li> -->
            <!--  ------------------------------------------------------- Booking Information --------------------------------------------------------------  -->

            <!--  ------------------------------------------------------- About as Information --------------------------------------------------------------  -->
            <!-- <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePagesAboutas" data-parent="#exampleAccordion">
                    <i class="fa fa-info-circle"></i>
                    <span class="nav-link-text">About as Information</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseExamplePagesAboutas">
                    <li>
                        <a href="<?php echo base_url(); ?>empmain/M6001">About as user page</a>
                    </li>
                </ul>
            </li> -->
            <!--  ------------------------------------------------------- About as Information --------------------------------------------------------------  -->

            <!--  ------------------------------------------------------- Gallery Information ---------------------------------------------------------------  -->
            <!-- <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePagesGallery" data-parent="#exampleAccordion">
                    <i class="fa fa-photo"></i>
                    <span class="nav-link-text">Gallery Information</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseExamplePagesGallery">
                    <li>
                        <a href="<?php echo base_url(); ?>empmain/M7001">Gallery user page</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>empmain/M7002">Picture</a>
                    </li>
                </ul>
            </li> -->
            <!--  ------------------------------------------------------- Gallery Information ---------------------------------------------------------------  -->

            <!--  ------------------------------------------------------- Gallery Information ---------------------------------------------------------------  -->
            <!-- <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePromotions" data-parent="#exampleAccordion">
                    <i class="fa fa-calendar"></i>
                    <span class="nav-link-text">Promotions Information</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseExamplePromotions">
                    <li>
                        <a href="<?php echo base_url(); ?>empmain/M8001">Promotions management</a>
                    </li>
                </ul>
            </li> -->
            <!--  ------------------------------------------------------- Gallery Information ---------------------------------------------------------------  -->

            <!--  ------------------------------------------------------- Personnel Information ---------------------------------------------------------------  -->
            <!-- <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePersonnel" data-parent="#exampleAccordion">
                    <i class="fa fa-user-circle"></i>
                    <span class="nav-link-text">Personnel Information</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseExamplePersonnel">
                    <li>
                        <a href="<?php echo base_url(); ?>empmain/M9001">Personnel management</a>
                    </li>
                </ul>
            </li> -->
            <!--  ------------------------------------------------------- Personnel Information ---------------------------------------------------------------  -->

            <!--  ------------------------------------------------------- Front Office ---------------------------------------------------------------  -->
            <!-- <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExampleFront" data-parent="#exampleAccordion">
                    <i class="fa fa-external-link"></i>
                    <span class="nav-link-text">Front Office</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseExampleFront">
                    <li>
                        <a href="<?php echo base_url(); ?>empmain/M1101">Booking</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>empmain/M1102">Booking management</a>
                    </li>
                </ul>
            </li> -->
            <!--  ------------------------------------------------------- Front Office ---------------------------------------------------------------  -->
        </ul>


        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-arrow-left"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-envelope"></i>Messages
                    <span class="d-lg-none">Messages
                        <span class="badge badge-pill badge-primary">12 New</span>
                    </span>
                    <span class="indicator text-primary d-none d-lg-block">
                        <i class="fa fa-fw fa-circle"></i>
                    </span>
                </a>
                <div class="dropdown-menu" aria-labelledby="messagesDropdown">
                    <h6 class="dropdown-header">New Messages:</h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        <strong>David Miller</strong>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        <strong>Jane Smith</strong>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        <strong>John Doe</strong>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>
                    </a>ห
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item small" href="#">View all messages</a>
                </div>
            </li> -->
            <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-bell"></i>Alerts
                    <span class="d-lg-none">Alerts
                        <span class="badge badge-pill badge-warning">6 New</span>
                    </span>
                    <span class="indicator text-warning d-none d-lg-block">
                        <i class="fa fa-fw fa-circle"></i>
                    </span>
                </a>
                <div class="dropdown-menu" aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header">New Alerts:</h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        <span class="text-success">
                            <strong>
                                <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
                        </span>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        <span class="text-danger">
                            <strong>
                                <i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>
                        </span>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        <span class="text-success">
                            <strong>
                                <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
                        </span>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item small" href="#">View all alerts</a>
                </div>
            </li> -->
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <!--                <form class="form-inline my-2 my-lg-0 mr-lg-2">
                                    <div class="input-group">
                                        <input class="form-control" type="text" placeholder="Search for...">
                                        <span class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                </form>-->
                <div class="btn-group">


                <button type="button" class="btn btn-warning" onclick="setlanguage(0);">TH</button>
                <button type="button" class="btn btn-danger" onclick="setlanguage(1);">EN</button>


                    <button type="button" class="btn btn-warning">
                        <i class="fa fa-user"></i> &nbsp;&nbsp; <?php echo $_SESSION['fname'] . '  ' . $_SESSION['lname']; ?> &nbsp;&nbsp;
                    </button>
                    <button type="button" class="btn btn-warning dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" >
                    </button>
                    <div class="dropdown-menu">
                        <h5 class="dropdown-header" style="background-color: lightgray"><?php echo $this->lang->line("please_select_language"); ?></h5>
                        <a class="dropdown-item" href="#" onclick="SelectLanguage('en');"><?php echo $this->lang->line("english"); ?></a>
                        <a class="dropdown-item" href="#" onclick="SelectLanguage('th');"><?php echo $this->lang->line("thailand"); ?></a>
                        <a class="dropdown-item disabled" href="#"><?php echo $this->lang->line("chinese"); ?></a>
                        <a class="dropdown-item disabled" href="#"><?php echo $this->lang->line("japanese"); ?></a>
                        <h5 class="dropdown-header" style="background-color: lightgray">User control</h5>
                        <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#myModalProfile"><i class="fa fa-edit"></i><?php echo $this->lang->line("editprofile"); ?></a> -->
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#myModalLogout"><i class="fa fa-fw fa-sign-out"></i><?php echo $this->lang->line("signout"); ?></a>
                    </div>
                </div>
            </li>
            <li class="nav-item">&nbsp;&nbsp;
                <!--                <div class="dropdown dropleft float-left">
                                    <button class="btn my-2 my-sm-0 font-bg" type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown">
                                        <svg id="i-settings" viewBox="0 0 32 32" width="16" height="16" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                        <path d="M13 2 L13 6 11 7 8 4 4 8 7 11 6 13 2 13 2 19 6 19 7 21 4 24 8 28 11 25 13 26 13 30 19 30 19 26 21 25 24 28 28 24 25 21 26 19 30 19 30 13 26 13 25 11 28 8 24 4 21 7 19 6 19 2 Z" />
                                        <circle cx="16" cy="16" r="4" />
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu">
                                        <h1 class="dropdown-header"><?php // echo $this->lang->line("please_select_language");  ?></h1>

                                        <a class="dropdown-item" href="#" onclick="SelectLanguage('en');"><?php // echo $this->lang->line("english");  ?></a>
                                        <a class="dropdown-item" href="#" onclick="SelectLanguage('th');"><?php // echo $this->lang->line("thailand");  ?></a>

                                        <a class="dropdown-item disabled" href="#"><?php // echo $this->lang->line("chinese");  ?></a>
                                        <a class="dropdown-item disabled" href="#"><?php // echo $this->lang->line("japanese");  ?></a>
                                    </div>
                                </div>-->
            </li>
            <li class="nav-item">&nbsp;&nbsp;
                <!--                <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fa fa-fw fa-sign-out"></i>Logout
                                </a>-->
            </li>
        </ul>
    </div>
</nav>

<!-- Logout Modal-->
<div class="modal fade" id="myModalLogout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 999999;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Confirm Logout</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?php echo base_url(); ?>logout">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- The Modal Profile -->
  <div class="modal fade" id="myModalProfile">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Modal Heading</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          Modal body..
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>


<script>
    $(document).ready(function () {
        // show the alert
        setTimeout(function () {
            $(".alert").alert('close');
        }, 2000);

//        var x = document.getElementById("hbtn");
//        if (x.style.display === "none") {
//            x.style.display = "block";
//        } else {
//            x.style.display = "none";
//        }
    });

    function SelectLanguage(lg) {
        document.cookie = "lang=";
        
        switch (lg) {
            case 'en' :
                document.cookie = "lang=english";
                break;
            case 'th' :
                document.cookie = "lang=thailand";
                break;
        }

        location.reload();
    }

    function setlanguage(lg){
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>setlanguage/" + lg,
            success: function (data) {
                // window.location.reload(true);
            },
            error: function (err) {
                console.log(err);
                console.log('ccccccccccccc');
            } 
        });
    }
</script>
