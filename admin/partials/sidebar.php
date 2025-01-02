

<nav class="page-sidebar" id="sidebar">
            <div id="sidebar-collapse">
                <div class="admin-block d-flex">
                    <div>
                        <img src="../css/assets/img/admin-avatar.png" width="45px" />
                    </div>
                    <div class="admin-info">
<<<<<<< HEAD
                        <div class="font-strong">ماعرفت جيب الاسم</div><small><?php echo $_SESSION["type"]; ?></small></div>
=======
                        <div class="font-strong"><?= $_SESSION['user_name'] ?></div><small>Administrator</small></div>
>>>>>>> bc903e7fa18b97abfca9b60f8d1b446fa60d78d8
                </div>
                <ul class="side-menu metismenu">
                    <li>
                        <a class="active" href="./dashboard.php"><i class="sidebar-item-icon fa fa-th-large"></i>
                            <span class="nav-label">Dashboard</span>
                        </a>
                        <a class="active" href="../index.php"><i class="sidebar-item-icon fa fa-home"></i>
                            <span class="nav-label">index</span>
                        </a>
                        
                    </li>
                    <li class="heading">FEATURES</li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-file-text"></i>
                            <span class="nav-label">Complaints</span><i class="fa fa-angle-left arrow"></i>
                        </a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href="./complaints.php">View Complaints</a>
                            </li>
                        </ul>
                    </li>

                    <li class="heading">PAGES</li>
                   </ul>
            </div>
        </nav>