<?= $this->extend('layout/page-template'); ?>

<?= $this->section('content'); ?>
<div class="container my-3">
    <div class="row">
        <div class="col mb-4">
            <h1
                class="my-3 text_outline_1 text-white"
                style="text-shadow: 3px 3px 0 #000;">
                <?= $title ?? 'Daftar Semua Produk'; ?>
            </h1>
        </div>
    </div>


    <div class="row card pt-3 bg-black bg-opacity-25">
        <div class="col mt-2">

            <?= $this->include('layout/page-flashdata'); ?>
            <div class="row">
                <div class="col">
                    <form action="" method="post">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Masukkan keyword pencarian.." name="keyword">
                            <button class="btn btn-outline-secondary text-white border-light" type="submit" name="submit">Cari</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col pt-3">
                    <?= $pager->simpleLinks('tableproduct', 'product_pagination'); ?>
                </div>

                <?php if ((logged_in())): ?>
                    <div class="col text-end">
                        <a href="<?= base_url('/product/create'); ?>" class="btn btn-primary my-3">+ Tambah Data Produk</a>
                    </div>
                <?php endif; ?>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Pos Kode</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                    <?php foreach ($product as $p) : ?>
                        <tr>
                            <th
                                class="align-middle bg-light"
                                style="--bs-bg-opacity: 0.5"
                                scope="row">
                                <?= $i++; ?>
                            </th>
                            <td class="align-middle bg-light bg-opacity-50">
                                <img
                                    class="border border-2 rounded-3 img-thumbnail"
                                    src="/img/product/<?= $p['cover']; ?>"
                                    onerror="if (this.src!='/img/product/not-found.jpg'){
                                        this.src='/img/product/not-found.jpg';}"
                                    alt=""

                                    style="max-width: 100px; " />
                            </td>
                            <td class="align-middle bg-light bg-opacity-50">
                                <?= $p['name']; ?>
                            </td>
                            <td class="align-middle bg-light bg-opacity-50">
                                <?= $p['postalcode']; ?>
                            </td>
                            <td class="align-middle bg-light bg-opacity-50">
                                <?=
                                msgfmt_format_message(
                                    "id",
                                    "{0, number, :: currency/IDR}",
                                    array($p['price'])
                                ); ?>
                            </td>

                            <td class="align-middle bg-light bg-opacity-50">
                                <?= ($p['stock'] > 0) ? $p['stock'] : "Habis"; ?>
                            </td>
                            <td class="align-middle bg-light bg-opacity-50">
                                <a href="/product/<?= $p['slug']; ?>" class="btn btn-success">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <?= $pager->links('tableproduct', 'product_pagination'); ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>