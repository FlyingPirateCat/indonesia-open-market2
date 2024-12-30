<?= $this->extend('layout/page-template'); ?>



<?= $this->section('content'); ?>

<?php $editAsUser  = user_id() == $ordermodel[0]['id_buyer']; ?>
<?php $editAsAdmin = in_groups('admin'); ?>

<div id="app" class="container invoice">
    <?= $this->include('layout/page-flashdata'); ?>
    <?php $i = 0; ?>
    <?php foreach ($orders as $key => $values):  ?>

        <div class="row mb-2" style="min-height: 780px;">

            <?php $i++; ?>
            <!-- data -->
            <div class="col-4 data py-4">
                <div class="line mt-4 mb-4"></div>
                <h1>INVOICE</h1>

                <div class="data-box">
                    <div class="data-separator d-block my-2"></div>
                    <h4 class="text-muted font-weight-light">No.</h4>
                    <h4 class="font-weight-bold"><?= $orders[0]['ordercode']; ?></h4>
                </div>
                <div class="data-box">
                    <div class="data-separator d-block my-2"></div>
                    <h4 class="text-muted font-weight-light">INVOICE DATE</h4>
                    <?php $date = date_create($ordermodel[0]['created_at']); ?>
                    <h4 class="font-weight-bold"><?= date_format($date, "F j\, Y",); ?></h4>
                </div>
                <div class="data-box">
                    <div class="data-separator d-block my-2"></div>
                    <h4 class="text-muted font-weight-light">DUE DATE</h4>
                    <?php $date = date_create($ordermodel[0]['created_at']); ?>
                    <?php date_add($date, date_interval_create_from_date_string("1 day")); ?>
                    <h4 class="font-weight-bold"><?= date_format($date, "F j\, Y",); ?></h4>
                </div>
                <?php $status = $ordermodel[0]['status']; ?>
                <div class="data-box mb-2">
                    <h5 class="font-weight-bold">STATUS</h5>
                    <h6 class="font-weight-light"><?= strtoupper($status); ?></h6>
                </div>



            </div>
            <!-- end data -->

            <!-- content -->
            <div class="col-8 content py-4" style="background-color: #f1f1f1;padding-right: 45px;">
                <div class="line mt-4 mb-4"></div>
                <!-- header -->
                <div class="header">
                    <div class="row">
                        <div class="col-6 from">

                            <?php $seller = $users->select('*'); ?>
                            <?php $seller = $seller->where(["id" => $ordermodel[$key]['id_seller']])->first(); ?>
                            <span class="d-block font-weight-light">FROM:</span>
                            <h3><?= $seller->shopname; ?></h3>
                            <span class="d-block font-weight-light"><?= $seller->street_address; ?></span>
                            <span class="d-block font-weight-light">Kode Pos: <?= $seller->postalcode; ?></span>
                            <span class="d-block font-weight-light">WhatsApp: <?= $seller->phone; ?></span>
                            <span class="d-block font-weight-light"><?= $seller->email; ?></span>
                        </div>
                        <div class="col-6 to">
                            <span class="d-block font-weight-light">TO:</span>
                            <h3><?= $orders[0]['receiverName']; ?></h3>
                            <span class="d-block font-weight-light"><?= $orders[0]['receiverAddress']; ?></span>
                            <span class="d-block font-weight-light">Kode Pos: <?= $orders[0]['receiverPoscode']; ?></span>
                            <span class="d-block font-weight-light">WhatsApp: <?= $orders[0]['receiverPhone']; ?></span>
                            <?php $user = $users->select('email'); ?>
                            <?php $user = $user->where(['id' => $ordermodel[0]['id_buyer']])->first(); ?>
                            <span class="d-block font-weight-light"><?= $user->email; ?></span>
                        </div>
                    </div>
                </div>
                <!-- end header -->

                <!-- items-header -->
                <div class="items-header">
                    <div class="row mt-4 items-header font-weight-bold">
                        <div class="col-12 my-2">
                            <div class="line"></div>
                        </div>
                        <div class="col-5">PRODUCT</div>
                        <div class="col-2 text-center">PRICE</div>
                        <div class="col-2 text-center">QUANTITY</div>
                        <div class="col-3 text-right">TOTAL</div>
                        <div class="col-12 my-2">
                            <div class="line"></div>
                        </div>
                    </div>
                </div>
                <!-- end items-header -->

                <!-- items -->
                <div class="items">

                    <?php $idr = "{0, number, :: currency/IDR unit-width-narrow}"; ?>
                    <?php foreach ($values['items'] as $key2 => $items): ?>
                        <div class="row mt-2 list-content">
                            <div class="col-5">
                                <p class="without-margin"><?= $items->name; ?></p>
                                <?php $seller = $users->select('*'); ?>
                                <?php $seller = $seller->where(["id" => $ordermodel[$key]['id_seller']])->first(); ?>
                                <p class="without-margin text-muted">
                                    <small>Seller: <?= $seller->shopname; ?></small>
                                </p>
                            </div>
                            <div class="col-2 text-center notranslate"><?= msgfmt_format_message("id", $idr, array($items->price)); ?></div>
                            <div class="col-2 text-center"><?= $items->qty; ?></div>
                            <div class="col-3 text-right notranslate"><?= msgfmt_format_message("id", $idr, array($items->subtotal)); ?></div>
                        </div>
                        <div class="row">
                            <div class="col-12 my-2">
                                <div class="line-light"></div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>
                <!-- end items -->

                <div class="values">
                    <?php
                    // dd($orders[$key]);
                    $subtotal = $orders[$key]['subtotal'];
                    $pajak = $orders[$key]['pajak'];
                    $totalweight = $orders[$key]['totalweight'];
                    $shipping = $orders[$key]['shipping'];
                    $total = $orders[$key]['total'];
                    ?>

                    <div class="row">
                        <div class="col-12 my-2">
                            <div class="line"></div>
                        </div>
                    </div>
                    <div class="row mt-2 list-content">
                        <div class="col-9 font-weight-bold">
                            SUBTOTAL
                        </div>
                        <div class="col-3 text-right font-weight-bold notranslate"><?= msgfmt_format_message("id", $idr, array($subtotal)); ?></div>
                    </div>

                </div>




                <!-- pagination -->
                <div class="invoice-pagination text-right">
                    <p class="text-muted text-right">Page <?= $i; ?> of <?= count($orders); ?></p>
                </div>
                <!-- end pagination -->
            </div>
        </div>

        <div style="break-after:page"></div>
    <?php endforeach; ?>



    <div class="row mb-2">
        <div class="col-4 data py-4">
            <div class="line mt-4 mb-4"></div>
            <h1>INVOICE</h1>

            <div class="data-box">
                <div class="data-separator d-block my-2"></div>
                <h4 class="text-muted font-weight-light">No.</h4>
                <h4 class="font-weight-bold"><?= $orders[0]['ordercode']; ?></h4>
            </div>
            <div class="data-box">
                <div class="data-separator d-block my-2"></div>
                <h4 class="text-muted font-weight-light">INVOICE DATE</h4>
                <?php $date = date_create($ordermodel[0]['created_at']); ?>
                <h4 class="font-weight-bold"><?= date_format($date, "F j\, Y",); ?></h4>
            </div>
            <div class="data-box">
                <div class="data-separator d-block my-2"></div>
                <h4 class="text-muted font-weight-light">DUE DATE</h4>
                <?php $date = date_create($ordermodel[0]['created_at']); ?>
                <?php date_add($date, date_interval_create_from_date_string("1 day")); ?>
                <h4 class="font-weight-bold"><?= date_format($date, "F j\, Y",); ?></h4>
            </div>
            <!-- <div class="data-box">
                <h5 class="font-weight-bold">TERMS</h5>
                <p>Mollit elit reprehenderit consectetur cupidatat anim qui deserunt duis. Veniam laboris id veniam in eu.</p>
            </div> -->
            <?php $status = $ordermodel[0]['status']; ?>
            <div class="data-box mb-2">
                <h5 class="font-weight-bold">STATUS</h5>
                <h6 class="font-weight-light"><?= strtoupper($status); ?></h6>
            </div>



        </div>
        <!-- end data -->

        <!-- content -->
        <div class="col-8 content py-4" style="background-color: #f1f1f1;padding-right: 45px;">
            <div class="line mt-4 mb-4"></div>
            <!-- values -->
            <div class="values">
                <?php
                $subtotal = array_column($orders, 'subtotal');
                $pajak = array_column($orders, 'pajak');
                $totalweight = array_column($orders, 'totalweight');
                $shipping = array_column($orders, 'shipping');
                $total = array_column($orders, 'total');
                ?>

                <?php
                $subtotal_all    = array_sum(array_values($subtotal));
                $pajak_all       = array_sum(array_values($pajak));
                $totalweight_all = array_sum(array_values($totalweight));
                $shipping_all    = array_sum(array_values($shipping));
                $total_all       = array_sum(array_values($total));
                ?>
                <div class="row">
                    <div class="col-12 my-2">
                        <div class="line"></div>
                    </div>
                </div>
                <div class="row mt-2 list-content">
                    <div class="col-7 font-weight-bold">
                        SUBTOTAL
                    </div>
                    <div class="col-5 text-right font-weight-bold notranslate"><?= msgfmt_format_message("id", $idr, array($subtotal_all)); ?></div>
                </div>
                <div class="row mt-2 list-content">
                    <div class="col-7">
                        Taxes
                    </div>
                    <div class="col-5 text-right notranslate"><?= msgfmt_format_message("id", $idr, array($pajak_all)); ?></div>
                </div>
                <div class="row mt-2 list-content">
                    <div class="col-7">
                        Weight
                    </div>
                    <div class="col-5 text-right"><?= $totalweight_all; ?> gr</div>
                </div>
                <div class="row mt-2 list-content">
                    <div class="col-7">
                        Shipping
                    </div>
                    <div class="col-5 text-right notranslate"><?= msgfmt_format_message("id", $idr, array($shipping_all)); ?></div>
                    <div class="col-12 my-2">
                        <div class="line-end"></div>
                    </div>
                </div>
                <div class="row mt-2 list-content">
                    <div class="col-7">
                        <h4 class="font-weight-bold">TOTAL</h3>
                    </div>
                    <div class="col-5 text-right">
                        <h4 class="font-weight-bold notranslate"><?= msgfmt_format_message("id", $idr, array($total_all)); ?></h3>
                    </div>
                </div>
            </div>
            <!-- end values -->
            <div class="mt-4 text-center">
                <?php if ($status == "Belum Dibayar" || $status == "Verifikasi"): ?>
                    <div class="data-box mb-2">
                        <img src=<?= base_url('/img/menu/qris.jpg'); ?> alt="" class="img-fluid p-2 border border-2 rounded-3" style="max-width:300px;">
                    </div>
                <?php endif; ?>

                <?php if ($editAsUser): ?>
                    <button type="button" class="btn btn-primary btn-lg d-print-none" href="#" data-toggle="modal" data-target="#paymentModal">
                        Saya Sudah Bayar
                    </button>
                <?php elseif ($editAsAdmin): ?>
                    <button type="button" class="btn btn-primary btn-lg d-print-none" href="#" data-toggle="modal" data-target="#checkpaymentModal">
                        Periksa Bukti Pembayaran
                    </button>
                <?php endif; ?>
            </div>
        </div>

    </div>

    <div class="modal fade"
        id="paymentModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Silahkan upload bukti pembayaran</h5>
                    <button
                        class="close"
                        type="button"
                        data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="<?= base_url('/order/add_payment_proof'); ?>" method='post' enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="ordercode" value="<?= $orders[0]['ordercode']; ?>">
                    <input type="hidden" name="oldproof" value="<?= $ordermodel[0]['payment_proof']; ?>">
                    <div class="modal-body">
                        <div class="col-md-6 text-center p-2">
                            <img src="/img/payment/<?= $ordermodel[0]['payment_proof']; ?>"
                                onerror="if(this.src!=($nf='/img/product/not-found.jpg')){this.src=$nf;}"
                                class="img-fluid w-100 border border-2 rounded-3 label-img" alt="...">
                            <input type="file" class="form-control"
                                onchange="previewImg(this.files[0],document.querySelector('.label-img'))"
                                id="payment_proof" name="payment_proof" accept="image/png,  image/jpeg, image/jpg">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary float-right" id="update-data">
                            <i class="fas fa-save"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade"
        id="checkpaymentModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Silahkan periksa bukti pembayaran</h5>
                    <button
                        class="close"
                        type="button"
                        data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="<?= base_url('/order/update_payment_status'); ?>" method='post' enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="ordercode" value="<?= $orders[0]['ordercode']; ?>">
                    <input type="hidden" name="oldproof" value="<?= $ordermodel[0]['payment_proof']; ?>">
                    <div class="modal-body">
                        <div class="col-md-6 text-center p-2">
                            <img src="/img/payment/<?= $ordermodel[0]['payment_proof']; ?>"
                                onerror="if(this.src!=($nf='/img/product/not-found.jpg')){this.src=$nf;}"
                                class="img-fluid w-100 border border-2 rounded-3 label-img" alt="...">
                        </div>



                        <div class="row p-2">
                            <span><label for="status" class="">Status Update</label></span>
                            <span class="pl-1">
                                <?php $status = $ordermodel[0]['status']; ?>
                                <select class="form-select"
                                    name="status" id="status">

                                    <option <?= ($status == 'Belum Dibayar') ? 'selected' : '' ?> value="Belum Dibayar">Belum Dibayar</option>
                                    <option <?= ($status == 'Verifikasi') ? 'selected' : '' ?> value="Verifikasi">Verifikasi</option>
                                    <option <?= ($status == 'Sudah Dibayar') ? 'selected' : '' ?> value="Sudah Dibayar">Sudah Dibayar</option>
                                </select>

                            </span>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary float-right" id="data_ok">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- end content -->


</div>
</div>

<div style="clear: both;"></div>

<!-- Scripts -->
<script>
    function previewImg(file, element) {
        const cover = new FileReader();
        cover.readAsDataURL(file);
        cover.onload = function(e) {
            element.src = e.target.result;
        };
    }
</script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<?= $this->endSection(); ?>