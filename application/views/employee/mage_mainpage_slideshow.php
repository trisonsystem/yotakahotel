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
// debug($pslide);
?>
<?php echo $startpage; ?>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators" style="visibility: hidden">
      <?php foreach ($xpslide as $key => $value): ?>
        <li data-target="#myCarousel" data-slide-to="<?php echo $key ?>" <?php if($key == 0){echo 'class="active"';} ?>></li>
      <?php endforeach; ?>
    </ol>

    <div class="carousel-inner">
      <?php foreach ($xpslide as $skey => $svalue): ?>
        <div class="carousel-item <?php if($skey == 0){echo "active";} ?>">
            <img class="first-slide" src="<?php echo base_url(); ?>assets/img/slide/<?php echo $svalue['PICname'] ?>">
            <div class="container">
                <div class="carousel-caption text-left">
                </div>
            </div>
        </div>
      <?php endforeach; ?>
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>


<!-- Example DataTables Card-->
<div class="card mb-3" style="margin-top:30px">
  <div class="card-header">
    <i class="fa fa-table"></i> Slide management</div>
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
            <th><?php echo $this->lang->line("no"); ?></th>
            <th><?php echo $this->lang->line("mypic"); ?></th>
            <th><?php echo $this->lang->line("note"); ?></th>
            <th><?php echo $this->lang->line("status"); ?></th>
            <th>Action</th>
          </tr>
        </thead>
        <!-- <tfoot>
          <tr>
            <th><?php echo $this->lang->line("no"); ?></th>
            <th><?php echo $this->lang->line("mypic"); ?></th>
            <th><?php echo $this->lang->line("note"); ?></th>
            <th><?php echo $this->lang->line("status"); ?></th>
            <th>Action</th>
          </tr>
        </tfoot> -->
        <tbody>
          <?php foreach ($pslide as $dkey => $dvalue): ?>
            <tr>
              <td><?php echo $dkey+1 ?></td>
              <td><?php echo '<img id="'. $dvalue['PICid'] .'" class="myImg" src="'. base_url(). 'assets/img/slide/' . $dvalue['PICname'] .'" alt="'. $dvalue['PICnote'] .'" width="120" height="80" onclick="showpic(this)">'; ?></td>
              <td><?php echo $dvalue['PICnote']; ?></td>
              <td><?php echo $dvalue['USCdesc'.$sl]; ?></td>
              <td>
                <?php if ($dvalue['PICdelete'] == 0): ?>
                    <button type="button" class="btn btn-warning btn-sm form-control" onclick="onclickDelete(<?php echo $dvalue['PICid']; ?>);">
                        <svg id="i-trash" viewBox="0 0 32 32" width="12" height="12" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        <path d="M28 6 L6 6 8 30 24 30 26 6 4 6 M16 12 L16 24 M21 12 L20 24 M11 12 L12 24 M12 6 L13 2 19 2 20 6" />
                        </svg>  Delete
                    </button>
                <?php else: ?>
                  <button type="button" class="btn btn-danger btn-sm form-control" onclick="onclickUndo(<?php echo $dvalue['PICid']; ?>);">
                      <svg id="i-trash" viewBox="0 0 32 32" width="12" height="12" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                      <path d="M28 6 L6 6 8 30 24 30 26 6 4 6 M16 12 L16 24 M21 12 L20 24 M11 12 L12 24 M12 6 L13 2 19 2 20 6" />
                    </svg>  Undo
                  </button>
                <?php endif; ?>
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
            <form name="from_customerhmanagement"enctype="multipart/form-data" id="from_customerhmanagement">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo $this->lang->line("slidehead"); ?></h4>
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
                      <label for="editBRHpic">Recommend:</label>
                  </div>
                  <div align="center">
                      <img src="<?php echo base_url() . 'assets/img/rec.png'?>" class="img-thumbnail" alt="Cinque Terre" width="304" height="236" />
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

<!-- The Modal -->
<div id="myModalShowPIC" class="modal" >
  <span class="close">×</span>
  <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">x</button> -->
  <img class="modal-content" id="img01" style="margin-top: 100px">
  <div id="caption"></div>
</div>

<?php echo $startpage; ?>


<script>

    function save_data(){
      var formData = new FormData();

      formData.append('PICpic', $('#PICpic')[0].files[0]);
      formData.append('PICperid', $('#PICperid').val());
      formData.append('PICnote', $('#PICnote').val());

      $.ajax({
          url: "<?php echo base_url(); ?>slsave",
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

    function onclickDelete(id) {
      var formData = new FormData();

      $.ajax({
          url: "<?php echo base_url(); ?>sldelete/" + id,
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

    function onclickUndo(id){
      var formData = new FormData();
        console.log(id);
        
      $.ajax({
          url: "<?php echo base_url(); ?>slundo/" + id,
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
</script>
