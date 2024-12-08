<?= $this->extend('layout/page-template'); ?>

<?= $this->section('content'); ?>
<div class="container my-3">
    <div class="row">
        <div class="col">
            <h1
                class="my-3 text_outline_1 text-white"
                style="text-shadow: 3px 3px 0 #000;">

            </h1>


            <div class="card bg-light bg-opacity-50">
                <h5 class="card-header"></h5>
                <div class="card mb-3 bg-light bg-opacity-50" style="--bs-bg-opacity: 0.0">
                    <div class="row g-0">
                        <div class="col-md-3 text-center p-3">
                            <img src="<?= base_url('/img/lambang.png'); ?>"
                                class="img-fluid w-100 border border-2 rounded-3 bg-light label-img" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title text-center"><b>Link Terkait</b></h5>
                                <table class="table mt-3 ">
                                    <thead>
                                        <tr>
                                            <td class="align-middle bg-light bg-opacity-10 ">
                                                <a class="text-decoration-none" href="https://infoharga.bappebti.go.id/menu_utama">Kemendag</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle bg-light bg-opacity-10 ">
                                                <a class="text-decoration-none" href="https://kemlu.go.id/">Kemenlu</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle bg-light bg-opacity-10 ">
                                                <a class="text-decoration-none" href="https://www.bi.go.id/id/statistik/informasi-kurs/transaksi-bi/default.aspx">Kurs Valas BI</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle bg-light bg-opacity-10 ">
                                                <a class="text-decoration-none" href="https://umkm.depkop.go.id/">Data UMKM</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle bg-light bg-opacity-10 ">
                                                <a class="text-decoration-none" href="https://www.kpu.go.id/dmdocuments/Data_Agregat_WNI.pdf">Agregat WNI</a>
                                            </td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
<?= $this->endSection(); ?>