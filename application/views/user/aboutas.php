
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
        <style type="text/css">
            
        @media (min-width: 500px){
            .col-3{ width: 100px !important; }
        }
        </style>
    </head>
    <body>

        <?php echo $topmenu; ?>

        <main role="main" class="container-fluid" style="margin-top:40px">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <div class="list-group">
                          <?php $str_html  = "";
                                krsort($amenu);
                                foreach ($amenu as $akey => $avalue) : ; 
                                $menu      = ( $aindex[0]['PU01title' . $sl] == $avalue['PU01title' . $sl] ) ? " active" : "";
                                $str_html .= '<a class="list-group-item list-group-item-action '.$menu.'" href="'.base_url().'showbookingbid/'.$avalue['PU01id'].'">'.$avalue['PU01title' . $sl].'</a>';

                                endforeach;

                                echo $str_html; 
                            ?>
                    </div>
                </div>
                
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 blog-main">
                <div class="dropdown dropleft float-right" >
                    <button class="btn my-2 my-sm-0" type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" style="background:transparent;color:#fff;">
                        <i class="fa fa-language fa-2x" aria-hidden="true"></i>
                    </button>
                    <div class="dropdown-menu">
                        <h1 class="dropdown-header"><?php echo $this->lang->line("please_select_language"); ?></h1>
                        <a class="dropdown-item" href="#" onclick="SelectLanguage('en');"><?php echo $this->lang->line("english"); ?></a>
                        <a class="dropdown-item" href="#" onclick="SelectLanguage('th');"><?php echo $this->lang->line("thailand"); ?></a>
                        <a class="dropdown-item disabled" href="#"><?php echo $this->lang->line("chinese"); ?></a>
                        <a class="dropdown-item disabled" href="#"><?php echo $this->lang->line("japanese"); ?></a>
                    </div>
                </div>
                
                  <?php foreach ($aindex as $dkey => $dvalue) : ?>
                    <div class="blog-post">
                        <h2 class="blog-post-title"><?php echo $dvalue['PU01title' . $sl]; ?> </h2>
                        <p class="blog-post-meta"><?php echo date("F d,Y", strtotime($dvalue['PU01createdDT'])); ?> by Yotaka Group</a></p>

                        <hr>

                        <?php if (isset($dvalue['pic'])) : ?>
                          <img src="<?php echo base_url() . 'assets/img/uploads/' . $dvalue['pic']['PICname'] ?>" class="img-thumbnail" alt="Cinque Terre" width="350" height="236" style="position: relative;">
                        <?php endif; ?>
                        <p style="margin-top:30px;font-size:14px;">
                          <?php echo $dvalue['PU01desc' . $sl]; ?>
                        </p>

                    </div>
                    <?php endforeach; ?>


                    <button class="btn my-2 my-sm-0" type="button" data-toggle="modal" data-target="#myModalLogin" data-backdrop="static" align="right" style="background:transparent;color:#fff;">
                    <i class="fa fa-user-circle-o fa-2x" aria-hidden="true"></i>
                  <?php
                    if (isset($_SESSION['isLoggedIn'])) {
                        echo $_SESSION['fname'] . '  ' . $_SESSION['lname'];
                    }
                    ?>
                </button>

                </div><!-- /.blog-main -->

            </div><!-- /.row -->
            <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div>
                  <?php foreach ($aindex as $aikey => $aivalue) : ?>
                    <?php if ($aivalue['PU01youtube'] != '') : ?>
                        <div class="col-lg-1 col-md-1 col-sm-2 col-xs-3 col-3">
                            <a href="<?php echo $aivalue['PU01youtube']; ?>" target="_blank">Youtube</a>
                        </div>
                    <?php endif; ?>
                    <?php if ($aivalue['PU01line'] != '') : ?>
                        <div class="col-lg-1 col-md-1 col-sm-2 col-xs-3 col-3">
                            <a href="<?php if (isset($aivalue['PU01line'])) {
                                        echo $aivalue['PU01line'];
                                    } ?>" target="_blank">Line</a>
                        </div>
                    <?php endif; ?>
                    <?php if ($aivalue['PU01twitter'] != '') : ?>
                          <div class="col-lg-1 col-md-1 col-sm-2 col-xs-3 col-3">
                            <a href="<?php if (isset($aivalue['PU01twitter'])) {
                                        echo $aivalue['PU01twitter'];
                                    } ?>" target="_blank">Twitter</a>
                        </div>
                    <?php endif; ?>
                    <?php if ($aivalue['PU01facebook'] != '') : ?>
                            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-3 col-3">
                                <a href="<?php if (isset($aivalue['PU01facebook'])) {
                                        echo $aivalue['PU01facebook'];
                                    } ?>" target="_blank">Facebook</a>
                            </div>
                    <?php endif; ?>
                  <?php endforeach; ?>
    
            </div>
        </main><!-- /.container -->

        <?php echo $footer; ?>

    </body>

    <?php echo $endpage; ?>

</html>
