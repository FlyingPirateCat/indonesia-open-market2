<?= $this->extend('layout/account-template'); ?>


<?= $this->section('content'); ?>

<div class="container-fluid my-3">
    <div class="row">
        <div class="col-10 mb-4  mx-auto">
            <h1
                class="my-3 text_outline_1 text-white"
                style="text-shadow: 3px 3px 0 #000;">
                <?= $title ?? ''; ?>
            </h1>
        </div>
    </div>


    <div class="row ">

        <div class="col-10  mx-auto">

            <div class="card bg-black bg-opacity-25">
                <ul class="nav nav-tabs mb-3 ">
                    <li class="nav-item">
                        <a class="nav-link <?= ($type == 0) ? 'text-black active' : 'text_outline_1 text-white'; ?>"
                            aria-current="<?= ($type == 0) ? 'page' : ''; ?>"
                            href="/user/sales">Belum Dibayar
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($type == 1) ? 'text-black active' : 'text_outline_1 text-white'; ?>"
                            aria-current="<?= ($type == 1) ? 'page' : ''; ?>"
                            href="/user/sales/1">Proses Verifikasi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($type == 2) ? 'text-black active' : 'text_outline_1 text-white'; ?>"
                            aria-current="<?= ($type == 2) ? 'page' : ''; ?>"
                            href="/user/sales/2">Sudah Dibayar
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($type == 3) ? 'text-black active' : 'text_outline_1 text-white'; ?>"
                            aria-current="<?= ($type == 3) ? 'page' : ''; ?>"
                            href="/user/sales/3">Pengemasan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($type == 4) ? 'text-black active' : 'text_outline_1 text-white'; ?>"
                            aria-current="<?= ($type == 4) ? 'page' : ''; ?>"
                            href="/user/sales/4">Pengiriman
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($type == 5) ? 'text-black active' : 'text_outline_1 text-white'; ?>"
                            aria-current="<?= ($type == 5) ? 'page' : ''; ?>"
                            href="/user/sales/5">Barang Sampai
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($type == 6) ? 'text-black active' : 'text_outline_1 text-white'; ?>"
                            aria-current="<?= ($type == 6) ? 'page' : ''; ?>"
                            href="/user/sales/6">Selesai
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($type == 7) ? 'text-black active' : 'text_outline_1 text-white'; ?>"
                            aria-current="<?= ($type == 7) ? 'page' : ''; ?>"
                            href="/user/sales/7">Dibatalkan
                        </a>
                    </li>
                </ul>
                <div class="d-flex justify-content-center row">
                    <div class="col-md-11">
                        <div class="rounded card p-1 mb-3 bg-white bg-opacity-100">
                            <div class="table-responsive table-borderless">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Order #</th>
                                            <th>Nama Pembeli</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th>Dibuat</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-body">
                                        <?php $idr = "{0, number, :: currency/IDR}"; ?>
                                        <?php foreach ($ordermodel as $key => $model): ?>
                                            <tr class="cell-1">
                                                <td><a href="/order/invoice/<?= $model['ordercode']; ?>"><?= $model['ordercode']; ?></td>
                                                <?php $user = $users->select('fullname'); ?>
                                                <?php $user->where(['id' => $model['id_buyer']]); ?>
                                                <td><?= $user->first()->fullname; ?></td>
                                                <?php
                                                $status = $model['status'];
                                                $badge = 'badge-info';
                                                if ($status == "Belum Dibayar") {
                                                    $badge = 'badge-danger';
                                                } elseif ($status == "Dibatalkan") {
                                                    $badge = 'badge-danger';
                                                } elseif ($status == "Pengemasan") {
                                                    $badge = 'badge-info';
                                                } elseif ($status == "Pengiriman") {
                                                    $badge = 'badge-info';
                                                } elseif ($status == "Selesai") {
                                                    $badge = 'badge-success';
                                                }
                                                ?>
                                                <td><span class="badge <?= $badge; ?>"><?= $status; ?></span></td>
                                                <td class="notranslate"><?= msgfmt_format_message("id", $idr, array($orders[$key]['total']));  ?></td>
                                                <?php $date = date_create($model['created_at']); ?>
                                                <td><?= date_format($date, "j-M-Y",); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        $('.toggle-btn').click(function() {
            $(this).toggleClass('active').siblings().removeClass('active');
        });

    });
</script>
<?= $this->endSection(); ?>