<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">แดชบอร์ด</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-gradient-info">
                    <div class="inner">
                        <h3><?php $countPost = countPost($conn);
                            foreach ($countPost as $countPosts) { ?>
                                <?= $countPosts['noPosts'] ?>
                            <?php }
                            mysqli_free_result($countPost); ?>
                        </h3>

                        <p>จำนวนโพสต์</p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-table-cells"></i>
                    </div>
                    <a href="../admin?p=viewPost" class="small-box-footer">รายละเอียดเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-gradient-success">
                    <div class="inner">
                        <h3>
                            <?php $countReview = countReview($conn);
                            foreach ($countReview as $countReviews) { ?>
                                <?= $countReviews['noReview'] ?>
                            <?php }
                            mysqli_free_result($countReview); ?>
                        </h3>

                        <p>จำนวนการรีวิว </p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-star-half-stroke"></i>
                    </div>
                    <a href="../admin?p=viewReview" class="small-box-footer">รายละเอียดเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-gradient-warning">
                    <div class="inner">
                        <h3 class="text-white"><?php $countMember = countMember($conn);
                                                foreach ($countMember as $countMembers) { ?>
                                <?= $countMembers['noMember'] ?>
                            <?php }
                                                mysqli_free_result($countMember); ?></h3>

                        <p class="text-white">จำนวนผู้ใช้งาน</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">รายละเอียดเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">

                <!-- Post Management -->
                <?php
                include_once "post/postTable.php";
                ?>
                <!--/.Post Management -->

                <!-- Member card -->
                <?php
                include_once "member/memberTable.php";
                ?>
                <!-- /.card -->
            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 connectedSortable">
                <!-- Member card -->
                <?php
                include_once "faculty/facultyTable.php";
                ?>
                <!-- /.card -->

                <!-- review card -->
                <?php
                include_once "review/reviewTable.php";
                ?>
                <!-- /.card -->

            </section>
            <!-- right col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->


        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->