<?php
if (!isset($_COOKIE["lang"])) {
    
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

    <body class="fixed-nav sticky-footer bg-dark" id="page-top">

        <?php echo $menu; ?>
        <div class="content-wrapper">
            <div class="container-fluid">
                <!-- Breadcrumbs-->
                <!-- <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">My Dashboard</li>
                </ol> -->
                <?php  echo $content; ?>

            </div>
            <!-- /.container-fluid-->
            <!-- /.content-wrapper-->
            <?php echo $footer; ?>
            <?php echo $endpage; ?>
        </div>
    </body>

</html>


<script>
//onkeypress="return numberOnly(event);"
    function numberOnly(evt){
        var charCode = (evt.which) ? evt.which : evt.keyCode
        return !(charCode > 31 && (charCode < 48 || charCode > 57));
    }

    function formValidation(fname){
        var elem = document.getElementById(fname).elements;
        for (var i = 0; i < elem.length; i++) {
            array[i]
        }
    }
</script>
