<?php

if(isset($datafromapi) && isset($branch)){
    $branchname = $branch;
    $bpicture = $datafromapi;
}

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

// echo '<pre>';
// print_r($bpicture);
// echo '</pre>';
// exit();
?>

<!-- Example DataTables Card-->
<div class="card mb-3" style="margin-top: 15px">
    <div class="card-header">
        <i class="fa fa-table"></i> Picture
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

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                      <th>Delete</th>
                      <th><?php echo $this->lang->line("branchcode"); ?></th>
                      <th><?php echo $this->lang->line("branchname"); ?></th>
                      <th><?php echo $this->lang->line("mypic"); ?></th>
                      <th><?php echo $this->lang->line("note"); ?></th>
                      <th><?php echo $this->lang->line("editdate"); ?></th>
                      <th>Action</th>
                    </tr>
                </thead>
                <!-- <tfoot>
                    <tr>
                      <th>
                          <button type="button" class="btn btn-warning btn-sm form-control" onclick="open_delgpicture_modal();">
                              <svg id="i-trash" viewBox="0 0 32 32" width="12" height="12" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                              <path d="M28 6 L6 6 8 30 24 30 26 6 4 6 M16 12 L16 24 M21 12 L20 24 M11 12 L12 24 M12 6 L13 2 19 2 20 6" />
                              </svg>
                          </button>
                      </th>
                      <th><?php echo $this->lang->line("branchcode"); ?></th>
                      <th><?php echo $this->lang->line("branchname"); ?></th>
                      <th><?php echo $this->lang->line("mypic"); ?></th>
                      <th><?php echo $this->lang->line("note"); ?></th>
                      <th><?php echo $this->lang->line("editdate"); ?></th>
                      <th>Action</th>
                    </tr>
                </tfoot> -->
                <tbody>
                    <?php
                    // debug($bpicture);
                    if (isset($bpicture)) :

                        ?>
                        <?php foreach ($bpicture as $key => $value): ?>
                            <tr id="tr<?php echo $value['PICid'].''; ?>" >
                                <td>
                                  <div class="form-check" >
                                      <label class="form-check-label">
                                        <input type="checkbox" id="<?php echo $value['PICid']; ?>" class="form-check-input" value="<?php echo $value['PICid']; ?>" name="chk" onchange="myFunction('tr' + this.id, this, this.id)"><?php echo $this->lang->line("select"); ?>
                                      </label>
                                  </div>
                                </td>
                                <td><?php echo $value['BRHcode']; ?></td>
                                <td><?php echo $value['BRHdesc'.$sl]; ?></td>
                                <td><?php echo '<img id="'. $value['PICid'] .'" class="myImg" src="'. base_url(). 'assets/img/uploads/' . $value['PICname'] .'" alt="'. $value['PICnote'] .'" width="120" height="80" onclick="showpic(this)">'; ?></td>
                                <td width="20%"><?php echo $value['PICnote']; ?></td>
                                <td><?php echo $value['PICeditedDT']; ?></td>
                                <th>
                                    <div class="btn-group btn-group-xs">
                                        <button type="button" class="btn btn-info btn-sm form-control" onclick="open_editpicture_modal(<?php echo $value['PICid']; ?>);">
                                            <svg id="i-edit" viewBox="0 0 32 32" width="12" height="12" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                            <path d="M30 7 L25 2 5 22 3 29 10 27 Z M21 6 L26 11 Z M5 22 L10 27 Z" />
                                            </svg>
                                        </button>
                                        <button type="button" class="btn btn-warning btn-sm form-control" onclick="open_delcustomer_modal(<?php echo $value['PICid']; ?>);">
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
        <!-- Updated yesterday at 11:59 PM -->
        <?php
        echo 'Updated  ' . $xdate;
        ?>
    </div>
</div>
<!-- /.container-fluid-->

<!-- /.container-fluid-->
<!-- /.content-wrapper-->

<!-- The Modal -->
<div id="myModalShowPIC" class="modal" >
  <span class="close">×</span>
  <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">x</button> -->
  <img class="modal-content" id="img01" style="margin-top: 100px">
  <div id="caption"></div>
</div>

<!-- The Add Modal -->
<div class="modal fade" id="myAddsModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form name="from_bookingpicture"enctype="multipart/form-data" id="from_bookingpicture">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo $this->lang->line("customomerhead"); ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                  <div class="form-group">
                    <input type="hidden" class="form-control" id="PICperid" name="PICperid" value="<?php echo $mysession['id']; ?>" >
                    <input type="hidden" class="form-control" id="PICidtab" name="PICidtab" value="103000" >
                    <input type="hidden" class="form-control" id="PICtype" name="PICtype" value="1" >
                  </div>
                  <div class="form-group">
                    <div class="dropdown">
                      <label for="PICsid"><?php echo $this->lang->line("selectbranch"); ?>:</label>
                      <select class="form-control" id="PICsid" name="PICsid">
                        <?php foreach ($branchname as $branchkey => $branchvalue): ?>
                        <option value="<?php echo $branchvalue['BRHid']; ?>"><?php echo $branchvalue['BRHdesc' . $sl]; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="PICpic"><?php echo $this->lang->line("mypic"); ?>:</label>
                    <input type="file" class="form-control-file border" name="PICpic" id="PICpic">
                  </div>
                  <div class="form-group">
                    <label for="PICnote"><?php echo $this->lang->line("note"); ?>:</label>
                    <textarea class="form-control" rows="5" id="PICnote" name="PICnote"></textarea>
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

<!-- The Delete by 1 Modal -->
<div class="modal fade" id="myDeleteModal">
    <div class="modal-dialog modal-lg">
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
    }, 2000);

    $(document).ready(function() {
      $('#myEditModal').on('shown.bs.modal', function () {
          var id = $("#xid").html();
          $.ajax({
              type: "GET",
              url: "<?php echo base_url(); ?>showpicbyid/" + id + "?param=true",
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
          $.ajax({
              type: "GET",
              url: "<?php echo base_url(); ?>delpicbyid/" + id + "?param=true",
              success: function (data) {
                  $("#dash1").html(data);
              },
              error: function (err) {
                  console.log(err);
              }
          });
      });

    });

    function open_editpicture_modal(id){
      var xid = id;
      $("#xid").html(xid);
      $("#myEditModal").modal("show");
    }

    function open_delcustomer_modal(id) {
        var xid = id;
        $("#xid1").html(xid);
        $("#myDeleteModal").modal("show");
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

    function open_delgpicture_modal(id) {
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

    function del_data(){
      var formData = new FormData();

      formData.append('delPICid', $('#delPICid').val());
      formData.append('delPICperid', $('#delPICperid').val());

      $.ajax({
          url: "<?php echo base_url(); ?>delpicture",
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
                  url: "<?php echo base_url(); ?>dgpicture",
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

    function edit_data(){
      var formData = new FormData();

      var c = 0;
      var elem = document.getElementById('from_epicture').elements;
      for (var i = 0; i < elem.length; i++) {

          if (elem[i].value.length == 0 && elem[i].type != "button" && elem[i].type != "file") {
              console.log(elem[i].id + ' == ' + elem[i].type + ' ++ ' + elem[i].name);
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

      formData.append('editPICpic', $('#editPICpic')[0].files[0]);
      formData.append('editPICid', $('#editPICid').val());
      formData.append('editPICperid', $('#editPICperid').val());
      formData.append('editPICsid', $('#editPICsid').val());
      formData.append('editPICnote', $('#editPICnote').val());
      formData.append('ePICpic', $('#ePICpic').val());

      $.ajax({
          url: "<?php echo base_url(); ?>editpicture",
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
      var elem = document.getElementById('from_bookingpicture').elements;
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

      formData.append('PICpic', $('#PICpic')[0].files[0]);
      formData.append('PICperid', $('#PICperid').val());
      formData.append('PICsid', $('#PICsid').val());
      formData.append('PICnote', $('#PICnote').val());

      $.ajax({
          url: "<?php echo base_url(); ?>sbpicture",
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

    function myFunction(x, _this, id) {
        if (_this.checked) {
            document.getElementById(x).style.backgroundColor = '#fff2e6';
        } else {
            document.getElementById(x).style.backgroundColor = '#ffffff';
        }
    }

</script>
