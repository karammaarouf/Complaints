

<nav class="page-sidebar" id="sidebar">
            <div id="sidebar-collapse">
                <div class="admin-block d-flex">
                    <div>
                        <img src="../css/assets/img/admin-avatar.png" width="45px" />
                    </div>
                    <div class="admin-info">

                        <div class="font-strong"><?= $_SESSION['user_name'] ?></div><small><?= $_SESSION['type'] ?></small></div>

                </div>
                <ul class="side-menu metismenu">
                    <li>
                        <a class="active" href="../index.php"><i class="sidebar-item-icon fa fa-home"></i>
                            <span class="nav-label">Home</span>
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