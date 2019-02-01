<?php
if (!isset($_COOKIE["lang"])) {
    
    $lg = $_COOKIE["lang"];
}

if ($lg == 'thailand') {
    $sl = 'TH';
} else {
    $sl = 'EN';
}
$branchname = $branch;
?>

<!-- Example DataTables Card-->
<div class="card mb-3">
  <div class="card-header">
    <i class="fa fa-table"></i> Gallery user page</div>
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
            <th><?php echo $this->lang->line("branchname"); ?></th>
            <th><?php echo $this->lang->line("groupno"); ?></th>
            <th><?php echo $this->lang->line("groupnameth"); ?></th>
            <th><?php echo $this->lang->line("groupnameen"); ?></th>
            <th><?php echo $this->lang->line("note"); ?></th>
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
            <th><?php echo $this->lang->line("branchname"); ?></th>
            <th><?php echo $this->lang->line("groupno"); ?></th>
            <th><?php echo $this->lang->line("groupnameth"); ?></th>
            <th><?php echo $this->lang->line("groupnameen"); ?></th>
            <th><?php echo $this->lang->line("note"); ?></th>
            <th>Action</th>
          </tr>
        </tfoot> -->
        <tbody>
          <?php if (isset($dgallery)): ?>
          <?php foreach ($dgallery as $dkey => $dvalue): ?>
          <tr id="tr<?php echo $dvalue['PU04id'].''; ?>" >
            <td>
              <div class="form-check" >
                  <label class="form-check-label">
                    <input type="checkbox" id="<?php echo $dvalue['PU04id']; ?>" class="form-check-input" value="<?php echo $dvalue['PU04id']; ?>" name="chk" onchange="myFunction('tr' + this.id, this, this.id)"><?php echo $this->lang->line("select"); ?>
                  </label>
              </div>
            </td>
            <td><?php echo $dvalue['brh']['BRHdesc'.$sl]; ?></td>
            <td><?php echo $dvalue['PU04id']; ?></td>
            <td><?php echo $dvalue['PU04descTH']; ?></td>
            <td><?php echo $dvalue['PU04descEN']; ?></td>
            <td><?php echo $dvalue['PU04note']; ?></td>
            <th>
                <div class="btn-group btn-group-xs">
                  <button type="button" class="btn btn-info btn-sm form-control" onclick="open_edigallery_modal(<?php echo $dvalue['PU04id']; ?>);">
                      <svg id="i-edit" viewBox="0 0 32 32" width="12" height="12" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                      <path d="M30 7 L25 2 5 22 3 29 10 27 Z M21 6 L26 11 Z M5 22 L10 27 Z" />
                      </svg>
                  </button>
                    <button type="button" class="btn btn-warning btn-sm form-control" onclick="open_delgallery_modal(<?php echo $dvalue['PU04id']; ?>);">
                        <svg id="i-trash" viewBox="0 0 32 32" width="12" height="12" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        <path d="M28 6 L6 6 8 30 24 30 26 6 4 6 M16 12 L16 24 M21 12 L20 24 M11 12 L12 24 M12 6 L13 2 19 2 20 6" />
                        </svg>
                    </button>
                </div>
            </th>
          </tr>
          <?php endforeach; ?>
          <?php endif; ?>
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

<!-- The Modal -->
<div id="myModalShowPIC" class="modal" >
  <span class="close">×</span>
  <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">x</button> -->
  <img class="modal-content" id="img01" style="margin-top: 100px">
  <button type="button" class="btn btn-warning">Warning</button>
  <div id="caption"></div>
</div>

<!-- The Add Modal -->
<div class="modal fade" id="myAddsModal" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content" >
          <!-- Modal Header -->
          <div class="modal-header">
              <h4 class="modal-title"><?php echo $this->lang->line("grouphead"); ?></h4>
              <button type="button" class="close" data-dismiss="modal">×</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form name="from_gallery_group"enctype="multipart/form-data" id="from_gallery_group">
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <div class="dropdown">
                    <label for="PU04brhid"><?php echo $this->lang->line("selectbranch"); ?>:</label>
                    <select class="form-control" id="PU04brhid" name="PU04brhid">
                      <?php foreach ($branchname as $branchkey => $branchvalue): ?>
                      <option value="<?php echo $branchvalue['BRHid']; ?>"><?php echo $branchvalue['BRHdesc' . $sl]; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="PU04descTH"><?php echo $this->lang->line("groupnameth"); ?>:</label>
                  <input type="text" class="form-control" id="PU04descTH" name="PU04descTH">
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="PU04descEN"><?php echo $this->lang->line("groupnameen"); ?>:</label>
                  <input type="text" class="form-control" id="PU04descEN" name="PU04descEN">
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="PU04note"><?php echo $this->lang->line("note"); ?>:</label>
                  <textarea class="form-control" rows="5" id="PU04note" name="PU04note"></textarea>
                </div>
              </div>
            </div>
            </form>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
              <button type="button" class="btn btn-success" onclick="save_imggroup();"><?php echo $this->lang->line("save"); ?></button>
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

<!-- The Delete by 1 Modal -->
<div class="modal fade" id="myDeleteModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!--Modal Header-->
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $this->lang->line("groupdelete"); ?></h4>
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
                <h4 class="modal-title"><?php echo $this->lang->line("groupedit"); ?></h4>
                <span id="xid" style="color: #ffffff"></span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="dash" id="dash">

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
                url: "<?php echo base_url(); ?>showgallerybyid/" + id + "?param=true",
                success: function (data) {
                    $("#dash").html(data);
                },
                error: function (err) {
                    console.log(err);
                }
            });
        });

        // $('#PICsid').prop('selectedIndex',0);

        $('#myDeleteModal').on('shown.bs.modal', function () {
            var id = $("#xid1").html();
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>dgallery/" + id + "?param=true",
                success: function (data) {
                    $("#dash1").html(data);
                },
                error: function (err) {
                    console.log(err);
                }
            });
        });
      });

      function save_imggroup(){
        var formData = new FormData();

        var c = 0;
        var elem = document.getElementById('from_gallery_group').elements;
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

        formData.append('PU04brhid', $('#PU04brhid').val());
        formData.append('PU04descTH', $('#PU04descTH').val());
        formData.append('PU04descEN', $('#PU04descEN').val());
        formData.append('PU04note', $('#PU04note').val());

        $.ajax({
            url: "<?php echo base_url(); ?>simggroup",
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

      function save_img(){
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

        var chkPICsid = $('input[name="PICsid"]:checked').val();

        formData.append('PICpic', $('#PICpic')[0].files[0]);
        formData.append('BRHoptradio', $('input[name="BRHoptradio"]:checked').val());
        formData.append('PICsid', $('input[name="PICsid"]:checked').val());
        formData.append('PICnote', $('#PICnote').val());
        formData.append('PICperid', $('#PICperid').val());

        if (chkPICsid > 0) {
          $.ajax({
              url: "<?php echo base_url(); ?>sbpicgallery",
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
        }else {
          alert('Please select group of image');
        }
      }

      function selectByBranchID(id){
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>showgroupbybimg/" + id,
            success: function (data) {
                $("#dash").html(data);
            },
            error: function (err) {
                console.log(err);
                console.log('ccccccccccccc');
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
                    url: "<?php echo base_url(); ?>dggallery",
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

      function open_delgallery_modal(id){
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

      function myFunction(x, _this, id) {
          if (_this.checked) {
              document.getElementById(x).style.backgroundColor = '#fff2e6';
          } else {
              document.getElementById(x).style.backgroundColor = '#ffffff';
          }
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

        formData.append('delPU04id', $('#delPU04id').val());
        formData.append('delPU04perid', $('#delPU04perid').val());

        $.ajax({
            url: "<?php echo base_url(); ?>delgallery",
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

      function open_edigallery_modal(id){
        var xid = id;
        $("#xid").html(xid);
        $("#myEditModal").modal("show");
      }

      function edit_data(){
        var formData = new FormData();

        var c = 0;
        var elem = document.getElementById('from_dgallery').elements;
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

        formData.append('editPU04perid', $('#editPU04perid').val());
        formData.append('editPU04idtab', $('#editPU04idtab').val());
        formData.append('editPU04type', $('#editPU04type').val());
        formData.append('editPU04id', $('#editPU04id').val());
        formData.append('editPU04descTH', $('#editPU04descTH').val());
        formData.append('editPU04descEN', $('#editPU04descEN').val());
        formData.append('editPU04note', $('#editPU04note').val());

        $.ajax({
            url: "<?php echo base_url(); ?>editgallery",
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
