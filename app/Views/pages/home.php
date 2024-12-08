<?= $this->extend('layout/page-template'); ?>

<?= $this->section('content'); ?>
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col">
            <div
                class="card  bg-light bg-opacity-50"
                style="max-width: 38rem;">
                <div class="card-body">
                    <h1
                        class="card-title text_outline_1 text-white"
                        style="text-shadow: 3px 3px 0 #000; ">
                        Indonesia <span class="text-warning">OpenMarket</span>
                    </h1>
                    <p
                        class="card-text text_outline_1 text-white">
                        Indonesia memiliki potensi besar di pasar global berkat kekayaan
                        sumber daya alam yang melimpah, seperti minyak, gas, dan hasil
                        pertanian. <br />
                        Indonesia Open Market dapat menjadi solusi efektif untuk
                        memanfaatkan potensi ini melalui perdagangan elektronik dengan
                        meningkatkan akses ke pasar internasional.
                    </p>
                    <a href="/product" class="btn btn-primary btn-lg">
                        <small>Sektor Market</small>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>