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

switch ($chk) {
  case 'Content0':
?>
    <?php foreach ($bcontent as $bkey => $bvalue):?>

    <div class="card bg-light" style="margin-top: 10px">
        <div class="card-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3">
                        <section class="gallery-block compact-gallery">
                            <div class="container">
                                <div class="row no-gutters">
                                        <?php foreach ($bcontent[$bkey]['pic'] as $pkey => $pvalue):?>

                                        <?php if ($pkey == 0): ?>
                                          <div class="col-md-12 col-lg-12 item zoom-on-hover">
                                              <a class="lightbox" href="<?php echo base_url(); ?>assets/img/uploads/<?php echo $pvalue['PICname']; ?>">
                                                  <img class="img-fluid image" src="<?php echo base_url(); ?>assets/img/uploads/<?php echo $pvalue['PICname']; ?>">
                                              </a>
                                          </div>
                                        <?php elseif ($pkey < 4) :?>
                                          <div class="col-md-6 col-lg-4 item zoom-on-hover">
                                              <a class="lightbox" href="<?php echo base_url(); ?>assets/img/uploads/<?php echo $pvalue['PICname']; ?>">
                                                  <img class="img-fluid image" src="<?php echo base_url(); ?>assets/img/uploads/<?php echo $pvalue['PICname']; ?>">
                                              </a>
                                          </div>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                </div>
                            </div>
                        </section>
                        <hr>
                    </div>
                    <div class="col-9">
                        <h5 class="h5-responsive product-name">
                            <!-- <strong><a href="#" id="<?php echo $bvalue['BRHid']; ?>" onclick="showdetail(this.id);"><?php echo $bvalue['BRHdesc'.$sl]; ?></a></strong> -->
                            <strong><?php echo $bvalue['BRHdesc'.$sl]; ?></strong>
                        </h5>
                        <h6 class="h6-responsive">
                            <span class="green-text">
                                <strong><a href="https://www.google.co.th/maps/place/<?php echo $bvalue['BRHlocation']; ?>" target="_blank">google map</a></strong>

                            </span>
                        </h6>
                        <hr>
                        <div class="row">
                            <p>
                                <?php echo $bvalue['PU03desc'.$sl]; ?>
                            </p>
                        </div>
                        <hr>
                        <button type="button" class="btn btn-primary" onclick="openShowModal(<?php echo $bvalue['BRHid']; ?>);">
                            <?php echo $this->lang->line("showmore"); ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
<?php
    break;
    case 'showDescriptionByBranch':
    // echo "ccccccccc";
    // exit();
    // debug($boption);
?>

    <div class="modal-body">
        <?php foreach ($bcontent as $bkey => $bvalue): ?>
        <table class="table table-bordered table-sm">
            <tbody>
                <tr>
                    <td style="width: 40%">
                        <table class="table table-bordered table-sm">
                            <tbody>
                                <tr>
                                    <td>
                                        <section class="gallery-block compact-gallery">
                                            <div class="container">
                                                <div class="row no-gutters">
                                                  <?php foreach ($bcontent[$bkey]['pic'] as $pkey => $pvalue):?>
                                                    <div class="col-md-6 col-lg-4 item zoom-on-hover">
                                                        <a class="lightbox" href="<?php echo base_url(); ?>assets/img/uploads/<?php echo $pvalue['PICname']; ?>">
                                                            <img class="img-fluid image" src="<?php echo base_url(); ?>assets/img/uploads/<?php echo $pvalue['PICname']; ?>" >
                                                            <span class="description">
                                                                <span class="description-heading">Click</span>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </section>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>

                    <td style="width: 60%">
                        <div class="container">
                            <h2 class="h2-responsive product-name">
                                <strong><?php echo $bvalue['BRHdesc'.$sl]; ?></strong>
                            </h2>

                            <!--Accordion wrapper-->
                            <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">

                                <!-- Accordion card -->
                                <div class="card">

                                    <!-- Card header -->
                                    <div class="card-header" role="tab" id="headingOne">
                                        <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <h5 class="mb-0">
                                                <?php echo $this->lang->line("description"); ?> <i class="fa fa-angle-down rotate-icon"></i>
                                            </h5>
                                        </a>
                                    </div>

                                    <!-- Card body -->
                                    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" >
                                        <div class="card-body">
                                            <?php echo $bvalue['PU03desc'.$sl]; ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- Accordion card -->

                                <!-- Accordion card -->
                                <div class="card">

                                    <!-- Card header -->
                                    <div class="card-header" role="tab" id="headingTwo">
                                        <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <h5 class="mb-0">
                                                <?php echo $this->lang->line("details"); ?> <i class="fa fa-angle-down rotate-icon"></i>
                                            </h5>
                                        </a>
                                    </div>

                                    <!-- Card body -->
                                    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion" >
                                        <div class="card-body">
                                            <?php echo $bvalue['PU03desc'.$sl]; ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- Accordion card -->
                            </div>
                            <!--/.Accordion wrapper-->

                            <!-- Add to Cart -->
                            <div class="card-body">
                                
                              <form name="from_chackbooking"enctype="multipart/form-data" id="from_chackbooking">
                                <input type="hidden" id="CBKbrhid" name="CBKbrhid" value="<?php echo $bvalue['BRHid']; ?>" />
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="md-form">
                                          <label for="CBKdate"><?php echo $this->lang->line("checkin"); ?>:</label>
                                          <input class="form-control" type="text" id="CBKbdaterange" name="CBKbdaterange" value="<?php date("Y/m/d") ." - " . date("Y/m/d"); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="CBKromtype"><?php echo $this->lang->line("roomtype"); ?>:</label>
                                        <?php if(isset($boption)): ?>
                                        <select class="form-control" id="CBKromtype">
                                        <!-- <option selected hidden></option> -->
                                        <?php  foreach ($boption as $bkey => $bvalue): ?>
                                        <option value="<?php  echo $bvalue['USCcode']; ?>"><?php  echo $bvalue['USCdesc' . $sl]; ?></option>
                                        <?php  endforeach; ?>
                                        </select>
                                        <?php else: ?>
                                        <select class="form-control" id="CBKromtype" ><option value="99" selected>ไม่มีห้องว่าง</option></select>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 10px">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="sel1"> <?php echo $this->lang->line("discode"); ?>:</label>
                                            <input class="form-control" type="text" id="CBKdode" name="CBKdode" value="" />
                                        </div>
                                    </div>                                   
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="sel1"> Note</label>
                                            <textarea class="form-control" rows="2" id="CBKnote" name="CBKnote"></textarea>
                                        </div>
                                    </div>                                   
                                </div>
                                <div class="text-center" style="margin-top:20px">
                                  <button type="button" class="btn btn-success" onclick="chk_booking()"><?php echo $this->lang->line("bbooking"); ?></button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
                                </div>
                              </form>
                            </div>
                            <!-- /.Add to Cart -->

                        </div>

                    </td>
                </tr>
            </tbody>
        </table>
        <?php endforeach; ?>
    </div>
    <script>
        baguetteBox.run('.compact-gallery', {animation: 'slideIn'});
    </script>
    <script>
      $(function() {
        $('input[name="CBKbdaterange"]').daterangepicker({
          opens: 'left',
          minDate: new Date()
        }, function(start, end, label) {

          console.log(moment.duration(start.diff(moment())));
          // moment.duration(moment(dateStart)).diff(moment());
          console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
      });
    </script>
<?php
      break;
      case 'Content1':

      // debug($bcontent);
      // exit();
?>
        <?php if (isset($bcontent)): ?>
        <?php foreach ($bcontent as $bkey => $bvalue):?>

        <div class="card bg-light" style="margin-top: 10px">
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-3">
                            <section class="gallery-block compact-gallery">
                                <div class="container">
                                    <div class="row no-gutters">
                                        <?php foreach ($bcontent[$bkey]['pic'] as $pkey => $pvalue):?>
                                          <div class="col-md-6 col-lg-4 item zoom-on-hover">
                                              <a class="lightbox" href="<?php echo base_url(); ?>assets/img/uploads/<?php echo $pvalue['PICname']; ?>">
                                                  <img class="img-fluid image" src="<?php echo base_url(); ?>assets/img/uploads/<?php echo $pvalue['PICname']; ?>">
                                              </a>
                                          </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </section>
                            <hr>
                            สิ่งอำนวยความสะดวกในโรงแรม
                        </div>
                        <div class="col-9">
                            <h5 class="h5-responsive product-name">
                                <strong><a href="#" id="<?php echo $bvalue['BRHid']; ?>" onclick="showdetail(this.id);"><?php echo $bvalue['BRHdesc'.$sl]; ?></a></strong>
                            </h5>
                            <h6 class="h6-responsive">
                                <span class="green-text">
                                    <strong><a href="https://www.google.co.th/maps/place/<?php echo $bvalue['BRHlocation']; ?>" target="_blank">google map</a></strong>

                                </span>
                            </h6>
                            <hr>
                            <div class="row">
                                <p>
                                    <?php echo $bvalue['PU03desc'.$sl]; ?>
                                </p>
                            </div>
                            <hr>
                            <button type="button" class="btn btn-primary" onclick="openShowModal(<?php echo $bvalue['BRHid']; ?>);">
                                <?php echo $this->lang->line("showmore"); ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
<?php
        break;
        case 'Detail':
        $boption = json_decode($boption, true)['data'];
?>
        <?php if (isset($bcontent)): ?>
        <?php foreach ($bcontent as $bkey => $bvalue):?>
        <div class="card bg-light" style="margin-top: 10px">
            <div class="card-body">

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

              <h2 style="text-align:center"><?php echo $bcontent[$bkey]['BRHdesc'.$sl]; ?></h2>

              <div class="container">
                <?php foreach ($bcontent[$bkey]['pic'] as $pkey => $pvalue):?>
                <div class="mySlides">
                  <div class="numbertext"><?php echo $pkey + 1 .' / ' . count($bcontent[$bkey]['pic']); ?></div>
                  <img src="<?php echo base_url(); ?>assets/img/uploads/<?php echo $pvalue['PICname']; ?>" style="width: 100%; height: 100%; position: relative;">
                </div>
                <?php endforeach; ?>
                <a class="prev" onclick="plusSlides(-1)">❮</a>
                <a class="next" style="margin-right:15px" onclick="plusSlides(1)">❯</a>

                <div class="caption-container">
                  <p id="caption"></p>
                </div>

                <div class="row" style="margin-top:20px">
                  <?php foreach ($bcontent[$bkey]['pic'] as $pkey => $pvalue):?>
                  <div class="column">
                    <img class="demo cursor" src="<?php echo base_url(); ?>assets/img/uploads/<?php echo $pvalue['PICname']; ?>" style="width: 100%; height: 150px;" onclick="currentSlide(<?php echo $pkey + 1; ?>)" alt="<?php echo $bcontent[$bkey]['pic'][$pkey]['PICnote'] ?>">
                  </div>
                  <?php endforeach; ?>
                </div>

              </div>
            </div>
        </div>

        <div class="card bg-light" style="margin-top: 10px">
          <div class="card-body">
            <?php echo $bcontent[$bkey]['PU03note'.$sl]; ?>
          </div>
        </div>

        <form name="from_chackbooking" enctype="multipart/form-data" id="from_chackbooking">
        <div class="card bg-light" style="margin-top: 10px;">
            <div class="card-body">
              <div class="form-group">
                <label for="CBKdate">วันที่เข้าพัก:</label>
                <input class="form-control" type="text" id="bdaterange" name="bdaterange" value="<?php date("Y/m/d") ." - " . date("Y/m/d"); ?>" />
              </div>
              <div class="form-group">
                <input type="hidden" class="form-control" id="CBKbrhid" name="CBKbrhid" value="<?php echo $bcontent[$bkey]['BRHid']; ?>">
                <button type="button" class="btn btn-primary btn-block btn-lg" onclick="chk_booking(<?php echo $bcontent[$bkey]['BRHid']; ?>);" style="margin-top:10px; margin-bottom:10px">เช็คห้องว่าง</button>
              </div>
            </div>
        </div>
        <div class="card" >
          <div id="accordion" id="accordion" role="tablist" aria-multiselectable="true">
            <?php // debug($boption); ?>
            <?php foreach (array_values($boption) as $bokey => $bovalue): ?>
                <div class="card">
                  <div class="card-header">
                    <a data-toggle="collapse" href="#collapse<?php echo $bovalue['id'] ?>" aria-expanded="true" aria-controls="collapse<?php echo $bovalue['id'] ?>">
                        <h5 class="mb-0">
                            <?php echo $bovalue['TypeName'] ?> <i class="fa fa-angle-down rotate-icon"></i>
                        </h5>
                    </a>
                  </div>
                  <div id="collapse<?php echo $bovalue['id'] ?>" class="collapse <?php if($bokey == 0){echo "show";} ?>" data-parent="#accordion">
                    <div class="card-body">
                      <table class="table table-hover table-borderless">
                        <thead>
                          <tr>
                            <th>ประเภทห้องพัก</th>
                            <th>จำนวนห้องพัก</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($bovalue['SubType'] as $sskey => $ssvalue): ?>
                          <tr>
                            <td width="40%">
                              <?php echo $ssvalue['Name'] . '  <b>(1 room for ' . $ssvalue['Quantity'] . ' people)</b>' ?>
                            </td>
                            <td width="60%">
                              <input type="number" class="form-control" name="Type<?php echo $ssvalue['RoomTyprID']; ?>SubTypeID<?php echo $ssvalue['id'] ?>" id="Type<?php echo $ssvalue['RoomTyprID']; ?>SubTypeID<?php echo $ssvalue['id'] ?>" value="0" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" />
                            </td>
                          </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
            <?php endforeach; ?>
          </div>
        </div>
        </form>
        <!-- <div class="card bg-primary text-white" style="margin-top: 80px" >
          <div class="card-body" >
            <form name="from_chackbooking"enctype="multipart/form-data" id="from_chackbooking">
              <div class="row"> -->
                <!-- <div class="col"> -->
                  <!-- <div class="form-group">
                    <label for="CBKdate">วันที่เข้าพัก:</label>
                    <input class="form-control" type="text" id="bdaterange" name="bdaterange" value="<?php // date("Y/m/d") ." - " . date("Y/m/d"); ?>" />
                  </div> -->

                <!-- </div> -->
                <!-- <div class="col">
                  <label for="CBKsubtype">ประเภทห้องพัก:</label>
                  <select class="form-control" id="CBKsubtype" name="CBKsubtype" onchange="selected(this.value);">
                    <option selected hidden></option>
                    <?php // foreach (json_decode($tcontent, true)['data'] as $stkey => $stvalue): ?>
                      <option value="<?php //echo $stvalue['id']; ?>"><?php //echo $stvalue['name'] ?></option>
                    <?php // endforeach; ?>
                  </select>

                </div> -->



              <!-- </div> -->
              <!-- <div class="col-sm-12"> -->
                <!-- <div class="dash1" id="dash1"> -->

                <!-- </div> -->
              <!-- </div> -->
              <!-- <div class="row">
                <div class="col">
                  <input type="hidden" class="form-control" id="CBKbrhid" name="CBKbrhid" value="<?php // echo $bcontent[$bkey]['BRHid']; ?>">
                  <button type="button" class="btn btn-success form-control" onclick="chk_booking(<?php // echo $bcontent[$bkey]['BRHid']; ?>);">เช็คห้องว่าง</button>
                </div>
              </div>
            </form>
          </div>
        </div> -->

        <!-- <div class="card bg-light" style="margin-top: 10px">
          <div class="card-body">

            <table class="table table-hover">
              <thead class="bg-warning text-white">
                <tr>
                  <th width="10%">ลำดับ</th>
                  <th>ประเภทห้องพัก</th>
                </tr>
              </thead>
              <tbody>
                <?php // foreach (json_decode($tcontent, true)['data'] as $tkey => $tvalue): ?>
                  <tr>
                    <td><?php // echo $tkey + 1; ?></td>
                    <td><?php // echo $tvalue['name'] ?></td>
                    <!-- <td><button type="button" class="btn btn-success btn-sm form-control">Somting</button></td> -->
                  <!-- </tr> -->
                <?php // endforeach; ?>
              <!-- </tbody>
            </table>
          </div>
        </div> -->

        <?php endforeach; ?>
        <?php endif; ?>


        <script>
           var slideIndex = 1;
           showSlides(slideIndex);

           function plusSlides(n) {
             showSlides(slideIndex += n);
           }

           function currentSlide(n) {
             showSlides(slideIndex = n);
           }

           function showSlides(n) {
             var i;
             var slides = document.getElementsByClassName("mySlides");
             var dots = document.getElementsByClassName("demo");
             var captionText = document.getElementById("caption");

             if (n > slides.length) {slideIndex = 1}
             if (n < 1) {slideIndex = slides.length}

             for (i = 0; i < slides.length; i++) {
                 slides[i].style.display = "none";
             }

             for (i = 0; i < dots.length; i++) {
                 dots[i].className = dots[i].className.replace(" active", "");
             }

             slides[slideIndex-1].style.display = "block";
             dots[slideIndex-1].className += " active";
             captionText.innerHTML = dots[slideIndex-1].alt;
           }
         </script>

<?php
          break;

          case 'showbyRoomType':
            $subtype = json_decode($bysubtype, true)['data'];
            // debug($subtype);
?>
          <div class="col-sm-12">
            <hr>
            <table class="table table-borderless">
              <thead>
                <tr>
                  <th>ประเภทห้องพัก</th>
                  <th>จำนวนผู้เข้าพัก</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($subtype as $key => $value): ?>
                  <tr>
                    <td>
                      <?php echo $value['name'] . '  <b>(' . $value['quantity'] . '  people per room)</b>' ?>
                    </td>
                    <td>
                      <div class="row">
                        <div class="col-sm-8">
                          <input type="number" class="form-control" id="subroomtyprid<?php echo $value['id'] ?>" name="subroomtyprid<?php echo $value['id'] ?>" value="0" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" />
                        </div>
                        <div class="col-sm-4">
                          people
                        </div>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>

<?php
            break;

            case 'selectBranchBytypeSubtype':     
            // debug($boption);
?>
            <?php if(isset($boption)): ?>
            <select class="form-control" id="CBKromtype">
            <option selected hidden></option>
            <?php  foreach ($boption as $bkey => $bvalue): ?>
            <option value="<?php  echo $bvalue['USCcode']; ?>"><?php  echo $bvalue['USCdesc' . $sl]; ?></option>
            <?php  endforeach; ?>
            </select>
            <?php else: ?>
            <select class="form-control" id="CBKromtype" ><option value="99" selected>ไม่มีห้องว่าง</option></select>
            <?php endif; ?>

<?php
              break;

              case 'getEvents':
?>
                <!-- Modal body -->
                <form name="from_event"enctype="multipart/form-data" id="from_event">
                <div class="modal-body">
                <?php // debug($epromotion) ?>
                    <table class="table table-hover">
                        <tbody>
                            <?php if(isset($epromotion)): ?>
                            <tr>
                                <th width="30%"><?php echo $this->lang->line("details"); ?></th>
                                <td><?php echo $epromotion[0]['POMdesc'.$sl] ?></td>
                            </tr>
                            <tr>
                                <th width="30%"><?php echo $this->lang->line("promotioncode"); ?></th>
                                <td><?php echo $epromotion[0]['POMpcode'] ?></td>
                            </tr>
                            <tr>
                                <th width="30%"><?php echo $this->lang->line("promotionsdiscount"); ?></th>
                                <td><?php echo $epromotion[0]['POMdis'] ?></td>
                            </tr>
                            <tr>
                                <th width="30%"><?php echo $this->lang->line("promotionsstartdate") .' - ' . $this->lang->line("promotionsenddate"); ?></th>
                                <td><?php echo $epromotion[0]['POMstartDT'] . ' - ' . $epromotion[0]['POMendDT'] ?></td>
                            </tr>                            
                            <tr>
                                <th width="30%"><?php echo $this->lang->line("branchname"); ?></th>
                                <td>
                                    <table class="table table-hover">
                                        <tbody>
                                        <?php foreach($epromotion[0]['branchName'] as $key => $value):?>
                                        <tr>
                                            <td><?php echo $value['BRHdesc'.$sl] ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>        
                            <?php endif; ?>                   
                        </tbody>
                    </table>
                </div>

                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="">จอง</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
                </div>
                </form>
<?php
                  break;

  default:
    echo 'No data and tag HTML';
    break;
}

 ?>
