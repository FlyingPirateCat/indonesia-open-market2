<?= $this->extend('layout/page-template'); ?>
<?= $this->section('content'); ?>

<?php

use PHPUnit\TextUI\Configuration\Php;

$permitted = logged_in() && $auth->hasPermission('crud-product', user_id()); ?>
<?php $from_self = logged_in() && user_id() == $product['id_user']; ?>


<div class="container my-3">
    <div class="row">
        <div class="col">
            <h1 class="my-2 text_outline_1 text-white"
                style="text-shadow: 3px 3px 0 #000;">
                Detail Produk
            </h1>

            <?= $this->include('layout/page-flashdata'); ?>

            <div class="card my-3 bg-light bg-opacity-50">
                <div class="row g-0">
                    <div class="col-md-4 text-center p-3">
                        <img src="<?= base_url('/img/product/' . $product['cover']); ?>"
                            onerror="if (this.src!='/img/product/not-found.jpg'){
                  this.src='/img/product/not-found.jpg';}"
                            class="img-fluid w-100 border border-2 rounded-3" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <a href="<?= base_url('/product/all'); ?>" class="text-decoration-none">
                                <button class="close" type="button" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                            </a>
                            </button>
                            <h5 class="card-title"><b><?= $product['name']; ?></b></h5>
                            <p class="card-text"><b>Deskripsi:</b><br><?= $product['description']; ?></p>
                            <div class="row my-3">
                                <div class="col-sm-6 mb-3 mb-sm-0 mt-2">
                                    <p class="card-text"><b>Harga:</b><br>
                                        <?=
                                        msgfmt_format_message(
                                            "id",
                                            "{0, number, :: currency/IDR}",
                                            array($product['price'])
                                        ); ?>
                                    </p>
                                </div>
                                <?php if ($product['type'] < 4): ?>
                                    <div class="col-sm-6 mb-3 mb-sm-0 mt-2">
                                        <?php $weight = $product['weight'] ?? 0; ?>
                                        <?php $kilo = $weight / 1000; ?>
                                        <p class="card-text"><b>Berat Satuan:</b><br>
                                            <?= $weight > 1000 ? "$kilo Kg" : "$weight gr"; ?>
                                        </p>
                                    </div>
                                <?php endif; ?>
                                <div class="col-sm-6 mb-3 mb-sm-0 mt-2">
                                    <p class="card-text"><b>Stok:</b><br>
                                        <?= ($product['stock'] > 0) ? $product['stock'] : "Habis"; ?></p>
                                </div>
                            </div>
                            <p>
                                <?php if (isset($user)): ?>
                                    <?php if (logged_in()): ?>
                                        <?php if (!$from_self): ?>
                                            <?php if ($product['stock'] > 0) : ?>
                                                <a href="/product/add_cart/<?= $product['id']; ?>" class="btn btn-primary">
                                                    <i class="fa fa-shopping-cart"></i> Tambah ke Keranjang
                                                </a>
                                            <?php else : ?>
                                                <a href='#' class="btn btn-secondary disabled">Stok Habis</a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <a href="<?= base_url('/login'); ?>" class="btn btn-primary">
                                            Silahkan Login
                                        </a>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <a href='#' class="btn btn-secondary disabled">Penjual Tidak Ada</a>
                                <?php endif; ?>
                            </p>
                            <?php if ($permitted): ?>
                                <?php if ($from_self): ?>
                                    <a href="<?= base_url('/product/edit/' . $product['slug']); ?>"><button class="btn btn-warning d-inline"><i class="fa fa-pen"> Edit</i></button></a>
                                    <form action="<?= base_url('/product/' . $product['id']); ?>" method="post" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?');"><i class="fa fa-trash"> Delete</i></button>
                                    </form>
                                <?php endif; ?>
                            <?php endif; ?>
                            <p class="card-text mt-2">
                                <small class="text-body-secondary">
                                    Last updated: <?php $upd = (empty($product['updated_at']) ? strtotime(time()) : $product['updated_at']);
                                                    $upd = CodeIgniter\I18n\Time::parse($upd);
                                                    echo $upd . " (" . $upd->humanize() . ")"; ?>
                                </small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (isset($user)): ?>
                <div class="card bg-light bg-opacity-50">
                    <h5 class="card-header">Profil Penjual</h5>
                    <div class="card mb-3 bg-light bg-opacity-50" style="--bs-bg-opacity: 0.0">
                        <div class="row g-0">
                            <div class="col-md-3 text-center p-3">
                                <img src="/img/user/<?= $user['user_image']; ?>"
                                    onerror="if (this.src!='/img/product/not-found.jpg'){
                                              this.src='/img/product/not-found.jpg';}"
                                    class="img-fluid w-100 border border-2 rounded-3 label-img" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title text-center notranslate"><b>@<?= $user['username']; ?></b></h5>
                                    <table class="table mt-3 ">
                                        <thead>
                                            <tr>
                                                <td class="align-middle bg-light bg-opacity-10 text-right" width="20%">
                                                    <span class="card-text"><b>Kios Agen:</b></span>
                                                </td>
                                                <td class="align-middle bg-light bg-opacity-10 notranslate" width="80%">
                                                    <?= $user['shopname']; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle bg-light bg-opacity-10 text-right">
                                                    <span class="card-text"><b>Alamat:</b></span>
                                                </td>
                                                <td class="align-middle bg-light bg-opacity-10">
                                                    <?= $user['street_address'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle bg-light bg-opacity-10 text-right">
                                                    <span class="card-text"><b>Kode Pos:</b></span>
                                                </td>
                                                <td class="align-middle bg-light bg-opacity-10">
                                                    <?php $pos =  $user['postalcode']; ?>
                                                    <?php $posdata = $kodepos->getData('kodepos', $pos) ?>
                                                    <?= $pos; ?><?= !empty($posdata) ? ' - ' . $posdata['kabupaten'] : ''; ?>
                                                </td>
                                            </tr>
                                        </thead>
                                    </table>
                                    <a href="<?= base_url('/user/' .  $user['id']); ?>" class="btn btn-primary my-3">
                                        Detail Penjual
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>