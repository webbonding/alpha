@php

@endphp
<!-------- back to top html------------>
<a id="back2Top" title="Back to top" href="#"><i class="fa fa-chevron-up" aria-hidden="true"></i></a>


<!-- login modal -->
<div class="modal fade" id="logIn" tabindex="-1" role="dialog" aria-labelledby="logInLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title modal-custom-title" id="logInLabel">Login To Alpha Maths</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true" class="cross"><i class="fa fa-times-circle"></i></span>
      </button>
    </div>
    <div class="modal-body">
      <div class="custom-modal-area">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="log-sign-body">
                <!-- <div class="login-with-btn">
                  <a href="https://www.facebook.com/" class="custom-my-button facebook-bg"><i class="fa fa-facebook-square margin-right-area" aria-hidden="true"></i> Continue With Facebook</a>
                </div>
                <div class="login-with-btn">
                  <a href="https://www.facebook.com/" class="custom-my-button google-bg"><i class="fa fa-google margin-right-area" aria-hidden="true"></i> Continue With Google</a>
                </div>
                <div class="login-with-btn text-center">
                  <h6 class="or-text">OR</h6>
                </div> -->
                <form id="login-form" action="{{ Route('login') }}" method="POST">
                    @csrf
                  <div class="form-group">
                    <input type="email" class="form-control log-user" placeholder="User Email" name="email" value="<?php
                        if (isset($_COOKIE['user_email']) && $_COOKIE['user_email'] !== NULL) {
                            echo $_COOKIE['user_email'];
                        }
                        ?>" placeholder="Enter Your Email" />
                    <div class="help-block" id="err-email"></div>
                  </div>
                  <div class="form-group gap-reduce">
                    <input type="password" class="form-control log-user" placeholder="User Password" name="password" value="<?php
                        if (isset($_COOKIE['user_password']) && $_COOKIE['user_password'] !== NULL) {
                            echo $_COOKIE['user_password'];
                        }
                        ?>" placeholder="Enter password" />
                    <div class="help-block" id="err-password"></div>
                  </div>
                  <div>	
                    <button type="submit" class="login-btn" id="" name="">Log in</button>
                  </div>
                  <div class="login-with-btn">
                    <div class="row">
                      <div class="col-sm-6 p-0 m-0">
                          <input id="myCheckbox" name="rememberMe" type="checkbox" value="1" <?php
                            if (isset($_COOKIE['user_email']) && $_COOKIE['user_password'] !== NULL) {
                                echo 'checked="checked"';
                            }
                            ?>>
                          <label for="remember" class="label">Remember Me</label>
                      </div>
                      <div class="col-sm-6 p-0 m-0">
                        <div class="custom-forgot">
                           <a href="javascript:void(0)" class="forgot-password-link" data-toggle="modal" onclick="forgot();"> Forgot Password?</a>
                        </div>  
                      </div>
                    </div>
                  </div>
                  <div class="log-in-modal-cus">
                    <hr>	
                    <p>No Account? <a href="javascript:void(0)" class="forgot-password-link" data-toggle="modal" onclick="signup();">Create An Account? </a></p>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>
</div>

<!-- signup modal -->
<div class="modal fade" id="signUp" tabindex="-1" role="dialog" aria-labelledby="signUpLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title modal-custom-title" id="signUpLabel">Signup To Alpha Maths</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true" class="cross"><i class="fa fa-times-circle"></i></span>
      </button>
    </div>
    <div class="modal-body">
      <div class="custom-modal-area">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="log-sign-body">
                <!-- <div class="login-with-btn">
                  <a href="https://www.facebook.com/" class="custom-my-button facebook-bg"><i class="fa fa-facebook-square margin-right-area" aria-hidden="true"></i> Continue With Facebook</a>
                </div>
                <div class="login-with-btn">
                  <a href="https://www.facebook.com/" class="custom-my-button google-bg"><i class="fa fa-google margin-right-area" aria-hidden="true"></i> Continue With Google</a>
                </div>
                <div class="login-with-btn text-center">
                  <h6 class="or-text">OR</h6>
                </div> -->
                <form id="signup-form" action="{{ Route('signup') }}" method="POST">
                    @csrf
                  <div class="form-group">
                    <input type="text" placeholder="User Full Name" class="form-control log-user" name="full_name">
                    <div class="help-block" id="error-full_name"></div>
                  </div>
                  <div class="form-group">
                    <input type="email" placeholder="User Email Id" class="form-control log-user" name="email">
                    <div class="help-block" id="error-email"></div>
                  </div>
                  <div class="form-group">
                    <input type="tel" placeholder="User Mobile" class="form-control log-user" name="phone">
                    <div class="help-block" id="error-phone"></div>
                  </div>
                  <div class="form-group">
                    <input type="password" placeholder="User Password" class="form-control log-user"  name="password">
                    <div class="help-block" id="error-password"></div>
                  </div>
                  <div class="form-group gap-reduce">
                    <input type="password" placeholder="Re-type Password" class="form-control log-user"  name="confirm_password">
                    <div class="help-block" id="error-confirm_password"></div>
                  </div>
                  <div>	
                    <button type="submit" class="login-btn" id="" name="">Create Account</button>
                  </div>
                  <div class="log-in-modal-cus">
                    <hr>	
                    <p>Already Member? <a href="javascript:void(0)" class="forgot-password-link" data-toggle="modal" onclick="login();">Login </a></p>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>
</div>


<!-- forgot modal-->
<div class="modal fade" id="forGot" tabindex="-1" role="dialog" aria-labelledby="forGotLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title modal-custom-title" id="forGotLabel">Forgot Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="cross"><i class="fa fa-times-circle"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="custom-modal-area">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="log-sign-body">
                                    <form id="forgot-form" action="{{ Route('forgot-password') }}" method="POST">
                                        @method('PUT')
                                        <div class="form-group">
                                            <input type="email" class="form-control log-user" name="email" placeholder="Email address">
                                            <div class="help-block" id="er-email"></div>
                                        </div>

                                        <div>	
                                            <button type="submit" class="login-btn" id="" name="">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reset modal-->
<div class="modal fade" id="reset_password_modal" tabindex="-1" role="dialog" aria-labelledby="forGotLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title modal-custom-title" id="forGotLabel">Reset Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="cross"><i class="fa fa-times-circle"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="custom-modal-area">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="log-sign-body">
                                    <form id="reset-password-form" action="{{ Route('set-password') }}" method="POST">
                                        @method('PUT')
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password" placeholder="Password">
                                            <div class="help-block" id="erro-password"></div>
                                        </div>
                                        <div class="form-group gap-reduce">
                                            <input type="password" class="form-control" name="retype_password" placeholder="Retype Password">
                                            <div class="help-block" id="erro-retype_password"></div>
                                        </div>

                                        <div>	
                                            <button type="submit" class="login-btn" id="" name="">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>