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

<?php
switch ($chk) {
    case 'printBookingPDF':
    
?>
    <style>
    #circle { 
        width: 140px; /* ความกว้าง */
        height: 140px; /* ความสูง */
        background: red; /* สี */
        -moz-border-radius: 70px; 
        -webkit-border-radius: 70px; 
        border-radius: 70px;
    }
    </style>
    <?php // debug($settingp) ?>
    <table border="0" width="100%">
        <tr>
            <td align="center">
                <b><?php echo $vs[0]['branch'][0]['BRHdescTH'] ?></b><br>
                <?php echo $vs[0]['branch'][0]['BRHadr'] ?><br>
                <?php echo 'Tel:  '.$vs[0]['branch'][0]['BRHnphone'] . '  ' ?>
                <?php echo 'Email:  '.$vs[0]['branch'][0]['BRHemail'] . '  ' ?>
                <?php echo 'เลขประจำตัวผู้เสียภาษี:  '.$vs[0]['branch'][0]['BRHvnum'] ?>
            </td>                        
        </tr>        
   </table>
   
   <table>
        <tr>
            <td align="center" >
            <h3>ใบเสร็จรับเงิน/ใบกำกับภาษี<br>
            TAXRECEPT</h3>
            </td>
        </tr>
   </table>
    <br><br>
    <?php $xelse = 0; $r = 0?>
   <table border="1">
        <tr>
            <td>
                <?php if($vs[0]['VOCsubadr']  == 0): ?>
                    <table border="0" width="100%">
                        <tr>
                            <td width="30%"><b>ชื่อ : </b></td>
                            <td width="70%"><?php echo $vs[0]['customer']['CUSfname'] . '  ' . $vs[0]['customer']['CUSlname'] ?></td>
                        </tr>
                        <tr>
                            <td width="30%"><b>ที่อยู่ : </b></td>
                            <td width="70%"><?php echo $vs[0]['customer']['CUSadr'] ?></td>
                        </tr>
                        <tr>
                            <td width="30%"><b>เบอร์โทรศัพ : </b></td>
                            <td width="70%"><?php echo $vs[0]['customer']['CUSnphone'] ?></td>
                        </tr>
                        <tr>
                            <td width="30%"><b>email : </b></td>
                            <td width="70%"><?php echo $vs[0]['customer']['CUSemail'] ?></td>
                        </tr>
                    </table>
                <?php else: ?>
                    <table>
                        <tr>
                            <td><b>ชื่อ : </b></td>
                            <td><?php echo $vs[0]['addr'][0]['ADRname'] ?></td>
                        </tr>
                        <tr>
                            <td><b>ที่อยู่ : </b></td>
                            <td><?php echo $vs[0]['addr'][0]['ADRnote'] ?></td>
                        </tr>
                        <tr>
                            <td>
                                <b>เบอร์โทรศัพ : </b>
                            </td>
                            <td><?php echo $vs[0]['addr'][0]['ADRtel'] ?></td>
                        </tr>
                        <tr>
                            <td><b>email : </b></td>
                            <td><?php echo $vs[0]['addr'][0]['ADRemail'] ?></td>
                        </tr>
                    </table> 
                <?php endif; ?>
            </td>
            <td>
                <table border="0" width="100%">
                    <tr>
                        <td width="30%"><b>เลขที่ใบสำคัญ : </b></td>
                        <td width="70%"><?php echo $vs[0]['VOCcode'] ?></td>
                    </tr>
                    <tr>
                        <td width="30%"><b>วันที่ออกบิล : </b></td>
                        <td width="70%"><?php echo $vs[0]['VOCdate'] ?></td>
                    </tr>
                    <tr>
                        <td width="30%"><b>ผู้ออกบิล : </b></td>
                        <td width="70%"><?php echo $vs[0]['VOCcreatedBY'] ?></td>
                    </tr>
                </table>
            </td>
        </tr>
   </table>
   <br><br>
   <table border="1" width="100%">
        <tr bgcolor="#66b3ff">
            <td align="center" width="10%">ลำดับ</td>
            <td align="center" width="35%">รายละเอียด</td>
            <td align="center" width="10%">จำนวน</td>
            <td align="center" width="15%">หน่วย</td>
            <td align="center" width="15%">ราคา/หน่วย</td>
            <td align="center" width="15%">ราคา</td>
        </tr>
   <?php if($settingp[0] == 0): ?>   
        <?php foreach ($vs[0]['voucherlist'] as $key => $value):?>
        <tr>
            <td align="center" width="10%"><?php echo $key + 1 ?></td>
            <td width="35%"><?php echo 'ห้อง ' . $value['sublist'][0]['room'][0]['ROMno'] . '  ( ' . $value['sublist'][0]['room'][0]['ROMdescTH'] . ' )' ?></td>
            <td align="center" width="10%"><?php echo number_format($value['VOLqty'], 0, '.', '') ?></td>
            <td align="center" width="15%">ห้อง</td>
            <td align="right" width="15%"><?php echo number_format($value['sublist'][0]['room'][0]['ROMpice'], 2, '.', '') ?></td>
            <td align="right" width="15%"><?php echo number_format($value['VOLprice'], 2, '.', '') ?></td>
        </tr>
        <?php endforeach; ?>        
    <?php else: ?>

        <?php foreach ($vs[0]['voucherlist'] as $key => $value):?>
            <tr>
                <td align="center" width="10%"><?php echo $key + 1 ?></td>
                <td width="35%"><?php echo 'ห้อง ' . $value['sublist'][0]['room'][0]['ROMno'] . '  ( ' . $value['sublist'][0]['room'][0]['ROMdescTH'] . ' )' ?></td>
                <td align="center" width="10%"><?php echo $value['sublist'][0]['atnight'] ?></td>
                <td align="center" width="15%">คืน</td>
                <td align="right" width="15%"><?php echo number_format($value['sublist'][0]['room'][0]['ROMpice'], 2, '.', '') ?></td>
                <td align="right" width="15%"><?php echo number_format($value['sublist'][0]['room'][0]['ROMpice'] * $value['sublist'][0]['atnight'], 2, '.', '') ?></td>
            </tr>
                <?php
                if(isset($value['sublist'][0]['extrabed'])):
                    foreach ($value['sublist'][0]['extrabed'] as $ekey => $evalue):
                        if($settingp[1] == 1):
                    ?>
                    <tr>
                        <td align="center" width="10%"></td>
                        <td width="35%">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <table border="0" width="100%">
                                <tr>
                                    <td width="30%"><b><?php if($ekey == 0){echo "ส่วนเสริม";} ?></b></td>
                                    <?php $e = $ekey + 1; ?>
                                    <td width="70%"><?php echo ' (' . $e . ') ' . $evalue['REDnote'] ?></td>
                                </tr>
                            </table>                        
                        </td>
                        <td align="center" width="10%"><?php echo number_format($evalue['REDqty'], 0, '.', '') ?></td>
                        <td align="center" width="15%">หน่วย</td>
                        <td align="right" width="15%"><?php echo number_format($evalue['REDprice'], 2, '.', '') ?></td>
                        <td align="right" width="15%"><?php echo number_format($evalue['REDtot'], 2, '.', '') ?></td>
                    </tr>
                    <?php 
                        else:
                            $xelse += $evalue['REDtot'];
                        endif;
                    endforeach;
                endif;
                ?>

                <?php   
                if(isset($value['sublist'][0]['minibar'])):
                    foreach ($value['sublist'][0]['minibar'] as $mikey => $mivalue):
                        if($settingp[2] == 1):
                    ?>
                    <tr>
                        <td align="center" width="10%"></td>
                        <td width="35%">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <table border="0" width="100%">
                                <tr>
                                    <td width="30%"><b><?php if($mikey == 0){echo "สินค้า";} ?></b></td>
                                    <?php $m = $mikey + 1; ?>
                                    <td width="70%"><?php echo ' (' . $m . ') ' .  $mivalue['product'][0]['STKdescTH'] ?></td>
                                </tr>
                            </table>
                        </td>
                        <td align="center" width="10%"><?php echo number_format($mivalue['MNSromrisqty'], 0, '.', '') ?></td>
                        <td align="center" width="15%"><?php echo $mivalue['product'][0]['unit'][0]['UNTdescTH'] ?></td>
                        <td align="right" width="15%"><?php echo number_format($mivalue['MNSromrisprice'], 2, '.', '') ?></td>
                        <td align="right" width="15%"><?php echo number_format($mivalue['MNSromristot'], 2, '.', '') ?></td>
                    </tr>
                    <?php 
                        else:
                            $xelse += $mivalue['MNSromristot'];
                        endif;
                    endforeach;
                endif;
                ?>

                <?php   
                if(isset($value['sublist'][0]['accessories'])):
                    foreach ($value['sublist'][0]['accessories'] as $akey => $avalue):
                        if($settingp[3] == 1):
                    ?>
                    <tr>
                        <td align="center" width="10%"></td>
                        <td width="35%">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <table border="0" width="100%">
                                <tr>
                                    <td width="30%"><b><?php if($akey == 0){echo "ค่าปรับ";} ?></b></td>
                                    <?php $a = $akey + 1; ?>
                                    <td width="70%"><?php echo ' (' . $a . ') ' .  $avalue['unit'][0]['RASdescTH'] ?></td>
                                </tr>
                            </table>
                        </td>
                        <td align="center" width="10%"><?php echo number_format($avalue['RADromrisqty'], 0, '.', '') ?></td>
                        <td align="center" width="15%">หน่วย</td>
                        <td align="right" width="15%"><?php echo number_format($avalue['RADromrisprice'], 2, '.', '') ?></td>
                        <td align="right" width="15%"><?php echo number_format($avalue['RADromristot'], 2, '.', '') ?></td>
                    </tr>
                    <?php 
                        else:
                            $xelse += $avalue['RADromristot'];
                        endif;
                    endforeach;
                endif;
                ?>

        <?php endforeach; ?>
    <?php endif; ?>
        <?php
        if($xelse > 0):
        ?>
            <tr>
                <td align="center" width="10%"></td>
                <td width="35%">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <table border="0" width="100%">
                        <tr>
                            <td width="30%"><b>เพิ่มเติม </b></td>                                    
                            <td width="70%">(1) อื่น ๆ</td>
                        </tr>
                    </table>
                </td>
                <td align="center" width="10%">1</td>
                <td align="center" width="15%">หน่วย</td>
                <td align="right" width="15%"><?php echo number_format($xelse, 2, '.', '') ?></td>
                <td align="right" width="15%"><?php echo number_format($xelse, 2, '.', '') ?></td>
            </tr>
        <?php
        endif;
        ?>
        <tr>
            <td rowspan="3" width="70%" align="middle"></td>
            <td width="15%" align="right" bgcolor="#ffcccc">รวม</td>
            <td align="right" width="15%" bgcolor="#ffcccc"><?php echo number_format($vs[0]['VOCsum'] - $vs[0]['VOCvatsum'] + $vs[0]['VOCdis'], 2, '.', '')?></td>
        </tr>
        <tr>
            <!-- <td rowspan="0" width="70%"></td> -->
            <td width="15%" align="right" bgcolor="#ffcccc">ส่วนลด</td>
            <td align="right" width="15%" bgcolor="#ffcccc"><?php echo number_format($vs[0]['VOCdis'], 2, '.', '') ?>&nbsp;</td>
        </tr>
        <tr>
            <!-- <td colspan="3" width="70%"></td> -->
            <td width="15%" align="right" bgcolor="#ffcccc">Vat <?php echo $vs[0]['VOCvat'] ?> %</td>
            <td align="right" width="15%" bgcolor="#ffcccc"><?php echo number_format($vs[0]['VOCvatsum'], 2, '.', '') ?>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3" width="70%" align="center" bgcolor="#e0e0d1">--<?php echo bahtText(number_format($vs[0]['VOCsum'], 2, '.', '')) ?>--</td>
            <td width="15%" align="right" bgcolor="#ffcccc">จำนวนเงินรวม</td>
            <td align="right" width="15%" bgcolor="#ffcccc"><?php echo number_format($vs[0]['VOCsum'], 2, '.', '') ?>&nbsp;</td>
        </tr>
    </table>
    <br><br><br><br><br><br>
    <table border="0" width="100%">
        <tr>
            <td align="center"><br><br>(...........................................................)</td>
        </tr>        
        <tr>
            <td align="center">ผู้รับเงิน</td>
        </tr>
        <tr>
            <td align="center">วันที่&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date("Y / m / d") ?></td>
        </tr>
    </table>
<?php
        break;
    
    default:
        # code...
        break;
}

?>