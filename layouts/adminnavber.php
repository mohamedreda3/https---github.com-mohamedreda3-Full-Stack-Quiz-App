<nav class="flex align-center">
  <p><span>Quiz</span>zat</p>
  <div class="navbar">
        <div class="head">
            <div class="info">
                <img src="https://www.dlf.pt/dfpng/middlepng/481-4816679_user-login-png-gambar-icon-user-png-transparent.png" alt="Admin">
                <div class="name"><?php echo $getUserName; ?></div>
            </div>
            <div class="bars">
                <div class="bar"></div>
            </div>
        </div>
        <ul class="body">
        <li>Welcome : <?php echo $getUserName; ?></li>
        <li><a href="./teacher.php"> Add Teacher </a></li>
        <li><a href="subject.php"> Add Subject </a></li>
        <!-- <li><a href="student.php"> Add Student </a></li> -->
            <li><a href="./functions/logout.php">
                    <i class="icon fa fa-sign-out-alt"></i>
                    Log out
                </a></li>
        </ul>
    </div>
</nav>