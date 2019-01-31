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

<?php
switch ($chk) {
    case 'printBookingCUSPDF':
    
?>
        <table border="0" width="100%">
            <tr>
                <td align="center">
                    <b><?php echo $vs[0]['Room'][0]['branch'][0]['BRHdescTH'] ?></b><br>
                    <?php echo $vs[0]['Room'][0]['branch'][0]['BRHadr'] ?><br>
                    <?php echo 'Tel:  '.$vs[0]['Room'][0]['branch'][0]['BRHnphone'] . '  ' ?>
                    <?php echo 'Email:  '.$vs[0]['Room'][0]['branch'][0]['BRHemail'] . '  ' ?>
                    <?php echo 'เลขประจำตัวผู้เสียภาษี:  '.$vs[0]['Room'][0]['branch'][0]['BRHvnum'] ?>
                </td>                        
            </tr>        
    </table>
    <br><br>
    <table>
            <tr>
                <td align="center" >
                <h3>ใบจอง<br>BOOK</h3>
                </td>
            </tr>
    </table>
    <br><br><br><br>
    <table border="1" width="100%">
        <tr>
            <td>   เช็คอิน : <h1><?php  echo '     '.$vs[0]['BOKstartDT'] ?></h1></td>
            <td>   เช็คเอาท์ : <h1><?php echo '     '.$vs[0]['BOKendDT'] ?></h1></td>
        </tr>
        <tr>           
            <td>   หมายเลขอ้างอิง  :  <h1><?php  echo '     '.$vs[0]['customer']['CUSidc'] ?></h1></td>
            <td>   ชื่อ - นามสกุล  :  <h1><?php  echo '     คุณ  '.$vs[0]['customer']['CUSfname'] . '  ' . $vs[0]['customer']['CUSlname'] ?></h1></td>
        </tr>
        <tr>            
            <td>   <b><?php echo $vs[0]['Room'][0]['branch'][0]['BRHdescTH'] . '    ' ?></b>ห้อง  :  <h1><?php  echo '     '.$vs[0]['Room'][0]['ROMno'] . '   ราคา  :  ' . number_format($vs[0]['Room'][0]['ROMpice'], 2, '.', '') ?></h1></td>
            <td>   ส่วนลด  :  <h1><?php  echo '    '.$vs[0]['Promotion']['POMpcode'] . '    (' . number_format($vs[0]['Promotion']['POMdis'], 2, '.', '') . ')' ?></h1></td>
        </tr>
    </table>
    <br><br>
    <h3>ข้อมูลห้อง  (<?php echo $vs[0]['Room'][0]['nature'][0]['USCdescTH'] ?>)</h3>    
    <?php if(isset($vs[0]['Room'][0]['accessories'])): ?>
    <table border="1" width="100%">
        <tr>
            <td width="30%">   อุปกรณ์อํานวยความสะดวก  :  </td>
            <td width="70%">
            <?php
                foreach ($vs[0]['Room'][0]['accessories'] as $key => $value) {$c = $key + 1;echo '  (' . $c . ')'.$value['RASdescTH'] . '<br>';}
            ?>
            </td>
        </tr>
    </table>
    <?php endif; ?>
    <?php if(isset($vs[0]['Room'][0]['type'])): ?>
    <table border="1" width="100%">
        <tr>
            <td width="30%">   กฎระเบียบการเข้าพัก  :  </td>
            <td width="70%">
            <?php
                foreach ($vs[0]['Room'][0]['type'] as $key => $value) {$c = $key + 1;echo '  (' . $c . ')'.$value['USCdescTH'] . '<br>';}
            ?>
            </td>
        </tr>
    </table>
    <?php endif; ?>
    <br><br><h3>เพิ่มเติม...</h3><br>
    <?php echo '     ' . $vs[0]['BOKnote'] ?>
<?php
        break;
    
    default:
        # code...
        break;
}

?>