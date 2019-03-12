
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
       <ol class="breadcrumb">
        <li><a href="<?php echo url('/admin'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Settings</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
          <div class="col-sm-12">
              <div class="box" id="ads-list">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-cogs"></i> Settings</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <form action="<?php echo $action; ?>" class="form-group">
                  <div id="form-results"></div>
                  <div class="form-group col-sm-12">
                   <label for="name">Site Name</label>
                   <input type="text" class="form-control" name="name" id="name" value="<?php //echo $name; ?>" placeholder="My Blog">
                  </div>
                  <div class="form-group col-sm-12">
                   <label for="name">Site E-mail</label>
                   <input type="email" class="form-control" name="email" id="email" value="<?php //echo $email; ?>" placeholder="admin@my-blog.com">
                  </div>
                  <div class="form-group col-sm-12">
                    <label for="status">Site Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="enabled">Enabled </option>
                        <option value="disabled" <?php //echo $status == 'disabled' ? 'selected' : false ?>>Disabled</option>
                    </select>
                 </div>
                  <div class="form-group col-sm-12">
                   <label for="details">Site Close Message</label>
                   <textarea name="details" id="details" col="30" rows="10"  class="form-control"><?php //echo $details; ?></textarea>
                 </div>
                  <div class="clearfix"></div>
                  <div class="form-group col-sm-12">
                   <button type="button" class="btn btn-info submit-btn">
                       Submit
                   </button>
                  </div> 
                </form>
                </div>
              </div>
          </div>
      </div>
    </section>
  </div>
    <!-- /.content -->