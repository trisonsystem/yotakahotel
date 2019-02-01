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
    <i class="fa fa-table"></i> About as user page</div>
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
            <th><?php echo $this->lang->line("title"); ?></th>
            <th><?php echo $this->lang->line("mypic"); ?></th>
            <th><?php echo $this->lang->line("story"); ?></th>
            <th>Link URL</th>
            <th>Action</th>
          </tr>
        </thead>
        <!-- <tfoot>
          <tr>
            <th>
              <button type="button" class="btn btn-warning btn-sm form-control" onclick="open_delgaboutas_modal();">
                  <svg id="i-trash" viewBox="0 0 32 32" width="12" height="12" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                  <path d="M28 6 L6 6 8 30 24 30 26 6 4 6 M16 12 L16 24 M21 12 L20 24 M11 12 L12 24 M12 6 L13 2 19 2 20 6" />
                  </svg>
              </button>
            </th>
            <th><?php echo $this->lang->line("title"); ?></th>
            <th><?php echo $this->lang->line("mypic"); ?></th>
            <th><?php echo $this->lang->line("story"); ?></th>
            <th>Link URL</th>
            <th>Action</th>
          </tr>
        </tfoot> -->
        <tbody>
          <?php foreach ($allaboutas as $akey => $avalue): ?>
          <tr  id="tr<?php echo $avalue['PU01id'].''; ?>" >
            <td><?php echo $akey + 1 ?></td>
            <td width="10%" style="display: none;">
              <div class="form-check" >
                  <label class="form-check-label">
                    <input type="checkbox" id="<?php echo $avalue['PU01id']; ?>" class="form-check-input" value="<?php echo $avalue['PU01id']; ?>" name="chk" onchange="myFunction('tr' + this.id, this, this.id)"><?php echo $this->lang->line("select"); ?>
                  </label>
              </div>
            </td>
            <td width="10%"><?php echo $avalue['PU01title'.$sl] ?></td>
            <td width="10%"><?php if(isset($avalue['pic']['PICname'])){echo '<img id="'. $avalue['pic']['PICid'] .'" class="myImg" src="'. base_url(). 'assets/img/uploads/' . $avalue['pic']['PICname'] .'" alt="'. $avalue['pic']['PICnote'] .'" width="120" height="80" onclick="showpic(this)">';} ?></td>
            <td width="40%"><?php echo substr($avalue['PU01desc'.$sl],0,200) . '...' ?></td>
            <td width="20%">
              Facebook:  <a href="<?php echo $avalue['PU01facebook']; ?>" ><?php echo $avalue['PU01facebook']; ?></a><br />
              Twitter:  <a href="<?php echo $avalue['PU01twitter']; ?>"><?php echo $avalue['PU01twitter']; ?></a><br />
              Youtube:  <a href="<?php echo $avalue['PU01youtube']; ?>"><?php echo $avalue['PU01youtube']; ?></a><br />
              Line:  <a href="<?php echo $avalue['PU01line']; ?>"><?php echo $avalue['PU01line']; ?></a>
            </td>
            <td width="10%">
              <div class="btn-group btn-group-xs">
                  <button type="button" class="btn btn-info btn-sm form-control" onclick="open_editaboutas_modal(<?php echo $avalue['PU01id']; ?>);">
                      <svg id="i-edit" viewBox="0 0 32 32" width="12" height="12" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                      <path d="M30 7 L25 2 5 22 3 29 10 27 Z M21 6 L26 11 Z M5 22 L10 27 Z" />
                      </svg>
                  </button>
                  <button type="button" class="btn btn-warning btn-sm form-control" onclick="open_delaboutas_modal(<?php echo $avalue['PU01id']; ?>);">
                      <svg id="i-trash" viewBox="0 0 32 32" width="12" height="12" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                      <path d="M28 6 L6 6 8 30 24 30 26 6 4 6 M16 12 L16 24 M21 12 L20 24 M11 12 L12 24 M12 6 L13 2 19 2 20 6" />
                      </svg>
                  </button>
              </div>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="card-footer small text-muted">
      <!-- Updated yesterday at 11:59 PM -->
      <?php
      echo 'Updated  ' . $xdate;
      ?>
  </div>
</div>

<!-- The Add Modal -->
<div class="modal fade" id="myAddsModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form name="from_aboutas"enctype="multipart/form-data" id="from_aboutas">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo $this->lang->line("contenthead"); ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                  <div class="form-group">
                    <label for="PU01titleTH"><?php echo $this->lang->line("titleth"); ?>:</label>
                    <input type="text" class="form-control" id="PU01titleTH" name="PU01titleTH">
                  </div>
                  <div class="form-group">
                    <label for="PU01titleEN"><?php echo $this->lang->line("titleen"); ?>:</label>
                    <input type="text" class="form-control" id="PU01titleEN" name="PU01titleEN">
                  </div>
                  <div class="form-group">
                    <label for="PU01descTH"><?php echo $this->lang->line("storyth"); ?>:</label>
                    <textarea class="form-control" rows="5" id="PU01descTH" name="PU01descTH"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="PU01descEN"><?php echo $this->lang->line("storyen"); ?>:</label>
                    <textarea class="form-control" rows="5" id="PU01descEN" name="PU01descEN"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="PU01youtube">Link Youtube:</label>
                    <input type="text" class="form-control" id="PU01youtube" name="PU01youtube">
                  </div>
                  <div class="form-group">
                    <label for="PU01facebook">Link Facebook:</label>
                    <input type="text" class="form-control" id="PU01facebook" name="PU01facebook">
                  </div>
                  <div class="form-group">
                    <label for="PU01line">Link Line:</label>
                    <input type="text" class="form-control" id="PU01line" name="PU01line">
                  </div>
                  <div class="form-group">
                    <label for="PU01twitter">Link Twitter:</label>
                    <input type="text" class="form-control" id="PU01twitter" name="PU01twitter">
                  </div>
                  <div class="form-group">
                    <label for="PICpic"><?php echo $this->lang->line("mypic"); ?>:</label>
                    <input type="file" class="form-control-file border" name="PICpic" id="PICpic">
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

<!-- The Modal -->
<div id="myModalShowPIC" class="modal" >
  <span class="close">×</span>
  <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">x</button> -->
  <img class="modal-content" id="img01" style="margin-top: 100px">
  <div id="caption"></div>
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

<!-- The Edit Modal -->
<div class="modal fade" id="myEditModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!--Modal Header-->
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $this->lang->line("contentedit"); ?></h4>
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
                <h4 class="modal-title"><?php echo $this->lang->line("contentdeletet"); ?></h4>
                <span id="xid1" style="color: #ffffff"></span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="dash1" id="dash1">

            </div>
        </div>
    </div>
</div>

<script>
  setTimeout(function () {
      $(".alert").alert('close');
  }, 2000);

  $(document).ready(function() {
    $('#myEditModal').on('shown.bs.modal', function () {
        var id = $("#xid").html();
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>showaboutasbyid/" + id + "?param=true",
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
            url: "<?php echo base_url(); ?>delaboutas/" + id + "?param=true",
            success: function (data) {
                $("#dash1").html(data);
            },
            error: function (err) {
                console.log(err);
            }
        });
    });

  });

  function edit_data(){
    var formData = new FormData();

    var c = 0;
    var elem = document.getElementById('from_eaboutas').elements;

    for (var i = 0; i < elem.length; i++) {
        if (elem[i].name != "editPU01youtube" && elem[i].name != "editPU01facebook" && elem[i].name != "editPU01line" && elem[i].name != "editPU01twitter" && elem[i].name != "editPICid"  && elem[i].name != "ePICpic") {
            if (elem[i].value.length == 0 && elem[i].type != "button" && elem[i].type != "file") {
                console.log(elem[i].id + ' == ' + elem[i].type + ' ++ ' + elem[i].name);
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

    formData.append('editPICpic', $('#editPICpic')[0].files[0]);

    formData.append('editPU01perid', $('#editPU01perid').val());
    formData.append('editPICidtab', $('#editPICidtab').val());
    formData.append('editPICtype', $('#editPICtype').val());
    formData.append('editPICid', $('#editPICid').val());
    formData.append('editPU01id', $('#editPU01id').val());
    formData.append('editPU01titleTH', $('#editPU01titleTH').val());
    formData.append('editPU01titleEN', $('#editPU01titleEN').val());
    formData.append('editPU01descTH', $('#editPU01descTH').val());
    formData.append('editPU01descEN', $('#editPU01descEN').val());
    formData.append('editPU01youtube', $('#editPU01youtube').val());
    formData.append('editPU01facebook', $('#editPU01facebook').val());
    formData.append('editPU01line', $('#editPU01line').val());
    formData.append('editPU01twitter', $('#editPU01twitter').val());
    formData.append('ePICpic', $('#ePICpic').val());

    $.ajax({
        url: "<?php echo base_url(); ?>eaboutas",
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

  function save_data(){
    var formData = new FormData();

    var c = 0;
    var elem = document.getElementById('from_aboutas').elements;

    for (var i = 0; i < elem.length; i++) {
        if (elem[i].name != "PU01youtube" && elem[i].name != "PU01facebook" && elem[i].name != "PU01line" && elem[i].name != "PU01twitter") {
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

    formData.append('PICpic', $('#PICpic')[0].files[0]);
    formData.append('PU01titleTH', $('#PU01titleTH').val());
    formData.append('PU01titleEN', $('#PU01titleEN').val());
    formData.append('PU01descTH', $('#PU01descTH').val());
    formData.append('PU01descEN', $('#PU01descEN').val());
    formData.append('PU01youtube', $('#PU01youtube').val());
    formData.append('PU01facebook', $('#PU01facebook').val());
    formData.append('PU01line', $('#PU01line').val());
    formData.append('PU01twitter', $('#PU01twitter').val());

    $.ajax({
        url: "<?php echo base_url(); ?>saboutas",
        // url: "<?php echo base_url(); ?>savepic",
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

  function open_editaboutas_modal(id){
    var xid = id;
    $("#xid").html(xid);
    $("#myEditModal").modal("show");
  }

  function showpic(tag){
    var modal = document.getElementById('myModalShowPIC');
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");

        modal.style.display = "block";
        modalImg.src = tag.src;
        captionText.innerHTML = tag.alt;

    var span = $('#myModalShowPIC > span.close').on('click',function(){
        $("#myModalShowPIC").attr("style", "display:none");
    });
  }

  function myFunction(x, _this, id) {
      if (_this.checked) {
          document.getElementById(x).style.backgroundColor = '#fff2e6';
      } else {
          document.getElementById(x).style.backgroundColor = '#ffffff';
      }
  }

  function open_delgaboutas_modal(id){
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

  function delbychk(psid)
  {
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
                url: "<?php echo base_url(); ?>dgaboutas",
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

  function open_delaboutas_modal(id){
    var xid = id;
    $("#xid1").html(xid);
    $("#myDeleteModal").modal("show");
  }

  function del_data(){
    var formData = new FormData();

    formData.append('delPICperid', $('#delPICperid').val());
    formData.append('delPU01id', $('#delPU01id').val());
    formData.append('delPICid', $('#delPICid').val());

    $.ajax({
        url: "<?php echo base_url(); ?>daboutas",
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
