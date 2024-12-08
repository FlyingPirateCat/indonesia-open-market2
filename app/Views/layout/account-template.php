<!DOCTYPE html>
<html lang>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title ?? ''; ?></title>

    <?= $this->include('layout/page-linkstyle'); ?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?= $this->include('layout/account-sidebar'); ?>
        <!-- End of Sidebar -->


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content" class="min-vh-100 pb-2 header_background">

                <!-- Topbar -->
                <?= $this->include('layout/page-navbar'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <?= $this->renderSection('content'); ?>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?= $this->include('layout/page-footer'); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <?= $this->include('layout/account-navlogoutmodal'); ?>



    <?= $this->include('layout/page-linkscript'); ?>




</body>

</html>