<?php
// $branchname = json_decode($branch, TRUE)['data'];
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

<div class="container-fluid" >
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link active" href="#" id="btext">
            <?php 
            if (isset($branchid)) {
                echo($branchid['BRHdesc'.$sl]);
            } else {
                echo("All");
            }
            
            ?>
            </a>
        </li>
        <?php if(isset($branch)): ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">เลือกสาขา</a>
            <div class="dropdown-menu">
                <?php foreach($branch as $bkey => $bvalue): ?>
                <a class="dropdown-item" href="<?php echo base_url(); ?>roombybranch/<?php echo($bvalue['BRHid']); ?>"><?php echo($bvalue['BRHdesc'.$sl] . ' <b>( ' . $bvalue['rooms']['myRoom'] . ' Rooms)</b>'); ?></a>
                <?php endforeach; ?>
            </div>
        </li>
        <?php 
        endif; 

        if(isset($branchid)):
        ?>
        <li class="nav-item">
            <a class="nav-link active" href="<?php echo base_url(); ?>empmain/M3001" style="background-color:#ff6600">ยกเลิกการค้นหา</a>
        </li>
        <?php endif; ?>
        <!-- 
        <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
        </li> -->
    </ul>
</div>

<!-- Example DataTables Card-->
<div class="card mb-3" style="margin-top:15px;">
    <div class="card-header">
        <i class="fa fa-table"></i> Room Management
    </div>
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

            <?php // debug($branch); ?>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th><?php echo $this->lang->line("no"); ?></th>
                        <th><?php echo $this->lang->line("branchname"); ?></th>
                        <th><?php echo $this->lang->line("roomno"); ?></th>
                        <th><?php echo $this->lang->line("roomname"); ?></th>
                        <th><?php echo $this->lang->line("roomnature"); ?></th>
                        <th><?php echo $this->lang->line("roomtype"); ?></th>
                        <th><?php echo $this->lang->line("roomdetails"); ?></th>
                        <th><?php echo $this->lang->line("price"); ?></th>
                        <th>Action</th>
                    </tr>
                </thead>
                <!-- <tfoot>
                    <tr>
                        <th><?php echo $this->lang->line("branchname"); ?></th>
                        <th><?php echo $this->lang->line("roomno"); ?></th>
                        <th><?php echo $this->lang->line("roomname"); ?></th>
                        <th><?php echo $this->lang->line("roomnature"); ?></th>
                        <th><?php echo $this->lang->line("roomtype"); ?></th>
                        <th><?php echo $this->lang->line("roomdetails"); ?></th>
                        <th><?php echo $this->lang->line("price"); ?></th>
                        <th>Action</th>
                    </tr>
                </tfoot> -->
                <tbody>
                    <?php
                    if(isset($room)):
                        foreach($room as $rkey => $rvalue):
                    ?>
                    <tr>
                        <td><?php echo $rkey + 1 ?></td>
                        <td><?php echo($rvalue['branch'][0]['BRHdesc'.$sl]) ?></td>
                        <td><?php echo($rvalue['ROMno']) ?></td>
                        <td><?php echo($rvalue['ROMdesc'.$sl]) ?></td>
                        <td><?php echo($rvalue['nature'][0]['USCdesc'.$sl]) ?></td>
                        <td>
                            <?php 
                            if(isset($rvalue['type'])):
                                foreach($rvalue['type'] as $tkey => $tvalue):
                                    echo($tkey+1 . '.  ' . $tvalue['USCdesc'.$sl] . "<br>");
                                endforeach;
                            endif;
                            ?>
                        </td>
                        <td>
                        <?php 
                            if(isset($rvalue['accessories'])):
                                foreach($rvalue['accessories'] as $akey => $avalue):
                                    echo($akey+1 . '.  ' . $avalue['RASdesc'.$sl] . "<br>");
                                endforeach;
                            endif;
                            ?>
                        </td>
                        <td><?php echo(number_format($rvalue['ROMpice'], 2, '.', '') ) ?></td>
                        <td>
                        <div class="btn-group btn-group-xs">
                            <button type="button" class="btn btn-info btn-sm form-control" onclick="open_editrooms_modal(<?php echo $rvalue['ROMid']; ?>);">
                                <svg id="i-edit" viewBox="0 0 32 32" width="12" height="12" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                <path d="M30 7 L25 2 5 22 3 29 10 27 Z M21 6 L26 11 Z M5 22 L10 27 Z" />
                                </svg>
                            </button>
                            <button type="button" class="btn btn-warning btn-sm form-control" onclick="open_delrooms_modal(<?php echo $rvalue['ROMid']; ?>);">
                                <svg id="i-trash" viewBox="0 0 32 32" width="12" height="12" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                <path d="M28 6 L6 6 8 30 24 30 26 6 4 6 M16 12 L16 24 M21 12 L20 24 M11 12 L12 24 M12 6 L13 2 19 2 20 6" />
                                </svg>
                            </button>
                        </div>
                        </td>
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
        <?php echo 'Updated  ' . $xdate; ?>
    </div>
</div>

<!-- The Add Modal -->
<div class="modal fade" id="myAddsModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form name="from_room"enctype="multipart/form-data" id="from_room">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo $this->lang->line("roominsert"); ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                <?php  // debug($mysession); ?>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="ROMcreatedBy" name="ROMcreatedBy" value="<?php echo $mysession['id'] ?>">
                        <label for="ROMbrhid"><?php echo $this->lang->line("branchname"); ?>:</label>                        
                        <select class="form-control" id="ROMbrhid" name="ROMbrhid" onchange="getAccessories(this.value);">
                            <option value="909090" hidden></option>
                            <?php 
                            if(isset($branch)):
                                foreach($branch as $bkey => $bvalue):
                            ?>
                            <option value="<?php echo $bvalue['BRHid']; ?>"><?php echo($bvalue['BRHdesc'.$sl] . ' <b>( ' . $bvalue['rooms']['myRoom'] . ' Rooms)</b>'); ?></option>
                            <?php 
                                endforeach;
                            endif;
                            ?>
                        </select>                    
                    </div>
                    <div class="dash" id="dash"></div>  
                </div>
            </form>
        </div>
    </div>
</div>

<!-- The Edit Modal -->
<div class="modal fade" id="myEditModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!--Modal Header-->
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $this->lang->line("roomedit"); ?></h4>
                <span id="xid" style="color: #ffffff"></span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="dash1" id="dash1">

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
                <h4 class="modal-title"><?php echo $this->lang->line("roomdelete"); ?></h4>
                <span id="xid1" style="color: #ffffff"></span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="dash2" id="dash2">

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
                url: "<?php echo base_url(); ?>showroombyid/" + id + "?param=true",
                success: function (data) {
                    $("#dash1").html(data);
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
                url: "<?php echo base_url(); ?>delroombyid/" + id + "?param=true",
                success: function (data) {
                    $("#dash2").html(data);
                },
                error: function (err) {
                    console.log(err);
                }
            });
        });

    });

    function getAccessories(id){
        // console.log(id);
        
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>getaccessories/" + id,
            success: function (data) {
                $("#dash").html(data);
            },
            error: function (err) {
                console.log(err);
                console.log('ccccccccccccc');
            } 
        });
    }

    function resetSelected(){
        select_box = document.getElementById("ROMbrhid");
        select_box.selectedIndex = 909090;
    }

    function open_editrooms_modal(id){
        var xid = id;
        $("#xid").html(xid);
        $("#myEditModal").modal("show");
    }

    function open_delrooms_modal(id){
        var xid = id;
        $("#xid1").html(xid);
        $("#myDeleteModal").modal("show");
    }

    function del_data(){
        var formData = new FormData();

        formData.append('delROMperid', $('#delROMperid').val());
        formData.append('delROMid', $('#delROMid').val());

        $.ajax({
            url: "<?php echo base_url(); ?>droom",
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

    function save_data(){
        var formData = new FormData();

        var c = 0;
        var elem = document.getElementById('from_room').elements;

        for (var i = 0; i < elem.length; i++) {
            if (elem[i].name != "ROMstart" && elem[i].name != "ROMend") {
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

        var chktype = [];
        $('.gvalue1').each(function(){  
            if($(this).is(":checked"))  
            {  
                chktype.push($(this).val());  
            }  
        });  

        var chkaccess = [];
        $('.gvalue2').each(function(){  
            if($(this).is(":checked"))  
            {  
                chkaccess.push($(this).val());  
            }  
        });  

        chktype = chktype.toString();
        chkaccess = chkaccess.toString();
        
        formData.append('ROMcreatedBy', $('#ROMcreatedBy').val());
        formData.append('ROMbrhid', $('#ROMbrhid').val());
        formData.append('ROMstart', $('#ROMstart').val());
        formData.append('ROMnum', $('#ROMnum').val());
        formData.append('ROMend', $('#ROMend').val());
        formData.append('ROMcount', $('#ROMcount').val());
        formData.append('ROMdescTH', $('#ROMdescTH').val());
        formData.append('ROMdescEN', $('#ROMdescEN').val());
        formData.append('ROMnature', $('#ROMnature').val());
        formData.append('ROMtype', chktype);
        formData.append('ROMrasid', chkaccess);
        formData.append('ROMlimit', $('#ROMlimit').val());
        formData.append('ROMpice', $('#ROMpice').val());        

        $.ajax({
            url: "<?php echo base_url(); ?>sarooms",
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

        resetSelected();
    }

    function edit_data(){
        var formData = new FormData();
        var c = 0;
        var elem = document.getElementById('from_eroom').elements;

        for (var i = 0; i < elem.length; i++) {
            if (elem[i].name != "ROMstart" && elem[i].name != "ROMend") {
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

        var echktype = [];
        $('.gvalue').each(function(){  
            if($(this).is(":checked"))  
            {  
                echktype.push($(this).val());  
            }  
        });  

        var echkaccess = [];
        $('.gvalue').each(function(){  
            if($(this).is(":checked"))  
            {  
                echkaccess.push($(this).val());  
            }  
        });  

        echktype = echktype.toString();
        echkaccess = echkaccess.toString();
        formData.append('eROMid', $('#eROMid').val());
        formData.append('eROMbrhid', $('#eROMbrhid').val());
        formData.append('eROMcreatedBy', $('#eROMcreatedBy').val());
        formData.append('eROMnum', $('#eROMnum').val());
        formData.append('eROMdescTH', $('#eROMdescTH').val());
        formData.append('eROMdescEN', $('#eROMdescEN').val());
        formData.append('eROMnature', $('#eROMnature').val());
        formData.append('eROMtype', echktype);
        formData.append('eROMrasid', echkaccess);
        formData.append('eROMlimit', $('#eROMlimit').val());
        formData.append('eROMpice', $('#eROMpice').val());

        $.ajax({
        url: "<?php echo base_url(); ?>eroom",
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
</script>