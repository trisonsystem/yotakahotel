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
$comment = $datafromapi;
?>

<!-- Example DataTables Card-->
<div class="card mb-3">
    <div class="card-header">
        <i class="fa fa-table"></i> Comment Information</div>
    <div class="card-body">
        <?php // debug($datafromapi) ?>
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
                        <th><?php echo $this->lang->line("no"); ?></th>
                        <th><?php echo $this->lang->line("cname"); ?></th>
                        <th><?php echo $this->lang->line("email"); ?></th>
                        <th><?php echo $this->lang->line("comments"); ?></th>
                        <th><?php echo $this->lang->line("vote"); ?></th>
                        <th><?php echo $this->lang->line("status"); ?></th>
                        <!-- <th>Action</th> -->
                    </tr>
                </thead>
                <!-- <tfoot>
                    <tr>
                        <th><?php echo $this->lang->line("no"); ?></th>
                        <th><?php echo $this->lang->line("cname"); ?></th>
                        <th><?php echo $this->lang->line("email"); ?></th>
                        <th><?php echo $this->lang->line("comments"); ?></th>
                        <th><?php echo $this->lang->line("vote"); ?></th>
                        <th><?php echo $this->lang->line("status"); ?></th>
                        <th>Action</th>
                    </tr>
                </tfoot> -->
                <tbody>
                    <?php foreach ($datafromapi as $key => $value): ?>

                        <tr <?php
                        // if ($value['CMErespond'] != 0) {
                            // echo 'style="background-color: #fff2e6"';
                        // }
                        ?>>
                            <td>
                              <?php
                            //   if ($value['CMErespond'] != 0) {
                                echo $key+1;
                            //   }
                              ?>
                            </td>
                            <td><?php echo $value['CMEname']; ?></td>
                            <td><?php echo $value['CMEemail']; ?></td>
                            <td><?php echo $value['CMEcomment']; ?></td>
                            <td><?php echo $value['CMEvote']; ?></td>
                            <td><?php echo $value['CMErespond']; ?></td>
                            <!-- <td>
                                <div class="btn-group btn-group-xs"> -->
                                    <!-- <button type="button" class="btn btn-info btn-sm form-control" onclick="open_ModalComment(<?php echo $value['CMEid']; ?>)" <?php if ($value['CMErespond'] != 0) { echo 'disabled';} ?>><?php echo $this->lang->line("reply"); ?></button> -->
                                    <!-- <button type="button" class="btn btn-warning btn-sm form-control" onclick="">xxx</button> -->
                                <!-- </div>
                            </td> -->
                        </tr>
                        <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>

<!-- The Modal -->
<div class="modal fade" id="myModalComment">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!--Modal Header-->
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $this->lang->line("commenthead"); ?></h4>
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
        $("#btadd").css("display", "none");
    }, 400);

    setTimeout(function () {
        $(".alert").alert('close');
    }, 2000);

    $(document).ready(function() {
      $('#myModalComment').on('shown.bs.modal', function () {
          var id = $("#xid").html();

          $.ajax({
              type: "GET",
              url: "<?php echo base_url(); ?>sentcomment/" + id + "?param=true",
              success: function (data) {
                  $("#dash").html(data);
              },
              error: function (err) {
                  console.log(err);
              }
          });
      });
    });

    function open_ModalComment(id){
      var xid = id;
      $("#xid").html(xid);
      $("#myModalComment").modal("show");
    }

    function send_data(){
      var formData = new FormData();

        var c = 0;
        var elem = document.getElementById('from_comment').elements;
        for (var i = 0; i < elem.length; i++) {
            if (elem[i].value.length == 0 && elem[i].type != "button") {
                alert('Please Enter a Value '+elem[i].placeholder);
                document.getElementById(elem[i].id).style.backgroundColor = "#F8E6E0";
                c = c + 1;
            }else{
                if(elem[i].type != "button" && elem[i].type != "checkbox" && elem[i].type != "radio" && elem[i].type != "select"){
                    document.getElementById(elem[i].id).style.backgroundColor = "#FFFFFF";
                }
            }
        }

        if(c > 0){
            console.log('false');
            return false;
        }

      formData.append('CMEperid', $('#CMEperid').val());
      formData.append('CMEid', $('#CMEid').val());
      formData.append('CMEvote', $('#CMEvote').val());
      formData.append('CMEname', $('#CMEname').val());
      formData.append('CMEemail', $('#CMEemail').val());
      formData.append('CMEcomment', $('#CMEcomment').val());
      formData.append('CMEresmessage', $('#CMEresmessage').val());
      formData.append('CMEcomdate', $('#CMEcomdate').val());

      $.ajax({
          url: "<?php echo base_url(); ?>savecomment",
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
                  console.log('ERRORS: ' + data.esrror);
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
