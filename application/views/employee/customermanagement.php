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
        <i class="fa fa-table"></i> Customer Management
    </div>
    <div class="card-body">
        <?php // debug($datafromapi); ?>
        <div class="table-responsive">
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
                        <th><?php // echo $this->lang->line("customomercode"); ?>Username</th>
                        <th><?php echo $this->lang->line("customomername"); ?></th>
                        <th><?php echo $this->lang->line("address"); ?></th>
                        <th><?php echo $this->lang->line("brithday"); ?></th>
                        <th><?php echo $this->lang->line("customomertype"); ?></th>
                        <th>Action</th>
                    </tr>
                </thead>
                <!-- <tfoot>
                    <tr>
                        <th>
                            <button type="button" class="btn btn-warning btn-sm form-control" onclick="open_delgcustomer_modal();">
                                <svg id="i-trash" viewBox="0 0 32 32" width="12" height="12" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                <path d="M28 6 L6 6 8 30 24 30 26 6 4 6 M16 12 L16 24 M21 12 L20 24 M11 12 L12 24 M12 6 L13 2 19 2 20 6" />
                                </svg>
                            </button>
                        </th>
                        <th><?php echo $this->lang->line("customomercode"); ?></th>
                        <th><?php echo $this->lang->line("customomername"); ?></th>
                        <th><?php echo $this->lang->line("address"); ?></th>
                        <th><?php echo $this->lang->line("brithday"); ?></th>
                        <th><?php echo $this->lang->line("customomertype"); ?></th>
                        <th>Action</th>
                    </tr>
                </tfoot> -->
                <tbody>
                    <?php
                    if (isset($datafromapi)) :
                    foreach ($datafromapi as $key => $value): 
                    ?>
                            <tr id="tr<?php echo $value['CUSid']; ?>" >
                                <th style="display: none;">
                                    <div class="form-check" >
                                        <label class="form-check-label">
                                            <?php if ($value['CUSid'] != 1) : ?>
                                                <input type="checkbox" id="<?php echo $value['CUSid']; ?>" class="form-check-input" value="<?php echo $value['CUSid']; ?>" name="chk" onchange="myFunction('tr' + this.id, this, this.id)"><?php echo $this->lang->line("select"); ?>
                                            <?php else : ?>
                                                <svg id="i-ban" viewBox="0 0 32 32" width="32" height="32" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                <circle cx="16" cy="16" r="14" />
                                                <path d="M6 6 L26 26" />
                                                </svg>
                                            <?php endif; ?>
                                        </label>
                                    </div>
                                </th>
                                <td><?php echo $key + 1 ?></td>
                                <td><?php echo $value['CUSuname']; ?></td>
                                <td><?php echo $value['TITLEdesc' . $sl] . '  ' . $value['CUSfname'] . '  ' . $value['CUSlname']; ?></td>
                                <td width = "20%"><?php echo $value['CUSadr'] . '  ' . $this->lang->line("email") . ': ' . $value['CUSemail'] . '  ' . $this->lang->line("phonenumber") . ': ' . $value['CUSnphone'] ?></td>
                                <td><?php echo date("Y-m-d", strtotime($value['CUSbday'])); ?></td>
                                <td><?php echo $value['TYPEdesc' . $sl]; ?></td>
                                <th>
                                    <div class="btn-group btn-group-xs">
                                        <button type="button" class="btn btn-info btn-sm form-control" onclick="open_editcustomer_modal(<?php echo $value['CUSid']; ?>);">
                                            <svg id="i-edit" viewBox="0 0 32 32" width="12" height="12" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                            <path d="M30 7 L25 2 5 22 3 29 10 27 Z M21 6 L26 11 Z M5 22 L10 27 Z" />
                                            </svg>
                                        </button>
                                        <button type="button" class="btn btn-warning btn-sm form-control" onclick="open_delcustomer_modal(<?php echo $value['CUSid']; ?>);">
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
        <!--Updated yesterday at 11:59 PM-->
        <?php
        echo 'Updated  ' . $xdate;
        ?>
    </div>
</div>
<!-- /.container-fluid-->

<!-- /.container-fluid-->
<!-- /.content-wrapper-->


<!-- The Add Modal -->
<div class="modal fade" id="myAddsModal">
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
                        <button type="button" class="btn btn-success" onclick="save_data();"><?php echo $this->lang->line("save"); ?></button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
                    </div>
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
                <h4 class="modal-title"><?php echo $this->lang->line("customomerheadedit"); ?></h4>
                <span id="xid" style="color: #ffffff"></span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="dash" id="dash">

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
    <div class="modal-dialog">
        <div class="modal-content">

            <!--Modal Header-->
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $this->lang->line("delcustomer"); ?></h4>
                <span id="xid1" style="color: #ffffff"></span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="dash1" id="dash1">

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


<script>
    setTimeout(function () {
        $(".alert").alert('close');
    }, 3000);

    $(document).ready(function () {
        $('#myEditModal').on('shown.bs.modal', function () {
            var id = $("#xid").html();
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>editcustomer/" + id + "?param=true",
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
                url: "<?php echo base_url(); ?>delcustomer/" + id + "?param=true",
                success: function (data) {
                    $("#dash1").html(data);
                },
                error: function (err) {
                    console.log(err);
                }
            });
        });

    });

    function open_editcustomer_modal(id) {
        var xid = id;
        $("#xid").html(xid);
        $("#myEditModal").modal("show");
//        $("#myModal").modal("show");
    }

    function open_delcustomer_modal(id) {
        var xid = id;
        $("#xid1").html(xid);
        $("#myDeleteModal").modal("show");
    }

    function open_delgcustomer_modal(id) {
        var myArray = [];
        var countArray = 0;
        $("input:checkbox[name=chk]:checked").each(function () {
            myArray.push($(this).val());
        });
        countArray = myArray.length;

        if (countArray > 0) {
            $("#myDeleteBySelectModal").modal("show");
        } else {
            $("#myXDeleteBySelectModal").modal("show");
        }

    }

    function save_data() {
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

    function edit_data() {

        var formData = new FormData();

        var c = 0;
        var elem = document.getElementById('from_ecustomerhmanagement').elements;
        elem.length
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

        formData.append("editCUSpic", $('#editCUSpic')[0].files[0]);
        formData.append('eCUSpic', $('#eCUSpic').val());

        formData.append('editCUSid', $('#editCUSid').val());
        formData.append('editCUSidc', $('#editCUSidc').val());
        formData.append('editCUStitle', $('#editCUStitle').val());
        formData.append('editCUSfname', $('#editCUSfname').val());
        formData.append('editCUSlname', $('#editCUSlname').val());
        formData.append('editCUSadr', $('#editCUSadr').val());
        formData.append('editCUSzipc', $('#editCUSzipc').val());
        formData.append('editCUSbday', $('#editCUSbday').val());
        formData.append('editCUSemail', $('#editCUSemail').val());
        formData.append('editCUSnphone', $('#editCUSnphone').val());
        formData.append('editCUStype', $('#editCUStype').val());

        formData.append('editCUSbrhid', $('#editCUSbrhid').val());


        $.ajax({
            url: "<?php echo base_url(); ?>ecustomer",
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

    function del_data() {
        var formData = new FormData();
        formData.append('delCUSid', $('#delCUSid').val());
        formData.append('delPERid', $('#delPERid').val());

        $.ajax({
            url: "<?php echo base_url(); ?>dcustomer",
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

    function delbychk(psid) {
//    console.log(psid);
        var myArray = [];
//        var countArray = 0;
        $("input:checkbox[name=chk]:checked").each(function () {
            myArray.push($(this).val());
        });
        console.log(myArray);
//        countArray = myArray.length;
//        console.log('array =>  ' + countArray);
        var jsonString = JSON.stringify(myArray);

        $.ajax({
            url: "<?php echo base_url(); ?>dgcustomer",
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
</script>
