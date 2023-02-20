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
            <div class="col-lg-3 col-6">
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
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-gradient-success">
                    <div class="inner">
                        <h3>53<sup style="font-size: 20px">%</sup></h3>

                        <p>Bounce Rate</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">รายละเอียดเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-gradient-warning">
                    <div class="inner">
                        <h3><?php $countMember = countMember($conn);
                            foreach ($countMember as $countMembers) { ?>
                                <?= $countMembers['noMember'] ?>
                            <?php }
                            mysqli_free_result($countMember); ?></h3>

                        <p>จำนวนผู้ใช้งาน</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">รายละเอียดเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-gradient-danger">
                    <div class="inner">
                        <h3>65</h3>

                        <p>Unique Visitors</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">รายละเอียดเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
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

            </section>
            <!-- right col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->


        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->