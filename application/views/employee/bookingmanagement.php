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

debug($bbill);
?>
<!-- Example DataTables Card-->
<div class="card mb-3">
    <div class="card-header">
    <i class="fa fa-table"></i> Data Table Example</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>ห้อง</th>
                        <th>ชื่อลูกค้า</th>
                        <th>สาขา</th>
                        <th>วิธีการจอง</th>
                        <th>Salary</th>
                    </tr>
                    </thead>              
                    <tbody>
                    <?php 
                    if(isset($bbill)): 
                        foreach($bbill as $key => $value):
                    ?>
                    <tr>
                        <td><?php echo $key + 1 ?></td>
                        <td><?php echo $value['Room'][0]['ROMno'] ?></td>
                        <td><?php echo $value['customer']['CUSfname'] . '  ' . $value['customer']['CUSfname'] ?></td>
                        <td><?php echo $value['Room'][0]['branch'][0]['BRHdesc'.$sl] ?></td>
                        <td><?php echo $value['USCdesc'.$sl] ?></td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-primary" onclick="roomMove(<?php echo $value['BOKid']; ?>);">ย้ายห้อง</button>
                                <button type="button" class="btn btn-primary">Samsung</button>
                                <button type="button" class="btn btn-primary">Sony</button>                            
                            </div>
                        </td>
                    </tr>           
                    <?php 
                        endforeach;
                    endif; 
                    ?>     
                    </tbody>
                </table>
            </div>
        </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>
<!-- The Edit Modal -->
<div class="modal fade" id="roomMoveModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!--Modal Header-->
            <div class="modal-header">
                <h4 class="modal-title">ย้ายห้อง</h4>
                <span id="xid" style="color: #ffffff"></span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="dash" id="dash">

            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#roomMoveModal').on('shown.bs.modal', function () {
            var id = $("#xid").html();
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>showaccessoriesbyid/" + id + "?param=true",
                success: function (data) {
                    $("#dash").html(data);
                },
                error: function (err) {
                    console.log(err);
                }
            });
        });
    });
    
    function roomMove(id){
        var xid = id;
        $("#xid1").html(xid);
        $("#roomMoveModal").modal("show");
    }
</script>