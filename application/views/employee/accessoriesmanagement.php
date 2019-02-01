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

<!-- Example DataTables Card-->
<div class="card mb-3">
    <div class="card-header">
        <i class="fa fa-wrench"></i> Accessories management</div>
    <div class="card-body">
        <div class="table-responsive">
        <?php // debug($access); ?>

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
                <th><?php echo $this->lang->line("branchname"); ?></th>
                <th><?php echo $this->lang->line("roomdetails"); ?></th>
                <th><?php echo $this->lang->line("quantity"); ?></th>
                <th><?php echo $this->lang->line("priceunit"); ?></th>
                <th><?php echo $this->lang->line("warranty"); ?></th>
                <th><?php echo $this->lang->line("purchasedate"); ?></th>
                <th>Action</th>
            </tr>
            </thead>
            <!-- <tfoot>
            <tr>
                <th>
                    <button type="button" class="btn btn-warning btn-sm form-control" onclick="open_delgaccessories_modal();">
                        <svg id="i-trash" viewBox="0 0 32 32" width="12" height="12" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        <path d="M28 6 L6 6 8 30 24 30 26 6 4 6 M16 12 L16 24 M21 12 L20 24 M11 12 L12 24 M12 6 L13 2 19 2 20 6" />
                        </svg>
                    </button>
                </th>
                <th>สาขา</th>
                <th>อุปกรณ์</th>
                <th>จำนวน</th>
                <th>ราคา</th>
                <th>ประกัน</th>
                <th>วันที่ซื้อ</th>
                <th>Action</th>
            </tr>
            </tfoot> -->
            <tbody>
            <?php
            if(isset($access)):
                foreach($access as $key => $value):
            ?>
            <tr  id="tr<?php echo $value['RASid'].''; ?>">
                <td style="display: none;">
                    <div class="form-check" >
                        <label class="form-check-label">
                        <input type="checkbox" id="<?php echo $value['RASid']; ?>" class="form-check-input" value="<?php  echo $value['RASid']; ?>" name="chk" onchange="myFunction('tr' + this.id, this, this.id)"><?php  echo $this->lang->line("select"); ?>
                        </label>
                    </div>
                </td>
                <td><?php echo $key + 1 ?></td>
                <td><?php echo $value['branch'][0]['BRHdesc'.$sl] ?></td>
                <td><?php echo $value['RASdesc'.$sl] ?></td>
                <td><?php echo number_format($value['RASquan'], 0, '', '') ?></td>
                <td><?php echo number_format($value['RASprice'], 2, '.', '') ?></td>
                <td><?php echo $value['USCdesc'.$sl] ?></td>
                <td><?php echo $value['RAScreatedDT'] ?></td>
                <th>
                    <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-info btn-sm form-control" onclick="open_editaccessories_modal(<?php  echo $value['RASid']; ?>);">
                            <svg id="i-edit" viewBox="0 0 32 32" width="12" height="12" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <path d="M30 7 L25 2 5 22 3 29 10 27 Z M21 6 L26 11 Z M5 22 L10 27 Z" />
                            </svg>
                        </button>
                        <button type="button" class="btn btn-warning btn-sm form-control" onclick="open_delaccessories_modal(<?php  echo $value['RASid']; ?>);">
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
    <div class="card-footer small text-muted"><?php echo 'Updated  ' . $xdate; ?></div>
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
                        <label for="RASbrhid"><?php echo $this->lang->line("branchname"); ?>:</label>
                        <select class="form-control" id="RASbrhid" name="RASbrhid">
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
                    </div>
                    <div class="form-group">
                        <label for="RASdescTH"><?php echo $this->lang->line("devicenameth"); ?>:</label>
                        <input type="text" class="form-control" id="RASdescTH" name="RASdescTH">
                    </div>
                    <div class="form-group">
                        <label for="RASdescEN"><?php echo $this->lang->line("devicenameen"); ?>:</label>
                        <input type="text" class="form-control" id="RASdescEN" name="RASdescEN">
                    </div>
                    <div class="form-group">
                        <label for="RASquan"><?php echo $this->lang->line("quantity"); ?>:</label>
                        <input type="text" class="form-control" id="RASquan" name="RASquan">
                    </div>
                    <div class="form-group">
                        <label for="RASprice"><?php echo $this->lang->line("priceunit"); ?>:</label>
                        <input type="text" class="form-control" id="RASprice" name="RASprice">
                    </div>
                    <div class="form-group">
                        <label for="RASwar"><?php echo $this->lang->line("warranty"); ?>:</label>
                        <select class="form-control" id="RASwar" name="RASwar">
                            <?php 
                            if(isset($warranty)):
                                foreach($warranty as $wkey => $wvalue):
                            ?>
                                <option value="<?php echo $wvalue['USCcode']; ?>"><?php echo $wvalue['USCdesc' . $sl]; ?></option>
                            <?php 
                                endforeach;
                            endif;
                            ?>
                        </select>                        
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

<!-- The Delete by 1 Modal -->
<div class="modal fade" id="myDeleteModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!--Modal Header-->
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $this->lang->line("delacc"); ?></h4>
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
                <h4 class="modal-title"><?php echo $this->lang->line("editacc"); ?></h4>
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
                url: "<?php echo base_url(); ?>delaccessoriesbyid/" + id + "?param=true",
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
                url: "<?php echo base_url(); ?>showaccessoriesbyid/" + id + "?param=true",
                success: function (data) {
                    $("#dash").html(data);
                },
                error: function (err) {
                    console.log(err);
                }
            });
        });

    });

    function delbychk(psid)
    {
        var myArray = [];
        $("input:checkbox[name=chk]:checked").each(function () {
            myArray.push($(this).val());
        });
        console.log(myArray);
        var jsonString = JSON.stringify(myArray);

        $.ajax({
            url: "<?php echo base_url(); ?>dgaccessories",
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

    function open_delgaccessories_modal(id){
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

        for (var i = 0; i < elem.length; i++) {
            if (elem[i].name != "RASprice") {
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

        formData.append('RASbrhid', $('#RASbrhid').val());
        formData.append('RASdescTH', $('#RASdescTH').val());
        formData.append('RASdescEN', $('#RASdescEN').val());
        formData.append('RASquan', $('#RASquan').val());
        formData.append('RASprice', $('#RASprice').val());
        formData.append('RASwar', $('#RASwar').val());

        $.ajax({
            url: "<?php echo base_url(); ?>saccessories",
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

    function myFunction(x, _this, id) {
        if (_this.checked) {
            document.getElementById(x).style.backgroundColor = '#fff2e6';
        } else {
            document.getElementById(x).style.backgroundColor = '#ffffff';
        }
    }

    function open_delaccessories_modal(id){
        var xid = id;
        $("#xid1").html(xid);
        $("#myDeleteModal").modal("show");
    }

    function open_editaccessories_modal(id){
        var xid = id;
        $("#xid").html(xid);
        $("#myEditModal").modal("show");
    }

    function del_data(){
        var formData = new FormData();

        formData.append('delRASperid', $('#delRASperid').val());
        formData.append('delRASid', $('#delRASid').val());

        $.ajax({
            url: "<?php echo base_url(); ?>daccessories",
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

    function edit_data() {
        var formData = new FormData();

        var c = 0;
        var elem = document.getElementById('from_eaccessories').elements;

        for (var i = 0; i < elem.length; i++) {
            if (elem[i].name != "RASprice") {
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
        
        formData.append('eRASid', $('#eRASid').val());
        formData.append('eRASbrhid', $('#eRASbrhid').val());
        formData.append('eRASdescTH', $('#eRASdescTH').val());
        formData.append('eRASdescEN', $('#eRASdescEN').val());
        formData.append('eRASquan', $('#eRASquan').val());
        formData.append('eRASprice', $('#eRASprice').val());
        formData.append('eRASwar', $('#eRASwar').val());

        $.ajax({
            url: "<?php echo base_url(); ?>eaccessories",
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
</script>