<section class="section">
    <div class="container mt-2">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="login-brand animate__bounceIn" id="title">
                    <img src="<?= base_url() ?>assets/icon/logoBKU-circle.png" alt="logo" width="100"
                        class="shadow-light rounded-circle">

                        <h1 class="mt-2">GLBKU</h1>
                        <h3 class="text-primary">SUMMARY REPORT</h3>
                        <h4>2022</h4>
                </div>

                <div class="card card-primary animate__bounceIn" id="loginForm">
                    <div class="card-header">
                        <h4>Login</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="<?= base_url() ?>login/proses_login" class="needs-validation"
                            novalidate="" >
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input id="username" type="username" class="form-control" name="user" tabindex="1"
                                    required autofocus>
                                <div class="invalid-feedback">
                                    Mohon masukan username !
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password" class="control-label">Password</label>
                                </div>
                                <input id="password" type="password" class="form-control" name="pwd" tabindex="2"
                                    required>
                                <div class="invalid-feedback">
                                    Mohon masukan password !
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" id="btnLogin" onclick="proses_login()"
                                    tabindex="4">
                                    Login
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="simple-footer">
                    Copyright © GLBKU 2022
                </div>
            </div>
        </div>
    </div>
</section>
</div>