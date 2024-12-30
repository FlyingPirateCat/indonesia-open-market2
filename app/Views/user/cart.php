<?= $this->section('content'); ?>
<?php
// use PHPUnit\TextUI\Configuration\Php;
$is_self = (logged_in()); ?>
<?php if ($is_self): ?>
    <?= $this->extend('layout/account-template'); ?>
<?php else: ?>
    <?= $this->extend('layout/page-template'); ?>
<?php endif; ?>


<?php
function calculateTax($price)
{
    $ppn_rate =  1.1 / 100;
    if ($price < 50000000):
        $pph_rate = 5 / 100;
    elseif ($price >= 50000000 && $price < 250000000):
        $pph_rate = 15 / 100;
    elseif ($price >= 250000000 && $price < 500000000):
        $pph_rate = 25 / 100;
    elseif ($price >= 500000000):
        $pph_rate = 30 / 100;
    endif;
    $ppn = $price * $ppn_rate;
    $pph = $price * $pph_rate;
    $pajak = $ppn + $pph;
    return $pajak;
}

function calculateShipment($seller_poskode, $buyer_poskode, $totalweight)
{
    if (!empty($seller_poskode) && !empty($buyer_poskode)) {
        $arrays = ['provinsi', 'kabupaten', 'kecamatan', 'kelurahan'];
        $shipping = 0;

        $poskargo ??= new App\Models\TarifposKargoModel();
        $posreguler ??= new App\Models\TarifposRegulerModel();
        foreach ($arrays as $array) {
            $stempname = str_replace(' ', '', $seller_poskode[$array]);
            $btempname = str_replace(' ', '', $buyer_poskode[$array]);
            if ($poskargo->exist($stempname)) {
                $seller_area_kargo = $stempname;
            }
            if ($poskargo->exist($btempname)) {
                $buyer_area_kargo = $btempname;
            }
            if ($posreguler->exist($stempname)) {
                $seller_area_reguler = $stempname;
            }
            if ($posreguler->exist($btempname)) {
                $buyer_area_reguler = $btempname;
            }
        }
        if ($totalweight >= 10000) {
            // 10kg = kargo
            if (!empty($seller_area_kargo) && !empty($buyer_area_kargo)) {
                $ceilingweight = ceil($totalweight / 1000.0);
                $shipping = $poskargo->getTarif1kg($seller_area_kargo, $buyer_area_kargo);
                $shipping *= $ceilingweight;
            } else {
                // reguler
                if (!empty($seller_area_reguler) && !empty($buyer_area_reguler)):
                    $shipping = $posreguler->getTarif($seller_area_reguler, $buyer_area_reguler);
                endif;
            }
        } else {
            // reguler
            if (!empty($seller_area_reguler) && !empty($buyer_area_reguler)):
                $shipping = $posreguler->getTarif($seller_area_reguler, $buyer_area_reguler);
            endif;
        }
    } else {
        // bila salah satu kode pos salah 
        $shipping = 0;
    }
    return $shipping;
} ?>


<div class="container my-3">
    <div class="row">
        <div class="col">

            <?= $this->include('layout/page-flashdata'); ?>

            <?php $cart ??= \Config\Services::cart(); ?>
            <?php $keranjang = $cart->contents(); ?>
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



                <form action='/product/update_cart' method='post' id='update_cart'>
                    <!-- test -->
                    <div class="row">
                        <div class="col-12">
                            <div class="px-3 pt-3 mb-2 card bg-white bg-opacity-50 table-responsive">

                                <?php if (true) : ?>
                                    <?php $agen = []; ?>

                                    <?php $idr = "{0, number, :: currency/IDR}"; ?>
                                    <?php foreach ($keranjang as $key => $value) : ?>
                                        <?php $agen[$value['options']['seller_id']] ??= []; ?>
                                        <?php array_push($agen[$value['options']['seller_id']], $value); ?>
                                    <?php endforeach; ?>


                                    <?php $seller = []; ?>
                                    <?php $products = []; ?>
                                    <?php $totalweight = []; ?>
                                    <?php $subtotal = []; ?>
                                    <?php foreach ($agen as $sellerID => $items) : ?>

                                        <?php $seller[$sellerID] = $users->find($sellerID) ?>
                                        <h3><?= $seller[$sellerID]->shopname; ?></h3>

                                        <?php
                                        $totalweight[$sellerID] = 0;
                                        $subtotal[$sellerID] = 0;
                                        $products[$sellerID] = $items;
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
                                                <?php foreach ($products[$sellerID] as $key => $value) : ?>
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
                                                    <!-- Menghitung Pajak -->
                                                    <?php $pajak[$sellerID] =  calculateTax($sub); ?>
                                                    <!-- Menghitung Ongkir -->
                                                    <?php
                                                    $seller_poskode = $kodepos->getData('kodepos', $seller[$sellerID]->postalcode);
                                                    $buyer_poskode  = $kodepos->getData('kodepos', user()->postalcode);
                                                    $shipping[$sellerID] = calculateShipment($seller_poskode, $buyer_poskode, $totalweight[$sellerID]);
                                                    ?>
                                                    <!-- Menghitung Total -->
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

                </form>



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
                                            <?= $address = user()->street_address; ?><br>
                                            <?= $postalcode = user()->postalcode; ?> - <?= $kodepos->getData('kodepos', $postalcode)['kabupaten'] ?? ''; ?><br>
                                            <i class="fab fa-whatsapp"></i> <?= $phone = user()->phone; ?>
                                        </address>
                                    </div>
                                    <div class="col-6 pt-3 mb-2 card bg-white bg-opacity-50">
                                        <div class="table-responsive">
                                            <?php $idr = "{0, number, :: currency/IDR}"; ?>
                                            <?php

                                            $subtotal_all    = array_sum(array_values($subtotal));
                                            $pajak_all       = array_sum(array_values($pajak));
                                            $totalweight_all = array_sum(array_values($totalweight));
                                            $shipping_all    = array_sum(array_values($shipping));
                                            $total_all       = array_sum(array_values($total));


                                            // echo json_encode($products);
                                            // $path = ($_SERVER['DOCUMENT_ROOT'] . '/eur_countries_array.json');

                                            // $fp = fopen($path, 'w');
                                            // fwrite($fp, json_encode($products));
                                            // fclose($fp);


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
                                <div class="row mt-2 d-print-none">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary" id="update-cart" form="update_cart" disabled><i class="fas fa-save"></i> Update</button>
                                        <a href="/product/clear_cart" class="btn btn-warning"><i class="fas fa-trash"></i> Clear</a>


                                        <?php if (empty($fullname) || empty($address) || empty($postalcode) || empty($phone)):  ?>
                                            <button type="button" class="btn btn-success float-right" href="#" data-toggle="modal" data-target="#buyerModal" id="check-out">
                                                <i class="far fa-credit-card"></i> Kirim Pesanan
                                            </button>
                                        <?php else: ?>
                                            <form action="<?= base_url('/order/add_order'); ?>" method="post" id='add_order' class="d-inline">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="products" value="<?= str_replace('"', "'", json_encode($products)); ?>">
                                                <input type="hidden" name="subtotal" value="<?= str_replace('"', "'", json_encode($subtotal)); ?>">
                                                <input type="hidden" name="pajak" value="<?= str_replace('"', "'", json_encode($pajak)); ?>">
                                                <input type="hidden" name="totalweight" value="<?= str_replace('"', "'", json_encode($totalweight)); ?>">
                                                <input type="hidden" name="shipping" value="<?= str_replace('"', "'", json_encode($shipping)); ?>">
                                                <input type="hidden" name="total" value="<?= str_replace('"', "'", json_encode($total)); ?>">
                                                <input type="hidden" name="fullname" value="<?= $fullname; ?>">
                                                <input type="hidden" name="address" value="<?= $address; ?>">
                                                <input type="hidden" name="postalcode" value="<?= $postalcode; ?>">
                                                <input type="hidden" name="phone" value="<?= $phone; ?>">
                                                <button type="submit" class="btn btn-success float-right" form='add_order' id="check-out">
                                                    <i class="far fa-credit-card"></i> Kirim Pesanan
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>





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