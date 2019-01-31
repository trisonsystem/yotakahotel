
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
    </head>
    <body>

        <?php echo $topmenu; ?>

        <main role="main" class="container" style="margin-top: 30px">
            <div class="row">
                <div class="col-md-8 blog-main">
                  <?php foreach ($aindex as $dkey => $dvalue): ?>
                    <div class="blog-post">
                        <h2 class="blog-post-title"><?php echo $dvalue['PU01title'.$sl]; ?> </h2>
                        <p class="blog-post-meta"><?php echo date("F d,Y", strtotime($dvalue['PU01createdDT'])); ?> by Yotaka Group</a></p>

                        <hr>

                        <?php if (isset($dvalue['pic'])): ?>
                          <img src="<?php echo base_url(). 'assets/img/uploads/' . $dvalue['pic']['PICname'] ?>" class="img-thumbnail" alt="Cinque Terre" width="350" height="236" style="position: relative;">
                        <?php endif; ?>
                        <p style="margin-top:30px">
                          <?php echo $dvalue['PU01desc'.$sl]; ?>
                        </p>

                    </div>
                    <?php endforeach; ?>
                </div><!-- /.blog-main -->

                <aside class="col-md-4 blog-sidebar">
                    <div class="p-3 mb-3 bg-dark text-white rounded">
                        <h4 class="font-italic">About</h4>
                        <ol class="list-unstyled mb-0">

                            <?php foreach ($amenu as $akey => $avalue): ?>
                              <!-- <li><a href="<?php echo base_url().'showbookingbid/'.$avalue['PU01id'] ?>" style="text-decoration: none"><?php echo date("Y F d", strtotime($avalue['PU01createdDT'])); ?></a></li> -->
                              <li><a href="<?php echo base_url().'showbookingbid/'.$avalue['PU01id'] ?>" style="text-decoration: none"><?php echo $avalue['PU01title'.$sl]; ?></a></li>
                            <?php endforeach; ?>
                        </ol>
                    </div>

                    <div class="p-3">
                        <h4 class="font-italic ">Elsewhere</h4>
                        <ol class="list-unstyled">
                          <?php foreach ($aindex as $aikey => $aivalue): ?>
                            <?php if ($aivalue['PU01youtube'] != ''): ?>
                              <li><a href="<?php echo $aivalue['PU01youtube'];?>" target="_blank">Youtube</a></li>
                            <?php endif; ?>
                            <?php if ($aivalue['PU01line'] != ''): ?>
                              <li><a href="<?php if(isset($aivalue['PU01line'])){echo $aivalue['PU01line'];} ?>" target="_blank">Line</a></li>
                            <?php endif; ?>
                            <?php if ($aivalue['PU01twitter'] != ''): ?>
                              <li><a href="<?php if(isset($aivalue['PU01twitter'])){echo $aivalue['PU01twitter'];} ?>" target="_blank">Twitter</a></li>
                            <?php endif; ?>
                            <?php if ($aivalue['PU01facebook'] != ''): ?>
                              <li><a href="<?php if(isset($aivalue['PU01facebook'])){echo $aivalue['PU01facebook'];} ?>" target="_blank">Facebook</a></li>
                            <?php endif; ?>
                          <?php endforeach; ?>
                        </ol>
                    </div>
                </aside><!-- /.blog-sidebar -->

            </div><!-- /.row -->

        </main><!-- /.container -->

        <?php echo $footer; ?>

    </body>

    <?php echo $endpage; ?>

</html>
