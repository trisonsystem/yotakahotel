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
    <i class="fa fa-user-circle"></i> Personnel management</div>
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
        <?php // debug($personnel) ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th style="display: none;">Delete</th>
            <th><?php echo $this->lang->line("no"); ?></th>
            <th><?php echo $this->lang->line("cname"); ?></th>
            <th><?php echo $this->lang->line("address"); ?></th>
            <th><?php echo $this->lang->line("phonenumber"); ?></th>
            <th><?php echo $this->lang->line("username"); ?></th>
            <th><?php echo $this->lang->line("branchname"); ?></th>
            <th>Action</th>
          </tr>
        </thead>
        <!-- <tfoot>           
            <tr>
                <th>
                    <button type="button" class="btn btn-warning btn-sm form-control" onclick="open_delgpersonnel_modal();">
                        <svg id="i-trash" viewBox="0 0 32 32" width="12" height="12" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        <path d="M28 6 L6 6 8 30 24 30 26 6 4 6 M16 12 L16 24 M21 12 L20 24 M11 12 L12 24 M12 6 L13 2 19 2 20 6" />
                        </svg>
                    </button>
                </th>
                <th><?php echo $this->lang->line("no"); ?></th>
                <th><?php echo $this->lang->line("cname"); ?></th>
                <th><?php echo $this->lang->line("address"); ?></th>
                <th><?php echo $this->lang->line("phonenumber"); ?></th>
                <th><?php echo $this->lang->line("username"); ?></th>
                <th><?php echo $this->lang->line("branchname"); ?></th>
                <th>Action</th>
            </tr>            
        </tfoot> -->
        <tbody>
            <?php 
            if (isset($personnel)) :
                foreach ($personnel as $key => $value):
            ?>
            <tr id="tr<?php echo $value['PERid'].''; ?>">
                <td style="display: none;">
                    <div class="form-check" >
                        <label class="form-check-label">
                        <input type="checkbox" id="<?php echo $value['PERid']; ?>" class="form-check-input" value="<?php  echo $value['PERid']; ?>" name="chk" onchange="myFunction('tr' + this.id, this, this.id)"><?php  echo $this->lang->line("select"); ?>
                        </label>
                    </div>
                </td>
                <td><?php echo $key + 1 ?></td>
                <td><?php echo $value['PERfname'] . ' - ' . $value['PERlname'] ?></td>
                <td><?php echo $value['PERadr'] ?></td>
                <td><?php echo $value['PERnphone'] ?></td>
                <td><?php echo $value['PERuname'] ?></td>
                <td><?php echo $value['branchName']['BRHdescTH'] ?></td>
                <th>
                    <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-info btn-sm form-control" onclick="open_editpersonnel_modal(<?php  echo $value['PERid']; ?>);">
                            <svg id="i-edit" viewBox="0 0 32 32" width="12" height="12" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <path d="M30 7 L25 2 5 22 3 29 10 27 Z M21 6 L26 11 Z M5 22 L10 27 Z" />
                            </svg>
                        </button>
                        <button type="button" class="btn btn-warning btn-sm form-control" onclick="open_delpersonnel_modal(<?php  echo $value['PERid']; ?>);">
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
            <form name="from_personnel"enctype="multipart/form-data" id="from_personnel">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo $this->lang->line("personnelhead"); ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>                
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="PERidc"><?php echo $this->lang->line("idcard"); ?>:</label>
                        <input type="text" class="form-control" id="PERidc" name="PERidc">
                    </div>
                    <div class="form-group">
                        <label for="PERtitle"><?php echo $this->lang->line("titlename"); ?>:</label>                        
                        <select class="form-control" id="PERtitle" name="PERtitle">
                            <?php 
                            if(isset($titlename)):
                                foreach($titlename as $tkey => $tvalue):
                            ?>
                            <option value="<?php echo $tvalue['USCcode']; ?>"><?php echo $tvalue['USCdesc' . $sl]; ?></option>
                            <?php 
                                endforeach;
                            endif;
                            ?>
                        </select>                    
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="PERfname"><?php echo $this->lang->line("fristname"); ?>:</label>
                                <input type="text" class="form-control" id="PERfname" name="PERfname">
                            </div>
                            <div class="col-sm-6">
                                <label for="PERlname"><?php echo $this->lang->line("lastname"); ?>:</label>
                                <input type="text" class="form-control" id="PERlname" name="PERlname">  
                            </div>
                        </div>                        
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="PERdepid"><?php echo $this->lang->line("department"); ?>:</label>
                                <select class="form-control" id="PERdepid" name="PERdepid" onchange="selectbydepartment(this.value)">
                                <option hidden></option>
                                <?php 
                                if(isset($department)):
                                    foreach($department as $dkey => $dvalue):
                                ?>
                                    <option value="<?php echo $dvalue['DEPid']; ?>"><?php echo $dvalue['DEPdesc' . $sl]; ?></option>
                                <?php 
                                    endforeach;
                                endif;
                                ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="PERlevel"><?php echo $this->lang->line("position"); ?>:</label>
                                <div id="myDIV">
                                    <select class="form-control" id="xPERlevel" name="xPERlevel">
                                        <option><?php echo $this->lang->line("selectdepartment"); ?></option>
                                    </select>
                                </div>
                                <div class="bydepartment" id="bydepartment"></div>
                            </div>
                        </div>                        
                    </div>
                    <div class="form-group">
                        <label for="PERadr"><?php echo $this->lang->line("address"); ?>:</label>
                        <textarea class="form-control" rows="3" id="PERadr" name="PERadr"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="PERbday"><?php echo $this->lang->line("brithday"); ?></label>
                        <input class="form-control" type="date" value="2011-08-19" id="PERbday" name="PERbday">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="PERemail"><?php echo $this->lang->line("email"); ?>:</label>
                                <input type="text" class="form-control" id="PERemail" name="PERemail">
                            </div>
                            <div class="col-sm-6">
                                <label for="PERnphone"><?php echo $this->lang->line("phonenumber"); ?>:</label>
                                <input type="text" class="form-control" id="PERnphone" name="PERnphone">  
                            </div>
                        </div>                          
                    </div>
                    <div class="form-group">
                        <label for="PERuname">Username:</label>
                        <input type="text" class="form-control" id="PERuname" name="PERuname">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="PERpawo">Password:</label>
                                <input type="password" class="form-control" id="PERpawo" name="PERpawo">
                            </div>
                            <div class="col-sm-6">
                                <label for="PERcpawo">Confirm Password:</label>
                                <input type="password" class="form-control" id="PERcpawo" name="PERcpawo"> 
                            </div>
                        </div>                         
                    </div>
                    <div class="form-group">
                        
                    </div>
                    <div class="form-group">
                        <label for="PERbrhid"><?php echo $this->lang->line("branchname"); ?>:</label>
                        <select class="form-control" id="PERbrhid" name="PERbrhid">
                            <?php 
                                if(isset($branch)):
                                    foreach($branch as $bkey => $bvalue):
                                ?>
                                    <option value="<?php echo $bvalue['BRHid']; ?>"><?php echo $bvalue['BRHdesc' . $sl]; ?></option>
                                <?php 
                                    endforeach;
                                endif;
                                ?>
                        </select>
                        <input type="hidden" class="form-control" id="PERses" name="PERses" value="<?php echo($ses['id']); ?>">
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

<!-- The Delete by select Modal -->
<div class="modal fade" id="myDeleteBySelectModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $this->lang->line("delpersonnel"); ?></h4>
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

<!-- The Edit Modal -->
<div class="modal fade" id="myEditModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!--Modal Header-->
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $this->lang->line("personneledit"); ?></h4>
                <span id="xid" style="color: #ffffff"></span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="dash" id="dash">

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
                <h4 class="modal-title"><?php echo $this->lang->line("delpersonnel"); ?></h4>
                <span id="xid1" style="color: #ffffff"></span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="dash1" id="dash1">

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#myEditModal').on('shown.bs.modal', function () {
            var id = $("#xid").html();
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>showpersonnelbyid/" + id + "?param=true",
                success: function (data) {
                    $("#dash").html(data);
                },
                error: function (err) {
                    console.log(err);
                }
            });
        });

        $('#myDeleteModal').on('shown.bs.modal', function () {
            var id = $("#xid1").html();
    //            console.log(id);
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>delpersonnelbyid/" + id + "?param=true",
                success: function (data) {
                    $("#dash1").html(data);
                },
                error: function (err) {
                    console.log(err);
                }
            });
        });
    });

    setTimeout(function () {
        $(".alert").alert('close');
    }, 2000);

    function selectbydepartment(value){
      console.log(value);
      if (value != 0 || value != '') {
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>bydepartment/" + value + "?param=true",
            success: function (data) {
                document.getElementById("myDIV").style.display = "none";
                document.getElementById("xmyDIV").style.display = "none";
                $("#bydepartment").html(data);
                $("#xbydepartment").html(data);
            },
            error: function (err) {
                console.log(err);
            }
        });
      }

    }

    function myFunction(x, _this, id) {
        if (_this.checked) {
            document.getElementById(x).style.backgroundColor = '#fff2e6';
        } else {
            document.getElementById(x).style.backgroundColor = '#ffffff';
        }
    }

    function open_delgpersonnel_modal(id) {
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
        var elem = document.getElementById('from_personnel').elements;
        var pass  = document.getElementById("PERpawo").value;
        var rpass  = document.getElementById("PERcpawo").value;

        if (pass != rpass) {
            alert('Password is not matching');
            return false;
        }

        for (var i = 0; i < elem.length; i++) {
            if (elem[i].name != "PERemail" && elem[i].name != "PERnphone") {
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

        }

        if(c > 0){
            console.log('false');
            return false;
        }

        if (PERidc.value.length < 12) {
            alert('Please check id card or passport < 13');
            return false;
        }

        formData.append('PERidc', $('#PERidc').val());
        formData.append('PERtitle', $('#PERtitle').val());
        formData.append('PERfname', $('#PERfname').val());
        formData.append('PERlname', $('#PERlname').val());
        formData.append('PERdepid', $('#PERdepid').val());
        formData.append('PERlevel', $('#PERlevel').val());
        formData.append('PERadr', $('#PERadr').val());
        formData.append('PERbday', $('#PERbday').val());
        formData.append('PERemail', $('#PERemail').val());
        formData.append('PERnphone', $('#PERnphone').val());
        formData.append('PERuname', $('#PERuname').val());
        formData.append('PERpawo', $('#PERpawo').val());
        formData.append('PERbrhid', $('#PERbrhid').val());
        formData.append('PERses', $('#PERses').val());

        $.ajax({
        url: "<?php echo base_url(); ?>spersonnel",
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

    function delbychk(psid)
    {
        var myArray = [];
        $("input:checkbox[name=chk]:checked").each(function () {
            myArray.push($(this).val());
        });
        console.log(myArray);
        var jsonString = JSON.stringify(myArray);

        $.ajax({
            url: "<?php echo base_url(); ?>dgpersonnel",
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

    function open_editpersonnel_modal(id){
        var xid = id;
        $("#xid").html(xid);
        $("#myEditModal").modal("show");
    }

    function edit_data(){
        var formData = new FormData();

        var c = 0;
        var elem = document.getElementById('from_epersonnel').elements;

        for (var i = 0; i < elem.length; i++) {
            if (elem[i].name != "PERemail" && elem[i].name != "PERnphone") {
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
        }

        if(c > 0){
            console.log('false');
            return false;
        }

        if (ePERidc.value.length < 12) {
            alert('Please check id card or passport < 13');
            return false;
        }

        formData.append('ePERidc', $('#ePERidc').val());
        formData.append('ePERtitle', $('#ePERtitle').val());
        formData.append('ePERfname', $('#ePERfname').val());
        formData.append('ePERlname', $('#ePERlname').val());
        formData.append('ePERdepid', $('#ePERdepid').val());
        formData.append('PERlevel', $('#PERlevel').val());
        // formData.append('xPERlevel', $('#xPERlevel').val());
        formData.append('ePERadr', $('#ePERadr').val());
        formData.append('ePERbday', $('#ePERbday').val());
        formData.append('ePERemail', $('#ePERemail').val());
        formData.append('ePERnphone', $('#ePERnphone').val());
        formData.append('ePERbrhid', $('#ePERbrhid').val());
        formData.append('ePERses', $('#ePERses').val());
        formData.append('ePERid', $('#ePERid').val());

        $.ajax({
        url: "<?php echo base_url(); ?>epersonnel",
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

    function open_delpersonnel_modal(id){
        var xid = id;
        $("#xid1").html(xid);
        $("#myDeleteModal").modal("show");
    }

    function del_data(){
        var formData = new FormData();

        formData.append('delPERperid', $('#delPERperid').val());
        formData.append('delPERid', $('#delPERid').val());

        $.ajax({
            url: "<?php echo base_url(); ?>dpersonnel",
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