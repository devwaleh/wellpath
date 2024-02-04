<?php

    error_reporting(E_ALL);
    require_once('partials/head.php');

?>
<body>
    
    <div class="container-fluid">
        <head>
            <div class="row py-3" id="mynav">
                <div class="col">
                    <nav class="d-flex justify-content-around">
                        <div class="col ps-4">
                            <a class="navbar-brand fs-2" href="index.php"><i class="fa-solid fa-person-running"></i> WellPath</a>
                        </div>
                        <div class="col-md-2 pe-1">
                            <a href="login.php" class="btn btn-primary">Login</a>
                            <a href="signup.php" class="btn btn-info">Sign Up</a>
                        </div>
                    </nav>
                </div>
            </div>
        </head>

        <main>
            <div class="row justify-content-center pt-5 text-light animate__animated animate__slideInDown" id="hero">
                <div class="col-md-6 text-center pt-4">
                    <h3 class="fs-1 mt-5"><i class="fa-solid fa-person-running"></i></h3>
                    <h1>WellPath</h1>
                    <h3>Attain your fitness aspirations with WellPath</h3>
                    <p class="fs-5 mb-3">Embrace a healthier lifestyle effortlessly with the all-in-one app designed to support your wellness journey</p>
                    <a href="signup.php" class="btn btn-info col-6">Get started today</a>
                    <div class="my-5 py-4"><a href="#enter" class="fs-4"><i class="fa-solid fa-circle-chevron-down fa-lg" style="color: #251f51;"></i></a></div>
                </div>
            </div>
            <div class="row justify-content-center py-5 bg-primary text-light" id="enter">
                <div class="col-md-6 text-center pt-3">
                    <h4>Fitness Objectives for Enhanced Well-being</h4>
                    <p class="fs-5">Regular physical activity is crucial for maintaining good health, but what amount and type of exercise is optimal for you?</p>
                    <p class="mt-3 fs-5">The pursuit of personal goals can be an enriching and rewarding endeavor, leading to a more fulfilling and successful life. However, achieving these objectives often requires a shift in mindset and a willingness to adopt new habits that align with your aspirations. Embarking on this journey of self-improvement necessitates a comprehensive approach that encompasses understanding effective strategies, tracking progress, and making necessary adjustments along the way.</p>
                    <p class="mt-3 fs-5">The journey of habit formation and goal attainment is an ongoing process that requires dedication, flexibility, and a willingness to embrace continuous learning. By understanding the science behind habit formation, employing effective strategies, tracking your progress, and incorporating fitness into your routine, you can successfully transform your habits, achieve your goals, and lead a more fulfilling and successful life.</p>
                </div>
            </div>
            <div class="row ps-5 mt-2 align-items-center animate__animated animate__slideInLeft">
                <div class="col-md-6 py-5">
                    <h4>Personalized coaching for your unique needs and goals</h4>
                    <p>Achieve your fitness goals seamlessly with customized coaching and actionable insights derived from your health and activity history. WellPath effortlessly simplifies progress tracking and activity monitoring right from your phone.</p>
                </div>
                <div class="col-md-4">
                    <img src="assets/images/fitness.png" alt="jogging" class="img-fluid">
                </div>
            </div>
            <div class="row justify-content-end align-items-center animate__animated animate__slideInRight">
                <div class="col-md-4">
                    <img src="assets/images/journaling.png" alt="journaling" class="img-fluid">
                </div>
                <div class="col-md-6 pe-5 py-5">
                    <h4>Transform every physical activity into a stepping stone towards your goals</h4>
                    <p>WellPath helps you make the most of every movement, from vigorous workouts to leisurely strolls, by seamlessly integrating with your favorite apps and health devices. This comprehensive approach provides a holistic view of your health and ensures that every step you take counts.</p>
                </div>
            </div>
            <div class="row justify-content-end bg-primary text-light py-5 mb-3">
                <div class="col-md-6 py-5">
                    <h3 class="my-3">Get Fit on any device</h3>
                    <a href="login.php" class="btn btn-light mt-2">Login</a>
                    &nbsp;
                    <a href="signup.php" class="btn btn-info mt-2">Sign Up</a>
                </div>
            </div>
        </main>

        <footer>
            <div class="row bg-dark text-light py-2">
                <div class="col ps-4">
                    <a class="footer-text fs-2 pt-3" href="index.php"> WellPath</a>
                </div>
                <div class="col pt-3 text-center">
                    <a href="policydocs/privacy.txt" class="footer-text" target="_blank">Privacy</a>
                    &nbsp;
                    <a href="policydocs/terms.txt" class="footer-text" target="_blank">Terms</a>
                </div>
                <dic class="col pt-3 text-center">
                    <p>&copy;2023</p>
                </dic>
            </div>
        </footer>
    </div>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>