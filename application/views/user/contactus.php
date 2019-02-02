<!doctype html>
<html lang="en">

    <head>
        <?php echo $startpage; ?>
    </head>

    <body>

        <?php echo $topmenu; ?>

        <main role="main" class="container-fluid" style="margin-top:45px">

          <!-- Alert Message -->
          <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12">
                  <?php
                  $error = $this->session->flashdata('error');
                  if ($error) {
                      ?>
                      <div class="alert alert-warning" style="margin-top: 25px " role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                          <h4 class="alert-heading"> Error ! </h4>
                          <p><?php echo $error; ?></p>
                          <hr>
                          <p class="mb-0">Message from system.</p>
                      </div>
                      <?php
                  }
                  $success = $this->session->flashdata('success');
                  if ($success) {
                      ?>
                      <div class="alert alert-success" style="margin-top: 25px " role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                          <h4 class="alert-heading"> Success ! </h4>
                          <?php echo $success; ?>
                          <hr>
                          <p class="mb-0">Message from system.</p>
                      </div>
                  <?php } ?>
              </div>
          </div>

            <div class="row">
                <div class="col-md-8 blog-main">
                    <h3 class="pb-3 mb-4 border-bottom">
                        <?php echo $this->lang->line("contactus"); ?> :: โยทะกา กรุ๊ป
                    </h3>

                    <div class="blog-post">
                        <div class="container marketing">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3874.3343095022046!2d100.65001631531614!3d13.818953199455784!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311d625838de9193%3A0x1aa8025d89c70593!2z4Lia4LiILuC5hOC4l-C4o-C5jOC4i-C4seC4mSDguIvguLTguKrguYDguJfguYfguKHguKrguYw!5e0!3m2!1sth!2sth!4v1526957196064"  width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                              </div>
                        </div>
                    </div><!-- /.blog-post -->
                </div><!-- /.blog-main -->

                <aside class="col-md-4 blog-sidebar" style="margin-top: 45px">
                    <div class="p-3 mb-3 font-bg rounded">
                        <h4 style="text-align:center;"><?php echo $this->lang->line("comments"); ?></h4>
                        <div class="container" style="margin-top: 20px">

                            <div class="form-group">
                              <form method="post" action="<?php base_url(); ?>scomments">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="commname" name="commname" placeholder="<?php echo $this->lang->line("cname"); ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="commemail" name="commemail" placeholder="e-mail" required>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" rows="5" id="commcomment" name="commcomment" placeholder="<?php echo $this->lang->line("comments"); ?>" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="commvote"><?php echo $this->lang->line("vote"); ?></label>
                                    <select class="form-control" id="commvote" name="commvote" required>
                                      <?php
                                      for ($i = 5; $i >= 1; $i -= 1) {
                                        echo "<option value=".$i.">".$i."</option>";
                                      }
                                      ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-info"><?php echo $this->lang->line("sent"); ?></button>
                                </div>
                                </form>
                            </div>

                        </div>
                    </div>

                </aside><!-- /.blog-sidebar -->

            </div><!-- /.row -->

        </main><!-- /.container -->

        <?php echo $footer; ?>

    <script>
        setTimeout(function () {
            $(".alert").alert('close');
        }, 2000);
    </script>
    </body>

    <?php echo $endpage; ?>

</html>
