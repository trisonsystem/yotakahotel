<!doctype html>
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
<html lang="en">

    <head>
        <?php echo $startpage; ?>
        <style>
          * {
              box-sizing: border-box;
          }

          /* body {
              background-color: #f1f1f1;
              padding: 20px;
              font-family: Arial;
          } */

          /* Center website */
          .main {
              max-width: 1000px;
              margin: auto;
          }

          h1 {
              font-size: 50px;
              word-break: break-all;
          }

          .row {
              /*margin: 10px -16px;*/
          }

          /* Add padding BETWEEN each column */
          .row,
          .row > .column {
              padding: 8px;
          }

          /* Create three equal columns that floats next to each other */
          .column {
              float: left;
              width: 33.33%;
              display: none; /* Hide all elements by default */
          }

          /* Clear floats after rows */
          .row:after {
              content: "";
              display: table;
              clear: both;
          }

          /* Content */
          .content {
              background-color: white;
              padding: 10px;
          }

          /* The "show" class is added to the filtered elements */
          .show {
            display: block;
          }

          /* Style the buttons */
          .xbtn {
            border: none;
            outline: none;
            padding: 7px 10px;
            background-color: white;
            cursor: pointer;
          }

          .xbtn:hover {
            background-color: #ddd;
          }

          .xbtn.active {
            border-radius:3px;
            background-color: #666;
            color: white;
          }

          /* Style the tab */
          .tab {
              overflow: hidden;
              border: 1px solid #ccc;
              background-color: #f1f1f1;
          }

          /* Style the buttons inside the tab */
          .tab button {
              background-color: inherit;
              float: left;
              border: none;
              outline: none;
              cursor: pointer;
              padding: 14px 16px;
              transition: 0.3s;
              font-size: 17px;
          }

          /* Change background color of buttons on hover */
          .tab button:hover {
              background-color: #ddd;
          }

          /* Create an active/current tablink class */
          .tab button.active {
              background-color: #ccc;
          }

          /* Style the tab content */
          .tabcontent {
              display: none;
              padding: 6px 12px;
              border: 1px solid #ccc;
              border-top: none;
          }

          .nav-tabs{
            margin-top: 15px;
          }

          </style>
    </head>

    <body>

        <?php echo $topmenu; ?>

        <?php
        //$branch = json_decode($branch, true)['data']
         ?>

        <div class="row">
            <div class="col-sm-12 col-md-12">
              <img src="<?php echo base_url(); ?>assets/img/1366x400.png" class="img-thumbnail" alt="" style="margin-top: 38px; margin-bottom: 10px; width: 100%">
            </div>
        </div>


        <?php if (isset($xdata)): ?>
        <div class="container-fluid">
          <h3><?php echo $this->lang->line("gallery"); ?></h3>
          <!-- Nav tabs -->
          <ul class="nav nav-tabs " role="tablist">
            <?php foreach ($xdata as $key => $value): ?>
              <?php if(count($value['pic']) == 0){continue;} ?>
              <li class="nav-item">
                <a class="nav-link <?php if($key == 0){echo "active";} ?>" href="#menu<?php echo $value['BRHid']; ?>"><?php echo $value['BRHdesc'.$sl]; ?></a>
              </li>
            <?php endforeach; ?>
          </ul>
          <?php // debug($xdata); ?>
          <!-- Tab panes -->
          <div class="tab-content">
            <?php foreach ($xdata as $xkey => $xvalue): ?>
            <div id="menu<?php echo $xvalue['BRHid']; ?>" class="container-fluid tab-pane <?php if($xkey == 0){echo "active";} ?>">
              <div id="myBtnContainer" style="margin-top:20px">
                  <button class="xbtn xbtnall active" onclick="filterSelection('all')">All</button>
                  <?php foreach ($xvalue['pu04'] as $pkey => $pvalue): ?>
                    <button class="xbtn xbtn<?php echo $pvalue['PU04id'] ?>" onclick="filterSelection('<?php echo $pvalue['PU04id'] ?>')"> <?php echo $pvalue['PU04desc'.$sl]; ?></button>
                  <?php endforeach; ?>

                  <section class="gallery-block cards-gallery">
                    <div class="row ">
                      <?php foreach ($xvalue['pic'] as $pkey => $pvalue): ?>
                        <?php if($pvalue['PICname'] == 'no-image.png'){continue;} ?>
                        <div class="column <?php echo $pvalue['PU04id'] ?> col-md-3">
                          <!-- <div class="col-md-6"> -->
            	                <div class="card border-0 transform-on-hover">
            	                	<a class="lightbox" href="<?php echo base_url(); ?>assets/img/uploads/<?php echo $pvalue['PICname']; ?>">
            	                		<img src="<?php echo base_url(); ?>assets/img/uploads/<?php echo $pvalue['PICname']; ?>" alt="Card Image" class="card-img-top" width="100px" height="255px" style="padding: unset">
            	                	</a>
            	                    <div class="card-body">
            	                        <!-- <h6><a href="#">Lorem Ipsum</a></h6> -->
            	                        <p class="text-muted card-text"><?php echo $pvalue['PICnote'] ?></p>
            	                    </div>
            	                </div>
            	            <!-- </div> -->
                        </div>

                      <?php endforeach; ?>
                    </div>
                  </section>

              </div>
            </div>
            <?php endforeach; ?>
          </div>


        </div>
        <?php endif; ?>

        <!-- <div id="myBtnContainer" style="margin-top:20px">
          <button class="xbtn active" onclick="filterSelection('all')"> Show all</button>
          <button class="xbtn" onclick="filterSelection('nature')"> Nature</button>
          <button class="xbtn" onclick="filterSelection('cars')"> Cars</button>
          <button class="xbtn" onclick="filterSelection('people')"> People</button>
        </div> -->

        <!-- Portfolio Gallery Grid -->
        <!-- <div class="row"> -->
          <!-- <section class="gallery-block cards-gallery">
          <div class="column nature">
            <div class="content">
              <a class="lightbox" href="<?php echo base_url(); ?>assets/img/image1.jpg">
            		<img src="<?php echo base_url(); ?>assets/img/image1.jpg" alt="Mountains" style="width:100%">
            	</a>
              <h4>Mountains</h4>
              <p>Lorem ipsum dolor..</p>
            </div>
          </div>
          <div class="column nature">
            <div class="content">
            <img src="<?php echo base_url(); ?>assets/img/image2.jpg" alt="Lights" style="width:100%">
              <h4>Lights</h4>
              <p>Lorem ipsum dolor..</p>
            </div>
          </div>
          <div class="column nature">
            <div class="content">
            <img src="<?php echo base_url(); ?>assets/img/image3.jpg" alt="Nature" style="width:100%">
              <h4>Forest</h4>
              <p>Lorem ipsum dolor..</p>
            </div>
          </div> -->

          <!-- <div class="column cars">
            <div class="content">
              <img src="<?php echo base_url(); ?>assets/img/image4.jpg" alt="Car" style="width:100%">
              <h4>Retro</h4>
              <p>Lorem ipsum dolor..</p>
            </div>
          </div>
          <div class="column cars">
            <div class="content">
            <img src="<?php echo base_url(); ?>assets/img/image5.jpg" alt="Car" style="width:100%">
              <h4>Fast</h4>
              <p>Lorem ipsum dolor..</p>
            </div>
          </div>
          <div class="column cars">
            <div class="content">
            <img src="<?php echo base_url(); ?>assets/img/image6.jpg" alt="Car" style="width:100%">
              <h4>Classic</h4>
              <p>Lorem ipsum dolor..</p>
            </div>
          </div> -->

          <!-- <div class="column people">
            <div class="content">
              <img src="<?php echo base_url(); ?>assets/img/image7.jpg" alt="Car" style="width:100%">
              <h4>Girl</h4>
              <p>Lorem ipsum dolor..</p>
            </div>
          </div>
          <div class="column people">
            <div class="content">
            <img src="<?php echo base_url(); ?>assets/img/image8.jpg" alt="Car" style="width:100%">
              <h4>Man</h4>
              <p>Lorem ipsum dolor..</p>
            </div>
          </div>
          <div class="column people">
            <div class="content">
            <img src="<?php echo base_url(); ?>assets/img/image9.jpg" alt="Car" style="width:100%">
              <h4>Woman</h4>
              <p>Lorem ipsum dolor..</p>
            </div>
          </div> -->
        <!-- END GRID -->

        <!-- </div> -->
        <!-- </section> -->

        <!-- END MAIN -->
        </div>

        <?php echo $footer; ?>

        <script>

          $(document).ready(function(){
              $(".nav-tabs a").click(function(){
                  $(this).tab('show');
              });
          });

          filterSelection("all")
          function filterSelection(c) {
            $(".xbtn").removeClass('active');
            $(".xbtn"+c).addClass('active');
            
            var x, i;
            x = document.getElementsByClassName("column");
            if (c == "all") c = "";
            for (i = 0; i < x.length; i++) {
              w3RemoveClass(x[i], "show");
              if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
            }
          }

          function w3AddClass(element, name) {
            var i, arr1, arr2;
            arr1 = element.className.split(" ");
            arr2 = name.split(" ");
            for (i = 0; i < arr2.length; i++) {
              if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
            }
          }

          function w3RemoveClass(element, name) {
            var i, arr1, arr2;
            arr1 = element.className.split(" ");
            arr2 = name.split(" ");
            for (i = 0; i < arr2.length; i++) {
              while (arr1.indexOf(arr2[i]) > -1) {
                arr1.splice(arr1.indexOf(arr2[i]), 1);
              }
            }
            element.className = arr1.join(" ");
          }


          // Add active class to the current button (highlight it)
          var btnContainer = document.getElementById("myBtnContainer");
          var btns = btnContainer.getElementsByClassName("btn");
          for (var i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function(){
              var current = document.getElementsByClassName("active");
              current[0].className = current[0].className.replace(" active", "");
              this.className += " active";
            });
          }

          function openCity(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
          }
          </script>

    </body>

    <?php echo $endpage; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script>
        baguetteBox.run('.cards-gallery', { animation: 'slideIn'});
    </script>

</html>
