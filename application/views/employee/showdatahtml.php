<?php

if (!isset($_COOKIE["lang"])) {
    $lg = $lang;
} else {
    $lg = $_COOKIE["lang"];
}
// debug($_COOKIE["lang"]);
// exit();
if ($lg == 'thailand') {
    $sl = 'TH';
} else {
    $sl = 'EN';
}

switch ($chk) {
    case 'showBranchByID':
        ?>
        <!-- Modal body -->
        <form name="from_ebranchmanagement"enctype="multipart/form-data" id="from_branchmanagement">
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden"  class="form-control" id="editBRHid" name="editBRHid" value="<?php echo json_decode($shbranch, true)['data']['BRHid']; ?>">
                    <label for="editBRHcode"><?php echo $this->lang->line("branchcode"); ?>:</label>
                    <input type="text"  class="form-control" id="editBRHcode" name="editBRHcode" value="<?php echo json_decode($shbranch, true)['data']['BRHcode']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="editBRHdescEN"><?php echo $this->lang->line("branchnameEN"); ?>:</label>
                    <input type="text" class="form-control" id="editBRHdescEN" name="editBRHdescEN" value="<?php echo json_decode($shbranch, true)['data']['BRHdescEN']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="editBRHdescTH"><?php echo $this->lang->line("branchnameTH"); ?>:</label>
                    <input type="text" class="form-control" id="editBRHdescTH" name="editBRHdescTH" value="<?php echo json_decode($shbranch, true)['data']['BRHdescTH']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="editBRHadr"><?php echo $this->lang->line("address"); ?>:</label>
                    <textarea class="form-control" rows="3" id="editBRHadr" name="editBRHadr" required><?php echo json_decode($shbranch, true)['data']['BRHadr']; ?></textarea>
                </div>

                <?php
                if (strlen(json_decode($shbranch, true)['data']['BRHpic']) > 3) {
                    $name = json_decode($shbranch, true)['data']['BRHpic'];
                } else {
                    $name = 'no-image.png';
                }
                ?>
                <div class="form-group">
                    <label for="editBRHpic"><?php echo $this->lang->line("logopicture"); ?>:</label>
                </div>
                <div align="center">
                    <img src="<?php echo base_url() . 'assets/img/uploads/' . $name ?>" class="img-thumbnail" alt="Cinque Terre" width="304" height="236" />
                </div>
                <div class="form-group" style="margin-top: 15px">
                    <input type="file" class="form-control-file border" name="editBRHpic" id="editBRHpic">
                    <input type="hidden" class="form-control" id="eBRHpic" name="eBRHpic" value="<?php echo $name; ?>" >
                </div>

                <div class="form-group">
                    <label for="editBRHzipc"><?php echo $this->lang->line("zipcode"); ?>:</label>
                    <input type="text" class="form-control" id="editBRHzipc" name="editBRHzipc" value="<?php echo json_decode($shbranch, true)['data']['BRHzipc']; ?>" onkeypress="return numberOnly(event);" required>
                </div>
                <div class="form-group">
                    <label for="editBRHvnum"><?php echo $this->lang->line("vatnumber"); ?>:</label>
                    <input type="text" class="form-control" id="editBRHvnum" name="editBRHvnum" value="<?php echo json_decode($shbranch, true)['data']['BRHvnum']; ?>" onkeypress="return numberOnly(event);" required>
                </div>
                <div class="form-group">
                    <?php
                    $sdate = json_decode($shbranch, true)['data']['BRHbday'];
                    ?>
                    <label for="editBRHbday"><?php echo $this->lang->line("establishment"); ?>:</label>
                    <!--<input type="text" class="form-control" id="BRHbday" name="BRHbday" value="12/45/3544" >-->
                    <input type="text" class="form-control sbt" id="eBRHbday" name="eBRHbday" value="<?php echo date("Y-m-d", strtotime($sdate)); ?>" readonly>
                    <div class="collapse">
                        <input type="date" class="form-control" id="editBRHbday" name="editBRHbday" min="1000-01-01" max="3000-12-31" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="editBRHemail"><?php echo $this->lang->line("email"); ?>:</label>
                    <input type="text" class="form-control" id="editBRHemail" name="editBRHemail" value="<?php echo json_decode($shbranch, true)['data']['BRHemail']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="editBRHnphone"><?php echo $this->lang->line("phonenumber"); ?>:</label>
                    <input type="text" class="form-control" id="editBRHnphone" name="editBRHnphone" value="<?php echo json_decode($shbranch, true)['data']['BRHnphone']; ?>" onkeypress="return numberOnly(event);" required>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="edit_data();"><?php echo $this->lang->line("save"); ?></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
            </div>
        </form>
        <script>
            $(document).ready(function () {
                $(".sbt").click(function () {
                    $(".collapse").collapse('toggle');
                });
            });
        </script>

        <?php
        break;
    case 'deleteBranchByID':
        ?>
        <!-- Modal body -->
        <form name="from_dbranchmanagement"enctype="multipart/form-data" id="from_branchmanagement">
            <div class="modal-body">
                <input type="hidden"  class="form-control" id="delBRHid" name="delBRHid" value="<?php echo json_decode($shbranch, true)['data']['BRHid']; ?>">
                <input type="hidden"  class="form-control" id="delPERid" name="delPERid" value="<?php echo $mysession['id']; ?>">
                <?php echo $this->lang->line("confdeletestart") . '   <b>' . json_decode($shbranch, true)['data']['BRHdesc' . $sl] . '</b>   ' . $this->lang->line("confdeleteend") ?>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="del_data();"><?php echo $this->lang->line("delete"); ?></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
            </div>
        </form>
        <?php
        break;
    case 'showCustomerByID':        
        $cus = $shcustomer[0]
        ?>
        <form name="from_ecustomerhmanagement"enctype="multipart/form-data" id="from_ecustomerhmanagement">
            <!-- Modal body -->
            <div class="modal-body">

                <div class="form-group">
                    <label for="editCUSpic"><?php echo $this->lang->line("mypic"); ?>:</label>
                </div>
                <div align="center">
                    <img src="<?php echo base_url() . 'assets/img/uploads/' . $cus['CUSpic']; ?>" class="img-thumbnail" alt="Cinque Terre" width="304" height="236" />
                </div>
                <div class="form-group" style="margin-top: 15px">
                    <input type="file" class="form-control-file border" name="editCUSpic" id="editCUSpic">
                    <input type="hidden" class="form-control" id="eCUSpic" name="eCUSpic" value="<?php echo $cus['CUSpic']; ?>" >
                </div>

                <div class="form-group">
                    <label for="editCUSidc"><?php echo $this->lang->line("idcard"); ?>:</label>
                    <input type="text"  class="form-control" id="editCUSidc" name="editCUSidc" value="<?php echo $cus['CUSidc']; ?>" onkeypress="return numberOnly(event);" required>
                </div>
                <div class="form-group">
                    <label for="editCUStitle"><?php echo $this->lang->line("titlename"); ?>:</label>
                    <select class="form-control" id="editCUStitle" name="editCUStitle" required>
                        <?php foreach ($titlename as $titlekey => $titlevalue) : ?><option value="<?php echo $titlevalue['USCcode']; ?>" <?php
                                                                                                                                        if ($dtitlename['USCcode'] == $titlevalue['USCcode']) {
                                                                                                                                            echo 'selected';
                                                                                                                                        }
                                                                                                                                        ?>>
                                        <?php echo $titlevalue['USCdesc' . $sl]; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="editCUSfname"><?php echo $this->lang->line("fristname"); ?>:</label>
                    <input type="text" class="form-control" id="editCUSfname" name="editCUSfname" value="<?php echo $cus['CUSfname']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="editCUSlname"><?php echo $this->lang->line("lastname"); ?>:</label>
                    <input type="text" class="form-control" id="editCUSlname" name="editCUSlname" value="<?php echo $cus['CUSlname']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="editCUSadr"><?php echo $this->lang->line("address"); ?>:</label>
                    <textarea class="form-control" rows="3" id="editCUSadr" name="editCUSadr" required><?php echo $cus['CUSadr']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="editCUSzipc"><?php echo $this->lang->line("zipcode"); ?>:</label>
                    <input type="text" class="form-control" id="editCUSzipc" name="editCUSzipc" value="<?php echo $cus['CUSzipc']; ?>" onkeypress="return numberOnly(event);" required>
                </div>
                <div class="form-group">
                    <label for="editCUSbday"><?php echo $this->lang->line("brithday"); ?>:</label>
                    <input type="date" class="form-control" id="editCUSbday" name="editCUSbday" min="1000-01-01" max="3000-12-31" value="<?php echo date("Y-m-d", strtotime($cus['CUSbday'])); ?>">
                </div>
                <div class="form-group">
                    <label for="editCUSemail"><?php echo $this->lang->line("email"); ?>:</label>
                    <input type="text" class="form-control" id="editCUSemail" name="editCUSemail" value="<?php echo $cus['CUSemail']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="editCUSnphone"><?php echo $this->lang->line("phonenumber"); ?>:</label>
                    <input type="text" class="form-control" id="editCUSnphone" name="editCUSnphone" value="<?php echo $cus['CUSnphone']; ?>" onkeypress="return numberOnly(event);"  required>
                </div>
                <div class="form-group">
                    <label for="editCUStype"><?php echo $this->lang->line("customomertype"); ?>:</label>
                    <select class="form-control" id="editCUStype" name="editCUStype" required>
                        <?php foreach ($custype as $custypekey => $custypevalue) : ?>
                            <option value="<?php echo $custypevalue['USCcode']; ?>" <?php
                                                                                    if ($custypevalue['USCcode'] == $custypevalue['USCcode']) {
                                                                                        echo 'selected';
                                                                                    }
                                                                                    ?>>
                                        <?php echo $custypevalue['USCdesc' . $sl]; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control" id="editCUSbrhid" name="editCUSbrhid" value="<?php echo $mysession['id']; ?>" >
                    <input type="hidden" class="form-control" id="editCUSid" name="editCUSid" value="<?php echo $cus['CUSid']; ?>" >
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="edit_data();"><?php echo $this->lang->line("save"); ?></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
                </div>

            </div>

        </form>
        <?php
        break;
    case 'deleteCustomerByID':
        ?>
        <!-- Modal body -->
        <form name="from_dcustomermanagement"enctype="multipart/form-data" id="from_branchmanagement">
            <div class="modal-body">
                <input type="hidden"  class="form-control" id="delCUSid" name="delCUSid" value="<?php echo json_decode($shcustomer, true)['data']['CUSid']; ?>">
                <input type="hidden"  class="form-control" id="delPERid" name="delPERid" value="<?php echo $mysession['id']; ?>">
                <?php echo $this->lang->line("confdeletestart") . '   <b>' . json_decode($shcustomer, true)['data']['CUSfname'] . '   ' . json_decode($shcustomer, true)['data']['CUSlname'] . '</b>   ' . $this->lang->line("confdeleteend") ?>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="del_data();"><?php echo $this->lang->line("delete"); ?></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
            </div>
        </form>
        <?php
        break;
    case 'showbyidPicture':
        $branchname = json_decode($branch, true)['data'];
        ?>
    <!-- Modal body -->
    <form name="from_epicture"enctype="multipart/form-data" id="from_epicture">
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" class="form-control" id="editPICperid" name="editPICperid" value="<?php echo $mysession['id']; ?>" >
            <input type="hidden" class="form-control" id="editPICidtab" name="editPICidtab" value="103000" >
            <input type="hidden" class="form-control" id="editPICtype" name="editPICtype" value="1" >
            <input type="hidden" class="form-control" id="editPICid" name="editPICtype" value="<?php echo $shpicture['PICid']; ?>" >
          </div>
          <div class="form-group">
            <div class="dropdown">
              <label for="editPICsid">กรุณาเลือกสาขา:</label>
              <select class="form-control" id="editPICsid" name="editPICsid">
                <?php foreach ($branchname as $branchkey => $branchvalue) : ?>
                <option value="<?php echo $branchvalue['BRHid']; ?>"
                  <?php if ($shpicture['PICsid'] == $branchvalue['BRHid']) {
                        echo 'selected';
                    } ?>
                  >
                  <?php echo $branchvalue['BRHdesc' . $sl]; ?>
                </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group">
              <label for="editPICpic">กรุณาเลือกรูปภาพ:</label>
          </div>
          <div align="center">
              <img src="<?php echo base_url() . 'assets/img/uploads/' . $shpicture['PICname'] ?>" class="img-thumbnail" alt="Cinque Terre" width="304" height="236" />
          </div>
          <div class="form-group" style="margin-top: 15px">
              <input type="file" class="form-control-file border" name="editPICpic" id="editPICpic">
              <input type="hidden" class="form-control" id="ePICpic" name="ePICpic" value="<?php echo $shpicture['PICname']; ?>" >
          </div>
          <div class="form-group">
            <label for="editPICnote">คำอธิบายรูปภาพ:</label>
            <textarea class="form-control" rows="5" id="editPICnote" name="editPICnote"><?php echo $shpicture['PICnote']; ?></textarea>
          </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-success" onclick="edit_data();"><?php echo $this->lang->line("save"); ?></button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
        </div>
    </form>
<?php
break;
case 'delbyidPicture':
    ?>
      <!-- Modal body -->
      <form name="from_dpicture"enctype="multipart/form-data" id="from_branchmanagement">
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" class="form-control" id="delPICperid" name="delPICperid" value="<?php echo $mysession['id']; ?>" >
            <input type="hidden" class="form-control" id="delPICidtab" name="delPICidtab" value="103000" >
            <input type="hidden" class="form-control" id="delPICtype" name="delPICtype" value="1" >
            <input type="hidden" class="form-control" id="delPICid" name="delPICid" value="<?php echo $shpicture['PICid']; ?>" >
          </div>
          <div align="center">
              <img src="<?php echo base_url() . 'assets/img/uploads/' . $shpicture['PICname'] ?>" class="img-thumbnail" alt="Cinque Terre" width="304" height="236" />
          </div>
          <div class="form-group">
            <label for="editPICnote">คำอธิบายรูปภาพ:</label>
            <textarea class="form-control" rows="5" id="editPICnote" name="editPICnote" readonly><?php echo $shpicture['PICnote']; ?></textarea>
          </div>

        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-success" onclick="del_data();"><?php echo $this->lang->line("save"); ?></button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
        </div>
      </form>
<?php
break;
case 'showbyidPageBooking':
    $branchname = json_decode($branch, true)['data'];
        // debug($status);
    ?>
            <!-- Modal body -->
            <form name="from_pbooking"enctype="multipart/form-data" id="from_pbooking">
              <div class="modal-body">
                <div class="form-group">
                  <input type="hidden" class="form-control" id="editPU03perid" name="editPU03perid" value="<?php echo $mysession['id']; ?>" >
                  <input type="hidden" class="form-control" id="editPU03id" name="editPU03id" value="<?php echo $shpagebooking['PU03id']; ?>" >
                  <!-- <input type="text" class="form-control" id="editPU03brhid" name="editPU03brhid" value="<?php //echo $shpagebooking['PU03brhid']; ?>" > -->
                </div>
                <div class="form-group">
                  <div class="dropdown">
                    <label for="editPU03brhid">กรุณาเลือกสาขา:</label>
                    <select class="form-control" id="editPU03brhid" name="editPU03brhid">
                      <?php foreach ($branchname as $branchkey => $branchvalue) : ?>
                      <option value="<?php echo $branchvalue['BRHid']; ?>"
                        <?php if ($shpagebooking['PU03id'] == $branchvalue['BRHid']) {
                            echo 'selected';
                        } ?>
                        >
                        <?php echo $branchvalue['BRHdesc' . $sl]; ?>
                      </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="dropdown">
                    <label for="editPU03sta">สถานะ:</label>
                    <select class="form-control" id="editPU03sta" name="editPU03sta">
                      <?php foreach ($status as $skey => $svalue) : ?>
                      <option value="<?php echo $svalue['USCcode']; ?>"
                        <?php if ($shpagebooking['PU03sta'] == $svalue['USCcode']) {
                            echo 'selected';
                        } ?>
                        >
                        <?php echo $svalue['USCdesc' . $sl]; ?>
                      </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="editPU03descTH">คำอธิบายภาษาไทย:</label>
                  <textarea class="form-control" rows="2" id="editPU03descTH" name="editPU03descTH"><?php echo $shpagebooking['PU03descTH']; ?></textarea>
                </div>
                <div class="form-group">
                  <label for="PU03descEN">คำอธิบายภาษาอังกฤษ:</label>
                  <textarea class="form-control" rows="2" id="editPU03descEN" name="editPU03descEN"><?php echo $shpagebooking['PU03descEN']; ?></textarea>
                </div>
                <div class="form-group">
                  <label for="editPU03noteTH">คำอธิบายเพิ่มเติมภาษาไทย:</label>
                  <textarea class="form-control" rows="5" id="editPU03noteTH" name="editPU03noteTH"><?php echo $shpagebooking['PU03noteTH']; ?></textarea>
                </div>
                <div class="form-group">
                  <label for="editPU03noteEN">คำอธิบายเพิ่มเติมภาษาอังกฤษ:</label>
                  <textarea class="form-control" rows="5" id="editPU03noteEN" name="editPU03noteEN"><?php echo $shpagebooking['PU03noteEN']; ?></textarea>
                </div>
              </div>
              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="edit_data();"><?php echo $this->lang->line("save"); ?></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
              </div>
            </form>

<?php
break;
case 'delbyidBookingUsePage':
    ?>
            <!-- Modal body -->
            <form name="from_dpicture"enctype="multipart/form-data" id="from_branchmanagement">
              <div class="modal-body">
                <div class="form-group">
                  <input type="text" class="form-control" id="delPU03perid" name="delPU03perid" value="<?php echo $mysession['id']; ?>" >
                  <input type="text" class="form-control" id="delPU03id" name="delPU03id" value="<?php echo $shpagebooking['PU03id']; ?>" >
                </div>
                <div align="center">
                  <?php echo $this->lang->line("confdeletestart") . '   <b>' . $shpagebooking['PU03desc' . $sl] . '   </b>' . $this->lang->line("confdeleteend") ?>
                </div>
              </div>
              <!-- Modal footer -->
              <div class="modal-footer">
                  <button type="button" class="btn btn-success" onclick="del_data();"><?php echo $this->lang->line("save"); ?></button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
              </div>
            </form>

<?php
break;

case 'sentCommentToCustomer':
          // debug($mycomment);
          // debug($mysession);
    ?>
            <!-- Modal body -->
            <form name="from_comment"enctype="multipart/form-data" id="from_comment">
              <div class="modal-body">
                <div class="form-group">
                  <input type="hidden" class="form-control" id="CMEperid" name="CMEperid" value="<?php echo $mysession['id']; ?>" >
                  <input type="hidden" class="form-control" id="CMEid" name="CMEid" value="<?php echo $mycomment['CMEid'] ?>" >
                  <input type="hidden" class="form-control" id="CMEvote" name="CMEvote" value="<?php echo $mycomment['CMEvote'] ?>" >
                  <input type="hidden" class="form-control" id="CMEcomdate" name="CMEcomdate" value="<?php echo date("Y-F-d", strtotime($mycomment['CMEcomdate'])) ?>" >
                </div>
                <div class="form-group">
                  <label for="CMEname">Name:</label>
                  <input type="text" class="form-control" id="CMEname" name="CMEname" value="<?php echo $mycomment['CMEname']; ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="CMEemail">Email:</label>
                  <input type="text" class="form-control" id="CMEemail" name="CMEemail" value="<?php echo $mycomment['CMEemail']; ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="CMEcomment">Comment:</label>
                  <textarea class="form-control" rows="3" id="CMEcomment" name="CMEcomment" readonly><?php echo $mycomment['CMEcomment']; ?></textarea>
                </div>
                <div class="form-group">
                  <label for="CMEresmessage">Reply:</label>
                  <textarea class="form-control" rows="5" id="CMEresmessage" name="CMEresmessage">Thanks for the comment.</textarea>
                </div>
              </div>
              <!-- Modal footer -->
              <div class="modal-footer">
                  <button type="button" class="btn btn-success" onclick="send_data();"><?php echo $this->lang->line("save"); ?></button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
              </div>
            </form>
<?php
break;

case 'showbyidAboutas':
    ?>
            <!-- Modal body -->
            <form name="from_eaboutas"enctype="multipart/form-data" id="from_eaboutas">
                <div class="modal-body">
                  <?php foreach ($shaboutas as $akey => $avalue) : ?>

                  <?php endforeach; ?>
                  <div class="form-group">
                    <input type="hidden" class="form-control" id="editPU01perid" name="editPU01perid" value="<?php echo $mysession['id']; ?>" >
                    <input type="hidden" class="form-control" id="editPU01id" name="editPU01id" value="<?php echo $shaboutas['PU01id']; ?>" >
                    <input type="hidden" class="form-control" id="editPICidtab" name="editPICidtab" value="980002" >
                    <input type="hidden" class="form-control" id="editPICtype" name="editPICtype" value="1" >
                    <input type="hidden" class="form-control" id="editPICid" name="editPICid" value="<?php echo $shaboutas['pic']['PICid']; ?>" >
                  </div>
                  <div class="form-group">
                    <label for="editPU01titleTH">Title TH:</label>
                    <input type="text" class="form-control" id="editPU01titleTH" name="editPU01titleTH" value="<?php echo $shaboutas['PU01titleTH']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="editPU01titleEN">Title EN:</label>
                    <input type="text" class="form-control" id="editPU01titleEN" name="editPU01titleEN" value="<?php echo $shaboutas['PU01titleEN']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="editPU01descTH">Content TH:</label>
                    <textarea class="form-control" rows="5" id="editPU01descTH" name="editPU01descTH"><?php echo $shaboutas['PU01descTH']; ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="editPU01descEN">Content EN:</label>
                    <textarea class="form-control" rows="5" id="editPU01descEN" name="editPU01descEN"><?php echo $shaboutas['PU01descEN']; ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="editPU01youtube">Link Youtube:</label>
                    <input type="text" class="form-control" id="editPU01youtube" name="editPU01youtube" value="<?php echo $shaboutas['PU01youtube']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="editPU01facebook">Link Facebook:</label>
                    <input type="text" class="form-control" id="editPU01facebook" name="editPU01facebook" value="<?php echo $shaboutas['PU01facebook']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="editPU01line">Link Line:</label>
                    <input type="text" class="form-control" id="editPU01line" name="editPU01line" value="<?php echo $shaboutas['PU01line']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="editPU01twitter">Link Twitter:</label>
                    <input type="text" class="form-control" id="editPU01twitter" name="editPU01twitter" value="<?php echo $shaboutas['PU01twitter']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="PICpic">รูปภาพ:</label>
                  </div>
                  <div align="center">
                      <img src="<?php echo base_url() . 'assets/img/uploads/' . $shaboutas['pic']['PICname'] ?>" class="img-thumbnail" alt="Cinque Terre" width="304" height="236" />
                  </div>
                  <div class="form-group" style="margin-top: 20px">
                    <input type="file" class="form-control-file border" name="editPICpic" id="editPICpic">
                    <input type="hidden" class="form-control" id="ePICpic" name="ePICpic" value="<?php echo $shaboutas['pic']['PICname']; ?>" >
                  </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="edit_data();"><?php echo $this->lang->line("save"); ?></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
                </div>
            </form>
<?php
break;

case 'delbyidAboutas':
    ?>
              <!-- Modal body -->
              <form name="from_dpicture"enctype="multipart/form-data" id="from_branchmanagement">
                <div class="modal-body">
                  <div class="form-group">
                    <input type="hidden" class="form-control" id="delPICperid" name="delPICperid" value="<?php echo $mysession['id']; ?>" >
                    <input type="hidden" class="form-control" id="delPU01id" name="delPU01id" value="<?php echo $shaboutas['PU01id']; ?>" >
                    <input type="hidden" class="form-control" id="delPICid" name="delPICid" value="<?php echo $shaboutas['pic']['PICid']; ?>" >
                    <?php echo $this->lang->line("confdeletestart") . '   <b>' . $shaboutas['PU01title' . $sl] . '</b>  ' . $this->lang->line("confdeleteend") ?>
                  </div>

                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="del_data();"><?php echo $this->lang->line("save"); ?></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
                </div>
              </form>
<?php
break;

case 'showGroupByImg':
    ?>

                  <?php if (count($sbbyimg) > 0) : ?>
                    <div class="row" style="margin-top:20px">
                      <div class="col-sm-12">
                        <div class="card border border-danger">
                          <div class="card-body">
                            <label for="PICsid"><?php echo $this->lang->line("pleaseselectgroup"); ?></label>
                            <div class="row">
                              <?php foreach ($sbbyimg as $sbkey => $sbvalue) : ?>
                              <div class="col col-sm-4">
                                <div class="form-check-inline">
                                  <label class="form-check-label" for="PICsid">
                                    <input type="radio" class="form-check-input" id="PICsid" name="PICsid" value="<?php echo $sbvalue['PU04id']; ?>"><?php echo $sbvalue['PU04descTH']; ?>
                                  </label>
                                </div>
                              </div>
                              <?php endforeach; ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-12" style="margin-top:20px">
                        <div class="form-group">
                          <label for="PICpic"><?php echo $this->lang->line("mypic"); ?>:</label>
                          <input type="file" class="form-control-file border" name="PICpic" id="PICpic">
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label for="PICnote"><?php echo $this->lang->line("note"); ?>:</label>
                          <textarea class="form-control" rows="5" id="PICnote" name="PICnote"></textarea>
                        </div>
                      </div>
                    </div>
                  <?php else : ?>
                    <div class="col-sm-12" style="margin-top:20px">
                      <div class="form-group">
                        <label ><?php echo $this->lang->line("pleaseaddgroup"); ?></label>
                      </div>
                    </div>
                  <?php endif; ?>

<?php
break;

case 'delbyidGallery':
    $shgallery = $shgallery[0];
    ?>
                    <!-- Modal body -->
                    <form name="from_dpicture"enctype="multipart/form-data" id="from_branchmanagement">
                      <div class="modal-body">
                        <div class="form-group">
                          <input type="hidden" class="form-control" id="delPU04perid" name="delPU04perid" value="<?php echo $mysession['id']; ?>" >
                          <input type="hidden" class="form-control" id="delPU04idtab" name="delPU04idtab" value="980003" >
                          <input type="hidden" class="form-control" id="delPU04type" name="delPU04type" value="1" >
                          <input type="hidden" class="form-control" id="delPU04id" name="delPU04id" value="<?php echo $shgallery['PU04id']; ?>" >
                        </div>
                        <div align="center">
                          <?php echo $this->lang->line("confdeletestart") . '   <b>' . $shgallery['PU04desc' . $sl] . '   </b>' . $this->lang->line("confdeleteend") ?>
                        </div>

                      </div>
                      <!-- Modal footer -->
                      <div class="modal-footer">
                          <button type="button" class="btn btn-success" onclick="del_data();"><?php echo $this->lang->line("save"); ?></button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
                      </div>
                    </form>
                    <?php
                    break;

                case 'showbyidGallery':
                    $shgallery = $shgallery[0];
                    ?>
                    <!-- Modal body -->
                    <form name="from_dgallery"enctype="multipart/form-data" id="from_dgallery">
                      <div class="modal-body">
                        <div class="form-group">
                          <input type="hidden" class="form-control" id="editPU04perid" name="editPU04perid" value="<?php echo $mysession['id']; ?>" >
                          <input type="hidden" class="form-control" id="editPU04idtab" name="editPU04idtab" value="980003" >
                          <input type="hidden" class="form-control" id="editPU04type" name="editPU04type" value="1" >
                          <input type="hidden" class="form-control" id="editPU04id" name="editPU04id" value="<?php echo $shgallery['PU04id']; ?>" >
                        </div>
                        <div class="form-group">
                          <label for="editPU04descTH">ชื่อกลุ่ม TH :</label>
                          <input type="text" class="form-control" id="editPU04descTH" name="editPU04descTH" value="<?php echo $shgallery['PU04descTH']; ?>">
                        </div>
                        <div class="form-group">
                          <label for="editPU04descEN">ชื่อกลุ่ม EN :</label>
                          <input type="text" class="form-control" id="editPU04descEN" name="editPU04descEN" value="<?php echo $shgallery['PU04descEN']; ?>">
                        </div>
                        <div class="form-group">
                          <label for="editPU04note">คำอธิบายกลุ่ม:</label>
                          <textarea class="form-control" rows="5" id="editPU04note" name="editPU04note"><?php echo $shgallery['PU04note']; ?></textarea>
                        </div>
                      </div>

                      </div>
                      <!-- Modal footer -->
                      <div class="modal-footer">
                          <button type="button" class="btn btn-success" onclick="edit_data();"><?php echo $this->lang->line("save"); ?></button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
                      </div>
                    </form>
<?php
break;

case 'showDeletegroupgallery':
    ?>
                      <!-- Modal body -->
                      <form name="from_dpicture"enctype="multipart/form-data" id="from_branchmanagement">
                        <?php foreach ($shgallery as $key => $value) : ?>
                        <div class="modal-body">
                          <div class="form-group">
                            <input type="hidden" class="form-control" id="gdelPU04perid" name="gdelPU04perid" value="<?php echo $mysession['id']; ?>" >
                            <input type="hidden" class="form-control" id="gdelPU04idtab" name="gdelPU04idtab" value="980003" >
                            <input type="hidden" class="form-control" id="gdelPU04type" name="gdelPU04type" value="1" >
                            <input type="hidden" class="form-control" id="gdelPU04id" name="gdelPU04id" value="<?php echo $value['PU04id']; ?>" >
                          </div>
                          <div align="center">
                            <?php echo $this->lang->line("confdeletestart") . '   <b>' . $value['PU04desc' . $sl] . '   </b>' . $this->lang->line("confdeleteend") ?>
                          </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" onclick="del_gdata();"><?php echo $this->lang->line("save"); ?></button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
                        </div>
                        <?php endforeach; ?>
                      </form>
<?php
break;

case 'delbyidPromotions':
    ?>
                        <!-- Modal body -->
                        <form name="from_dpicture"enctype="multipart/form-data" id="from_branchmanagement">
                          <div class="modal-body">
                            <div class="form-group">
                              <input type="hidden" class="form-control" id="delPOMperid" name="delPOMperid" value="<?php echo $mysession['id']; ?>" >
                              <input type="hidden" class="form-control" id="delPOMid" name="delPOMid" value="<?php echo $promotionbid['POMid'] ?>" >
                              <?php echo $this->lang->line("confdeletestart") . '   <b>' . $promotionbid['POMdesc' . $sl] . '</b>  ' . $this->lang->line("confdeleteend") ?>
                            </div>

                          </div>
                          <!-- Modal footer -->
                          <div class="modal-footer">
                              <button type="button" class="btn btn-success" onclick="del_data();"><?php echo $this->lang->line("save"); ?></button>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
                          </div>
                        </form>
<?php
break;

case 'showbyidPromotions':
    ?>
                        <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> -->
                        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
                        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
                        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

                         <!-- Modal body -->
                          <form name="from_epromotion"enctype="multipart/form-data" id="from_epromotion">
                            <div class="modal-body">
                              <div class="form-group">
                                <label for="sel1"><?php echo $this->lang->line("promotionsstartdate") . ' - ' . $this->lang->line("promotionsenddate"); ?>:  <font color="red">**กรุณาตั้งเวลาใหม่</font></label>
                                <input class="form-control" type="text" id="edateranges" name="edateranges"  />
                                <input type="hidden" class="form-control" id="ePOMid" name="ePOMid" value="<?php echo $epromotion[0]['POMid'] ?>">
                                <input type="hidden" class="form-control" id="ePERid" name="ePERid" value="<?php echo $mysession['id'] ?>">
                              </div>
                              <div class="form-group">
                                <label for="POMdescTH"><?php echo $this->lang->line("promotionsdescriptionTH"); ?>:</label>
                                <input type="text" class="form-control" id="ePOMdescTH" name="ePOMdescTH" value="<?php echo $epromotion[0]['POMdescTH'] ?>">
                              </div>
                              <div class="form-group">
                                <label for="POMdescEN"><?php echo $this->lang->line("promotionsdescriptionEN"); ?>:</label>
                                <input type="text" class="form-control" id="ePOMdescEN" name="ePOMdescEN" value="<?php echo $epromotion[0]['POMdescEN'] ?>">
                              </div>
                              <div class="form-group">
                                <label for="POMpcode"><?php echo $this->lang->line("promotioncode"); ?>:</label>
                                <input type="text" class="form-control" id="ePOMpcode" name="ePOMpcode" value="<?php echo $epromotion[0]['POMpcode'] ?>">
                              </div>
                              <div class="form-group">
                                <label for="POMlink"><?php echo $this->lang->line("promotionslink"); ?>:</label>
                                <input type="text" class="form-control" id="ePOMlink" name="ePOMlink" value="<?php echo $epromotion[0]['POMlink'] ?>">
                              </div>
                              <div class="form-group">
                                <label for="POMdis"><?php echo $this->lang->line("promotionsdiscount"); ?>:</label>
                                <input type="text" class="form-control" id="ePOMdis" name="ePOMdis" value="<?php echo number_format($epromotion[0]['POMdis'], 2, '.', '') ?>">
                              </div>
                              <div class="row">
                                <?php foreach ($branch as $bkey => $bvalue) : ?>
                                <div class="col col-sm-6">
                                  <div class="form-check-inline">
                                    <label class="form-check-label" for="echkbrh">
                                      <input type="checkbox" class="form-check-input egvalue" id="echkbrh" name="echkbrh" value="<?php echo $bvalue['BRHid']; ?>" <?php if (isset($epromotion[0]['branchName'])) : foreach ($epromotion[0]['branchName'] as $bk => $bv) : if ($bvalue['BRHid'] == $bv['BRHid']) {
                                                                                                                                                                        echo "checked";
                                                                                                                                                                    }
                                                                                                                                                                    endforeach;
                                                                                                                                                                    endif; ?> ><?php echo $bvalue['BRHdesc' . $sl] ?>                                      
                                    </label>
                                  </div>
                                </div>                                
                                <?php endforeach; ?>
                              </div>
                              
                            </div>

                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" onclick="edit_data();"><?php echo $this->lang->line("save"); ?></button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
                            </div>
                          </form>

                          <script>
                            $(function() {
                              $('input[name="edateranges"]').daterangepicker({
                                opens: 'left',
                                // "startDate": "12/04/2018",
                                // "endDate": "12/20/2018",
                                "minDate": new Date()
                                // minDate: new Date()
                              }, function(start, end, label) {
                                // console.log('111');
                                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                              });
                            });
                          </script>
<?php
break;
case 'filterDepartment':
    // debug($position);
    ?>
      <select class="form-control" id="PERlevel" name="PERlevel">
      <?php 
        if (isset($position)) :
            foreach ($position as $pkey => $pvalue) :
        ?>
      <option value="<?php echo $pvalue['DPOid']; ?>"><?php echo $pvalue['DPOdesc' . $sl]; ?></option>      
      <?php 
        endforeach;
        endif;
        ?>
      </select>
<?php
break;
case 'showbyidPersonnel':
    ?>
        <form name="from_epersonnel"enctype="multipart/form-data" id="from_epersonnel">
                  
        <!-- Modal body -->
        <div class="modal-body">
            <div class="form-group">
                <label for="ePERidc"><?php echo $this->lang->line("idcard"); ?>:</label>
                <input type="text" class="form-control" id="ePERidc" name="ePERidc" value="<?php echo ($per[0]['PERidc']); ?>">
            </div>
            <div class="form-group">
                <label for="ePERtitle"><?php echo $this->lang->line("titlename"); ?>:</label>                        
                <select class="form-control" id="ePERtitle" name="ePERtitle">
                    <?php 
                    if (isset($titlename)) :
                        foreach ($titlename as $tkey => $tvalue) :
                    ?>
                    <option value="<?php echo $tvalue['USCcode']; ?>" <?php if ($tvalue['USCcode'] == $per[0]['PERbrhid']) {
                                                                            echo ("selected");
                                                                        } ?>><?php echo $tvalue['USCdesc' . $sl]; ?></option>
                    <?php 
                    endforeach;
                    endif;
                    ?>
                </select>                    
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="ePERfname"><?php echo $this->lang->line("fristname"); ?>:</label>
                        <input type="text" class="form-control" id="ePERfname" name="ePERfname" value="<?php echo ($per[0]['PERfname']); ?>">
                    </div>
                    <div class="col-sm-6">
                        <label for="ePERlname"><?php echo $this->lang->line("lastname"); ?>:</label>
                        <input type="text" class="form-control" id="ePERlname" name="ePERlname" value="<?php echo ($per[0]['PERlname']); ?>">  
                    </div>
                </div>                        
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="ePERdepid"><?php echo $this->lang->line("department"); ?>:</label>
                        <select class="form-control" id="ePERdepid" name="ePERdepid" onchange="selectbydepartment(this.value)">
                        <option hidden></option>
                        <?php 
                        if (isset($department)) :
                            foreach ($department as $dkey => $dvalue) :
                        ?>
                            <option value="<?php echo $dvalue['DEPid']; ?>" <?php if ($dvalue['DEPid'] == $per[0]['PERdepid']) {
                                                                                echo ("selected");
                                                                            } ?> ><?php echo $dvalue['DEPdesc' . $sl]; ?></option>
                        <?php 
                        endforeach;
                        endif;
                        ?>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="PERlevel"><?php echo $this->lang->line("position"); ?>:</label>
                        <div id="xmyDIV">
                            <select class="form-control" id="PERlevel" name="PERlevel">
                            <option value="<?php echo ($per[0]['PERlevel']); ?>" ><?php echo ($per[0]['position']['DPOdesc' . $sl]); ?></option>
                            </select>
                        </div>
                        <div class="xbydepartment" id="xbydepartment"></div>
                    </div>
                </div>                        
            </div>
            <div class="form-group">
                <label for="ePERadr"><?php echo $this->lang->line("address"); ?>:</label>
                <textarea class="form-control" rows="3" id="ePERadr" name="ePERadr"><?php echo ($per[0]['PERadr']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="ePERbday"><?php echo $this->lang->line("brithday"); ?>:</label>
                <input class="form-control" type="date" value="<?php echo date("Y-m-d", strtotime($per[0]['PERbday'])); ?>" id="ePERbday" name="ePERbday" >
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="ePERemail"><?php echo $this->lang->line("email"); ?>:</label>
                        <input type="text" class="form-control" id="ePERemail" name="ePERemail" value="<?php echo ($per[0]['PERemail']); ?>">
                    </div>
                    <div class="col-sm-6">
                        <label for="ePERnphone"><?php echo $this->lang->line("phonenumber"); ?>:</label>
                        <input type="text" class="form-control" id="ePERnphone" name="ePERnphone" value="<?php echo ($per[0]['PERnphone']); ?>">  
                    </div>
                </div>                          
            </div>
            <div class="form-group">
                <label for="ePERbrhid"><?php echo $this->lang->line("branchname"); ?>:</label>
                <select class="form-control" id="ePERbrhid" name="ePERbrhid">
                    <?php 
                    if (isset($branch)) :
                        foreach ($branch as $bkey => $bvalue) :
                    ?>
                            <option value="<?php echo $bvalue['BRHid']; ?>" <?php if ($bvalue['BRHid'] == $per[0]['PERbrhid']) {
                                                                                echo ("selected");
                                                                            } ?> ><?php echo $bvalue['BRHdesc' . $sl]; ?></option>
                        <?php 
                        endforeach;
                        endif;
                        ?>
                </select>
                <input type="hidden" class="form-control" id="ePERses" name="ePERses" value="<?php echo ($mysession['id']); ?>">
                <input type="hidden" class="form-control" id="ePERid" name="ePERid" value="<?php echo ($per[0]['PERid']); ?>">
            </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-success" onclick="edit_data();"><?php echo $this->lang->line("save"); ?></button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
        </div>
    </form>
<?php
break;

case 'delbyidPersonnel':
    ?>
        <!-- Modal body -->
        <form name="from_dpicture"enctype="multipart/form-data" id="from_branchmanagement">
            <div class="modal-body">
            <div class="form-group">
                <input type="hidden" class="form-control" id="delPERperid" name="delPERperid" value="<?php echo $mysession['id']; ?>" >
                <input type="hidden" class="form-control" id="delPERid" name="delPERid" value="<?php echo $personnel[0]['PERid'] ?>" >
                <?php echo $this->lang->line("confdeletestart") . '   <b>' . $personnel[0]['PERfname'] . '  ' . $personnel[0]['PERlname'] . '</b>  ' . $this->lang->line("confdeleteend") ?>
            </div>

            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="del_data();"><?php echo $this->lang->line("save"); ?></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
            </div>
        </form>
<?php
break;
case 'getAccessories':
    ?>
        <!-- <div class="form-group"> -->
        <label for="usr">Example: <b>R001V</b></label>
        <!-- </div> -->
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="ROMstart"><?php echo $this->lang->line("strstrat"); ?>:</label>
                    <input type="text" class="form-control" placeholder="R" id="ROMstart" name="ROMstart">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="ROMnum"><?php echo $this->lang->line("nostrat"); ?>:</label>
                    <input type="text" class="form-control" placeholder="001" placeholder="R" id="ROMnum" name="ROMnum">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="ROMend"><?php echo $this->lang->line("strend"); ?>:</label>
                    <input type="text" class="form-control" placeholder="V" id="ROMend" name="ROMend">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="ROMcount"><?php echo $this->lang->line("roomamount"); ?>:</label>
                    <input type="text" class="form-control" id="ROMcount" name="ROMcount">
                </div>
            </div>                        
        </div>
        <div class="form-group">
            <label for="ROMdescTH"><?php echo $this->lang->line("roomnameth"); ?>:</label>
            <input type="text" class="form-control" id="ROMdescTH" name="ROMdescTH">
        </div>
        <div class="form-group">
            <label for="ROMdescEN"><?php echo $this->lang->line("roomnameen"); ?>:</label>
            <input type="text" class="form-control" id="ROMdescEN" name="ROMdescEN">
        </div>
        <div class="form-group">
            <label for="ROMnature"><?php echo $this->lang->line("roomnature"); ?>:</label>
            <select class="form-control" id="ROMnature" name="ROMnature">
                <?php 
                if (isset($nature)) :
                    foreach ($nature as $nkey => $nvalue) :
                ?>
                <option value="<?php echo $nvalue['USCcode']; ?>"><?php echo $nvalue['USCdesc' . $sl]; ?></option>
                <?php 
                endforeach;
                endif;
                ?>
            </select>
        </div>
        <hr>
        <label for="sel1"><?php echo $this->lang->line("roomtype"); ?>:</label>
        <div class="row" >
        <?php foreach ($rtype as $tkey => $tvalue) : ?>
            <div class="col-sm-6" >
            <div class="form-check-inline">
                <label class="form-check-label" for="chktype">
                <input type="checkbox" class="form-check-input gvalue1" id="chktype" name="chktype" value="<?php echo $tvalue['USCcode']; ?>" ><?php echo $tvalue['USCdesc' . $sl] ?>
                </label>
            </div>
            </div>
        <?php endforeach; ?>
        </div>   
        <hr>                    
        <label for="sel1"><?php echo $this->lang->line("roomdetails"); ?>:</label>
        <div class="row" >
        <?php foreach ($access as $akey => $avalue) : ?>
            <div class="col-sm-6" >
            <div class="form-check-inline">
                <label class="form-check-label" for="chkaccess">
                <input type="checkbox" class="form-check-input gvalue2" id="chkaccess" name="chkaccess" value="<?php echo $avalue['RASid']; ?>" ><?php echo $avalue['RASdesc' . $sl] ?>
                </label>
            </div>
            </div>
        <?php endforeach; ?>
        </div>
        <hr> 
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="ROMlimit"><?php echo $this->lang->line("numberofusers"); ?>:</label>
                    <input type="text" class="form-control" id="ROMlimit" name="ROMlimit">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="ROMpice"><?php echo $this->lang->line("price"); ?>:</label>
                    <input type="text" class="form-control" id="ROMpice" name="ROMpice">
                </div>
            </div>
        </div>
    <!-- </div> -->

    <!-- Modal footer -->
    <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="save_data();"><?php echo $this->lang->line("save"); ?></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
    </div>
<?php 
break;
case 'showbyidRooms':
    ?>
            <form name="from_eroom"enctype="multipart/form-data" id="from_eroom">
            <!-- Modal body -->
            <div class="modal-body">
            <?php //  debug($access); ?>
                <div class="form-group">
                    <input type="hidden" class="form-control" id="eROMid" name="eROMid" value="<?php echo $room[0]['ROMid']; ?>">
                    <input type="hidden" class="form-control" id="eROMcreatedBy" name="eROMcreatedBy" value="<?php echo $mysession['id'] ?>">
                    <label for="eROMbrhid">สาขา:</label>                        
                    <select class="form-control" id="eROMbrhid" name="eROMbrhid" onchange="getAccessories(this.value);">
                        <!-- <option value="909090" hidden></option> -->
                        <?php 
                        if (isset($branch)) :
                            foreach ($branch as $bkey => $bvalue) :
                        ?>
                        <option value="<?php echo $bvalue['BRHid']; ?>" <?php if ($bvalue['BRHid'] == $room[0]['ROMbrhid']) {
                                                                            echo ("selected");
                                                                        } ?> ><?php echo ($bvalue['BRHdesc' . $sl]); ?></option>
                        <?php 
                        endforeach;
                        endif;
                        ?>
                    </select>                    
                </div>          
                <div class="form-group">
                    <label for="eROMnum"><?php echo $this->lang->line("roomno"); ?>:</label>
                    <input type="text" class="form-control" id="eROMnum" name="eROMnum" value="<?php echo $room[0]['ROMno'] ?>">
                </div>
                <div class="form-group">
                    <label for="eROMdescTH"><?php echo $this->lang->line("roomnameth"); ?>:</label>
                    <input type="text" class="form-control" id="eROMdescTH" name="eROMdescTH" value="<?php echo $room[0]['ROMdescTH'] ?>">
                </div>
                <div class="form-group">
                    <label for="eROMdescEN"><?php echo $this->lang->line("roomnameen"); ?>:</label>
                    <input type="text" class="form-control" id="eROMdescEN" name="eROMdescEN" value="<?php echo $room[0]['ROMdescEN'] ?>">
                </div>
                <?php 
                if (isset($nature)) :
                ?>
                <div class="form-group">
                    <label for="eROMnature"><?php echo $this->lang->line("roomnature"); ?>:</label>
                    <select class="form-control" id="eROMnature" name="eROMnature" >
                        <?php foreach ($nature as $nkey => $nvalue) : ?>
                        <option value="<?php echo $nvalue['USCcode']; ?>" <?php if ($nvalue['USCcode'] == $room[0]['ROMnature']) {
                                                                                echo ("selected");
                                                                            } ?>><?php echo $nvalue['USCdesc' . $sl]; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <?php endif; ?>
                <hr>
                <label for="sel1"><?php echo $this->lang->line("roomtype"); ?>:</label>
                <div class="row" >
                <?php foreach ($rtype as $tkey => $tvalue) : ?>
                    <div class="col-sm-6" >
                        <div class="form-check-inline">
                            <label class="form-check-label" for="echktype">
                            <input type="checkbox" class="form-check-input gvalue" id="echktype" name="echktype" value="<?php echo $tvalue['USCcode']; ?>" <?php if (isset($room[0]['type'])) : foreach ($room[0]['type'] as $rk => $rv) : if ($tvalue['USCcode'] == $rv['USCcode']) {
                                                                                                                                                                echo "checked";
                                                                                                                                                            }
                                                                                                                                                            endforeach;
                                                                                                                                                            endif; ?> ><?php echo $tvalue['USCdesc' . $sl] ?>
                            </label>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>   
                <hr>
                <?php // if(isset($access)): ?>     
                <label for="sel1"><?php echo $this->lang->line("roomdetails"); ?>:</label>
                <div class="row" >
                <?php foreach ($access as $akey => $avalue) : ?>
                    <div class="col-sm-6" >
                    <div class="form-check-inline">
                        <label class="form-check-label" for="echkaccess">
                            <input type="checkbox" class="form-check-input gvalue" id="echkaccess" name="echkaccess" value="<?php echo $avalue['RASid']; ?>" <?php if (isset($room[0]['accessories'])) : foreach ($room[0]['accessories'] as $ak => $av) : if ($avalue['RASid'] == $av['RASid']) {
                                                                                                                                                                echo "checked";
                                                                                                                                                            }
                                                                                                                                                            endforeach;
                                                                                                                                                            endif; ?>><?php echo $avalue['RASdesc' . $sl] ?>
                        </label>
                    </div>
                    </div>
                <?php endforeach; ?>
                </div>
                <hr> 
                <?php // endif; ?>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="eROMlimit"><?php echo $this->lang->line("numberofusers"); ?>:</label>
                            <input type="text" class="form-control" id="eROMlimit" name="eROMlimit" value="<?php echo $room[0]['ROMlimit'] ?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="eROMpice"><?php echo $this->lang->line("price"); ?>:</label>
                            <input type="text" class="form-control" id="eROMpice" name="eROMpice" value="<?php echo number_format($room[0]['ROMpice'], 2, '.', ''); ?>">
                        </div>
                    </div>
                </div>
            </div>
            

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="edit_data();"><?php echo $this->lang->line("save"); ?></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
            </div>
            </form>
<?php
break;
case 'delbyidRoom':
    ?>
            <!-- Modal body -->
            <form name="from_droom"enctype="multipart/form-data" id="from_droom">
                <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" class="form-control" id="delROMperid" name="delROMperid" value="<?php echo $mysession['id']; ?>" >
                    <input type="hidden" class="form-control" id="delROMid" name="delROMid" value="<?php echo $room[0]['ROMid'] ?>" >
                    <?php echo $this->lang->line("confdeletestart") . '   <b>' . $room[0]['ROMno'] . '  ' . $room[0]['ROMdesc' . $sl] . '</b>  ' . $this->lang->line("confdeleteend") ?>
                </div>

                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="del_data();"><?php echo $this->lang->line("save"); ?></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
                </div>
            </form>
<?php
break;

case 'delbyidAccessories':
    ?>
            <!-- Modal body -->
            <form name="from_accessories"enctype="multipart/form-data" id="from_accessories">
                <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" class="form-control" id="delRASperid" name="delRASperid" value="<?php echo $mysession['id']; ?>" >
                    <input type="hidden" class="form-control" id="delRASid" name="delRASid" value="<?php echo $access[0]['RASid'] ?>" >
                    <?php echo $this->lang->line("confdeletestart") . '   <b>' . $access[0]['RASdesc' . $sl] . '</b>  ' . $this->lang->line("confdeleteend") ?>
                </div>

                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="del_data();"><?php echo $this->lang->line("save"); ?></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
                </div>
            </form>
<?php
break;

case 'showbyidAccessories':
    ?>
            <form name="from_eaccessories"enctype="multipart/form-data" id="from_eaccessories">
                           
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="eRASbrhid"><?php echo $this->lang->line("branchname"); ?>:</label>
                        <input type="hidden" class="form-control" id="eRASid" name="eRASid" value="<?php echo $access[0]['RASid']; ?>">
                        <select class="form-control" id="eRASbrhid" name="eRASbrhid">
                            <?php 
                            if (isset($branch)) :
                                foreach ($branch as $bkey => $bvalue) :
                            ?>
                                    <option value="<?php echo $bvalue['BRHid']; ?>" <?php if ($bvalue['BRHid'] == $access[0]['RASbrhid']) {
                                                                                        echo ("selected");
                                                                                    } ?> ><?php echo $bvalue['BRHdesc' . $sl]; ?></option>
                                <?php 
                                endforeach;
                                endif;
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="eRASdescTH"><?php echo $this->lang->line("devicenameth"); ?>:</label>
                        <input type="text" class="form-control" id="eRASdescTH" name="eRASdescTH" value="<?php echo $access[0]['RASdescTH'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="eRASdescEN"><?php echo $this->lang->line("devicenameen"); ?>:</label>
                        <input type="text" class="form-control" id="eRASdescEN" name="eRASdescEN" value="<?php echo $access[0]['RASdescEN'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="eRASquan"><?php echo $this->lang->line("quantity"); ?>:</label>
                        <input type="text" class="form-control" id="eRASquan" name="eRASquan" value="<?php echo number_format($access[0]['RASquan'], 2, '.', ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="eRASprice"><?php echo $this->lang->line("priceunit"); ?>:</label>
                        <input type="text" class="form-control" id="eRASprice" name="eRASprice" value="<?php echo number_format($access[0]['RASprice'], 2, '.', ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="eRASwar"><?php echo $this->lang->line("branchname"); ?>:</label>
                        <select class="form-control" id="eRASwar" name="eRASwar">
                            <?php 
                            if (isset($branch)) :
                                foreach ($warranty as $wkey => $wvalue) :
                            ?>
                                <option value="<?php echo $wvalue['USCcode']; ?>" <?php if ($wvalue['USCcode'] == $access[0]['RASwar']) {
                                                                                        echo ("selected");
                                                                                    } ?>><?php echo $wvalue['USCdesc' . $sl]; ?></option>
                            <?php 
                            endforeach;
                            endif;
                            ?>
                        </select>                        
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="edit_data();"><?php echo $this->lang->line("save"); ?></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
                </div>
            </form>
<?php
break;
case 'getRoomByCustomer':
    // debug($croom);
?>
            <div class="container" >
                <input type="hidden" class="form-control" id="sta0BOKid" name="sta0BOKid" value="<?php echo $croom[0]['BOKid'] ?>">
                <input type="hidden" class="form-control" id="sta0BOKfrom" name="sta0BOKfrom" value="<?php echo $croom[0]['BOKfrom'] ?>">
                <input type="hidden" class="form-control" id="sta0BOKpomid" name="sta0BOKpomid" value="<?php echo $croom[0]['BOKpomid'] ?>">
                <input type="hidden" class="form-control" id="sta0BOKromid" name="sta0BOKromid" value="<?php echo $croom[0]['BOKromid'] ?>">
                <input type="hidden" class="form-control" id="sta0BOKcusid" name="sta0BOKcusid" value="<?php echo $croom[0]['BOKcusid'] ?>">
                <input type="hidden" class="form-control" id="sta0BOKbrhid" name="sta0BOKbrhid" value="<?php echo $croom[0]['BOKbrhid'] ?>">                
                <input type="hidden" class="form-control" id="sta0BOKstartDT" name="sta0BOKstartDT" value="<?php echo $croom[0]['BOKstartDT'] ?>">
                <input type="hidden" class="form-control" id="sta0BOKendDT" name="sta0BOKendDT" value="<?php echo $croom[0]['BOKendDT'] ?>">
                <input type="hidden" class="form-control" id="sta0PERid" name="sta0PERid" value="<?php echo $mysession['id'] ?>"> 
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="ROMno" style="color:#ffffff">หมายเลขห้อง:  <?php // echo $croom[0]['Room'][0]['ROMno'] ?></label>
                            <label for="ROMno" style="color:#ffffff"><?php echo $croom[0]['Room'][0]['ROMno'] ?></label>
                            <!-- <input type="text" class="form-control" id="ROMno" name="ROMno" value="<?php // echo $croom[0]['Room'][0]['ROMno'] ?>" readonly>                                 -->
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="ROMdesc" style="color:#ffffff">ชื่อห้อง:  <?php // echo $croom[0]['Room'][0]['ROMdesc' . $sl] ?></label>
                            <label for="ROMdesc" style="color:#ffffff"><?php echo $croom[0]['Room'][0]['ROMdesc' . $sl] ?></label>
                            <!-- <input type="text" class="form-control" id="ROMdesc" name="ROMdesc" value="<?php //  echo $croom[0]['Room'][0]['ROMdesc' . $sl] ?>" readonly> -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="ROMlimit" style="color:#ffffff">จำนวนผู้เข้าพักสูงสุด:  <?php // echo $croom[0]['Room'][0]['ROMlimit'] ?></label>
                            <label for="ROMlimit" style="color:#ffffff"><?php echo $croom[0]['Room'][0]['ROMlimit'] . '  ท่าน'?></label>
                            <!-- <input type="text" class="form-control" id="ROMlimit" name="ROMlimit" value="<?php //  echo $croom[0]['Room'][0]['ROMlimit'] ?>" readonly> -->
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="ROMpice" style="color:#ffffff">ราคาห้อง:  <?php // echo number_format($croom[0]['Room'][0]['ROMpice'], 2, '.', '');  ?></label>
                            <label for="ROMpice" style="color:#ffffff"><?php echo number_format($croom[0]['Room'][0]['ROMpice'], 2, '.', '') . ' บาท';  ?></label>
                            <!-- <input type="text" class="form-control" id="ROMpice" name="ROMpice" value="<?php //  echo number_format($croom[0]['Room'][0]['ROMpice'], 2, '.', '');  ?>" readonly> -->
                        </div>
                    </div>
                </div>
                <hr style="border: 1px solid #ffffff; margin-top: -10px">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group" style="margin-left: auto; margin-right: auto; text-align: center;">
                            <label for="BOKnote" style="color:#ff3333; font-size: 20px;">วันที่จอง:  <?php echo date("Y-m-d",strtotime($croom[0]['BOKstartDT'])) . ' ถึง ' . date("Y-m-d",strtotime($croom[0]['BOKendDT'])) ?></label>
                        </div>
                    </div>
                </div>
                <hr style="border: 1px solid #ffffff; margin-top: -10px">
                <div class="row" style="margin-top: -15px">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="sta0BOKsta" style="color:#ffffff">สถานะการจอง:</label>
                            <select class="form-control" id="sta0BOKsta" name="sta0BOKsta">
                                <?php
                                if(isset($bookingstatus)):
                                    foreach($bookingstatus as $skey => $svalue):
                                        if($svalue['USCcode'] == 1 || $svalue['USCcode'] == 4):
                                ?>
                                <option value="<?php echo $svalue['USCcode'] ?>"><?php echo $svalue['USCdesc'.$sl] ?></option>
                                <?php
                                        endif;
                                    endforeach;
                                endif;
                                ?>
                            </select>
                        </div>
                    <div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="sta0BOKnote" style="color:#ffffff">Comment:</label>
                            <textarea class="form-control" rows="2" id="sta0BOKnote" name="sta0BOKnote"><?php echo $croom[0]['BOKnote'] ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-primary btn-block" onclick="savebookingsta0()">Booking</button>
                    </div>
                </div>
                <hr style="border: 1px solid #ffffff; margin-top: 10px">
                <div class="row" style="margin-top: -15px">
                    <div class="col-sm-4">
                        <label for="ROMlimit" style="color:#ffffff">คุณ:</label>
                    </div>
                    <div class="col-sm-8">
                        <label for="ROMlimit" style="color:#ffffff"><?php echo $croom[0]['Customer']['CUSfname'] . '  ' . $croom[0]['Customer']['CUSlname'] ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="ROMlimit" style="color:#ffffff">ที่อยู่:</label>
                    </div>
                    <div class="col-sm-8">
                        <label for="ROMlimit" style="color:#ffffff"><?php echo $croom[0]['Customer']['CUSadr'] . '  ' . $croom[0]['Customer']['CUSzipc'] ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="ROMlimit" style="color:#ffffff">Email:</label>
                    </div>
                    <div class="col-sm-8">
                        <label for="ROMlimit" style="color:#ffffff"><?php echo $croom[0]['Customer']['CUSemail'] ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="ROMlimit" style="color:#ffffff">เบอร์โทรศัพ:</label>
                    </div>
                    <div class="col-sm-8">
                        <label for="ROMlimit" style="color:#ffffff"><?php echo $croom[0]['Customer']['CUSnphone'] ?></label>
                    </div>
                </div>
            </div>
<?php
    break;
case 'getRoomByID':
            // debug($mysession);
    ?>
                <div class="container" style="margin-top:10px"> 
                    <input type="hidden" class="form-control" id="ROMid" name="ROMid" value="<?php echo $room[0]['ROMid'] ?>">
                    <input type="hidden" class="form-control" id="BRHid" name="BRHid" value="<?php echo $mysession['brhid'] ?>"> 
                    <input type="hidden" class="form-control" id="PERid" name="PERid" value="<?php echo $mysession['id'] ?>">     
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="BOKfrom" style="color:#ffffff">ลักษณะการจอง:</label>
                                <select class="form-control" id="BOKfrom">
                                    <?php 
                                    if(isset($bookingfrom)):
                                        foreach($bookingfrom as $fkey => $fvalue):
                                            if($fvalue['USCcode'] != 0):
                                    ?>
                                    <option value="<?php echo $fvalue['USCcode'] ?>"><?php echo $fvalue['USCdesc'.$sl] ?></option>
                                    <?php
                                            endif;
                                        endforeach;
                                    endif;
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="ROMno" style="color:#ffffff">หมายเลขห้อง:</label>
                                <input type="text" class="form-control" id="ROMno" name="ROMno" value="<?php echo $room[0]['ROMno'] ?>" readonly>                                
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="ROMdesc" style="color:#ffffff">ชื่อห้อง:</label>
                                <input type="text" class="form-control" id="ROMdesc" name="ROMdesc" value="<?php echo $room[0]['ROMdesc' . $sl] ?>" readonly>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="ROMlimit" style="color:#ffffff">จำนวนผู้เข้าพักสูงสุด:</label>
                                <input type="text" class="form-control" id="ROMlimit" name="ROMlimit" value="<?php echo $room[0]['ROMlimit'] ?>" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="ROMpice" style="color:#ffffff">ราคาห้อง:</label>
                                <input type="text" class="form-control" id="ROMpice" name="ROMpice" value="<?php echo number_format($room[0]['ROMpice'], 2, '.', '');  ?>" readonly>
                            </div>
                        </div>
                    </div>   
                    <div class="form-group">
                        <label for="ROMidc" style="color:#ffffff">เลขที่บัตรประชาชน:</label>
                        <div class="input-group mb-3">
                            <input type="ROMidc" class="form-control" placeholder="Please enter 13 characters or more." id="ROMidc" name="ROMidc" style="background-color:#ffe6e6">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-success" onclick="searchidc()">search</button>  
                            </div>
                        </div>
                    </div>
                </div>
            <script>                
                
                // $(document).ready(function() {
                //     document.getElementById('ROMidc').style.backgroundColor = "#FFFFFF";
                // });
                
            </script>
<?php
break;
case 'showbyidCustomer':
    // debug($titlename);
?>
            <form name="from_ecustomerh"enctype="multipart/form-data" id="from_ecustomerh">
            <!-- Modal body -->
            <div class="modal-body">

                <div class="form-group">
                    <label for="editCUSidc"><?php echo $this->lang->line("idcard"); ?>:</label>
                    <input type="text"  class="form-control" id="editCUSidc" name="editCUSidc" value="<?php echo $bycusid[0]['CUSidc']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="editCUStitle"><?php echo $this->lang->line("titlename"); ?>:</label>
                    <select class="form-control" id="editCUStitle" name="editCUStitle" required>
                        <?php foreach ($titlename as $titlekey => $titlevalue) : ?>
                        <option value="<?php echo $titlevalue['USCcode']; ?>" 
                        <?php
                        if ($bycusid[0]['CUStitle'] == $titlevalue['USCcode']) {
                            echo 'selected';
                        }
                        ?>>
                        <?php echo $titlevalue['USCdesc' . $sl]; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="editCUSfname"><?php echo $this->lang->line("fristname"); ?>:</label>
                    <input type="text" class="form-control" id="editCUSfname" name="editCUSfname" value="<?php echo $bycusid[0]['CUSfname']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="editCUSlname"><?php echo $this->lang->line("lastname"); ?>:</label>
                    <input type="text" class="form-control" id="editCUSlname" name="editCUSlname" value="<?php echo $bycusid[0]['CUSlname']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="editCUSadr"><?php echo $this->lang->line("address"); ?>:</label>
                    <textarea class="form-control" rows="3" id="editCUSadr" name="editCUSadr" required><?php echo $bycusid[0]['CUSadr']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="editCUSzipc"><?php echo $this->lang->line("zipcode"); ?>:</label>
                    <input type="text" class="form-control" id="editCUSzipc" name="editCUSzipc" value="<?php echo $bycusid[0]['CUSzipc']; ?>" onkeypress="return numberOnly(event);" required>
                </div>
                <div class="form-group">
                    <label for="editCUSbday"><?php echo $this->lang->line("brithday"); ?>:</label>
                    <input type="date" class="form-control" id="editCUSbday" name="editCUSbday" min="1000-01-01" max="3000-12-31" value="<?php echo date("Y-m-d", strtotime($bycusid[0]['CUSbday'])); ?>">
                </div>
                <div class="form-group">
                    <label for="editCUSemail"><?php echo $this->lang->line("email"); ?>:</label>
                    <input type="text" class="form-control" id="editCUSemail" name="editCUSemail" value="<?php echo $bycusid[0]['CUSemail']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="editCUSnphone"><?php echo $this->lang->line("phonenumber"); ?>:</label>
                    <input type="text" class="form-control" id="editCUSnphone" name="editCUSnphone" value="<?php echo $bycusid[0]['CUSnphone']; ?>" onkeypress="return numberOnly(event);"  required>
                </div>

                <div class="form-group">
                    <input type="hidden" class="form-control" id="editCUSbrhid" name="editCUSbrhid" value="<?php echo $mysession['id']; ?>" >
                    <input type="hidden" class="form-control" id="editCUSid" name="editCUSid" value="<?php echo $bycusid[0]['CUSid']; ?>" >
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="chkedit_data();"><?php echo $this->lang->line("save"); ?></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
                </div>

            </div>

        </form>
<?php
    break;
case 'getRoomToCheckout':
    // debug($cout);
?>
            <div class="container" >
                <input type="hidden" class="form-control" id="sta1BOKid" name="sta1BOKid" value="<?php echo $cout[0]['BOKid'] ?>">

                <input type="hidden" class="form-control" id="sta1BOKfrom" name="sta1BOKfrom" value="<?php echo $cout[0]['BOKfrom'] ?>">
                <input type="hidden" class="form-control" id="sta1BOKpomid" name="sta1BOKpomid" value="<?php echo $cout[0]['BOKpomid'] ?>">
                <input type="hidden" class="form-control" id="sta1BOKromid" name="sta1BOKromid" value="<?php echo $cout[0]['BOKromid'] ?>">
                <input type="hidden" class="form-control" id="sta1BOKcusid" name="sta1BOKcusid" value="<?php echo $cout[0]['BOKcusid'] ?>">
                <input type="hidden" class="form-control" id="sta1BOKbrhid" name="sta1BOKbrhid" value="<?php echo $cout[0]['BOKbrhid'] ?>">                
                <input type="hidden" class="form-control" id="sta1BOKstartDT" name="sta1BOKstartDT" value="<?php echo $cout[0]['BOKstartDT'] ?>">
                <input type="hidden" class="form-control" id="sta1BOKendDT" name="sta1BOKendDT" value="<?php echo $cout[0]['BOKendDT'] ?>">
                <input type="hidden" class="form-control" id="sta1PERid" name="sta1PERid" value="<?php echo $mysession['id'] ?>"> 
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group" style="margin-left: auto; margin-right: auto; text-align: center;">
                            <label for="BOKnote" style="color:#ff3333; font-size: 20px;"><?php echo $cout[0]['Room'][0]['ROMno'] . '  :  ' . date("Y-m-d",strtotime($cout[0]['BOKstartDT'])) . ' ถึง ' . date("Y-m-d",strtotime($cout[0]['BOKendDT'])) ?></label>
                        </div>
                    </div>
                </div>
                <hr style="border: 1px solid #ffffff; margin-top: -10px">                
                <div class="row" style="margin-top: -15px">
                    <div class="col-sm-4">
                        <label for="ROMlimit" style="color:#ffffff"><?php echo $this->lang->line("sir"); ?>:</label>
                    </div>
                    <div class="col-sm-8">
                        <label for="ROMlimit" style="color:#ffffff"><?php echo $cout[0]['Customer']['CUSfname'] . '  ' . $cout[0]['Customer']['CUSlname'] ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="ROMlimit" style="color:#ffffff"><?php echo $this->lang->line("address"); ?>:</label>
                    </div>
                    <div class="col-sm-8">
                        <label for="ROMlimit" style="color:#ffffff"><?php echo $cout[0]['Customer']['CUSadr'] . '  ' . $cout[0]['Customer']['CUSzipc'] ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="ROMlimit" style="color:#ffffff"><?php echo $this->lang->line("email"); ?>:</label>
                    </div>
                    <div class="col-sm-8">
                        <label for="ROMlimit" style="color:#ffffff"><?php echo $cout[0]['Customer']['CUSemail'] ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="ROMlimit" style="color:#ffffff"><?php echo $this->lang->line("phonenumber"); ?>:</label>
                    </div>
                    <div class="col-sm-8">
                        <label for="ROMlimit" style="color:#ffffff"><?php echo $cout[0]['Customer']['CUSnphone'] ?></label>
                    </div>
                </div>
                <hr style="border: 1px solid #ffffff; margin-top: -10px">
                <div class="row">
                    <div class="col-sm-4">
                        <label for="ROMlimit" style="color:#ffffff"><?php echo $this->lang->line("checktheroom"); ?>:</label>
                    </div>
                    <div class="col-sm-8">
                    <div class="form-check-inline">
                        <label class="form-check-label" for="havehardware" style="color:#ffffff">
                            <input type="checkbox" class="form-check-input" id="havehardware" name="havehardware" value="0" onclick="addhardware(<?php echo $cout[0]['BOKid'] ?>);" <?php if($cout[0]['BOKhard'] == 1){ echo "checked";} ?>>มีอุปกรณ์ชำรุด
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label" for="haveminibar" style="color:#ffffff">
                            <input type="checkbox" class="form-check-input" id="haveminibar" name="haveminibar" value="1" onclick="addminibar(<?php echo $cout[0]['BOKid'] ?>);" <?php if($cout[0]['BOKmini'] == 1){ echo "checked";} ?>>ใช้ Mini bar
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label" for="extrabed" style="color:#ffffff">
                            <input type="checkbox" class="form-check-input get_value_exb" id="extrabed" name="extrabed" value="1" onclick="addextrabed(<?php echo $cout[0]['BOKid'] ?>);" <?php if($cout[0]['BOKexbed'] == 1){ echo "checked";} ?>>ใช้เตียงเสริม
                        </label>
                    </div>
                    </div>
                </div>
                <hr id="myDIV4" style="border: 1px solid #ffffff;display:none; margin-top: 0px">
                <div class="row" id="myDIV3" style="display:none; margin-top: -10px">                
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="REDprice" style="color:#ffffff"><?php echo $this->lang->line("price"); ?>:</label>
                            <input type="text" class="form-control" id="REDprice" name="REDprice" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" />
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="REDnote" style="color:#ffffff">Comment:</label>
                            <textarea class="form-control" rows="3" id="REDnote" name="REDnote"></textarea>
                        </div>
                    </div>
                </div>
                <hr style="border: 1px solid #ffffff;">
                <div class="row">
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-primary btn-block" onclick="savebookingsta1()">Booking</button>
                    </div>
                </div>
                <!-- <hr style="border: 1px solid #ffffff; margin-top: 10px">
                <div class="row">
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-primary btn-block" >Booking</button>
                    </div>
                </div> -->
            </div>
<?php
    break;
    case 'showShowhardware':
        // debug($bok);
?>
        <form name="from_hardware"enctype="multipart/form-data" id="from_hardware">
            <div class="container">            
                <input type="text" class="form-control" id="RADbokid" name="RADbokid" value="<?php echo $bok[0]['BOKid'] ?>">
                
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><?php echo $this->lang->line("no"); ?></th>
                            <th><?php echo $this->lang->line("devicename"); ?></th>
                            <th><?php echo $this->lang->line("quantity"); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(isset($bok)):
                            foreach($bok[0]['Room'][0]['accessories'] as $bkey => $bvalue):
                        ?>                    
                        <tr>
                            <td>
                                <?php echo $bkey + 1 ?>                            
                            </td>
                            <td width="60%"><?php echo $bvalue['RASdesc'.$sl] . '  (' . number_format($bvalue['RASquan']) . ')' ?></td>
                            <td>
                                <?php
                                if($c == 0):
                                ?>
                                <input type="number" class="form-control" min="0" max="<?php echo number_format($bvalue['RASquan']) ?>" id="RADid<?php echo $bvalue['RASid'] ?>" name="RADid<?php echo $bvalue['RASid'] ?>" value="0" oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" onKeyDown="if(this.value.length==1 && event.keyCode!=8) return false;">
                                <?php
                                else:
                                    if (isset($bvalue['equipment'][0])):                                    
                                ?>
                                    <input type="number" class="form-control" min="0" max="<?php echo number_format($bvalue['RASquan']) ?>" id="RADid<?php echo $bvalue['RASid'] ?>" name="RADid<?php echo $bvalue['RASid'] ?>" value="<?php echo number_format($bvalue['equipment'][0]['RADromrisqty']);  ?>" oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" onKeyDown="if(this.value.length==1 && event.keyCode!=8) return false;">
                                <?php 
                                    else:
                                ?>
                                    <input type="number" class="form-control" min="0" max="<?php echo number_format($bvalue['RASquan']) ?>" id="RADid<?php echo $bvalue['RASid'] ?>" name="RADid<?php echo $bvalue['RASid'] ?>" value="0" oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" onKeyDown="if(this.value.length==1 && event.keyCode!=8) return false;">
                                <?php
                                    endif;
                                endif;
                                ?>
                            </td>
                        </tr>     
                        <?php
                            endforeach;
                        endif;
                        ?>       
                    </tbody>
                </table>            
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="save_equipment();"><?php echo $this->lang->line("save"); ?></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
            </div>
        </form>
<?php
        break;

    case 'showMinibar':
        // debug($item);
?>
        <form name="from_minibar"enctype="multipart/form-data" id="from_minibar">
            <div class="container">            
                <input type="hidden" class="form-control" id="RADbokid" name="RADbokid" value="<?php echo $bok[0]['BOKid'] ?>">
                <input type="hidden" class="form-control" id="BOKromid" name="BOKromid" value="<?php echo $bok[0]['BOKromid'] ?>">
                <input type="hidden"  class="form-control" id="PERid" name="PERid" value="<?php echo $mysession['id']; ?>">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><?php echo $this->lang->line("no"); ?></th>
                            <th><?php echo $this->lang->line("devicename"); ?></th>
                            <th><?php echo $this->lang->line("quantity"); ?></th>
                            <th><?php echo $this->lang->line("unit"); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($item)):
                        foreach($item as $ikey => $ivalue):
                            if(number_format($ivalue['quantity']['QTYbyid']) != 0):
                    ?>
                    <tr>
                        <td><?php echo $ikey + 1 ?></td>
                        <td><?php echo $ivalue['item'][0]['STKdesc'.$sl] . ' (' . number_format($ivalue['quantity']['QTYbyid']) . ')' ?></td>
                        <td>
                        <?php
                        if($c == 0):
                        ?>
                            <input type="number" class="form-control" min="0" max="<?php echo number_format($ivalue['quantity']['QTYbyid']) ?>" id="STKid<?php echo $ivalue['item'][0]['STKid'] ?>" name="STKid<?php echo $ivalue['item'][0]['STKid'] ?>" value="0" oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" onKeyDown="if(this.value.length==1 && event.keyCode!=8) return false;">
                        <?php
                        else:
                            if (isset($ivalue['outquantity'][0])):
                        ?>
                                <input type="number" class="form-control" min="0" max="<?php echo number_format($ivalue['quantity']['QTYbyid']) ?>" id="STKid<?php echo $ivalue['item'][0]['STKid'] ?>" name="STKid<?php echo $ivalue['item'][0]['STKid'] ?>" value="<?php echo number_format($ivalue['outquantity'][0]['MNSromrisqty']) ?>" oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" onKeyDown="if(this.value.length==1 && event.keyCode!=8) return false;">
                        <?php 
                            else:
                        ?>
                                <input type="number" class="form-control" min="0" max="<?php echo number_format($ivalue['quantity']['QTYbyid']) ?>" id="STKid<?php echo $ivalue['item'][0]['STKid'] ?>" name="STKid<?php echo $ivalue['item'][0]['STKid'] ?>" value="0" oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" onKeyDown="if(this.value.length==1 && event.keyCode!=8) return false;">
                        <?php
                            endif;
                        endif;
                        ?>
                        </td>
                        <td><?php  echo $ivalue['item'][0]['unit'][0]['UNTdesc'.$sl] ?></td>
                    </tr>
                    <?php
                            endif;
                        endforeach;
                    endif;
                    ?>
                    </tbody>
                </table>            
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="save_minibar();"><?php echo $this->lang->line("save"); ?></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
            </div>
        </form>
<?php
        break;
    case 'showBillCheckOut':
    // debug($customer);
?>
        <div class="container">
            <div class="row" style="margin-top: 15px">
                <div class="col-sm-6">
                    <div class="form-check-inline">
                        <label class="form-check-label" for="radio1">
                            <input type="radio" class="form-check-input" id="radio1" name="cusaddress" value="0" onclick="myaddress(0);" checked><?php echo $this->lang->line("currentaddress"); ?>
                        </label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-check-inline">
                        <label class="form-check-label" for="radio2">
                            <input type="radio" class="form-check-input" id="radio2" name="cusaddress" value="1" onclick="myaddress(1);"><?php echo $this->lang->line("company"); ?>
                        </label>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row" id="myDIV" style="display:block">
                <div class="col-sm-12">
                    <!-- <input type="text" class="form-control" id="BOKid" name="BOKid" value="<?php echo $booking[0]['BOKid'] ?>"> -->
                    <input type="hidden" class="form-control" id="CUSid" name="CUSid" value="<?php echo $customer['CUSid'] ?>">
                    <div class="form-group">
                        <label for="comment"><?php echo $this->lang->line("address"); ?>:</label>
                        <?php 
                        $txt = 'คุณ ' . $customer['CUSfname'] . '  ' . $customer['CUSlname'] . "\n" 
                        . $customer['CUSadr'] . "\n" 
                        . $customer['CUSemail'] . "\n"
                        . $customer['CUSnphone'] . "\n";
                        ?>
                        <textarea class="form-control" rows="5" id="comment" readonly><?php echo $txt ?></textarea>
                    </div>
                </div>
            </div>
            <div class="row" id="myDIV2" style="display:none">
                <!-- <div class="row"> -->
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="ADRname"><?php echo $this->lang->line("fristname"); ?> / <?php echo $this->lang->line("company"); ?>:</label>
                                    <input type="text" class="form-control" id="ADRname" name="ADRname">
                                </div>
                            </div>                                     
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="ADRtel"><?php echo $this->lang->line("phonenumber"); ?>:</label>
                                    <input type="text" class="form-control" id="ADRtel" name="ADRtel">
                                </div>
                            </div>  
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="ADRemail"><?php echo $this->lang->line("email"); ?>:</label>
                                    <input type="text" class="form-control" id="ADRemail" name="ADRemail">
                                </div>
                            </div>       
                        </div>                            
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="ADRnote"><?php echo $this->lang->line("address"); ?>:</label>
                                    <textarea class="form-control" rows="4" id="ADRnote" name="ADRnote"></textarea>
                                </div>
                            </div>        
                        </div>
                    </div>
                <!-- </div>                                 -->
            </div>
            <!-- <hr> -->
            
            <hr>
            <div class="row">
                <div class="col-sm-4">
                    <label for="usr"><?php echo $this->lang->line("selectroom"); ?>:</label>
                </div>
                <div class="col-sm-8">
                <?php
                if(isset($booking)):
                    foreach($booking as $bkey => $bvalue):
                ?>
                    <div class="form-check-inline">
                        <label class="form-check-label" for="check1">
                            <input type="checkbox" class="form-check-input get_value_d" id="check<?php echo $bvalue['BOKid'] ?>" name="xcheck<?php echo $bvalue['BOKid'] ?>" value="<?php echo $bvalue['BOKid'] ?>" <?php if($bkey == 0){echo("checked");} ?>><?php echo 'Room NO.' . $bvalue['room'][0]['ROMno'] ?>
                        </label>
                    </div>
                <?php
                    endforeach;
                endif;
                ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <label for="usr"><?php  echo $booking[0]['discode'] ?>:</label>
                </div>
                <div class="col-sm-8">                    
                    <div class="row">
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="POMpcode" name="POMpcode">
                            <input type="text" class="form-control" id="POMid" name="POMid" hidden>                                                        
                            <p id="resmessage"></p>
                        </div>
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-warning btn-block" onclick="checkpromotion('<?php  echo $booking[0]['BOKstartDT'] ?>', '<?php  echo $booking[0]['BOKendDT'] ?>', '<?php  echo $booking[0]['BOKbrhid'] ?>');"><?php echo $this->lang->line("check"); ?></button>
                        </div>
                    </div>
                </div>               
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <label for="usr"><?php echo $this->lang->line("disbill"); ?>:</label>
                </div>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="POMdis" name="POMdis" value='0' readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <label for="usr"><?php echo $this->lang->line("vat"); ?>:</label>
                </div>
                <div class="col-sm-8">
                    <div class="form-check-inline">
                        <label class="form-check-label" for="vat7">
                            <input type="radio" class="form-check-input" id="vat7" name="vat" value="7" checked>Value Added Tax 7%
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label" for="vat9">
                            <input type="radio" class="form-check-input" id="vat9" name="vat" value="9" disabled>Value Added Tax 9%
                        </label>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-8">
                    <button type="button" class="btn btn-primary btn-block" onclick="show_detail_room();"><?php echo $this->lang->line("showdetails"); ?></button>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12"><hr></div>
            </div>
        </div>            
<?php
        break;
    case 'getDetailRoomBill':
    // debug($bycusid);
?>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                <table class="table" id="xtable">
                    <thead>
                    <tr>
                        <th><?php echo $this->lang->line("no"); ?></th>
                        <th></th>
                        <th><?php echo $this->lang->line("details"); ?></th>
                        <th align="center"><?php echo $this->lang->line("quantity"); ?></th>
                        <th align="center"><?php echo $this->lang->line("priceunit"); ?></th>
                        <th align="center"><?php echo $this->lang->line("price"); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($bycusid)):
                        $sumroom = 0; $sumextrabed = 0; $summinibar = 0; $sumaccessories = 0; $tot = 0;
                        foreach($bycusid as $bckey => $bcvalue):
                            // debug($bcvalue['accessories']);
                            // exit();
                            $bkstr[$bckey]['BOKid'] = $bcvalue['BOKid'];
                    ?>
                            <tr>
                                <td><?php echo $bckey + 1 ?></td>
                                <td></td>
                                <td><?php echo $bcvalue['room'][0]['ROMno'] ?></td>
                                <td align="right"><?php echo number_format($bcvalue['atnight'], 2, '.', ''); ?></td>
                                <th align="center">
                                <?php 
                                    if ($sl == 'TH') {
                                        echo("คืน");
                                    } else {
                                        echo("Nigth");
                                    }
                                    
                                ?>
                                </th>
                                <td align="right">
                                <?php 
                                $sumproom = $bcvalue['room'][0]['ROMpice'] * $bcvalue['atnight'];
                                echo number_format($sumproom, 2, '.', '');
                                ?>
                                </td>
                            </tr>


                            <?php                    
                            if(isset($bcvalue['extrabed'])):
                                foreach($bcvalue['extrabed'] as $exkey => $exvalue):
                            ?>
                                <tr>
                                    <td><?php $a = $exkey + 1 ?></td>
                                    <td <?php if($exkey == 0){ echo "bgcolor='#ccccff'";} ?>><?php if($exkey == 0){ echo $this->lang->line("addon");} ?></td>                            
                                    <td bgcolor="#ccccff"><?php echo '(' . $a . ')  ' . $exvalue['REDnote'] ?></td>
                                    <td bgcolor="#ccccff" align="right"><?php echo number_format($exvalue['REDqty'], 2, '.', '') ?></td>
                                    <th align="center" bgcolor="#ccccff">
                                    <?php 
                                    if ($sl == 'TH') {
                                        echo("หน่วย");
                                    } else {
                                        echo("Unit");
                                    }
                                    
                                    ?>
                                    </th>
                                    <td bgcolor="#ccccff" align="right"><?php echo number_format($exvalue['REDprice'], 2, '.', '') ?></td>
                                </tr>
                            <?php 
                                $sumextrabed += $exvalue['REDprice'];
                                endforeach;
                            endif;
                            ?>


                            <?php
                            if(isset($bcvalue['minibar'])):
                                foreach($bcvalue['minibar'] as $mkey => $mvalue):
                            ?>
                                <tr>
                                    <td><?php $b = $mkey + 1 ?></td>
                                    <td <?php if($mkey == 0){ echo "bgcolor='#ffffb3'";} ?>><?php if($mkey == 0){ echo $this->lang->line("product");} ?></td>                            
                                    <td bgcolor="#ffffb3"><?php echo '(' . $b . ')  ' . $mvalue['product'][0]['STKdesc'.$sl] ?></td>
                                    <td bgcolor="#ffffb3" align="right"><?php echo number_format($mvalue['MNSromrisqty'], 2, '.', '') ?></td>
                                    <th align="center" bgcolor="#ffffb3"><?php echo $mvalue['product'][0]['unit'][0]['UNTdesc'.$sl] ?></th>
                                    <td bgcolor="#ffffb3" align="right"><?php echo number_format($mvalue['MNSromristot'], 2, '.', '') ?></td>
                                </tr>
                            <?php 
                                $summinibar += $mvalue['MNSromristot'];
                                endforeach;
                            endif;
                            ?>


                            <?php

                            if(isset($bcvalue['accessories'])):
                                foreach($bcvalue['accessories'] as $akey => $avalue):
                            ?>
                                <tr>
                                    <td><?php $c = $akey + 1 ?></td>
                                    <td <?php if($akey == 0){ echo "bgcolor='#ffe6e6'";} ?>><?php if($akey == 0){ echo $this->lang->line("fine");} ?></td>                            
                                    <td bgcolor="#ffe6e6"><?php echo '(' . $c . ')  ' . $avalue['unit'][0]['RASdesc'.$sl] ?></td>
                                    <td bgcolor="#ffe6e6" align="right"><?php echo number_format($avalue['RADromrisqty'], 2, '.', '') ?></td>
                                    <th align="center" bgcolor="#ffe6e6">
                                    <?php 
                                    if ($sl == 'TH') {
                                        echo("หน่วย");
                                    } else {
                                        echo("Unit");
                                    }
                                    
                                    ?>
                                    </th>
                                    <td bgcolor="#ffe6e6" align="right"><?php echo number_format($avalue['RADromristot'], 2, '.', '') ?></td>
                                </tr>                        
                            <?php 
                                $sumaccessories += $avalue['RADromristot'];
                                endforeach;
                            endif;
                            ?>        


                    <?php
                        $sumroom +=  $sumproom;
                        endforeach;
                    endif;
                    ?>
                    <tr>
                        <td><?php // echo $sumroom ?></td>
                        <td><?php // echo $sumextrabed ?></td>
                        <td><?php // echo $summinibar ?></td>
                        <td></td>
                        <td align="right"><b><?php echo $this->lang->line("tot"); ?></b><?php // echo $sumaccessories ?></td>
                        <td align="right">
                        <?php 
                        $tot = $sumroom + $sumextrabed + $summinibar + $sumaccessories;
                        echo  number_format($tot , 2, '.', '');
                        ?>
                        </td>
                    </tr>
                    <tr>                        
                        <td colspan="5" align="right"><b><?php echo $this->lang->line("dis"); ?></b></td>                        
                        <td align="right"><?php echo $POMdis ?></td>
                    </tr>
                    <tr>
                        <td colspan="5" align="right"><b><?php echo $this->lang->line("vat"); ?></b></td>                        
                        <td align="right"><?php $vat = number_format($tot * $VAT / 100 , 2, '.', ''); echo $vat; ?></td>
                    </tr>
                    <tr>
                        <td colspan="5" align="right"><b><?php echo $this->lang->line("net"); ?></b></td>                        
                        <td align="right">
                        <?php
                        $stot = ($tot + ($tot * $VAT / 100)) - $POMdis;
                        echo  number_format($stot , 2, '.', '');
                        ?>
                        </td>
                    </tr>
                    </tbody>
                </table>                 
                <input type="hidden" class="form-control" id="abokid" name="abokid" value="<?php echo implode(", ",array_column($bkstr, 'BOKid')); ?>">
                <input type="hidden" class="form-control" id="BRHid" name="BRHid" value="<?php echo $mysession['brhid']; ?>">
                <input type="hidden" class="form-control" id="PERid" name="PERid" value="<?php echo $mysession['id']; ?>">
                <input type="hidden" class="form-control" id="VATsum" name="VATsum" value="<?php echo $vat ?>">
                <input type="hidden" class="form-control" id="TOTsum" name="TOTsum" value="<?php echo $stot ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <label for="usr"><?php echo $this->lang->line("bdisplay"); ?>:</label>
                </div>
                <div class="col-sm-8">
                    <div class="form-check-inline">
                        <label class="form-check-label" for="display1">
                            <input type="checkbox" class="form-check-input get_value_disp" id="display1" name="display1" value="0"><?php echo $this->lang->line("showitems"); ?>
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label" for="display2">
                            <input type="checkbox" class="form-check-input get_value_disp" id="display2" name="display2" value="0"><?php echo $this->lang->line("extraitems"); ?>
                        </label>
                    </div>                    
                    <div class="form-check-inline">
                        <label class="form-check-label" for="display4">
                            <input type="checkbox" class="form-check-input get_value_disp" id="display4" name="display4" value="0"><?php echo $this->lang->line("showproducts"); ?>
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label" for="display5">
                            <input type="checkbox" class="form-check-input get_value_disp" id="display5" name="display5" value="0"><?php echo $this->lang->line("finelist"); ?>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer" >
            <button type="button" id="myDIV5" class="btn btn-success" onclick="save_voucher();"><?php echo $this->lang->line("save"); ?></button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line("close"); ?></button>
        </div>
<?php
        break;
default:
    echo 'No data and tag HTML';

    break;
}
?>
