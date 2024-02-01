
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="<?=current_url()?>" method="POST">
              <h1>Login Form</h1>
              <div class="error-area" style="padding:5px;">
                <?php if(!empty($errors)) { for ($i=0; $i < count($errors); $i++) { 
                  // code...
                  echo "<span class='text text-danger'>".$errors[$i]."</span>";
                }} ?>
              </div>
              <div>
                <input type="text" class="form-control" name="userName" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" class="form-control" name="passWord" placeholder="Password" required="" />
              </div>
              <div>
                <button type="submit" class="btn btn-default submit" >Log in</button>
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><img src="<?=base_url('assets/img/org-logo.png')?>" style="width: 150px;height: 130px;"></h1>
                  <p>©<?=date('Y')?> Students Organization Collections and Events Monitoring System</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 4 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>