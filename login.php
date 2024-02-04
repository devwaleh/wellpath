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
                    <h2>Login</h2>
                    <p>or <a href="signup.php">create an account</a></p>
                    <form action="process/process_login.php" method="post">
                        <input type="email" name="mail" id="mail" class="form-control border-dark my-2" placeholder="Email Address">
                        <input type="password" name="pass" id="pass" class="form-control border-dark my-2" placeholder="Password">
                        <button type="submit" class="btn btn-primary col-12">Login</button>
                    </form>
                </div>
            </div>
        </main>

 <?php
    require_once('partials/login_footer.php');
?>

</body>
</html>