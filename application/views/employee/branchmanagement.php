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
        <i class="fa fa-table"></i> Branch Management <?php // echo $_COOKIE["lang"] ?>
    </div>
    <div class="card-body">
        <?php // debug($datafromapi); ?>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="display: none;">Delete</th>
                        <th><?php echo $this->lang->line("no"); ?></th>
                        <th><?php echo $this->lang->line("branchcode"); ?></th>
                        <th><?php echo $this->lang->line("vatnumber"); ?></th>
                        <th><?php echo $this->lang->line("branchname"); ?></th>
                        <th><?php echo $this->lang->line("address"); ?></th>
                        <th><?php echo $this->lang->line("establishment"); ?></th>
                        <th>Action</th>
                    </tr>
                </thead>
                <!-- <tfoot>
                    <tr>
                        <th>                   
                            <button type="button" class="btn btn-warning btn-sm form-control" onclick="open_delgbranch_modal();"> <?php // echo $this->lang->line("delete"); ?> </button>
                        </th>
                        <th><?php echo $this->lang->line("branchcode"); ?></th>
                        <th><?php echo $this->lang->line("vatnumber"); ?></th>
                        <th><?php echo $this->lang->line("branchname" . $sl); ?></th>
                        <th><?php echo $this->lang->line("address"); ?></th>
                        <th><?php echo $this->lang->line("establishment"); ?></th>
                        <th>Action</th>
                    </tr>
                </tfoot> -->
                <tbody>
                    <?php
                    if (isset($datafromapi)) :
                        ?>
                        <?php foreach ($datafromapi as $key => $value): ?>
                            <tr id="tr<?php echo $value['BRHid']; ?>" >
                                <td><?php echo $key + 1 ?></td>
                                <th style="display: none;">
                                    <div class="form-check" >
                                        <label class="form-check-label">
                                            <?php if ($value['BRHid'] != 1) : ?>
                                                <input type="checkbox" id="<?php echo $value['BRHid']; ?>" class="form-check-input" value="<?php echo $value['BRHid']; ?>" name="chk" onchange="myFunction('tr' + this.id, this, this.id)"><?php echo $this->lang->line("select"); ?>
                                            <?php else : ?>
                                                <svg id="i-ban" viewBox="0 0 32 32" width="32" height="32" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                <circle cx="16" cy="16" r="14" />
                                                <path d="M6 6 L26 26" />
                                                </svg>
                                            <?php endif; ?>
                                        </label>
                                    </div>                                                                
                                </th>
                                <td><?php echo $value['BRHcode']; ?></td>
                                <td><?php echo $value['BRHvnum']; ?></td>
                                <td><?php echo $value['BRHdescTH'] . ' (' . $value['BRHdescEN'] .')'; ?></td>
                                <td><?php echo $value['BRHadr']; ?></td>
                                <td><?php
                                    $sdate = $value['BRHbday'];
                                    echo date("Y-m-d", strtotime($sdate));
                                    ?></td>
                                <th>
                                    <div class="btn-group form-control">
                                        <button type="button" class="btn btn-info btn-sm form-control" onclick="open_editbranch_modal(<?php echo $value['BRHid']; ?>);"> <?php echo $this->lang->line("edit"); ?> </button>
                                        <?php if ($value['BRHid'] != 1) : ?>
                                            <button type="button" class="btn btn-warning btn-sm form-control" onclick="open_delbranch_modal(<?php echo $value['BRHid']; ?>);"> <?php echo $this->lang->line("delete"); ?> </button>
                                        <?php endif; ?>
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
            <form name="from_branchmanagement"enctype="multipart/form-data" id="from_branchmanagement">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo $this->lang->line("branchhead"); ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="BRHdescEN"><?php echo $this->lang->line("branchnameEN"); ?>:</label>
                        <input type="text" class="form-control" id="BRHdescEN" name="BRHdescEN" required>
                    </div>
                    <div class="form-group">
                        <label for="BRHdescTH"><?php echo $this->lang->line("branchnameTH"); ?>:</label>
                        <input type="text" class="form-control" id="BRHdescTH" name="BRHdescTH" required>
                    </div>
                    <div class="form-group">
                        <label for="BRHadr"><?php echo $this->lang->line("address"); ?>:</label>
                        <textarea class="form-control" rows="3" id="BRHadr" name="BRHadr" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="BRHpic"><?php echo $this->lang->line("logopicture"); ?>:</label>  
                        <input type="file" class="form-control-file border" name="BRHpic" id="BRHpic">
                    </div>
                    <div class="form-group">
                        <label for="BRHzipc"><?php echo $this->lang->line("zipcode"); ?>:</label>
                        <input type="text" class="form-control" id="BRHzipc" name="BRHzipc" required>
                    </div>
                    <div class="form-group">
                        <label for="BRHvnum"><?php echo $this->lang->line("vatnumber"); ?>:</label>
                        <input type="text" class="form-control" id="BRHvnum" name="BRHvnum" required>
                    </div>
                    <div class="form-group">
                        <label for="BRHbday"><?php echo $this->lang->line("establishment"); ?>:</label>
                        <!--<input type="text" class="form-control" id="BRHbday" name="BRHbday" value="12/45/3544" >-->
                        <input type="date" class="form-control" id="BRHbday" name="BRHbday" min="1000-01-01" max="3000-12-31">
                    </div>
                    <div class="form-group">
                        <label for="BRHemail"><?php echo $this->lang->line("email"); ?>:</label>
                        <input type="text" class="form-control" id="BRHemail" name="BRHemail" required>
                    </div>
                    <div class="form-group">
                        <label for="BRHnphone"><?php echo $this->lang->line("phonenumber"); ?>:</label>
                        <input type="text" class="form-control" id="BRHnphone" name="BRHnphone" required>
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

<!-- The Edit Modal -->
<div class="modal fade" id="myEditModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!--Modal Header--> 
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $this->lang->line("editbranch"); ?></h4>
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
    <div class="modal-dialog">
        <div class="modal-content">

            <!--Modal Header--> 
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $this->lang->line("delbranch"); ?></h4>
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
                <h4 class="modal-title"><?php echo $this->lang->line("delbranch"); ?></h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <?php echo $this->lang->line("deleteselect"); ?>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger " onclick="delbychk(<?php echo $mysession['id']; ?>);"> <?php echo $this->lang->line("delete"); ?> </button>
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

<script>
    // setTimeout(function(){ 
    //     $("#btadd").css("display", "none");
    // }, 400);
    
    $(document).ready(function () {       
        $('#myEditModal').on('shown.bs.modal', function () {
            var id = $("#xid").html();
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>editbranch/" + id + "?param=true",
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
            console.log(id);
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>delbranch/" + id + "?param=true",
                success: function (data) {
                    $("#dash1").html(data);
                },
                error: function (err) {
                    console.log(err);
                }
            });
        });

    });

    function open_editbranch_modal(id) {
        var xid = id;
        $("#xid").html(xid);
        $("#myEditModal").modal("show");
    }

    function open_delbranch_modal(id) {
        var xid = id;
        $("#xid1").html(xid);
        $("#myDeleteModal").modal("show");
    }

    function open_delgbranch_modal(id) {
        var myArray = [];
        var countArray = 0;
        $("input:checkbox[name=chk]:checked").each(function () {
            myArray.push($(this).val());
        });
        countArray = myArray.length;
        
        if(countArray > 0){
            $("#myDeleteBySelectModal").modal("show");
        }else{
            $("#myXDeleteBySelectModal").modal("show");
        }
        
    }

    function save_data() {
        var formData = new FormData();

        formData.append("BRHpic", $('#BRHpic')[0].files[0]);

//        formData.append('BRHcode', $('#BRHcode').val());
        formData.append('BRHdescTH', $('#BRHdescTH').val());
        formData.append('BRHdescEN', $('#BRHdescEN').val());
        formData.append('BRHadr', $('#BRHadr').val());
        formData.append('BRHzipc', $('#BRHzipc').val());
        formData.append('BRHvnum', $('#BRHvnum').val());
        formData.append('BRHbday', $('#BRHbday').val());
        formData.append('BRHemail', $('#BRHemail').val());
        formData.append('BRHnphone', $('#BRHnphone').val());

        $.ajax({
            url: "<?php echo base_url(); ?>sbranch",
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

        formData.append("editBRHpic", $('#editBRHpic')[0].files[0]);

        formData.append('editBRHid', $('#editBRHid').val());
        formData.append('editBRHcode', $('#editBRHcode').val());
        formData.append('editBRHdescTH', $('#editBRHdescTH').val());
        formData.append('editBRHdescEN', $('#editBRHdescEN').val());
        formData.append('editBRHadr', $('#editBRHadr').val());
        formData.append('editBRHzipc', $('#editBRHzipc').val());
        formData.append('editBRHvnum', $('#editBRHvnum').val());
        formData.append('editBRHbday', $('#editBRHbday').val());
        formData.append('editBRHemail', $('#editBRHemail').val());
        formData.append('editBRHnphone', $('#editBRHnphone').val());

        formData.append('eBRHpic', $('#eBRHpic').val());
        formData.append('eBRHbday', $('#eBRHbday').val());

        $.ajax({
            url: "<?php echo base_url(); ?>ebranch",
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
        formData.append('delBRHid', $('#delBRHid').val());
        formData.append('delPERid', $('#delPERid').val());

        $.ajax({
            url: "<?php echo base_url(); ?>dbranch",
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
        var myArray = [];
//        var countArray = 0;
        $("input:checkbox[name=chk]:checked").each(function () {
            myArray.push($(this).val());
        });
//        countArray = myArray.length;
//        console.log('array =>  ' + countArray);
        var jsonString = JSON.stringify(myArray);

        $.ajax({
            url: "<?php echo base_url(); ?>dgbranch",
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