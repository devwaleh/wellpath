<?php

    error_reporting(E_ALL);
    session_start();
    require_once('partials/head.php');
    require_once('partials/login_head.php');

?>

                <div class="col-md pe-5 text-center py-2">
                    <?php
                        require_once('session_messages.php');
                    ?>
                    <h2>Create an Account</h2>
                    <p>Have an account already? <a href="login.php">Login to your account</a></p>
                    <form action="process/process_signup.php" method="post">
                        <div>
                            <input type="text" name="user" id="user" class="form-control border-dark mb-2" placeholder="Username">
                        </div>
                        <div>
                            <input type="email" name="mail" id="mail" class="form-control border-dark mb-2" placeholder="Email Address">
                        </div>
                        <div>
                            <input type="password" name="password" id="password" class="form-control border-dark mb-2" placeholder="Choose Password">
                        </div>
                        <div>
                            <input type="password" name="cpassword" id="cpassword" class="form-control border-dark mb-2" placeholder="Confirm Password">
                        </div>
                        <p id="feedback" class="text-danger text-start"></p>
                        <span>By creating an account, you agree to our <a href="policydocs/terms.txt" target="_blank">terms of service</a></span>
                        <button type="submit" class="btn btn-primary col-12 my-2">Create Account</button>
                    </form>
                </div>
            </div>
        </main>

        <?php
    require_once('partials/login_footer.php');
?>

    <script src="assets/css/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#cpassword').change(function(){
                var password = $('#password').val();
                var confirmPassword = $('#cpassword').val();
                if (password != confirmPassword) {
                    $('#feedback').text('Passwords must be the same');
                } else{
                    $('#feedback').text('');
                }
            });
        });
    </script>

</body>
</html>