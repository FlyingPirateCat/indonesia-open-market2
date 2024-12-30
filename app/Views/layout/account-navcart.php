<li class="nav-item dropdown no-arrow mx-1">
    <?php
    $cart ??= \Config\Services::cart();
    $keranjang = $cart->contents();
    $jml_item  = 0;
    $idr       = "{0, number, :: currency/IDR}";
    foreach ($keranjang as $key => $value) {
        $jml_item += $value['qty'];
    } ?>


    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-shopping-cart fa-fw"></i>
        <?php if ($jml_item > 0): ?>
            <span class="badge badge-danger badge-counter"><?= $jml_item; ?></span>
        <?php endif; ?>
    </a>
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in bg-dark "
        style="--bs-bg-opacity: 0.9"
        aria-labelledby="messagesDropdown">
        <h6 class="dropdown-header">
            Keranjang Belanja Anda
        </h6>


        <?php if (empty($keranjang)) : ?>
            <a class="dropdown-item d-flex align-items-center text-center text_outline_1 text-bg-dark"
                href="<?= base_url('/product'); ?>">
                Keranjang Belanja Kosong
            </a>
        <?php else : ?>
            <?php foreach ($keranjang as $key => $value) : ?>
                <a class="dropdown-item d-flex align-items-center "
                    href="/product/<?= $value['options']['slug']; ?>">
                    <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle "
                            src="<?= base_url(); ?>/img/product/<?= $value['options']['cover']; ?>"
                            alt="...">
                        <div class="status-indicator bg-success"></div>
                    </div>
                    <div class="font-weight-bold">
                        <div class="text-truncate text_outline_1 text-white"><?= $value['name']; ?></div>
                        <div class="small text-gray-500"><?= $value['qty']; ?> ×
                            <?= msgfmt_format_message("id", $idr, array($value['price'])); ?> =
                            <?= msgfmt_format_message("id", $idr, array($value['subtotal'])); ?>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
            <a class="dropdown-item text-center small text-gray-500">Total:
                <?= msgfmt_format_message("id", $idr, array($cart->total())); ?>
            </a>
            <a class="dropdown-item text-center small text-gray-500" href="<?= base_url('/user/cart'); ?>">
                <i class="fa fa-shopping-cart"></i> Lihat Keranjang Belanja</a>
        <?php endif; ?>
    </div>
</li>