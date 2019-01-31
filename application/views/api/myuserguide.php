<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//echo '<pre>';
//print_r($branchapi);
//echo '</pre>';
//exit();
?>
<?php // foreach ($branchapi as $bkey => $bvalue): ?>
<?php // echo '<pre>'; ?>
<?php // echo $bvalue['name'] . '<br>'; ?>
<?php // echo '</pre>'; ?>
<?php // endforeach; ?>
<?php // exit(); ?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Welcome to CodeIgniter</title>

        <style type="text/css">

            ::selection { background-color: #E13300; color: white; }
            ::-moz-selection { background-color: #E13300; color: white; }

            body {
                background-color: #fff;
                margin: 40px;
                font: 13px/20px normal Helvetica, Arial, sans-serif;
                color: #4F5155;
            }

            a {
                color: #003399;
                background-color: transparent;
                font-weight: normal;
            }

            h1 {
                color: #444;
                background-color: transparent;
                border-bottom: 1px solid #D0D0D0;
                font-size: 19px;
                font-weight: normal;
                margin: 0 0 14px 0;
                padding: 14px 15px 10px 15px;
            }

            code {
                font-family: Consolas, Monaco, Courier New, Courier, monospace;
                font-size: 12px;
                background-color: #f9f9f9;
                border: 1px solid #D0D0D0;
                color: #002166;
                display: block;
                margin: 14px 0 14px 0;
                padding: 12px 10px 12px 10px;
            }

            #body {
                margin: 0 15px 0 15px;
            }

            p.footer {
                text-align: right;
                font-size: 11px;
                border-top: 1px solid #D0D0D0;
                line-height: 32px;
                padding: 0 10px 0 10px;
                margin: 20px 0 0 0;
            }

            #container {
                margin: 10px;
                border: 1px solid #D0D0D0;
                box-shadow: 0 0 8px #D0D0D0;
            }
        </style>
    </head>
    <body>

        <div id="container">
            <h1><b>Welcome to Yotaka Hotel API version 0.1 </b></h1>

            <div id="body">
                <p><b>The page you are looking at is being generated dynamically by Yotaka System.</b></p>

                <h1><b>Branch</b></h1>
                <?php foreach ($branchapi as $bkey => $bvalue): ?>                
                    <p><b><?php echo $bvalue['name']; ?> :</b></p>
                    <code>
                        { Url : <?php echo $bvalue['api']; ?> }<br>
                        { Method : <?php echo$bvalue['method']; ?> } <br>
                        { Parameter : <?php echo $bvalue['param']; ?> } <br>
                        { Example : <?php echo $bvalue['example']; ?> } <br>
                    </code><br>
                <?php endforeach; ?>

                <br><br>

                <h1><b>Customer</b></h1>
                <?php foreach ($customerapi as $ckey => $cvalue): ?>                
                    <p><b><?php echo $cvalue['name']; ?> :</b></p>
                    <code>
                        { Url : <?php echo $cvalue['api']; ?> }<br>
                        { Method : <?php echo$cvalue['method']; ?> } <br>
                        { Parameter : <?php echo $cvalue['param']; ?> } <br>
                        { Example : <?php echo $cvalue['example']; ?> } <br>
                    </code><br>
                <?php endforeach; ?>

                <br><br>

                <h1><b>Use case</b></h1>
                <?php foreach ($usecaseapi as $ukey => $uvalue): ?>                
                    <p><b><?php echo $uvalue['name']; ?> :</b></p>
                    <code>
                        { Url : <?php echo $uvalue['api']; ?> }<br>
                        { Method : <?php echo$uvalue['method']; ?> } <br>
                        { Parameter : <?php echo $uvalue['param']; ?> } <br>
                        { Example : <?php echo $uvalue['example']; ?> } <br>
                    </code><br>
                <?php endforeach; ?>

            </div>
            <div id="body">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe width="1024" height="500" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vTZ6yLSwjbzUhATU-_1I6jkBrYbR2EwexW604mQO7ik4VTrUyIrrDUTlksbzlf55IYiiHfFOem_3-Om/pubhtml?gid=0&amp;single=true&amp;widget=true&amp;headers=false"></iframe>
                </div>
            </div>

            <p class="footer">Update by Yotaka System 14-08-2561</p>
        </div>

    </body>
</html>