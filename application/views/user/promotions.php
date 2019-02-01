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
        .pmt-title{ padding: 0px 10px 10px 15px; }
        .pmt-btn-detail{ 
            width: 260px;
            /*border-top: 1px solid #EAEAEA;*/
            bottom: 35px;
            position: absolute;
            text-align: center;
        }
        .btn-detail{ border: 1px solid #EAEAEA; border-radius: 10px; color: #7b7a7a !important; padding: 5px 25px 5px 25px;; font-size: 12px; width: 150px }
        .btn-detail:hover{ background: #FAFAFA; }
    </style>
    </head>
    <body>
        <?php echo $topmenu;  ?>
        
        <div class="main-container">
            <div class="container">
                <div class="row" style="margin-top: 30px; border-bottom: 1px solid #EAEAEA; ">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h5>โปรโมชั่น (Promotion)</h5>
                    </div>
                </div>
                <div class="row" style="margin-top: 20px;">
                    <?php
                        
                        foreach ($promotions as $k => $v) {
                            $str_html  = "";
                            $str_html .= '<div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">';
                            $str_html .= '  <div class="box-promotion" id="pmt_id_'.$v['POMid'].'">';
                            $str_html .= '      <div class="pmt-img">';
                            $str_html .= '          <img src="assets/img/image'.($k+1).'.jpg">';
                            $str_html .= '      </div>';
                            $str_html .= '      <div class="pmt-time">'.convert_date_show($v['POMstartDT']).' - '.convert_date_show($v['POMendDT']).'</div>';
                            $str_html .= '      <div class="pmt-title">'.$v['POMdescTH'].' ('.$v['POMdescEN'].')</div>';
                            $str_html .= '      <div class="pmt-btn-detail"><a class="btn-detail">รายละเอียด</a></div>';
                            $str_html .= '  </div>';
                            $str_html .= '</div>';
                            echo $str_html;
                        }
                    ?>
                </div>
            </div>
        </div>

        <?php echo $footer; ?>
    </body>

    <?php // echo $endpage; ?>

    <script src="<?php echo base_url(); ?>assets/js/boostrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/vender/popper.min.js"></script>


<?php 
function convert_date_show( $strDate ){
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
}
?>
