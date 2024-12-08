<?= $this->section('content'); ?>
<?php

use PHPUnit\TextUI\Configuration\Php;

$is_self = (logged_in()); ?>
<?php if ($is_self): ?>
    <?= $this->extend('layout/account-template'); ?>
<?php else: ?>
    <?= $this->extend('layout/page-template'); ?>
<?php endif; ?>

<div class="container my-3">
    <div class="row">
        <div class="col">

            <?= $this->include('layout/page-flashdata'); ?>

            <?php $cart ??= \Config\Services::cart(); ?>
            <?php $keranjang = $cart->contents(); ?>
            <form action='/product/update_cart' method='post'>
                <!-- Main content -->
                <div class="invoice p-3 mb-3 card bg-white bg-opacity-50">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12 mb-2">
                            <h4>
                                <i class="fas fa-shopping-cart"></i> Keranjang Belanja
                                <small class="float-right">Date: <?= date('d/m/Y'); ?></small>
                            </h4>

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->



                    <!-- test -->
                    <div class="row">
                        <div class="col-12">
                            <div class="px-3 pt-3 mb-2 card bg-white bg-opacity-50 table-responsive">

                                <?php if (true) : ?>
                                    <?php $test = []; ?>
                                    <?php $totalweight = []; ?>
                                    <?php $subtotal2 = []; ?>

                                    <?php $idr = "{0, number, :: currency/IDR}"; ?>
                                    <?php foreach ($keranjang as $key => $value) : ?>
                                        <?php $test[$value['options']['seller_id']] ??= []; ?>
                                        <?php array_push($test[$value['options']['seller_id']], $value); ?>
                                    <?php endforeach; ?>


                                    <?php foreach ($test as $sellerID => $products) : ?>
                                        <?php $seller = $users->find($sellerID) ?>
                                        <h3><?= $seller->shopname; ?></h3>

                                        <?php
                                        $totalweight[$sellerID] = 0;
                                        $subtotal[$sellerID] = 0;
                                        // $pajak[$sellerID] = 0;
                                        // $shipping[$sellerID] = 0;
                                        ?>

                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th width="100px">Qty</th>
                                                    <th width="300px">Nama Barang</th>
                                                    <th width="100px">Berat</th>
                                                    <th width="200px">Harga Satuan</th>
                                                    <th width="200px">Subtotal Barang</th>
                                                    <th width="100px">Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($products as $key => $value) : ?>
                                                    <?php $totalweight[$sellerID] += $value['qty'] * $value['options']['weight']; ?>
                                                    <?php $subtotal[$sellerID] += $value['subtotal']; ?>
                                                    <tr>
                                                        <td>
                                                            <input type="number" class="form-control"
                                                                min="1" max="<?= $value['options']['stock']; ?>"
                                                                name="qty<?= $value['id']; ?>"
                                                                value="<?= $value['qty']; ?>"
                                                                onchange="document.querySelector('#check-out').disabled = true;
                                                                document.querySelector('#update-cart').disabled = false;">
                                                        </td>
                                                        <td><?= $value['name']; ?></td>
                                                        <td><?= $value['qty'] * $value['options']['weight']; ?> gr</td>
                                                        <td><?= msgfmt_format_message("id", $idr, array($value['price'])); ?></td>
                                                        <td><?= msgfmt_format_message("id", $idr, array($value['subtotal'])); ?></td>
                                                        <td>
                                                            <a href="/product/delete_cart/<?= $value['rowid']; ?>" class=" btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                        <div class="row pr-2">
                                            <div class="col-6 px-3 pt-2 mb-2 bg-white bg-opacity-0" style="--bs-bg-opacity: 0.0">
                                            </div>
                                            <div class="col-6 mb-2 ">
                                                <div class="table-responsive">
                                                    <?php $idr = "{0, number, :: currency/IDR}"; ?>
                                                    <?php $sub = $subtotal[$sellerID]; ?>
                                                    <?php
                                                    $ppn_rate =  11 / 100;
                                                    if ($sub < 50000000):
                                                        $pph_rate = 5 / 100;
                                                    elseif ($sub >= 50000000 && $sub < 250000000):
                                                        $pph_rate = 15 / 100;
                                                    elseif ($sub >= 250000000 && $sub < 500000000):
                                                        $pph_rate = 25 / 100;
                                                    elseif ($sub >= 500000000):
                                                        $pph_rate = 30 / 100;
                                                    endif;
                                                    $ppn = $sub * $ppn_rate;
                                                    $pph = $sub * $pph_rate;
                                                    $pajak[$sellerID] = $ppn + $pph;
                                                    ?>

                                                    <?php
                                                    $seller_poskode = $kodepos->getData('kodepos', $seller->postalcode);
                                                    $buyer_poskode = $kodepos->getData('kodepos', user()->postalcode);

                                                    if (!empty($seller_poskode) && !empty($buyer_poskode)) {
                                                        $seller_area = str_replace(' ', '', $seller_poskode['kabupaten']);
                                                        $buyer_area = str_replace(' ', '', $buyer_poskode['kabupaten']);
                                                        // berdasarkan kabupaten
                                                        $shipping[$sellerID] = $posreguler->getTarif($seller_area, $buyer_area);
                                                        // bila tidak ditemukan
                                                        $shipping[$sellerID] ??= 0;
                                                    } else {
                                                        // bila salah satu kode pos salah 
                                                        $shipping[$sellerID] = 0;
                                                    }
                                                    ?>

                                                    <?php $total[$sellerID] = $sub + $pajak[$sellerID] + $shipping[$sellerID]; ?>
                                                    <table class="table">
                                                        <tr>
                                                            <th style="width:50%">Subtotal Produk:</th>
                                                            <td><?= msgfmt_format_message("id", $idr, array($sub)); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Pajak (PPn dan PPh):</th>
                                                            <td><?= msgfmt_format_message("id", $idr, array($pajak[$sellerID])); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Berat:</th>
                                                            <td><?= $totalweight[$sellerID]; ?> gr</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Ongkos Kirim:</th>
                                                            <td><?= msgfmt_format_message("id", $idr, array($shipping[$sellerID])); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Total:</th>
                                                            <td><?= msgfmt_format_message("id", $idr, array($total[$sellerID])); ?></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>
                                    <?php endforeach; ?>


                                <?php endif; ?>
                            </div>
                        </div>
                    </div>




                    <div class="row">

                        <div class="col-12">
                            <div class="px-3 py-3 mb-2 card bg-white bg-opacity-50 table-responsive">
                                <!-- Table row -->


                                <?php if (!empty($keranjang)) : ?>
                                    <div class="row px-2">
                                        <div class="col-6 px-3 pt-2 mb-2 card bg-white bg-opacity-50">
                                            <h4 class="mb-2"><i class="far fa-address-card"></i> Tujuan pengiriman
                                                <small class="float-right"><a href="#" data-toggle="modal" data-target="#buyerModal"><i class="far fa-edit"></i></a></small>
                                            </h4>
                                            <address class="pl-3 ">
                                                <strong><?= ($fullname = user()->fullname) ?? user()->username; ?></strong><br>
                                                <i class="far fa-address-book"></i> <?= $address = user()->street_address; ?><br>
                                                <i class="far fa-envelope"></i> <?= $postalcode = user()->postalcode; ?><br>
                                                <i class="fab fa-whatsapp"></i> <?= $phone = user()->phone; ?>
                                            </address>
                                        </div>
                                        <div class="col-6 pt-3 mb-2 card bg-white bg-opacity-50">
                                            <div class="table-responsive">
                                                <?php $idr = "{0, number, :: currency/IDR}"; ?>
                                                <?php
                                                // $subtotal = $cart->total();
                                                $subtotal_all = array_sum(array_values($subtotal));
                                                $pajak_all = array_sum(array_values($pajak));
                                                $totalweight_all = array_sum(array_values($totalweight));
                                                $shipping_all = array_sum(array_values($shipping));
                                                $total_all = array_sum(array_values($total));
                                                ?>
                                                <table class="table">
                                                    <tr>
                                                        <th style="width:50%">Subtotal Produk:</th>
                                                        <td><?= msgfmt_format_message("id", $idr, array($subtotal_all)); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total Pajak (PPn dan PPh):</th>
                                                        <td><?= msgfmt_format_message("id", $idr, array($pajak_all)); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total Berat:</th>
                                                        <td><?= $totalweight_all; ?> gr</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total Ongkos Kirim:</th>
                                                        <td><?= msgfmt_format_message("id", $idr, array($shipping_all)); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total Keseluruhan:</th>
                                                        <td><?= msgfmt_format_message("id", $idr, array($total_all)); ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                    </div>

                                    <!-- /.row -->

                                    <!-- this row will not appear when printing -->
                                    <div class="row mt-2 no-print">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary" id="update-cart" disabled><i class="fas fa-save"></i> Update</button>
                                            <a href="/product/clear_cart" class="btn btn-warning"><i class="fas fa-trash"></i> Clear</a>


                                            <?php if (empty($fullname) || empty($address) || empty($postalcode) || empty($phone)):  ?>
                                                <button type="button" class="btn btn-success float-right" href="#" data-toggle="modal" data-target="#buyerModal" id="check-out">
                                                    <i class="far fa-credit-card"></i> Kirim Pesanan
                                                </button>
                                            <?php else: ?>
                                                <button type="button" class="btn btn-success float-right" id="check-out">
                                                    <i class="far fa-credit-card"></i> Kirim Pesanan
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </form>





            <div class="modal fade"
                id="buyerModal"
                tabindex="-1"
                role="dialog"
                aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Silahkan isi data dibawah ini</h5>
                            <button
                                class="close"
                                type="button"
                                data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form action='/user/update_crt_profile' method='post'>
                            <div class="modal-body">
                                <div class="row p-2">
                                    <span><label for="fullname" class="">Nama Lengkap</label></span>
                                    <span class=" pl-1">
                                        <input type="text" class="form-control"
                                            id="fullname" name="fullname"
                                            maxlength="255"
                                            placeholder="Nama lengkap anda"
                                            value="<?= old('fullname') ?? user()->fullname; ?>"
                                            required />
                                    </span>
                                </div>

                                <div class="row p-2">
                                    <span><label for="phone" class="">No. WhatsApp</label></span>
                                    <span class="pl-1">
                                        <input type="text" class="form-control"
                                            id="phone" name="phone"
                                            maxlength="20"
                                            placeholder="No Telp / WhatsApp anda"
                                            value="<?= old('phone') ?? user()->phone; ?>"
                                            required />
                                    </span>
                                </div>
                                <div class="row p-2">
                                    <span><label for="description" class="">Alamat</label></span>
                                    <span class=" pl-1">
                                        <textarea
                                            type="textbox" class="form-control"
                                            id="street_address" name="street_address"
                                            maxlength="255" required><?= old('street_address') ?? user()->street_address; ?></textarea>
                                    </span>
                                </div>
                                <div class="row p-2">
                                    <span><label for="postalcode" class="">Pos Kode</label></span>
                                    <span class=" pl-1">
                                        <input type="text" class="form-control"
                                            id="postalcode" name="postalcode"
                                            placeholder="Pos kode daerah anda"
                                            value="<?= old('postalcode') ?? user()->postalcode; ?>"
                                            required />

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
        </div>


        <div>











        </div>
    </div>
</div>

<?= $this->endSection(); ?>