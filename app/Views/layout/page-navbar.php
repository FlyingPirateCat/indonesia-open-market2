<nav class="navbar navbar-expand navbar-light bg-black topbar mb-4 static-top shadow">

    <div class="navbar-brand ml-4 d-none d-md-block">
        <a class="nav-link text-light notranslate" href="<?= base_url(); ?>">
            <em>Indonesia OpenMarket</em>
        </a>
    </div>

    <div class="navbar-nav ml-4 d-none d-sm-block">
        <a class="nav-link text-light" aria-current="page" href="<?= base_url(); ?>">Beranda</a>
    </div>
    <div class="navbar-nav d-none d-sm-block">
        <a class="nav-link text-light" aria-current="page" href="/product">Produk</a>
    </div>
    <div class="navbar-nav d-none d-sm-block">
        <a class="nav-link text-light" aria-current="page" href="/about">About Us</a>
    </div>

    <ul class="navbar-nav ml-4 d-block d-sm-none">
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-list fa-fw"></i>
            </a>
            <div class="dropdown-list dropdown-menu dropdown-menu-left shadow animated--grow-in bg-dark "
                style="--bs-bg-opacity: 0.9"
                aria-labelledby="messagesDropdown">
                <a class="dropdown-item d-flex align-items-center text-center text_outline_1 text-bg-dark" href="<?= base_url(); ?>">
                    Beranda
                </a>
                <a class="dropdown-item d-flex align-items-center text-center text_outline_1 text-bg-dark" href="/product">
                    Produk
                </a>
                <a class="dropdown-item d-flex align-items-center text-center text_outline_1 text-bg-dark" href="/about">
                    About Us
                </a>
            </div>
        </li>
    </ul>


    <ul class="navbar-nav ml-auto">
        <?= $this->include('layout/page-navgoogletrans'); ?>

        <!-- Nav Item - User Information -->
        <?php if ((logged_in())): ?>
            <?= $this->include('layout/account-navcart'); ?>
            <?= $this->include('layout/account-navuserinfo'); ?>
        <?php else : ?>
            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow mx-1 align-middle">
                <a class="nav-link mr-3 mt-3 btn bg-secondary bg-opacity-50 btn-info px-4 align-middle notranslate"
                    href="/login" style="height: 32px;"><i class="fas fa-user fa-fw"></i> Login
                </a>
            </li>
        <?php endif ?>

    </ul>

</nav>