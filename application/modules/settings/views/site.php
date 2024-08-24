<main class="content-wrapper">
  <section class="container-fluid"><label>Site settings</label>
    <hr>
    <div class="container-fluid">
      <?php if (!empty($errors)): ?>
        <?php if ($errors['status'] == true): ?>
          <span class="errors alert alert-success"><?=$errors['msg']?></span>
          <?php else: ?>
          <span class="errors alert alert-danger"><?=$errors['msg']?></span>

        <?php endif ?>
      <?php else: ?>
        <span class="errors"></span>
      <?php endif ?>
     <hr>
    <div class="form-responsive">
      <form class="form" action="<?=site_url('settings/site')?>" method="POST" enctype="multipart/form-data">
        <div class="row form-group">
          <label>SITE LOGO</label>
          <input type="hidden" name="action" value="logo">
          <input class="form-control" type="file" name="logo" required>
          <?php if (!empty($site_logo)): ?>
            <div class="bg-black">
              
            <img src="<?=$site_logo?>" class="thumb img-thumb">
            
            </div>
          <?php endif ?>
        </div>
        <div class="form-group">
          <button class="btn btn-outline-primary">Upload</button>
        </div>
      </form>
    </div>
<hr>

    <div class="form-responsive">
      <form class="form">
        <input type="hidden" name="action" value="site_title">
        <div class="row form-group">
          <label>SITE TITLE <small><i>(Leave empty when you used site logo)</i></small></label>
          <input type="text" class="form-control site-settings" name="site_title" value="<?=(!empty($site_title) ? $site_title : '')?>">
        </div>
        <div class="row form-group d-none">
          <label> Short Description</label>
          <textarea class="form-control site-settings" name="site_desc" rows="10"><?=(!empty($desc) ? $desc : '')?></textarea>
         
        </div>
      </form>
    </div>

     <div class="form-responsive">
      <form class="form" action="<?=site_url('settings/site')?>" method="POST" enctype="multipart/form-data">
        <div class="row form-group">
          <label>LOGIN LOGO</label>
          <input type="hidden" name="action" value="loginlogo">
          <input class="form-control" type="file" name="loginlogo" accept=".jpg,.png" required>
          <?php if (!empty($login_logo)): ?>
            <div class="bg-black">
              
            <img src="<?=$login_logo?>" class="thumb img-thumb" style="max-width: 150px;">
            
            </div>
          <?php endif ?>
        </div>
        <div class="form-group">
          <button class="btn btn-outline-primary">Upload</button>
        </div>
      </form>
    </div>
<hr>

</main>