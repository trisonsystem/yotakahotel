<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<?php
if (!isset($_COOKIE["lang"])) {
   
    $lg = $_COOKIE["lang"];
}

if ($lg == 'thailand') {
    $sl = 'TH';
} else {
    $sl = 'EN';
}

?>

<!-- Example DataTables Card-->
<div class="card mb-3">
  <div class="card-header">
    <i class="fa fa-calendar"></i> Promotions management</div>
  <div class="card-body">
    <div class="table-responsive">

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

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th style="display: none;">Delete</th>
            <th><?php echo $this->lang->line("no"); ?></th>
            <th><?php echo $this->lang->line("promotionsdescriptionTH"); ?></th>
            <th><?php echo $this->lang->line("promotionsdescriptionEN"); ?></th>
            <th><?php echo $this->lang->line("promotioncode"); ?></th>
            <th><?php echo $this->lang->line("promotionslink"); ?></th>
            <th><?php echo $this->lang->line("promotionsdiscount"); ?></th>
            <th><?php echo $this->lang->line("branchname"); ?></th>
            <th>Action</th>
          </tr>
        </thead>
        <!-- <tfoot>           
            <tr>
                <th>
                    <button type="button" class="btn btn-warning btn-sm form-control" onclick="open_delgpromotion_modal();">
                        <svg id="i-trash" viewBox="0 0 32 32" width="12" height="12" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        <path d="M28 6 L6 6 8 30 24 30 26 6 4 6 M16 12 L16 24 M21 12 L20 24 M11 12 L12 24 M12 6 L13 2 19 2 20 6" />
                        </svg>
                    </button>
                </th>
                <th><?php echo $this->lang->line("promotionsdescriptionTH"); ?></th>
                <th><?php echo $this->lang->line("promotionsdescriptionEN"); ?></th>
                <th><?php echo $this->lang->line("promotioncode"); ?></th>
                <th><?php echo $this->lang->line("promotionslink"); ?></th>
                <th><?php echo $this->lang->line("promotionsdiscount"); ?></th>
                <th><?php echo $this->lang->line("branchname"); ?></th>
                <th>Action</th>
            </tr>            
        </tfoot> -->
        <tbody>
            <?php 
            if (isset($promotion)) :
                foreach ($promotion as $key => $value):
            ?>
            <tr id="tr<?php echo $value['POMid'].''; ?>" >
                <td style="display: none;">
                    <div class="form-check" >
                        <label class="form-check-label">
                        <input type="checkbox" id="<?php echo $value['POMid']; ?>" class="form-check-input" value="<?php echo $value['POMid']; ?>" name="chk" onchange="myFunction('tr' + this.id, this, this.id)"><?php echo $this->lang->line("select"); ?>
                        </label>
                    </div>
                </td>
                <td><?php echo $key + 1 ?></td>
                <td><?php echo $value['POMdescTH'] ?></td>
                <td><?php echo $value['POMdescEN'] ?></td>
                <td><?php echo $value['POMpcode'] ?></td>
                <td><?php echo $value['POMlink'] ?></td>
                <td><?php echo $value['POMdis'] ?></td>
                <td>
                <?php //echo $value['branchName']['BRHdescTH'] ?>
                    <?php 
                    if(isset($value['branchName'])) : 
                        foreach($value['branchName'] as $k => $v) :
                            echo($v['BRHdesc'.$sl] . ' , ');
                        endforeach;
                    endif; 
                    ?>
                </td>
                <th>
                    <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-info btn-sm form-control" onclick="open_editpormotion_modal(<?php echo $value['POMid']; ?>);">
                            <svg id="i-edit" viewBox="0 0 32 32" width="12" height="12" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <path d="M30 7 L25 2 5 22 3 29 10 27 Z M21 6 L26 11 Z M5 22 L10 27 Z" />
                            </svg>
                        </button>
                        <button type="button" class="btn btn-warning btn-sm form-control" onclick="open_delpormotion_modal(<?php echo $value['POMid']; ?>);">
                            <svg id="i-trash" viewBox="0 0 32 32" width="12" height="12" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <path d="M28 6 L6 6 8 30 24 30 26 6 4 6 M16 12 L16 24 M21 12 L20 24 M11 12 L12 24 M12 6 L13 2 19 2 20 6" />
                            </svg>
                        </button>
                    </div>
                </th>
            </tr>    
          <?php 
                endforeach;
            endif;
            ?>      
        </tbody>
      </table>
    </div>
  </div>
  <div class="card-footer small text-muted">
  <?php
    echo 'Updated  ' . $xdate;
    ?>
  </div>
</div>

<!-- The Add Modal -->
<div class="modal fade" id="myAddsModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form name="from_promotion"enctype="multipart/form-data" id="from_promotion">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo $this->lang->line("promotionhead"); ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                  <div class="form-group">
                    <label for="sel1"><?php echo $this->lang->line("promotionsstartdate") . ' - ' . $this->lang->line("promotionsenddate"); ?>:</label>
                    <input class="form-control" type="text" id="bdaterange" name="bdaterange" value="<?php date("Y/m/d") ." - " . date("Y/m/d"); ?>" />
                    <input type="text" class="form-control" id="POMperid" name="POMperid" value="<?php echo $mysession['id'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="POMdescTH"><?php echo $this->lang->line("promotionsdescriptionTH"); ?>:</label>
                    <input type="text" class="form-control" id="POMdescTH" name="POMdescTH">
                  </div>
                  <div class="form-group">
                    <label for="POMdescEN"><?php echo $this->lang->line("promotionsdescriptionEN"); ?>:</label>
                    <input type="text" class="form-control" id="POMdescEN" name="POMdescEN">
                  </div>
                  <div class="form-group">
                    <label for="POMpcode"><?php echo $this->lang->line("promotioncode"); ?>:</label>
                    <input type="text" class="form-control" id="POMpcode" name="POMpcode">
                  </div>
                  <div class="form-group">
                    <label for="POMlink"><?php echo $this->lang->line("promotionslink"); ?>:</label>
                    <input type="text" class="form-control" id="POMlink" name="POMlink">
                  </div>
                  <div class="form-group">
                    <label for="POMdis"><?php echo $this->lang->line("promotionsdiscount"); ?>:</label>
                    <input type="text" class="form-control" id="POMdis" name="POMdis">
                  </div>                  
                  <div class="row" >
                  <?php foreach ($branch as $bkey => $bvalue): ?>
                    <div class="col-sm-6" >
                      <div class="form-check-inline">
                        <label class="form-check-label" for="chkbrh">
                          <input type="checkbox" class="form-check-input gvalue" id="chkbrh" name="chkbrh" value="<?php echo $bvalue['BRHid']; ?>" checked><?php echo $bvalue['BRHdesc'.$sl] ?>
                        </label>
                      </div>
                    </div>
                  <?php endforeach; ?>
                  </div>             
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="save_data();"><?php echo $this->lang->line("save"); ?></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- The Delete by select Modal -->
<div class="modal fade" id="myDeleteBySelectModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $this->lang->line("delcustomer"); ?></h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <?php echo $this->lang->line("deleteselect"); ?>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="delbychk(<?php echo $mysession['id']; ?>);"> <?php echo $this->lang->line("delete"); ?> </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
            </div>

        </div>
    </div>
</div>

<!-- The Delete by select Modal XXXX-->
<div class="modal fade" id="myXDeleteBySelectModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $this->lang->line("delbranch"); ?></h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <?php echo $this->lang->line("nodelete"); ?>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger disabled" > <?php echo $this->lang->line("delete"); ?> </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
            </div>

        </div>
    </div>
</div>

<!-- The Delete by 1 Modal -->
<div class="modal fade" id="myDeleteModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!--Modal Header-->
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $this->lang->line("deletepromotionhead"); ?></h4>
                <span id="xid1" style="color: #ffffff"></span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="dash1" id="dash1">

            </div>
        </div>
    </div>
</div>

<!-- The Edit Modal -->
<div class="modal fade" id="myEditModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!--Modal Header-->
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $this->lang->line("editpromotionhead"); ?></h4>
                <span id="xid" style="color: #ffffff"></span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="dash" id="dash">

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#myDeleteModal').on('shown.bs.modal', function () {
            var id = $("#xid1").html();
    //            console.log(id);
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>delpromotionbyid/" + id + "?param=true",
                success: function (data) {
                    $("#dash1").html(data);
                },
                error: function (err) {
                    console.log(err);
                }
            });
        });

        $('#myEditModal').on('shown.bs.modal', function () {
            var id = $("#xid").html();
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>showpromotionbyid/" + id + "?param=true",
                success: function (data) {
                    $("#dash").html(data);
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

    setTimeout(function () {
        $(".alert").alert('close');
    }, 2000);

    function open_delpormotion_modal(id) {
        var xid = id;
        $("#xid1").html(xid);
        $("#myDeleteModal").modal("show");
    }

    function open_editpormotion_modal(id){
        var xid = id;
        $("#xid").html(xid);
        $("#myEditModal").modal("show");
    }

    function open_delgpromotion_modal(id) {
        var myArray = [];
        var countArray = 0;
        $("input:checkbox[name=chk]:checked").each(function () {
            myArray.push($(this).val());
        });
        countArray = myArray.length;
        // console.log(myArray);
        if (countArray > 0) {
            $("#myDeleteBySelectModal").modal("show");
        } else {
            $("#myXDeleteBySelectModal").modal("show");
        }
    }

    function save_data(){
        var formData = new FormData();

        var c = 0;
        var elem = document.getElementById('from_promotion').elements;

        for (var i = 0; i < elem.length; i++) {
            if (elem[i].name != "POMlink") {
                if (elem[i].value.length == 0 && elem[i].type != "button" && elem[i].type != "file" && elem[i].type != "checkbox") {
                    // console.log(elem[i].id + ' == ' + elem[i].type);
                    alert('Please Enter a Value ');
                    document.getElementById(elem[i].id).style.backgroundColor = "#F8E6E0";
                    c = c + 1;
                }
                else{
                    if(elem[i].type != "button" && elem[i].type != "select" && elem[i].type != "file" && elem[i].type != "checkbox"){
                        document.getElementById(elem[i].id).style.backgroundColor = "#FFFFFF";
                    }
                }
            }
        }

        if(c > 0){
            console.log('false');
            return false;
        }

        var chkbrh = [];
        $('.gvalue').each(function(){  
            if($(this).is(":checked"))  
            {  
                chkbrh.push($(this).val());  
            }  
        });  

        chkbrh = chkbrh.toString();
        formData.append('POMdescTH', $('#POMdescTH').val());
        formData.append('POMdescEN', $('#POMdescEN').val());
        formData.append('POMpcode', $('#POMpcode').val());
        formData.append('POMdis', $('#POMdis').val());
        formData.append('bdaterange', $('#bdaterange').val());
        formData.append('POMlink', $('#POMlink').val());
        formData.append('POMperid', $('#POMperid').val());
        formData.append('chkbrh', chkbrh);
        

        $.ajax({
            url: "<?php echo base_url(); ?>sapromotion",
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
                    // window.location.reload(true);
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

    function edit_data(){
    var formData = new FormData();

    var c = 0;
    var elem = document.getElementById('from_epromotion').elements;

    for (var i = 0; i < elem.length; i++) {
            if (elem[i].name != "ePOMlink") {
                if (elem[i].value.length == 0 && elem[i].type != "button" && elem[i].type != "file" && elem[i].type != "checkbox") {
                    // console.log(elem[i].id + ' == ' + elem[i].type);
                    alert('Please Enter a Value ');
                    document.getElementById(elem[i].id).style.backgroundColor = "#F8E6E0";
                    c = c + 1;
                }
                else{
                    if(elem[i].type != "button" && elem[i].type != "select" && elem[i].type != "file" && elem[i].type != "checkbox"){
                        document.getElementById(elem[i].id).style.backgroundColor = "#FFFFFF";
                    }
                }
            }
        }

    if(c > 0){
        console.log('false');
        return false;
    }

    var echkbrh = [];
    $('.egvalue').each(function(){  
        if($(this).is(":checked"))  
        {  
            echkbrh.push($(this).val());  
        }  
    });

    formData.append('ePOMid', $('#ePOMid').val());
    formData.append('edateranges', $('#edateranges').val());
    formData.append('ePERid', $('#ePERid').val());
    formData.append('ePOMdescTH', $('#ePOMdescTH').val());
    formData.append('ePOMdescEN', $('#ePOMdescEN').val());
    formData.append('ePOMpcode', $('#ePOMpcode').val());
    formData.append('ePOMlink', $('#ePOMlink').val());
    formData.append('ePOMdis', $('#ePOMdis').val());
    formData.append('echkbrh', echkbrh);

    $.ajax({
        url: "<?php echo base_url(); ?>epromotion",
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
                // window.location.reload(true);
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

    function delbychk(psid)
    {
        var myArray = [];
        $("input:checkbox[name=chk]:checked").each(function () {
            myArray.push($(this).val());
        });
        console.log(myArray);
        var jsonString = JSON.stringify(myArray);

        $.ajax({
            url: "<?php echo base_url(); ?>dgpromotion",
            type: 'POST',
            data: {chkmydel: jsonString, psid},
            cache: false,
            success: function (data)
            {
                console.log(typeof data.error);
                if (typeof data.error === 'undefined')
                {
                    // Success so call function to process the form
                    console.log('SUCCESS: ' + data.success);
                    window.location.reload(true);
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

    function myFunction(x, _this, id) {
        if (_this.checked) {
            document.getElementById(x).style.backgroundColor = '#fff2e6';
        } else {
            document.getElementById(x).style.backgroundColor = '#ffffff';
        }
    }

    function del_data(){
        var formData = new FormData();

        formData.append('delPOMperid', $('#delPOMperid').val());
        formData.append('delPOMid', $('#delPOMid').val());

        $.ajax({
            url: "<?php echo base_url(); ?>dpromotion",
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