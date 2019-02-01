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
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


<style>
.sidebar {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 55px;
  right: 0;
  background-color: #111;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidebar a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidebar a:hover {
  color: #f1f1f1;
}

.sidebar .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

.openbtn {
  font-size: 20px;
  cursor: pointer;
  background-color: #111;
  color: white;
  padding: 10px 15px;
  border: none;
}

.openbtn:hover {
  background-color: #444;
}

#main {
  transition: margin-left .5s;
  padding: 16px;
}

/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
@media screen and (max-height: 450px) {
  .sidebar {padding-top: 15px;}
  .sidebar a {font-size: 18px;}
}
</style>

<div id="mySidebar" class="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <form name="from_addfbooking"enctype="multipart/form-data" id="from_addfbooking">
        <div class="dash" id="dash"></div>
        <div class="container">
            <div class="form-group">
                <label for="sel1" style="color:#ffffff"><?php echo $this->lang->line("bookingdate"); ?>:</label>
                <input class="form-control" type="text" id="bdaterange" name="bdaterange" value="<?php date("Y/m/d") ." - " . date("Y/m/d"); ?>" />
            </div>
            <div class="form-group">
                <label for="BOKnote" style="color:#ffffff">Comment:</label>
                <textarea class="form-control" rows="3" id="BOKnote" name="BOKnote"></textarea>
            </div>
            <div class="form-group" id="hbt" style="display:none">
                <button type="button" class="btn btn-primary btn-block" onclick="savebooking()">Booking</button>
            </div>
        </div>    
    </form>
</div>

<div id="mySidebar_sta0" class="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <form name="from_bookingsta0"enctype="multipart/form-data" id="from_bookingsta0">
        <div class="dash2" id="dash2" ></div>
        
    </form>
</div>

<div id="mySidebar_sta1" class="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <form name="from_bookingsta1"enctype="multipart/form-data" id="from_bookingsta1">
        <div class="dash3" id="dash3" ></div>
        
    </form>
</div>

<div id="main">
    <?php // debug($rooms) 
    ?>
    
    <table class='table table-bordered'>    
        <tbody>
            <?php
            if(isset($rooms)):
                $crroom = count($rooms);
                
                for ($row = 0; $row < $crroom / 4; $row ++) {
            ?>
            <tr>
                <?php
                for ($col = 0; $col <= 3; $col ++) {
                    if (isset($rooms[($col + ($row * 4))]['ROMno'])) {
                ?>

                <td width="25%">
                    <?php 
                        switch ($rooms[($col + ($row * 4))]['roomstatus']['BOKsta']) {
                            case '0':
                                $bstr = 'btn-primary';
                                break;
                            
                            case '1':
                                $bstr = 'btn-success';
                                break;

                            case '2':
                                $bstr = 'btn-warning';
                                break;

                            default:
                                $bstr = '';
                                break;
                        }

                        if ($rooms[($col + ($row * 4))]['roomstatus']['BOKid'] == null) {
                            $bid = 99;
                        } else {
                            $bid = $rooms[($col + ($row * 4))]['roomstatus']['BOKid'];
                        }

                        if ($rooms[($col + ($row * 4))]['roomstatus']['BOKsta'] == null) {
                            $sta = 99;
                        } else {
                            $sta = $rooms[($col + ($row * 4))]['roomstatus']['BOKsta'];
                        }
                        
                    ?>                    
                    <button type="button" class="btn <?php echo($bstr); ?> btn-block" onclick="openNav(<?php echo $bid ?>, <?php echo $sta ?>, <?php  echo $rooms[($col + ($row * 4))]['ROMid'] ?>)"><?php  echo $rooms[($col + ($row * 4))]['ROMno'] ?></button>
                    <div align="center">
                    <?php 
                    if ($rooms[($col + ($row * 4))]['roomstatus']['BOKsta'] < 3 && $rooms[($col + ($row * 4))]['roomstatus']['BOKsta'] != null) {
                        echo 'คุณ  ' . $rooms[($col + ($row * 4))]['roomstatus']['customer']['CUSfname'] . '  ' . $rooms[($col + ($row * 4))]['roomstatus']['customer']['CUSlname'];
                    }                    
                    ?>
                    </div>
                </td>
                <?php 
                    }
                }
                ?>
            </tr>      
            <?php 
                }
            endif;
            ?>
        </tbody>
    </table>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4" >
                <button type="button" class="btn btn-primary btn-block"><?php echo $this->lang->line("bookings"); ?></button><br>
                <button type="button" class="btn btn-success btn-block" onclick="test(24)">Checkin</button><br>
                <button type="button" class="btn btn-warning btn-block"><?php echo $this->lang->line("cleaning"); ?></button><br>
                <button type="button" class="btn btn-block">สามารถทำรายการได้</button>
            </div>
            <div class="col-sm-8" >
                <?php if(isset($cusbill)): ?>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th><?php echo $this->lang->line("no"); ?></th>
                        <th><?php echo $this->lang->line("fristname"); ?></th>
                        <th><?php echo $this->lang->line("roomamount"); ?></th>
                        <th><?php echo $this->lang->line("pirnt"); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($cusbill as $ckey => $cvalue):
                    ?>
                    <tr>
                        <td><?php echo $ckey + 1 ?></td>
                        <td><?php echo $cvalue['customer']['CUSfname'] . '  ' . $cvalue['customer']['CUSlname'] ?></td>
                        <td><?php  echo $cvalue['BOKromcount'] ?></td>
                        <td>
                            <button type="button" class="btn btn-danger btn-block btn-sm" onclick="showmodalprint(<?php echo $cvalue['customer']['CUSid'] ?>);"><i class="fa fa-print"></i></button>                        
                        </td>
                    </tr>            
                    <?php
                    endforeach;
                    ?>        
                    </tbody>
                </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- The Add Modal -->
<div class="modal fade" id="AddCustomerModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form name="from_customerhmanagement"enctype="multipart/form-data" id="from_customerhmanagement">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo $this->lang->line("customomerhead"); ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="CUSidc"><?php echo $this->lang->line("idcard"); ?>:</label>
                        <input type="text"  class="form-control" id="CUSidc" name="CUSidc" required>
                    </div>
                    <div class="form-group">
                        <label for="CUStitle"><?php echo $this->lang->line("titlename"); ?>:</label>
                        <select class="form-control" id="CUStitle" name="CUStitle" required>
                            <?php foreach ($titlename as $titlekey => $titlevalue): ?>
                                <option value="<?php echo $titlevalue['USCcode']; ?>"><?php echo $titlevalue['USCdesc' . $sl]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="CUSfname"><?php echo $this->lang->line("fristname"); ?>:</label>
                        <input type="text" class="form-control" id="CUSfname" name="CUSfname" required>
                    </div>
                    <div class="form-group">
                        <label for="CUSlname"><?php echo $this->lang->line("lastname"); ?>:</label>
                        <input type="text" class="form-control" id="CUSlname" name="CUSlname" required>
                    </div>
                    <div class="form-group">
                        <label for="CUSadr"><?php echo $this->lang->line("address"); ?>:</label>
                        <textarea class="form-control" rows="3" id="CUSadr" name="CUSadr" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="CUSzipc"><?php echo $this->lang->line("zipcode"); ?>:</label>
                        <input type="text" class="form-control" id="CUSzipc" name="CUSzipc" onkeypress="return numberOnly(event);" required>
                    </div>
                    <!-- <div class="form-group">
                        <label for="CUSzipc"><?php echo $this->lang->line("zipcode"); ?>:</label>
                        <input type="text" class="form-control" id="CUSzipc" name="CUSzipc" value="57110" required>
                    </div> -->
                    <div class="form-group">
                        <label for="CUSbday"><?php echo $this->lang->line("brithday"); ?>:</label>
                        <input type="date" class="form-control" id="CUSbday" name="CUSbday" min="1000-01-01" max="3000-12-31" >
                    </div>
                    <div class="form-group">
                        <label for="CUSemail"><?php echo $this->lang->line("email"); ?>:</label>
                        <input type="text" class="form-control" id="CUSemail" name="CUSemail" required>
                    </div>
                    <div class="form-group">
                        <label for="CUSnphone"><?php echo $this->lang->line("phonenumber"); ?>:</label>
                        <input type="text" class="form-control" id="CUSnphone" name="CUSnphone" onkeypress="return numberOnly(event);" required>
                    </div>
                    <div class="form-group">
                        <label for="CUStype"><?php echo $this->lang->line("customomertype"); ?>:</label>
                        <select class="form-control" id="CUStype" name="CUStype" required>
                            <?php foreach ($custype as $custypekey => $custypevalue): ?>
                                <option value="<?php echo $custypevalue['USCcode']; ?>"><?php echo $custypevalue['USCdesc' . $sl]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="CUSbrhid" name="CUSbrhid" value="<?php echo $mysession['id']; ?>" >
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="save_customer();"><?php echo $this->lang->line("save"); ?></button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- The showCusto -->
<div class="modal fade" id="showCusto">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!--Modal Header-->
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $this->lang->line("customomerhead"); ?></h4>
                <span id="xid" style="color: #ffffff"></span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="dash1" id="dash1">

            </div>
        </div>
    </div>
</div>

<!-- The hardWareModal Modal -->
<div class="modal fade" id="hardWareModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!--Modal Header-->
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $this->lang->line("insertequipment"); ?></h4>
                <span id="xid" style="color: #ffffff"></span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="dash4" id="dash4">

            </div>
        </div>
    </div>
</div>

<!-- The minibarModal Modal -->
<div class="modal fade" id="minibarModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!--Modal Header-->
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $this->lang->line("insertminibar"); ?></h4>
                <span id="xid" style="color: #ffffff"></span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="dash5" id="dash5">

            </div>
        </div>
    </div>
</div>

<!-- The billModal Modal -->
<div class="modal fade" id="billModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!--Modal Header-->
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $this->lang->line("pirnt"); ?></h4>
                <span id="xid" style="color: #ffffff"></span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form name="from_minibar"enctype="multipart/form-data" id="from_minibar">
                <div class="dash6" id="dash6">

                </div>
                <div class="dash7" id="dash7">

                </div>

                
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {        
        $('#showCusto').on('shown.bs.modal', function () {
            var id = $("#xid").html();
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>showcusidc/" + id + "?param=true",
                success: function (data) {
                    $("#dash1").html(data);
                },
                error: function (err) {
                    console.log(err);
                }
            });
        });

        $('#minibarModal').on('shown.bs.modal', function () {
            var id = $("#xid").html();
            
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>showminibar/" + id + "?param=true",
                success: function (data) {
                    $("#dash5").html(data);
                },
                error: function (err) {
                    console.log(err);
                }
            });
        });

        $('#hardWareModal').on('shown.bs.modal', function () {
            var id = $("#xid").html();
            
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>showhardware/" + id + "?param=true",
                success: function (data) {
                    $("#dash4").html(data);
                },
                error: function (err) {
                    console.log(err);
                }
            });
        });

        $('#billModal').on('shown.bs.modal', function () {
            var id = $("#xid").html();
            
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>showbillcheckout/" + id + "?param=true",
                success: function (data) {
                    $("#dash6").html(data);
                },
                error: function (err) {
                    console.log(err);
                }
            });
        });
    });

    $('input[name="bdaterange"]').daterangepicker({
        opens: 'left',
        minDate: new Date()
    }, function(start, end, label) {
        console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    });

    function openNav(boid, sta, id) {
        closeNav();
        
        switch (sta) {
            case 0: 
                $( "body" ).addClass( "sidenav-toggled" );
                document.getElementById("mySidebar_sta0").style.width = "450px";
                document.getElementById("main").style.marginRight = "450px";
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url(); ?>getroomsbycus/" + boid,
                    success: function (data) {
                        $("#dash2").html(data);
                    },
                    error: function (err) {
                        console.log(err);
                        console.log('ccccccccccccc');
                    } 
                });

                break;

            case 1:
                $( "body" ).addClass( "sidenav-toggled" );
                document.getElementById("mySidebar_sta1").style.width = "450px";
                document.getElementById("main").style.marginRight = "450px";
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url(); ?>getroomtocheckout/" + boid,
                    success: function (data) {
                        $("#dash3").html(data);
                    },
                    error: function (err) {
                        console.log(err);
                        console.log('ccccccccccccc');
                    } 
                });

                break;

            case 2:
                if (confirm("Cleaned successfully ?")) {
                    $.ajax({
                    type: "GET",
                    url: "<?php echo base_url(); ?>scleaned/" + boid,
                    success: function (data) {
                        window.location.reload(true);
                    },
                    error: function (err) {
                        console.log(err);
                        console.log('ccccccccccccc');
                    } 
                });
                }

                break;
        
            default:
                $( "body" ).addClass( "sidenav-toggled" );
                document.getElementById("mySidebar").style.width = "450px";
                document.getElementById("main").style.marginRight = "450px";
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url(); ?>getroomsbyid/" + id,
                    success: function (data) {
                        $("#dash").html(data);
                    },
                    error: function (err) {
                        console.log(err);
                        console.log('ccccccccccccc');
                    } 
                });

                break;
        }    
    }

    function searchidc(){
        var str = document.getElementById("ROMidc").value;
        // console.log(str);
        
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>searchidc/" + str,
            success: function (data) {
                // console.log(data);
                
                if (data == 1) {
                    var xid = str;
                    $("#xid").html(xid);
                    $("#showCusto").modal("show");
                } else {
                    if (confirm("No data. Do you want insert data")) {
                        $("#AddCustomerModal").modal("show");
                    } 
                }           
            },
            error: function (err) {
                console.log(err);
                console.log('ccccccccccccc');
            } 
        });            
    }

    function save_customer(){
        var formData = new FormData();

        var c = 0;
        var elem = document.getElementById('from_customerhmanagement').elements;
        for (var i = 0; i < elem.length; i++) {

            if (elem[i].value.length == 0 && elem[i].type != "button") {
                // console.log(elem[i].id + ' == ' + elem[i].type);
                alert('Please Enter a Value ');
                document.getElementById(elem[i].id).style.backgroundColor = "#F8E6E0";
                c = c + 1;
            }
            else{
                if(elem[i].type != "button" && elem[i].type != "select"){
                    document.getElementById(elem[i].id).style.backgroundColor = "#FFFFFF";
                }
            }
        }

        if(c > 0){
            console.log('false');
            return false;
        }

        //            formData.append("BRHpic", $('#BRHpic')[0].files[0]);
        //            formData.append('BRHcode', $('#BRHcode').val());

        formData.append('CUSidc', $('#CUSidc').val());
        formData.append('CUStitle', $('#CUStitle').val());
        formData.append('CUSfname', $('#CUSfname').val());
        formData.append('CUSlname', $('#CUSlname').val());
        formData.append('CUSadr', $('#CUSadr').val());
        formData.append('CUSzipc', $('#CUSzipc').val());
        formData.append('CUSbday', $('#CUSbday').val());
        formData.append('CUSemail', $('#CUSemail').val());
        formData.append('CUSnphone', $('#CUSnphone').val());
        //            formData.append('CUSuname', $('#CUSuname').val());
        //            formData.append('CUSpawo', $('#CUSpawo').val());
        formData.append('CUSbrhid', $('#CUSbrhid').val());
        formData.append('CUStype', $('#CUStype').val());

        $.ajax({
            url: "<?php echo base_url(); ?>savecustomer",
            type: 'POST',
            data: formData,
            cache: false,
            //            dataType: 'json',
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
                    document.getElementById("ROMidc").readOnly = true;
                    document.getElementById("hbt").style.display = "block";
                    $("#AddCustomerModal").modal("hide");
                } else
                {
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
    }

    function chkedit_data(){
        var formData = new FormData();

        var c = 0;
        var elem = document.getElementById('from_ecustomerh').elements;

        for (var i = 0; i < elem.length; i++) {
            if (elem[i].value.length == 0 && elem[i].type != "button" && elem[i].type != "file") {
                // console.log(elem[i].id + ' == ' + elem[i].type);
                alert('Please Enter a Value ');
                document.getElementById(elem[i].id).style.backgroundColor = "#F8E6E0";
                c = c + 1;
            }
            else{
                if(elem[i].type != "button" && elem[i].type != "select" && elem[i].type != "file"){
                    document.getElementById(elem[i].id).style.backgroundColor = "#FFFFFF";
                }
            }
        }

        if(c > 0){
            console.log('false');
            return false;
        }

        formData.append('editCUStitle', $('#editCUStitle').val());
        formData.append('editCUSfname', $('#editCUSfname').val());
        formData.append('editCUSlname', $('#editCUSlname').val());
        formData.append('editCUSadr', $('#editCUSadr').val());
        formData.append('editCUSzipc', $('#editCUSzipc').val());
        formData.append('editCUSbday', $('#editCUSbday').val());
        formData.append('editCUSemail', $('#editCUSemail').val());
        formData.append('editCUSnphone', $('#editCUSnphone').val());
        formData.append('editCUSbrhid', $('#editCUSbrhid').val());
        formData.append('editCUSid', $('#editCUSid').val());

        $.ajax({
        url: "<?php echo base_url(); ?>ecusbybooking",
        type: 'POST',
        data: formData,
        cache: false,
        //            dataType: 'json',
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
                    document.getElementById("ROMidc").readOnly = true;
                    document.getElementById("hbt").style.display = "block";
                    $("#showCusto").modal("hide");                    
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

    }

    function savebooking(){
        var formData = new FormData();

        var c = 0;
        var elem = document.getElementById('from_addfbooking').elements;

        for (var i = 0; i < elem.length; i++) {
            if (elem[i].name != "ROMidc" && elem[i].name != "BOKnote") {
                if (elem[i].value.length == 0 && elem[i].type != "button" && elem[i].type != "file") {
                     console.log(elem[i].id + ' == ' + elem[i].type);
                    alert('Please Enter a Value ');
                    document.getElementById(elem[i].id).style.backgroundColor = "#F8E6E0";
                    c = c + 1;
                }
                else{
                    if(elem[i].type != "button" && elem[i].type != "select" && elem[i].type != "file"){
                        document.getElementById(elem[i].id).style.backgroundColor = "#FFFFFF";
                    }
                }
            }
        }

        if(c > 0){
            console.log('false');
            return false;
        }

        formData.append('BOKfrom', $('#BOKfrom').val());
        formData.append('BOKromid', $('#ROMid').val());
        formData.append('ROMidc', $('#ROMidc').val());
        formData.append('BOKnote', $('#BOKnote').val());
        formData.append('BOKdate', $('#bdaterange').val());
        formData.append('BRHid', $('#BRHid').val());
        formData.append('PERid', $('#PERid').val());

        $.ajax({
            url: "<?php echo base_url(); ?>sbooking",
            type: 'POST',
            data: formData,
            cache: false,
            //            dataType: 'json',
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
    }

    function savebookingsta0(){
        var formData = new FormData();

        var c = 0;
        var elem = document.getElementById('from_bookingsta0').elements;

        for (var i = 0; i < elem.length; i++) {
            if (elem[i].name != "ROMidc" && elem[i].name != "BOKnote") {
                if (elem[i].value.length == 0 && elem[i].type != "button" && elem[i].type != "file") {
                     console.log(elem[i].id + ' == ' + elem[i].type);
                    alert('Please Enter a Value ');
                    document.getElementById(elem[i].id).style.backgroundColor = "#F8E6E0";
                    c = c + 1;
                }
                else{
                    if(elem[i].type != "button" && elem[i].type != "select" && elem[i].type != "file"){
                        document.getElementById(elem[i].id).style.backgroundColor = "#FFFFFF";
                    }
                }
            }
        }

        if(c > 0){
            console.log('false');
            return false;
        }

        formData.append('BOKid', $('#sta0BOKid').val());
        formData.append('BOKfrom', $('#sta0BOKfrom').val());
        formData.append('BOKromid', $('#sta0BOKromid').val());
        formData.append('BOKcusid', $('#sta0BOKcusid').val());
        formData.append('BOKnote', $('#sta0BOKnote').val());
        formData.append('BOKstartDT', $('#sta0BOKstartDT').val());
        formData.append('BOKendDT', $('#sta0BOKendDT').val());
        formData.append('BOKbrhid', $('#sta0BOKbrhid').val());
        formData.append('PERid', $('#sta0PERid').val());
        formData.append('BOKsta', $('#sta0BOKsta').val());

        $.ajax({
            url: "<?php echo base_url(); ?>scheckin",
            type: 'POST',
            data: formData,
            cache: false,
            //            dataType: 'json',
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

    }

    function savebookingsta1(){
        var formData = new FormData();
        var extrabed = [];

        $('.get_value_exb').each(function(){  
            if($(this).is(":checked"))  
            {  
                extrabed.push($(this).val());  
            }else{
                extrabed.push(0); 
            }
        });

        extrabed = extrabed.toString();
        formData.append('BOKid', $('#sta1BOKid').val());
        formData.append('BOKfrom', $('#sta1BOKfrom').val());
        formData.append('BOKromid', $('#sta1BOKromid').val());
        formData.append('BOKcusid', $('#sta1BOKcusid').val());
        formData.append('BOKstartDT', $('#sta1BOKstartDT').val());
        formData.append('BOKendDT', $('#sta1BOKendDT').val());
        formData.append('BOKbrhid', $('#sta1BOKbrhid').val());
        formData.append('PERid', $('#sta1PERid').val());

        formData.append('REDprice', $('#REDprice').val());
        formData.append('REDnote', $('#REDnote').val());
        formData.append('extrabed', extrabed);

        $.ajax({
            url: "<?php echo base_url(); ?>scheckout",
            type: 'POST',
            data: formData,
            cache: false,
            //            dataType: 'json',
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


    }

    function closeNav() {
        // document.getElementById("sidenavToggler").click();
        document.getElementById("mySidebar").style.width = "0";
        document.getElementById("main").style.marginRight= "0";
        document.getElementById("mySidebar_sta0").style.width = "0";
        document.getElementById("mySidebar_sta1").style.width = "0";
    }

    function addhardware(id){
        var xid = id;
        $("#xid").html(xid);
        $("#hardWareModal").modal("show");
    }

    function save_equipment(){        
        var formData = new FormData();
        var elem = document.getElementById('from_hardware').elements;
        
        for (var ob = 0; ob < elem.length; ob++) {
            if (elem[ob].type != 'button') {
                formData.append(elem[ob].id, $("#" + elem[ob].id).val());                
            }
        }

        $.ajax({
        url: "<?php echo base_url(); ?>sequipment",
        type: 'POST',
        data: formData,
        cache: false,
        //            dataType: 'json',
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
                    document.getElementById("havehardware").checked = true;
                    $("#hardWareModal").modal("hide");
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
        
    }

    function addminibar(id){        
        var xid = id;
        $("#xid").html(xid);
        $("#minibarModal").modal("show");
    }

    function save_minibar(){
        var formData = new FormData();
        var elem = document.getElementById('from_minibar').elements;
        
        for (var ob = 0; ob < elem.length; ob++) {
            if (elem[ob].type != 'button') {
                formData.append(elem[ob].id, $("#" + elem[ob].id).val());                
            }
        }

        $.ajax({
        url: "<?php echo base_url(); ?>sminibar",
        type: 'POST',
        data: formData,
        cache: false,
        //            dataType: 'json',
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
                    document.getElementById("haveminibar").checked = true;
                    $("#minibarModal").modal("hide");
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
    }

    function test(id){
        var xid = id;
        $("#xid").html(xid);
        $("#billModal").modal("show");
    }

    function myaddress(c) {
        var x = document.getElementById("myDIV");
        var y = document.getElementById("myDIV2");
        
        if (c == 0) {
            x.style.display = "block";
            y.style.display = "none";
        } else {
            x.style.display = "none";
            y.style.display = "block";
        }
    }

    function addextrabed(id){
        var z = document.getElementById("myDIV3");
        var zz = document.getElementById("myDIV4");
        if (z.style.display === "none" && zz.style.display === "none") {
            z.style.display = "block";
            zz.style.display = "block";
        } else {
            z.style.display = "none";
            zz.style.display = "none";
        }
    }
    
    function showmodalprint(cusid){
        var xid = cusid;
        $("#xid").html(xid);
        $("#billModal").modal("show");
        $("#xtable").empty();
        // document.getElementById("myDIV5").style.display = "none";
    }

    function show_detail_room(){
        var bokid = [];
        // var x = document.getElementById("myDIV5");
        var POMdis = document.getElementById("POMdis").value;
        var vat = $("input[name='vat']:checked").val();
        $("#xtable").empty();        

        $('.get_value_d').each(function(){  
            if($(this).is(":checked"))  
            {  
                bokid.push($(this).val());  
            }  
        });  

        bokid = bokid.toString();        
        // console.log(romid);
        
        if (bokid != '') {
            // if (x.style.display === "none") {
            //     x.style.display = "block";        
            // }

            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>getdetailroomb",
                data:{bokid:bokid, POMdis:POMdis, VAT:vat},
                success: function (data) {
                    $("#dash7").html(data);
                },
                error: function (err) {
                    console.log(err);
                    console.log('ccccccccccccc');
                } 
            });


        } else {
            // x.style.display = "none";
            $("#dash7").empty();
            alert("Please choose room");
        }
        
    }

    function checkpromotion(startDT, endDT, brhid){
        var x = document.getElementById("POMpcode").value;
        var mass = '';
        $("#resmessage").empty();
        document.getElementById("POMdis").value = 0;
        $("#xtable").empty();
        var mass = '';
        if (x != '') {
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>chkpromotion",
                data:{POMpcode:x, POMstartDT:startDT, POMendDT:endDT, POMbrhid:brhid},
                success: function (data) {
                    var x = JSON.parse(data);
                    console.log(x.POMid);
                    
                    if (x.POMid != null) {
                        mass = 'This code is compatible.';
                        document.getElementById("POMid").value = x.POMid;
                        document.getElementById("POMdis").value = parseFloat(x.POMdis).toFixed(2);
                        document.getElementById("resmessage").style.color = 'blue';
                    } else {
                        mass = 'This code is not compatible.';
                        document.getElementById("resmessage").style.color = 'red';
                    }
                    document.getElementById("resmessage").innerHTML = "Message: " + mass;
                },
                error: function (err) {
                    console.log(err);
                    console.log('ccccccccccccc');
                } 
            });
        } else {
            document.getElementById("POMid").value = '';
            document.getElementById("resmessage").display = "none";
            alert("Please check promotion code");
        }
        
    }

    function save_voucher(){            
        var CUSadr = $("input[name='cusaddress']:checked").val();

        // head            
        var VOCcusid = document.getElementById("CUSid").value;
        var VOCbrhid = document.getElementById("BRHid").value;
        var VOCcreatedBY = document.getElementById("PERid").value;
        var VOCdis = document.getElementById("POMdis").value;
        var VATsum = document.getElementById("VATsum").value;
        var TOTsum = document.getElementById("TOTsum").value;
        var VOCvat = $("input[name='vat']:checked").val();
        // list
        var VOL = document.getElementById("abokid").value;

        // bill setting
        var billsett = [];
        $('.get_value_disp').each(function(){  
            if($(this).is(":checked"))  
            {  
                billsett.push($(this).val());  
            }else{
                billsett.push(1);  
            }
        }); 
        billsett = billsett.toString();  

        if (CUSadr == 0) {
            
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>svoucherbk",
                data:{
                        VOCcusid:VOCcusid, 
                        VOCbrhid:VOCbrhid, 
                        VOCcreatedBY:VOCcreatedBY,
                        VOCdis:VOCdis,
                        VATsum:VATsum,
                        TOTsum:TOTsum,
                        VOCvat:VOCvat,
                        VOL:VOL,
                        VOCsubadr:0
                    },
                success: function (data) {
                    console.log(data);
                    window.open('<?php echo base_url(); ?>printbokpdf/'  + data + '?setting=' + billsett + '_blank');
                    window.location.reload(true);
                },
                error: function (err) {
                    console.log(err);
                    console.log('ccccccccccccc');
                } 
            });
        
        } else {
            var ADRname = document.getElementById("ADRname").value;
            var ADRtel = document.getElementById("ADRtel").value;
            var ADRemail = document.getElementById("ADRemail").value;
            var ADRnote = document.getElementById("ADRnote").value;

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>svoucherbk",
                data:{
                        VOCcusid:VOCcusid, 
                        VOCbrhid:VOCbrhid, 
                        VOCcreatedBY:VOCcreatedBY,
                        VOCdis:VOCdis,
                        VATsum:VATsum,
                        TOTsum:TOTsum,
                        VOCvat:VOCvat,
                        VOL:VOL,
                        VOCsubadr:1,
                        ADRname:ADRname,
                        ADRtel:ADRtel,
                        ADRemail:ADRemail,
                        ADRnote:ADRnote
                    },
                success: function (data) {
                    console.log(data);
                    window.open('<?php echo base_url(); ?>printbokpdf/'  + data + '?setting=' + billsett + '_blank');
                    window.location.reload(true);
                },
                error: function (err) {
                    console.log(err);
                    console.log('ccccccccccccc');
                } 
            });
        }
    }
</script>