<?= $this->extend('layout/page-template'); ?>

<?= $this->section('content'); ?>

<?php $permitted = logged_in() && $auth->hasPermission('crud-product', user_id()); ?>

<div class="container my-3">
    <div class="row">
        <div class="col mb-4">
            <h1
                class="my-3 text_outline_1 text-white"
                style="text-shadow: 3px 3px 0 #000;">
                <?= $title ?? ''; ?>
            </h1>
        </div>
    </div>


    <div class="row card bg-black bg-opacity-25">

        <ul class="nav nav-tabs mb-3 ">
            <li class="nav-item">
                <a class="nav-link <?= ($type == -1) ? 'text-black active' : 'text_outline_1 text-white'; ?>"
                    aria-current="<?= ($type == -1) ? 'page' : ''; ?>"
                    href="/product/all">Semua Produk
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($type == 0) ? 'text-black active' : 'text_outline_1 text-white'; ?>"
                    aria-current="<?= ($type == 0) ? 'page' : ''; ?>"
                    href="/product/product_home">Kerajinan Rumah Tangga
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($type == 1) ? 'text-black active' : 'text_outline_1 text-white'; ?>"
                    aria-current="<?= ($type == 1) ? 'page' : ''; ?>"
                    href="/product/product_agri">Hasil Bumi
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($type == 2) ? 'text-black active' : 'text_outline_1 text-white'; ?>"
                    aria-current="<?= ($type == 2) ? 'page' : ''; ?>"
                    href="/product/product_sea">Hasil Laut
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($type == 3) ? 'text-black active' : 'text_outline_1 text-white'; ?>"
                    aria-current="<?= ($type == 3) ? 'page' : ''; ?>"
                    href="/product/product_mining">Hasil Pertambangan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($type == 4) ? 'text-black active' : 'text_outline_1 text-white'; ?>"
                    aria-current="<?= ($type == 4) ? 'page' : ''; ?>"
                    href="/product/product_culinary">Kuliner
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($type == 5) ? 'text-black active' : 'text_outline_1 text-white'; ?>"
                    aria-current="<?= ($type == 5) ? 'page' : ''; ?>"
                    href="/product/product_tour">Wisata dan Umroh
                </a>
            </li>
        </ul>
        <div class="col mt-2">

            <?= $this->include('layout/page-flashdata'); ?>

            <div class="row">
                <div class="col">
                    <form action="" method="post">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control"
                                placeholder="Masukkan keyword pencarian.." name="keyword">
                            <button class="btn btn-outline-secondary text-white border-light"
                                type="submit" name="submit"><i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row ">
                <div class="col pt-3">
                    <?= $pager->simpleLinks($ptable, 'product_pagination'); ?>
                </div>
                <div class="col text-end">
                    <?php if ($permitted): ?>
                        <a href="<?= base_url('/product/create'); ?>" class="btn btn-primary my-3">+ Tambah Data Produk</a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 mb-2 g-4 ">
                <?php foreach ($product as $p) : ?>

                    <?php $from_self = user_id() == $p['id_user']; ?>
                    <div class="card mx-auto bg-white bg-opacity-50" style="width: 14rem;">
                        <a href="<?= base_url('/product/' . $p['slug']); ?>" class="mx-auto">
                            <img
                                class="card-img-top rounded-circle mx-auto mt-2 border border-2 rounded-3 img-thumbnail"
                                src="<?= base_url('/img/product/' . $p['cover']); ?>"
                                onerror="if (this.src!='/img/product/not-found.jpg'){
                                        this.src='/img/product/not-found.jpg';}"
                                style="width: 12rem; height:12rem " />

                        </a>
                        <div class="card-body">
                            <h6 class="card card-title bg-white bg-opacity-50 p-1 mb-2 text-center align-middle"
                                style="height:32px">
                                <span class="small"><?= $p['name']; ?></span>
                            </h6>
                            <p class="card-text">
                                <?= msgfmt_format_message(
                                    "id",
                                    "{0, number, :: currency/IDR}",
                                    array($p['price'])
                                ); ?><br>
                                <?= ($p['stock'] > 0) ? 'Stok: ' . $p['stock'] : "Habis"; ?><br>
                                <?php if ($p['type'] < '4'): ?>
                                    Berat: <?= $p['weight']; ?> gr
                                <?php endif; ?>

                            </p>


                            <div class="row text-end">
                                <?php if (logged_in()): ?>
                                    <?php if (!$from_self): ?>
                                        <div class="col " style="width:50px">
                                            <?php if ($p['stock'] > 0) : ?>
                                                <a href="/product/add_cart/<?= $p['id']; ?>" class="btn btn-primary">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </a>
                                            <?php else: ?>
                                                <a href='#' class="btn btn-secondary disabled">
                                                    <i class="fa fa-times-circle"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($permitted): ?>
                                        <?php if ($from_self): ?>
                                            <div class="col " style="width:50px">
                                                <a href="/product/edit/<?= $p['slug']; ?>"><button class="btn btn-warning d-inline small"><i class="fa fa-pen"></i></button></a>
                                                <form action="/product/<?= $p['id']; ?>" method="post" class="d-inline">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?');"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </div>

                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
            <?= $pager->links($ptable, 'product_pagination'); ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>