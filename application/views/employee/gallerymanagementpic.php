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
$branchname = $branch;
 ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="<?php echo base_url(); ?>assets/css/cards-gallery.css" rel="stylesheet">
<!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Picture</div>
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
                  <th width="15%"><?php echo $this->lang->line("branchname"); ?></th>
                  <th width="15%"><?php echo $this->lang->line("groupname"); ?></th>
                  <th><?php echo $this->lang->line("mypic"); ?></th>
                  <th>Action</th>

                </tr>
              </thead>
              <!-- <tfoot>
                <tr>
                  <th width="15%"><?php echo $this->lang->line("branchname"); ?></th>
                  <th width="15%"><?php echo $this->lang->line("groupname"); ?></th>
                  <th><?php echo $this->lang->line("mypic"); ?></th>
                  <th>Action</th>
                </tr>
              </tfoot> -->
              <tbody>
                <?php foreach ($dgallery as $key => $value): ?>
                  <tr>
                    <td width="15%"><?php echo $value['brh']['BRHdesc'.$sl]; ?></td>
                    <td width="15%"><?php echo $value['PU04descTH']; ?></td>
                    <td>
                      <section class="gallery-block cards-gallery" style="padding-top:unset">
                      	    <div class="container-fluid">
                      	        <div class="row">
                                    <?php foreach ($value['pic'] as $pkey => $pvalue): ?>
                      	            <div class="col-md-4 col-lg-4">
                      	                <div class="card border-0 transform-on-hover">
                      	                	<a class="lightbox" href="<?php echo base_url(). 'assets/img/uploads/' . $pvalue['PICname'] ?>">
                      	                		<img src="<?php echo base_url(). 'assets/img/uploads/' . $pvalue['PICname'] ?>" height="50px" width="50px" alt="<?php echo $pvalue['PICnote']; ?>" class="card-img-top">
                      	                	</a>
                      	                    <div class="card-body">
                                              <div class="btn-group btn-group-sm " align="center">
                                                <button type="button" class="btn btn-primary" onclick="deleteimg(<?php echo $pvalue['PICid']; ?>);"><i class="fa fa-minus-circle"></i>  ลบ</button>
                                              </div>
                      	                    </div>
                      	                </div>
                      	            </div>
                                    <?php endforeach; ?>
                      	        </div>
                      	    </div>
                          </section>
                    </td>
                    <td>
                      <?php if ($value['pic']): ?>
                        <button type="button" class="btn btn-warning btn-sm form-control" onclick="open_delgroupgallery_modal(<?php echo $value['PU04id']; ?>);">
                            <svg id="i-trash" viewBox="0 0 32 32" width="12" height="12" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <path d="M28 6 L6 6 8 30 24 30 26 6 4 6 M16 12 L16 24 M21 12 L20 24 M11 12 L12 24 M12 6 L13 2 19 2 20 6" />
                          </svg> By Group
                        </button>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->

<!-- The Add Modal -->
<div class="modal fade" id="myAddsModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form name="from_magallerypic"enctype="multipart/form-data" id="from_magallerypic">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo $this->lang->line("slidehead"); ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                  <div class="form-group">
                    <label for="PICsid"><?php echo $this->lang->line("selectbranch"); ?>:</label>
                      <div class="row">
                        <?php foreach ($branchname as $branchkey => $branchvalue): ?>
                        <div class="col col-sm-4">
                          <div class="form-check-inline">
                            <label class="form-check-label" for="radio.<?php echo $branchvalue['BRHid']; ?>">
                              <input type="radio" class="form-check-input" id="BRHoptradio" name="BRHoptradio" value="<?php echo $branchvalue['BRHid']; ?>" onclick="selectByBranchID(<?php echo $branchvalue['BRHid']; ?>);" ><?php echo $branchvalue['BRHdesc' . $sl]; ?>
                            </label>
                          </div>
                        </div>
                        <?php endforeach; ?>
                      </div>
                  </div>
                  <div class="form-group">
                    <div class="dash col-sm-12" id="dash">

                    </div>
                  </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="save_img();"><?php echo $this->lang->line("save"); ?></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="myDeleteModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!--Modal Header-->
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $this->lang->line("confirmdeletion"); ?></h4>
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
    $('#myDeleteModal').on('shown.bs.modal', function () {
        var id = $("#xid1").html();
        console.log(id);
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>sdeletegroupgallery/" + id + "?param=true",
            success: function (data) {
                $("#dash1").html(data);
            },
            error: function (err) {
                console.log(err);
            }
        });
    });
  });

  function selectByBranchID(id){
    // console.log(id);
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

  function save_img(){
    var formData = new FormData();

    var c = 0;
    var elem = document.getElementById('from_magallerypic').elements;
    elem.length
    for (var i = 0; i < elem.length; i++) {

        if (elem[i].value.length == 0 && elem[i].type != "button" && elem[i].type != "file" && elem[i].type != "radio") {
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
    }else {
      alert('Please select group of image');
    }
  }

  function deleteimg(id){
    var formData = new FormData();

    $.ajax({
        url: "<?php echo base_url(); ?>deleteimggallery/" + id + "?param=true",
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

  function open_delgroupgallery_modal(id) {
      var xid = id;
      $("#xid1").html(xid);
      $("#myDeleteModal").modal("show");
  }

  function del_gdata(){
    var formData = new FormData();

    formData.append('gdelPU04id', $('#gdelPU04id').val());
    formData.append('gdelPU04perid', $('#gdelPU04perid').val());

    $.ajax({
        url: "<?php echo base_url(); ?>dgpgallery",
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
<script>
    baguetteBox.run('.cards-gallery', { animation: 'slideIn'});
</script>
