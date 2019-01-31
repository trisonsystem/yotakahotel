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
//  debug($_SESSION);
// exit();
?>

<style>

</style>

<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top font-bg">
        <a class="navbar-brand" href="<?php echo base_url(); ?>HomeControllers"><img class="mx-auto d-block" src="<?php echo base_url(); ?>assets/img/logo2.png" width="50px" height="40px"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link active" href="<?php echo base_url(); ?>HomeControllers" ><?php echo $this->lang->line("home"); ?></a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link active" href="<?php echo base_url(); ?>aboutas" ><?php echo $this->lang->line("aboutas"); ?></a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link active" href="<?php echo base_url(); ?>promotions" ><?php echo $this->lang->line("promotions"); ?></a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link active" href="<?php echo base_url(); ?>booking" ><?php echo $this->lang->line("booking"); ?></a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link active" href="<?php echo base_url(); ?>gallery" ><?php echo $this->lang->line("gallery"); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active " href="<?php echo base_url(); ?>contactus" ><?php echo $this->lang->line("contactus"); ?></a>
                </li>
            </ul>
            <form class="form-inline mt-2 mt-md-0"></form>
                <!--<input class="form-control mr-sm-2" type="text"  placeholder="Search" aria-label="Search">-->
                <button class="btn my-2 my-sm-0 font-bg" type="button" data-toggle="modal" data-target="#myModalLogin" data-backdrop="static" align="right">
                    <svg id="i-user" viewBox="0 0 32 32" width="32" height="32" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                    <path d="M22 11 C22 16 19 20 16 20 13 20 10 16 10 11 10 6 12 3 16 3 20 3 22 6 22 11 Z M4 30 L28 30 C28 21 22 20 16 20 10 20 4 21 4 30 Z" />
                  </svg>
                  <?php
                  if(isset($_SESSION['isLoggedIn'])){
                    echo $_SESSION['fname'] . '  ' . $_SESSION['lname'];
                  }
                  ?>
                </button>
                <div class="dropdown dropleft float-right">
                    <button class="btn my-2 my-sm-0 font-bg" type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown">
                        <svg id="i-settings" viewBox="0 0 32 32" width="32" height="32" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        <path d="M13 2 L13 6 11 7 8 4 4 8 7 11 6 13 2 13 2 19 6 19 7 21 4 24 8 28 11 25 13 26 13 30 19 30 19 26 21 25 24 28 28 24 25 21 26 19 30 19 30 13 26 13 25 11 28 8 24 4 21 7 19 6 19 2 Z" />
                        <circle cx="16" cy="16" r="4" />
                        </svg>
                    </button>
                    <div class="dropdown-menu">
                        <h1 class="dropdown-header"><?php echo $this->lang->line("please_select_language"); ?></h1>
                        <a class="dropdown-item" href="#" onclick="SelectLanguage('en');"><?php echo $this->lang->line("english"); ?></a>
                        <a class="dropdown-item" href="#" onclick="SelectLanguage('th');"><?php echo $this->lang->line("thailand"); ?></a>
                        <a class="dropdown-item disabled" href="#"><?php echo $this->lang->line("chinese"); ?></a>
                        <a class="dropdown-item disabled" href="#"><?php echo $this->lang->line("japanese"); ?></a>
                    </div>
                </div>

        </div>
    </nav>
</header>

<!--<header>
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">Carousel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Disabled</a>
            </li>
          </ul>
          <form class="form-inline mt-2 mt-md-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>
    </header>-->


<!-- Modal Login -->
<div class="modal fade" id="myModalLogin" role="dialog" style="z-index: 99999;">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content font-bg">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $this->lang->line("user"); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <?php if(!isset($_SESSION['isLoggedIn'])): ?>
            <div class="modal-body font-bg2">
                <div class="text-center mb-4">
                    <img class="mb-4" src="<?php echo base_url(); ?>assets/img/logo2.png" alt="" width="172" height="172">
                </div>

                <?php
                $this->load->helper('form');
                $error = $this->session->flashdata('error');
                if ($error) {
                    echo '<div class="alert alert-danger alert-dismissable">';
                    echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
                    echo $error;
                    echo '</div>';
                }
                $success = $this->session->flashdata('success');
                if ($success) {
                    echo '<div class="alert alert-success alert-dismissable">';
                    echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
                    echo $success;
                    echo '</div>';
                }
                ?>

                <form action="<?php echo base_url(); ?>login" method="post">
                    <div class="input-group mb-4" style="margin-top: -25px">
                        <input type="text" class="form-control" id="usr" name="usr" placeholder="<?php echo $this->lang->line("username"); ?>" required autofocus>
                    </div>
                    <div class="input-group mb-4">
                        <input type="password" class="form-control" id="pwd" name="pwd" placeholder="<?php echo $this->lang->line("password"); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-dark btn-lg btn-block"><?php echo $this->lang->line("signin"); ?></button>
                    <div class="form-group" align="center">
                        <button type="button" class="btn btn-link" data-dismiss="modal" data-toggle="modal" data-target="#ModalForgotPassword"><?php echo $this->lang->line("forgot_your_password"); ?></button>
                        |
                        <button type="button" class="btn btn-link"  data-toggle="modal" data-target="#ModalRegis"> <?php echo $this->lang->line("register"); ?></button>
                    </div>
                </form>

            </div>
          <?php else: ?>
            <div class="modal-body font-bg2">
              <div class="form-group" align="center">
                <img src="<?php echo base_url(); ?>assets/img/logo2.png" class="rounded-circle" alt="Cinque Terre" width="172" height="172">
              </div>
              <div class="form-group" align="center">
                <label for="uname"><h1><b>Welcome</b></h1></label><br />
                <label for="uname"><b><?php echo $_SESSION['fname'] . '  ' . $_SESSION['lname'] ?></b></label>
              </div>
              <div class="form-group" align="center">
                  <button type="button" class="btn btn-link" data-dismiss="modal" data-toggle="modal" data-target="#ModalResetPassword">เปลี่ยนรหัสผ่าน</button>
                  |
                  <button type="button" class="btn btn-link" onclick="open_logout();"> ออกจากระบบ</button>
              </div>
            </div>
          <?php endif; ?>
            <div class="modal-footer font-bg">
                <button type="button" class="btn" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
            </div>
        </div>

    </div>
</div>

<!-- Forgot your password -->
<div class="modal fade" id="ModalForgotPassword" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <form method="post" action="<?php base_url(); ?>forgotpassword">
            <div class="modal-content font-bg">
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo $this->lang->line("forgot_your_password"); ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body font-bg2">
                    <label for="demo"><?php echo $this->lang->line("write_your_email_here"); ?>:</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="email@example.com" id="demo" name="email">
                    </div>
                </div>
                <div class="modal-footer font-bg2">
                    <div id="hbtn">
                        <button type="submit" class="btn btn-success" name="bftsave" id="bftsave" value="save"><?php echo $this->lang->line("continue"); ?></button>
                    </div>
                    <button type="button" class="btn font-bg" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Reset your password -->
<div class="modal fade" id="ModalResetPassword" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <!-- <form method="post" action="<?php base_url(); ?>resetpassword"> -->
          <form name="from_aboutas"enctype="multipart/form-data" id="from_aboutas">
            <div class="modal-content font-bg">
                <div class="modal-header">
                    <h4 class="modal-title">เปลี่ยนรหัสผ่าน</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body font-bg2">
                  <div class="form-group">
                    <label for="pwd">Old password:</label>
                    <input type="password" class="form-control" id="ocpass" name="ocpass">
                  </div>
                  <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" id="cpass" name="cpass">
                  </div>
                  <div class="form-group">
                    <label for="pwd">Confirm Password:</label>
                    <input type="password" class="form-control" id="cfpass" name="cfpass">
                  </div>
                </div>
                <div class="modal-footer font-bg2">
                    <!-- <div id="hbtn"> -->
                    <input type="text" class="form-control" id="cid" name="cid" value="<?php echo $_SESSION['id']; ?>">
                    <button type="button" class="btn btn-success" name="xbftsave" id="xbftsave" value="save" onclick="return rValidate()"><?php echo $this->lang->line("continue"); ?></button>
                    <!-- </div> -->
                    <button type="button" class="btn font-bg" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Regis  -->
<!-- The Modal -->
<div class="modal" id="ModalRegis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" >
    <div class="modal-dialog" role="document">
        <div class="modal-content font-bg">

            <form method="post" action="<?php base_url(); ?>cusregister">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo $this->lang->line("regisheading"); ?></h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body font-bg2">

                    <div class="form-group">
                        <label for="CUSidc"><?php echo $this->lang->line("idcard"); ?> :</label>
                        <input type="text" class="form-control" id="CUSidc" name="CUSidc" required>
                    </div>
                    <div class="form-group ">
                        <label for="CUStitle"><?php echo $this->lang->line("titlename"); ?> :</label>
                        <select class="form-control" id="CUStitle" name="CUStitle">
                            <?php
                            foreach ($title as $key => $value) {
                                echo '<option value ="' . $value['USCcode'] . '">' . $value['USCdesc' . $sl] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="CUSfname"><?php echo $this->lang->line("fristname"); ?> :</label>
                        <input type="text" class="form-control" id="CUSfname" name="CUSfname" required>
                    </div>
                    <div class="form-group">
                        <label for="CUSlname"><?php echo $this->lang->line("lastname"); ?> :</label>
                        <input type="text" class="form-control" id="CUSlname" name="CUSlname" required>
                    </div>
                    <div class="form-group">
                        <label for="CUSadr"><?php echo $this->lang->line("address"); ?> :</label>
                        <textarea class="form-control" rows="2" id="CUSadr" name="CUSadr" required></textarea>
                    </div>
                    <div class="form-group" >
                        <label for="CUSbday"><?php echo $this->lang->line("brithday"); ?> :</label>
                        <input type="date" class="form-control" name="CUSbday" min="1000-01-01" max="3000-12-31" id="CUSbday" name="CUSbday" required>
                    </div>
                    <div class="form-group">
                        <label for="CUSnphone"><?php echo $this->lang->line("phonenumber"); ?> :</label>
                        <input type="text" class="form-control" id="CUSnphone" name="CUSnphone" onkeypress="return numberOnly(event);">
                    </div>
                    <div class="form-group">
                        <label for="CUSemail"><?php echo $this->lang->line("email"); ?> :</label>
                        <input type="text" class="form-control" id="CUSemail" name="CUSemail" required>
                    </div>
                    <div class="form-group">
                        <label for="CUSuname"><?php echo $this->lang->line("user"); ?> :</label>
                        <input type="text" class="form-control" id="CUSuname" name="CUSuname" required>
                    </div>
                    <div class="form-group">
                        <label for="CUSpawo"><?php echo $this->lang->line("password"); ?> :</label>
                        <input type="password" class="form-control" id="CUSpawo" name="CUSpawo" required>
                    </div>
                    <div class="form-group">
                        <label for="CUSconfpass"><?php echo $this->lang->line("confirmpassword"); ?> :</label>
                        <input type="password" class="form-control" id="CUSconfpass" name="CUSconfpass" required>
                    </div>
                    <div class="form-group">
                      <span id='message'></span>
                    </div>
                    <input type="hidden" class="form-control" id="CUSmychk" name="CUStabid" value="101000">
                </div>

                <!-- Modal footer -->
                <div class="modal-footer font-bg2">
                    <button type="submit" class="btn btn-success" name="bt_save" id="btsave" value="save" onclick="return Validate()"><?php echo $this->lang->line("save"); ?></button>
                    <button type="button" class="btn font-bg" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Logout Modal-->
<div class="modal fade" id="myModalLogout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Logout</h5>
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



<script>
    $(document).ready(function () {
        // show the alert
        setTimeout(function () {
            $(".alert").alert('close');
        }, 2000);
    });

    function Validate() {
        var password = document.getElementById("CUSpawo").value;
        var confirmPassword = document.getElementById("CUSconfpass").value;
        if (password != confirmPassword) {
            alert("Passwords do not match.");
            return false;
        }

        return true;
    }

    function rValidate(){
      var formData = new FormData();

      var password = document.getElementById("cpass").value;
      var confirmPassword = document.getElementById("cfpass").value;
      if (password != confirmPassword) {
          alert("Passwords do not match.");
          return false;
      }

      formData.append('cid', $('#cid').val());
      formData.append('ocpass', $('#ocpass').val());
      formData.append('cpass', $('#cpass').val());
      formData.append('cfpass', $('#cfpass').val());

      $.ajax({
          url: "<?php echo base_url(); ?>resetpassword",
          type: 'POST',
          data: formData,
          cache: false,
          processData: false, // tell jQuery not to process the data
          contentType: false, // tell jQuery not to set contentType
          enctype: 'multipart/form-data',
          success: function (data)
          {
              console.log(typeof data.error);
              if (typeof data.error === 'undefined')
              {
                  // Success so call function to process the form
                  console.log('SUCCESS: ' + data.success);
                  window.location.reload(true);
              } else {
                  // Handle errors here
                  console.log('ERRORS: ' + data.error);
              }
          },
          error: function (errorThrown)
          {
              // Handle errors here
              console.log('ERRORS: ');
          },
          complete: function ()
          {
              // STOP LOADING SPINNER
          }
      });
      // return true;
    }

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

    function open_logout(){
        $("#myModalLogin").modal("hide");
        $("#myModalLogout").modal("show");
    }
</script>
