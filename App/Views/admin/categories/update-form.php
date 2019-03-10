
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo url('/admin'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo url('/admin/categories'); ?>"><i class="fa fa-folder"></i> Categories</a></li>
        <li class="active">Update Category</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
          <div class="col-sm-12">
              <div class="box" id="users-list">
                <div class="box-header with-border">
                  <h1>Edit <?php echo $category->name; ?></h1>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <form action="<?php echo url('admin/categories/save/' . $category->id); ?>" method="post" enctype="multipart/form-data">
                      <div id="form-results"></div>
                       <div class="form-group col-sm-6">
                         <label for="category-name">Category name</label>
                         <input type="text" class="form-control" name="name" id="category-name" placeholder="Category Name" value="<?php echo $category->name; ?>">
                         <?php if(! empty($errors['name'])) : ?>
                             <div style="color:red;">
                               <?php echo $errors['name']; ?>
                             </div>
                         <?php endif; ?>
                       </div>
                    
                       <div class="form-group col-sm-6">
                          <label for="status">Status</label>
                          <select class="form-control" id="status" name="status">
                              <option value="enabled">Enabled </option>
                              <option value="disabled" <?php echo $status == 'disabled' ? 'selected' : false ?>>Disabled</option>
                          </select>
                       </div>
                       <div class="clearfix"></div>
                       <div class="col-sm-6">
                           <button class="btn btn-info">Submit</button> 
                       </div>
                  </form>
                </div>
                <!-- /.box-body -->
              </div>
          </div>
      </div>
     
    </section>
  </div>
    <!-- /.content -->