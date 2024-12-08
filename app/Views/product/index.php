<?= $this->extend('layout/page-template'); ?>

<?= $this->section('content'); ?>
<div class="container my-3">
    <div class="row">
        <div class="col">
            <div class="row text-center">
                <h1
                    class="my-3 text_outline_1 text-white"
                    style="text-shadow: 3px 3px 0 #000;">
                    Sektor Market
                </h1>
            </div>
            <div class="row mt-3">
                <div class="card mx-auto text-justify text-bg-dark"
                    style="max-width:30rem;font-weight: 300;  
                    line-height: 1.6;  padding: 10px;  --bs-bg-opacity: 0.4">
                    Sektor kerajinan, hasil bumi, hasil laut, dan hasil tambang Indonesia menyediakan produk berkualitas untuk bersaing di pasar global.
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 row-cols-xxl-4 g-4 mt-4">
                <div class="col">
                    <div class="card bg-white border border-0" style="--bs-bg-opacity: 0">
                        <a href="<?= base_url('/product/product_home'); ?>" class="mx-auto">
                            <img src="<?= base_url('/img/menu/menu1.jpg'); ?>"
                                class="card-img-top rounded-circle mx-auto border border-3 border-dark"
                                alt="..." style="max-width:10rem;max-height:10rem"></a>
                        <div class="card-body ">
                            <p class="card-text text-center text-white text_outline_1">-Kerajinan Rumah Tangga-</p>
                        </div>

                    </div>
                </div>
                <div class="col">
                    <div class="card bg-white border border-0" style="--bs-bg-opacity: 0">
                        <a href="<?= base_url('/product/product_agri'); ?>" class="mx-auto">
                            <img src="<?= base_url('/img/menu/menu2.jpg'); ?>"
                                class="card-img-top rounded-circle mx-auto border border-3 border-dark"
                                alt="..." style="max-width:10rem;max-height:10rem">
                        </a>
                        <div class="card-body ">
                            <p class="card-text text-center text-white text_outline_1">-Hasil Bumi-</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-white border border-0" style="--bs-bg-opacity: 0">
                        <a href="<?= base_url('/product/product_sea'); ?>" class="mx-auto">
                            <img src="<?= base_url('/img/menu/menu3.jpg'); ?>"
                                class="card-img-top rounded-circle mx-auto border border-3 border-dark"
                                alt="..." style="max-width:10rem;max-height:10rem">
                        </a>
                        <div class="card-body ">
                            <p class="card-text text-center text-white text_outline_1">-Hasil Laut-</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-white border border-0" style="--bs-bg-opacity: 0">
                        <a href="<?= base_url('/product/product_mining'); ?>" class="mx-auto">
                            <img src="<?= base_url('/img/menu/menu4.jpg'); ?>"
                                class="card-img-top rounded-circle mx-auto border border-3 border-dark"
                                alt="..." style="max-width:10rem;max-height:10rem">
                        </a>
                        <div class="card-body ">
                            <p class="card-text text-center text-white text_outline_1">-Hasil Pertambangan-</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-white border border-0" style="--bs-bg-opacity: 0">
                        <a href="<?= base_url('/product/product_culinary'); ?>" class="mx-auto">
                            <img src="<?= base_url('/img/menu/menu5.jpg'); ?>"
                                class="card-img-top rounded-circle mx-auto border border-3 border-dark"
                                alt="..." style="max-width:10rem;max-height:10rem">
                        </a>

                        <div class="card-body ">
                            <p class="card-text text-center text-white text_outline_1">-Kuliner-</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card bg-white border border-0" style="--bs-bg-opacity: 0">
                        <a href="<?= base_url('/product/product_tour'); ?>" class="mx-auto">
                            <img src="<?= base_url('/img/menu/menu6.jpg'); ?>"
                                class="card-img-top rounded-circle mx-auto border border-3 border-dark"
                                alt="..." style="max-width:10rem;max-height:10rem">
                        </a>
                        <div class="card-body ">
                            <p class="card-text text-center text-white text_outline_1">-Wisata dan Umroh-</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>