        <!-- Top content -->
        <div class="top-content">
            
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>Control De Pagos De Proyectos Hydralab</strong></h1>
                            <div class="description">
                              
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                            <div class="form-top">
                                <div class="form-top-left">
                                    <h3>Login to our site</h3>
                                    <p>Enter your username and password to log on:</p>
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-lock"></i>
                                </div>
                            </div>
                            <div class="form-bottom">
                               <?= validation_errors() ?>
                               <?= form_open('verifylogin') ?>
                                    <div class="form-group">
                                         <label class="sr-only" for="username">Username:</label>
                                        <input type="text" size="20" id="username" name="username"/>
                                     </div>
                                     <div class="form-group">
                                        <label class="sr-only" for="password">Password:</label>
                                        <input type="password" size="20" id="passowrd" name="password"/>
                                     </div>
                                     <input type="submit" class="btn-primary" value="Login"/>
                               </form>

                            <!--    <form action="application/controllers/login.php" method="post" class="login-form">
                                    <div class="form-group">
                                        <label class="sr-only" for="form-username">Username</label>
                                        <input type="text" name="name" placeholder="Username..." class="form-username form-control" id="name">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-password">Password</label>
                                        <input type="password" name="pass" placeholder="Password..." class="form-password form-control" id="pass">
                                    </div>
                                    <button type="submit" class="btn">Sign in!</button>
                                    </form>
                                -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 social-login">
                            <h3>...or login with:</h3>
                            <div class="social-login-buttons">
                                <a class="btn btn-link-2" href="#">
                                    <i class="fa fa-facebook"></i> Facebook
                                </a>
                                <a class="btn btn-link-2" href="#">
                                    <i class="fa fa-twitter"></i> Twitter
                                </a>
                                <a class="btn btn-link-2" href="#">
                                    <i class="fa fa-google-plus"></i> Google Plus
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
