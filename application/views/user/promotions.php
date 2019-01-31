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
        /*            body {
                        margin: 40px 10px;
                        padding: 0;
                        font-family: "Lucida Grande", Helvetica, Arial, Verdana, sans-serif;
                        font-size: 14px;
                    }*/

        #calendar {
            max-width: 900px;
            margin: 0 auto;
            /* color: #18b9e6; */
        }
    </style>
    </head>
    <body>
        <?php echo $topmenu; ?>
        <h1 style="margin-top: 45px; text-align: center"><?php echo $this->lang->line("promotions"); ?></h1>
        <div  id='calendar' style="margin-top: 50px"></div>

        <!-- The Edit Modal -->
        <div class="modal fade" id="myShowEvent">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!--Modal Header-->
                    <div class="modal-header">
                        <h4 class="modal-title"><?php echo $this->lang->line("event"); ?></h4>
                        <span id="xid" style="color: #ffffff"></span>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="dash" id="dash">

                    </div>
                </div>
            </div>
        </div>

        <?php echo $footer; ?>
    </body>

    <?php // echo $endpage; ?>

    <script src="<?php echo base_url(); ?>assets/js/boostrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/vender/popper.min.js"></script>

</html>

<!--https://fullcalendar.io/releases/fullcalendar/3.9.0/demos/agenda-views.html-->
<!--https://www.patchesoft.com/fullcalendar-with-php-and-codeigniter-->
