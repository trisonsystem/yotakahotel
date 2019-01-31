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

<html>
    <head>
        <?php echo $startpage; ?>
        <link href="<?php echo base_url(); ?>assets/css/compact-gallery.css" rel="stylesheet">
        <style>
        /* Position the image container (needed to position the left and right arrows) */
          .container {
            position: relative;
          }

          /* Hide the images by default */
          .mySlides {
            display: none;
          }

          /* Add a pointer when hovering over the thumbnail images */
          .cursor {
            cursor: pointer;
          }

          /* Next & previous buttons */
          .prev,
          .next {
            cursor: pointer;
            position: absolute;
            top: 40%;
            width: auto;
            padding: 16px;
            margin-top: -50px;
            color: white;
            font-weight: bold;
            font-size: 20px;
            border-radius: 0 3px 3px 0;
            user-select: none;
            -webkit-user-select: none;
          }

          /* Position the "next button" to the right */
          .next {
            right: 0;
            border-radius: 3px 0 0 3px;
          }

          /* On hover, add a black background color with a little bit see-through */
          .prev:hover,
          .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
          }

          /* Number text (1/3 etc) */
          .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
          }

          /* Container for image text */
          .caption-container {
            text-align: center;
            background-color: #222;
            padding: 2px 16px;
            color: white;
          }

          .row:after {
            content: "";
            display: table;
            clear: both;
          }

          /* Six columns side by side */
          .column {
            float: left;
            width: 16.66%;
          }

          /* Add a transparency effect for thumnbail images */
          .demo {
            opacity: 0.6;
          }

          .active,
          .demo:hover {
            opacity: 1;
          }
        </style>
    </head>
    <body>
        <?php echo $topmenu; ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

        <div class="container-fluid">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                      <img src="<?php echo base_url(); ?>assets/img/banner.png" class="img-thumbnail" alt="" style="margin-top: 38px; margin-bottom: 10px; width: 100%">
                    </div>
                    <div class="col-sm-2 col-md-2 " style="margin-top: 10px;">
                        <!-- <div class="card-deck ">
                            <div class="card bg-info text-dark">
                                <div class="card-body">
                                  <form method="post" action="<?php // echo base_url('booking/Content1');?>">
                                    <div class="form-group">
                                        <label for="bbranch"><?php // echo $this->lang->line("branchname"); ?>:</label>
                                        <select class="form-control" id="bbranch" name="bbranch">
                                          <?php // foreach ($branchname as $branchkey => $branchvalue): ?>
                                            <option value="<?php // echo $branchvalue['BRHid']; ?>"><?php // echo $branchvalue['BRHdesc'.$sl]; ?></option>
                                            <?php // endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                      <label for="bpeople"><?php // echo $this->lang->line("checkin"); ?>:</label>
                                      <input class="form-control" type="text" name="daterange" value="<?php // date("Y/m/d") ." - " . date("Y/m/d"); ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="bpeople"><?php // echo $this->lang->line("noofguest"); ?>:</label>
                                        <select class="form-control" id="bpeople" name="bpeople">
                                          <?php
                                        //   for($i = 1; $i <= 20; $i++){
                                        //     echo '<option>'. $i .'</option>';
                                        //   }
                                          ?>
                                        </select>
                                    </div>

                                    <div class="form-group" align="right">
                                        <button type="submit" class="btn btn-primary"><?php // echo $this->lang->line("search"); ?></button>
                                    </div>
                                  </form>
                                </div>
                            </div>
                        </div> -->
                        <div class="list-group">
                          <a href="<?php echo base_url(); ?>booking" class="list-group-item list-group-item-action">show all</a>
                          <?php if (isset($branch)): ?>
                              <?php foreach ($branch as $branchkey => $branchvalue): ?>
                              <a href="<?php echo base_url(); ?>bookings/<?php echo $branchvalue['BRHid']; ?>" class="list-group-item list-group-item-action"><?php echo $branchvalue['BRHdesc'.$sl]; ?></a>
                              <?php endforeach; ?>
                          <?php endif; ?>                          
                        </div>
                    </div>
                    <div class="col-sm-10 col-md-10">
                        <?php
                        if (isset($content)) {
                          echo $content;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="container mt-3"> -->
            <!-- The Modal -->
            <div class="modal fade" id="myModalRoom">
                <div class="modal-dialog modal-lg">

                    <div class="modal-content">
                      <span id="xid" style="color: #ffffff"></span>
                      <div class="dash" id="dash">

                      </div>
                    </div>
                </div>
            </div>
        <!-- </div> -->

        <?php echo $footer; ?>

        <script>
        $(document).ready(function() {
            $('#myModalRoom').on('shown.bs.modal', function () {
                var id = $("#xid").html();

                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url(); ?>showdesbookingbybranch/" + id + "?param=true",
                    success: function (data) {
                        $("#dash").html(data);
                    },
                    error: function (err) {
                        console.log(err);
                    }
                });
            });
          });

          function showOnclick(bid){
            var formData = new FormData();
            // formData.append('bdaterange', $('#bdaterange').val());
            // formData.append('CBKpeople', $('#CBKpeople').val());
            // formData.append('CBKbrhid', $('#CBKbrhid').val());
            console.log(bid);
            $.ajax({
                url: "<?php echo base_url(); ?>booking/Content1?id="+bid,
                type: 'GET',
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
                        // window.location.reload(true);
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

          function openShowModal(id){
            var xid = id;
            $("#xid").html(xid);
            $("#myModalRoom").modal("show");
          }

          $(function() {
            $('input[name="daterange"]').daterangepicker({
              opens: 'left',
              minDate: new Date()
            }, function(start, end, label) {
              // console.log('111');
              console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
          });

          $(function() {
            $('input[name="bdaterange"]').daterangepicker({
              opens: 'left',
              minDate: new Date()
            }, function(start, end, label) {
              // console.log('222');
              console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
          });

          function showdetail(id){
            // console.log(id);
            window.open("viewde/" + id);
          }

        //   function chk_booking(id){

        //    var test = <?php echo (isset($_SESSION['isLoggedIn']))?$_SESSION['isLoggedIn']:'0'?>;

        //    if (test == 1) {
        //     var formData = new FormData();
        //     var elem = document.getElementById('from_chackbooking').elements;
        //     var conf = 0;


        //     for (var i = 0; i < elem.length; i++) {
        //         console.log(elem[i].id);
        //       if (elem[i].value > 0) {
        //         formData.append(elem[i].id, $('#'+elem[i].id).val());
        //         if (elem[i].id != 'bdaterange' && elem[i].id != 'CBKbrhid') {
        //             conf = conf + 1
        //         }
        //         // console.log(elem[i].value);
        //       }
        //     }

        //     if (conf != 0) {
        //         formData.append('bdaterange', $('#bdaterange').val());

        //         $.ajax({
        //             url: "<?php echo base_url(); ?>mybooking",
        //             type: 'POST',
        //             data: formData,
        //             cache: false,
        //             //            dataType: 'json',
        //             processData: false, // tell jQuery not to process the data
        //             contentType: false, // tell jQuery not to set contentType
        //             enctype: 'multipart/form-data',
        //             success: function (data)
        //             {
        //                 console.log(typeof data.error);
        //                 if (typeof data.error === 'undefined')
        //                 {
        //                     // Success so call function to process the form
        //                     console.log('SUCCESS: ' + data.success);
        //                     // window.location.reload(true);
        //                 } else
        //                 {
        //                     // Handle errors here
        //                     console.log('ERRORS: ' + data.error);
        //                 }
        //             },
        //             error: function (errorThrown)
        //             {
        //                 // Handle errors here
        //                 console.log('ERRORS: ');
        //             },
        //             complete: function ()
        //             {
        //                 // STOP LOADING SPINNER
        //             }
        //           });
        //       }else {
        //           alert("Please fill in all required fields.");
        //       }
        //     }else {
        //       $("#myModalLogin").modal("show");
        //     }
        //   }

          function selected(myval){
            console.log(myval);

            var formData = new FormData();

            // formData.append('bdaterange', $('#bdaterange').val());
            // formData.append('CBKpeople', $('#CBKpeople').val());
            // formData.append('CBKbrhid', $('#CBKbrhid').val());

            $.ajax({
                url: "<?php echo base_url(); ?>showbyroomtype/"+myval,
                type: 'GET',
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
                        $("#dash1").html(data);
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


        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
        <script>
            baguetteBox.run('.compact-gallery', {animation: 'slideIn'});
        </script>

    </body>

    <?php echo $endpage; ?>

</html>
