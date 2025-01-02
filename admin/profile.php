
<div class="page-heading">
    <h1 class="page-title">Profile</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">Profile</li>
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="row">
        <div class="col-lg-3 col-md-4">
            <div class="ibox">
                <div class="ibox-body text-center">
                    <div class="m-t-20">
                        <img class="img-circle" src="http://localhost/Complaints/css/assets/img/admin-avatar.png" />
                    </div>
                    <h5 class="font-strong m-b-10 m-t-10"><?= $_SESSION['user_name'] ?></h5>
                    <div class="m-b-20 text-muted">Web Developer</div>
                    <div class="profile-social m-b-20">
                        <a href="javascript:;"><i class="fa fa-twitter"></i></a>
                        <a href="javascript:;"><i class="fa fa-facebook"></i></a>
                        <a href="javascript:;"><i class="fa fa-pinterest"></i></a>
                        <a href="javascript:;"><i class="fa fa-dribbble"></i></a>
                    </div>
                   
                </div>
            </div>
            <div class="ibox">
                <div class="ibox-body">
                    <div class="row text-center m-b-20">
                        <div class="col-4">
                            <div class="font-24 profile-stat-count">15</div>
                            <div class="text-muted">الشكاوي المنتظرة</div>
                        </div>
                        <div class="col-4">
                            <div class="font-24 profile-stat-count">20</div>
                            <div class="text-muted">الشكاوي المحلولة</div>
                        </div>
                        <div class="col-4">
                            <div class="font-24 profile-stat-count">15</div>
                            <div class="text-muted">الرسائل</div>
                        </div>
                    </div>
                    <p class="text-center">Lorem Ipsum is simply dummy text of the printing and industry. Lorem Ipsum
                        has been</p>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-8">
            <div class="ibox">
                <div class="ibox-body">
                    <ul class="nav nav-tabs tabs-line">

                        <li class="nav-item">
                            <a class="nav-link" href="#tab-2" data-toggle="tab"><i class="ti-settings"></i> Settings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab-3" data-toggle="tab"><i class="ti-announcement"></i>
                                Complaints</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        
                        <div class="tab-pane fade" id="tab-2">
                            <form action="dashboard.php" method="post">
                            <input type="hidden" name="id" value="<?= $user['id'] ?>" >
                                <div class="row">
                                    <div class="col-sm-6 form-group">
                                        <label>Full Name</label>
                                        <input name="fullname" class="form-control" type="text" placeholder="First Name" value="<?= $user['fullname'] ?>" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="email" class="form-control" type="text" placeholder="Email address" value="<?= $user['email'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input name="password" class="form-control" type="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label class="ui-checkbox">
                                        <input type="checkbox">
                                        <span class="input-span"></span>Remamber me</label>
                                </div>
                                <div class="form-group">
                                    <input name="update_profile" class="btn btn-default" type="submit" value="Update">
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="tab-3">
                            <h5 class="text-info m-b-20 m-t-20"><i class="fa fa-bullhorn"></i> Latest Complaints</h5>
                            <ul class="media-list media-list-divider m-0">
                                <!-- عرض الشكاوي -->
                                <?php foreach($complaints as $complaint): ?>
                                <li class="media">
                                    <div class="media-img"><i class="ti-user font-18 text-muted"></i></div>
                                    <div class="media-body">
                                        <div class="media-heading"><?= $complaint['type'] ?><small
                                                class="float-right text-muted"><?= $complaint['submission_date'] ?></small></div>
                                        <div class="font-13"><?= $complaint['description'] ?></div>
                                    </div>
                                </li>
                                <?php endforeach ?>
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
    .profile-social a {
        font-size: 16px;
        margin: 0 10px;
        color: #999;
    }

    .profile-social a:hover {
        color: #485b6f;
    }

    .profile-stat-count {
        font-size: 22px
    }
    </style>
</div>
