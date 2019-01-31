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
.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  right: 0;
  background-color: #111;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>

<?php
// $branchname = json_decode($branch, true)['data'];

// debug($slpic);
?>

<div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin-top:-13px">
    <ol class="carousel-indicators" style="visibility: hidden">
      <?php foreach ($slpic as $key => $value): ?>
        <li data-target="#myCarousel" data-slide-to="<?php echo $key; ?>" <?php if($key == 0){echo 'class="active"';} ?>></li>
      <?php endforeach; ?>
    </ol>
    <div class="carousel-inner">
      <?php foreach ($slpic as $skey => $svalue): ?>
        <div class="carousel-item <?php if($skey == 0){echo "active";} ?>" style="height: auto">
            <img class="first-slide" src="<?php echo base_url(); ?>assets/img/slide/<?php echo $svalue['PICname'] ?>" style="position: relative; height: 800px;">
            <!-- <img class="first-slide img-fluid mx-auto d-block" src="<?php echo base_url(); ?>assets/img/slide/<?php echo $svalue['PICname'] ?>" alt="First slide" style="width: 100%; height: auto; position: relative;"> -->
        </div>
      <?php endforeach; ?>
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    <a class="carousel-indicators">
      
    </a>
</div>

<div id="mySidenav" class="sidenav" style="z-index: 200;">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()" style="margin-top: 60px">&times;</a>
    <div align="center" style="margin-top: 60px">
    <h1 style="color:#ffffff">สำรองห้องพัก</h1>
    </div>
    <div class="row" style="margin-top: 10px">
        <div class="col-sm-1" ></div>
        <div class="col-sm-10" >
            <div class="form-group">
                <label for="sel1" style="color:#ffffff">สาขา:</label>
                <select class="form-control" id="CBKbrhid" name="CBKbrhid" onchange="selectbybranch(this.value)">
                    <option selected hidden></option>
                    <?php foreach ($branch as $branchkey => $branchvalue): ?>
                    <option value="<?php echo $branchvalue['BRHid']; ?>"><?php echo $branchvalue['BRHdesc' . $sl]; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-sm-1" ></div>
    </div>   
    <div class="row">
        <div class="col-sm-1" ></div>
        <div class="col-sm-10" >
            <div class="form-group">
                <label for="sel1" style="color:#ffffff">ห้อง:</label>                                
                <select class="form-control" id="sel99"> </select>
                <div class="optionrtype" id="optionrtype">

                </div>
            </div>
        </div>
        <div class="col-sm-1" ></div>
    </div>    
    <div class="row">
        <div class="col-sm-1" ></div>
        <div class="col-sm-10" >
            <div class="form-group">
                <label for="sel1" style="color:#ffffff">วันที่จอง</label>
                <input class="form-control" type="text" id="CBKbdaterange" name="CBKbdaterange" value="<?php date("Y/m/d") ." - " . date("Y/m/d"); ?>" />
            </div>
        </div>
        <div class="col-sm-1" ></div>
    </div>
    <div class="row">
        <div class="col-sm-1" ></div>
        <div class="col-sm-10" >
            <div class="form-group">
                <label for="sel1" style="color:#ffffff"> โค้ดส่วนลด</label>
                <input class="form-control" type="text" id="CBKdode" name="CBKdode" value="" />
            </div>
        </div>
        <div class="col-sm-1" ></div>
    </div>
    <div class="row">
        <div class="col-sm-1" ></div>
        <div class="col-sm-10" >
            <div class="form-group">
                <label for="sel1" style="color:#ffffff"> Note</label>
                <textarea class="form-control" rows="3" id="CBKnote" name="CBKnote"></textarea>
            </div>
        </div>
        <div class="col-sm-1" ></div>
    </div>    
    <div class="row">
        <div class="col-sm-1" ></div>
        <div class="col-sm-10" >
            <button type="button" class="btn btn-warning form-control" onclick="chk_booking();" style="margin-top:15px;">BOOK NOW</button>
        </div>
        <div class="col-sm-1" ></div>
    </div>
    
</div>

<button class="open-button" onclick="openNav()">สำรองห้องพัก</button>
<!-- data-toggle="modal" data-target="#myBookingModal" -->


<script>
    $(function() {
      $('input[name="CBKbdaterange"]').daterangepicker({
        opens: 'left',
        minDate: new Date()
      }, function(start, end, label) {
        //   console.log(Date());
          
        console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
      });
    });

    function selectbybranch(value){
      // var value = selectObject.value;
    //   console.log(value);
      if (value != 0 || value != '') {
        document.getElementById("sel99").style.display = "none";
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>sbtypesubtype/" + value + "?param=true",
            success: function (data) {
                $("#optionrtype").html(data);
            },
            error: function (err) {
                console.log(err);
            }
        });        
      }

    }

    function openNav() {
        document.getElementById("mySidenav").style.width = "400px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }

</script>