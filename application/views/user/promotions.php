<!DOCTYPE html>
<html>
    <head>
    <?php echo $startpage; ?>
    <link href="<?php echo base_url(); ?>assets/calendar/fullcalendar.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/calendar/fullcalendar.print.min.css" rel='stylesheet' media='print' />

    <script src="<?php echo base_url(); ?>assets/calendar/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/calendar/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/calendar/fullcalendar.min.js"></script>
    <script>
    <?php
    if (!isset($_COOKIE["lang"])) {
        $lg = $lang;
    } else {
        $lg = $_COOKIE["lang"];
    }

    if ($lg == 'thailand') {
        $sl = 'TH';
        $lcode = 0;
    } else {
        $sl = 'EN';
        $lcode = 1;
    }
    ?>

    $(document).ready(function () {
        
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
//                        right: 'month,agendaWeek,agendaDay,listWeek'
                right: 'month,agendaDay'
            },
            defaultDate: '<?php echo date("Y-m-d") ?>',
            navLinks: true, // can click day/week names to navigate views
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: {
                url: '<?php echo base_url(); ?>showevents/<?php echo $lcode ?>',
                error: function() {}
            },
            eventClick: function(event) {
                if (event.id) {
                    // window.open(event.url, "_blank");
                    var xid = event.id;
                    $("#xid").html(xid);
                    $("#myShowEvent").modal("show");
                    // alert(event.id);
                    return false;
                }
            }
        });

       $('#myShowEvent').on('shown.bs.modal', function () {
            var id = $("#xid").html();
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>getevent/" + id + "?param=true",
                success: function (data) {
                    $("#dash").html(data);
                },
                error: function (err) {
                    console.log(err);
                }
            });
        });

    });

    </script>
    <style>
        .box-promotion{ 
            width: 260px; 
            min-height: 375px; 
            margin: 0 auto;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            -o-border-radius: 2px;
            border-radius: 2px;
            -webkit-box-shadow: 0 1px 2px rgba(0,0,0,0.2);
            -moz-box-shadow: 0 1px 2px rgba(0,0,0,0.2);
            -o-box-shadow: 0 1px 2px rgba(0,0,0,0.2);
            box-shadow: 0 1px 2px rgba(0,0,0,0.2);  
            margin-bottom: 20px;
            cursor: pointer;
        }
        .box-promotion:hover{ 
            -webkit-box-shadow: 0 1px 10px 1px rgba(0,0,0,0.2);
            -moz-box-shadow: 0 1px 10px 1px rgba(0,0,0,0.2);
            -o-box-shadow: 0 1px 10px 1px rgba(0,0,0,0.2);
            box-shadow: 0 1px 10px 1px rgba(0,0,0,0.2);
         }
        .pmt-img img{ width: 100%; height: 156px; }
        .pmt-time{ color: #999; font-size: 12px; padding: 10px; }
        .pmt-title{ 
            padding: 0px 10px 10px 15px; 
            max-height: 135px;
            overflow-y: hidden;
            overflow-x: hidden; }
        .pmt-btn-detail{ 
            width: 260px;
            /*border-top: 1px solid #EAEAEA;*/
            bottom: 35px;
            position: absolute;
            text-align: center;
        }
        .btn-detail{ border: 1px solid #EAEAEA; border-radius: 10px; color: #7b7a7a !important; padding: 5px 25px 5px 25px;; font-size: 12px; width: 150px }
        .btn-detail:hover{ background: #FAFAFA; }
        #sp_pmt_time{ color: #999; font-size: 12px; padding: 10px 10px 10px 0px;  }
        #sp_pmt_title{ padding: 10px 10px 10px 0px; font-weight: bold;}
        #sp_pmt_detail{ color: #777; }

        @media (min-width: 1300px){
            .col-lg-3 {
                -ms-flex: 0 0 20%;
                flex: 0 0 20%;
                max-width: 20%;
            }

            #pmt-d-img{ width: 1200px !important; }
        }
    </style>
    </head>
    <body>
        <?php echo $topmenu;  ?>
        
        <div class="main-container">
            <div class="container-fluid">
                <div class="row" style="margin-top: 30px; ">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <img src="assets/img/promotion.png" style="width: 100%;">
                        <div class="text-promotion"></div>
                    </div>
                </div>
            </div>
            <div class="container-fluid" id="box-promotion" style="transition: 1.0s;">
                <div class="row" style="margin-top: 20px; border-bottom: 1px solid #EAEAEA; ">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h5><?php echo $this->lang->line("M8001");?></h5>
                    </div>
                </div>
                <div class="row" style="margin-top: 20px;">
                    <?php
                        $img_name = 1;
                        switch ($sl) {
                            case 'TH': $l = 0; break;
                            case 'EN': $l = 1; break;
                        }
                        foreach ($promotions as $k => $v) {
                            $img_name  = ( $img_name > 5 ) ? 1 : $img_name + 1;
                            $str_html  = "";
                            $str_html .= '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">';
                            $str_html .= '  <div class="box-promotion" id="pmt_id_'.$v['POMid'].'" onclick="get_detail_pomotion('.$v['POMid'].','.$img_name.','.$l.')">';
                            $str_html .= '      <div class="pmt-img">';
                            $str_html .= '          <img src="assets/img/pic'.$img_name.'.png">';
                            $str_html .= '      </div>';
                            $str_html .= '      <div class="pmt-time">'.convert_date_show($v['POMstartDT'], $sl).' - '.convert_date_show($v['POMendDT'], $sl).'</div>';
                            $str_html .= '      <div class="pmt-title">'.$v['POMdescTH'].' ('.$v['POMdescEN'].')</div>';
                            $str_html .= '      <div class="pmt-btn-detail"><a class="btn-detail">'.$this->lang->line("details").'</a></div>';
                            $str_html .= '  </div>';
                            $str_html .= '</div>';
                            echo $str_html;
                        }
                    ?>
                </div>
            </div>


            <div class="container-fluid" id="box-promotion-detail" style="display: none; transition: 1.0s;">
                <div class="row">
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h5 id="pmt-d-title" onclick="back_pomotion()"  style="margin-top: 30px; height: 40px; border-bottom: 1px solid #EAEAEA; cursor: pointer; "><?php echo $this->lang->line("M8001");?> </h5>
                    </div>
                </div>
                <div class="row"  style="margin-top: 30px;">
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h5 id="pmt-d-title"><?php echo $this->lang->line("promotionsdescriptionTH");?> </h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 5px;">
                        <img src="assets/img/pic3.png" id="pmt-d-img" style="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  style="margin-top: 20px;">
                        <span id="sp_pmt_time"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  style="margin-top: 20px;">
                        <span id="sp_pmt_title"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  style="margin-top: 20px;">
                        <h5><?php echo $this->lang->line("discode");?></h5>
                        <span id="sp_pmt_code"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
                        <h5><?php echo $this->lang->line("branchname");?></h5>
                        <span id="sp_pmt_detail"></span>
                    </div>
                </div>
            </div>
        </div>

        <?php echo $footer; ?>
    </body>

    <?php // echo $endpage; ?>

    <script src="<?php echo base_url(); ?>assets/js/boostrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/vender/popper.min.js"></script>
    <script type="text/javascript">
        function get_detail_pomotion( id , img_name, sl){
            $.get("get_detail_pomotion", { id : id }, function(res){
                res = jQuery.parseJSON( res );
                
                $("#sp_pmt_time").html( convert_date_show(res.POMstartDT, sl) + " - " + convert_date_show(res.POMendDT, sl) ); 
                $("#sp_pmt_title").html( res.POMdescTH + "<br>" + res.POMdescEN );
                $("#sp_pmt_code").html( res.POMpcode);
                var str_html = "";
                $.each( res.branchName, function( k, v){
                    str_html += "<div class='branch-list col-lg-12'> - " + v.BRHdescTH + " ("+v.BRHdescEN+")</div>";
                });
                $("#pmt-d-img").attr("src","assets/img/pic"+img_name+".png");
                $('#sp_pmt_detail').html(str_html);
                $("#box-promotion").hide();
                $('#box-promotion-detail').show();

            });
        }

        function convert_date_show( strDate, lang ){
            var D = strDate.split("-");
            var strYear     = parseInt( D[0] )+543;
            var strMonth    = parseInt( D[1] );
            var strDay      = D[2];
            if (lang = 'TH') {
                var strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
            }
            if (lang = 'EN') {
                var strMonthCut = Array("","JAN","FEB","MAR","APR","MAY","JUN","JUL","AUG","SEP","OCT","NOV","DEC");
            }
            var strMonthThai= strMonthCut[strMonth];
            return strDay + " " + strMonthThai + " " + strYear;
        }

        function back_pomotion(){
            $("#box-promotion").show();
            $('#box-promotion-detail').hide();
        }
    </script>

<?php

function convert_date_show( $strDate , $lang){
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    if ($lang == 'TH') {
        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    }
    if ($lang == 'EN') {
        $strMonthCut = Array("","JAN","FEB","MAR","APR","MAY","JUN","JUL","AUG","SEP","OCT","NOV","DEC");
    }
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
}
?>
