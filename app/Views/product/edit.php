<?= $this->extend('layout/page-template'); ?>

<?= $this->section('content'); ?>

<?php $logged      = (logged_in()); ?>
<?php $create      = !isset($product); ?>
<?php $editAsUser  = isset($product) && user_id() == $product['id_user']; ?>
<?php $editAsAdmin = isset($product) && in_groups('admin'); ?>

<?php if ($logged && ($create || $editAsUser || $editAsAdmin)): ?>
    <div class="container">
        <div class="row">
            <div class="col-8 my-3 mx-auto">
                <?php $judul = $create ? 'Tambah Data Produk' : 'Ubah Data Produk'; ?>

                <h1 class="my-3 text_outline_1 text-white"
                    style="text-shadow: 3px 3px 0 #000;">Form <?= $judul; ?></h1>
            </div>
        </div>

        <div class="row">
            <div class="col-8 my-3  mx-auto">
                <?= $this->include('layout/page-flashdata'); ?>
                <?php $link = base_url('/product/update/' . ($create ? '0' : $product['id'])); ?>

                <form class="p-3 bg-black rounded text-white" style="--bs-bg-opacity: .4;"
                    action="<?= $link; ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="slug" value="<?= $create ? '' : $product['slug']; ?>">
                    <div class="row mb-3">
                        <span><label for="name" class="">Nama Produk</label></span>
                        <span class=" pl-1"><input
                                type="text"
                                class="form-control 
                            <?= ($validation->hasError('name')) ? 'is-invalid' : ''; ?>"
                                id="name"
                                name="name"
                                maxlength="30"
                                value="<?= (old('name')) ?? $create ? '' : $product['name']; ?>"
                                required />
                            <div class="invalid-feedback">
                                <?= $validation->getError('name'); ?>
                            </div>

                        </span>
                    </div>
                    <div class="row mb-3">
                        <div class="col ml-n2">
                            <div class="row">
                                <span><label for="cover" class="">Gambar Produk</label></span>

                                <div class="input-group mb-3">
                                    <input type="file"
                                        class="form-control <?= ($validation->hasError('cover')) ? 'is-invalid' : ''; ?>"
                                        onchange="previewImg(this.files[0],document.querySelector('.label-img'))"
                                        id="cover" name="cover" accept="image/png,  image/jpeg, image/jpg">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('cover'); ?>
                                    </div>
                                    <label class="input-group-text" for="cover">
                                        <img src="<?= base_url('/img/product/' . (old('cover')) ?? ($create ? '' : $product['cover'])); ?>"
                                            alt="" class="img-thumbnail label-img"
                                            style="max-width: 24px; max-height:24px">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <?php $vartype = (old('type')) ?? $create ? '' : $product['type']; ?>
                                <span><label for="type" class="">Kategori Produk <?= $vartype; ?></label></span>
                                <span class="pl-2"><select class="form-control" name="type" id="type"
                                        onloadedmetadata="weightformchange(this.value)"
                                        onchange="weightformchange(this.value)"
                                        value="<?= $vartype; ?>">
                                        <option <?= ($vartype == '') ? 'selected' : '' ?> value="">--- Kategori Produk ---</option>
                                        <option <?= ($vartype == '0') ? 'selected' : '' ?> value="0">Kerajinan Rumah Tangga</option>
                                        <option <?= ($vartype == '1') ? 'selected' : '' ?> value="1">Hasil Bumi</option>
                                        <option <?= ($vartype == '2') ? 'selected' : '' ?> value="2">Hasil Laut</option>
                                        <option <?= ($vartype == '3') ? 'selected' : '' ?> value="3">Hasil Pertambangan</option>
                                        <option <?= ($vartype == '4') ? 'selected' : '' ?> value="4">Kuliner</option>
                                        <option <?= ($vartype == '5') ? 'selected' : '' ?> value="5">Wisata dan Umroh</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('type'); ?>
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col pr-3">
                            <div class="row">
                                <span><label for="price" class="">Harga Produk (IDR)</label></span>
                                <span class=" pl-1"><input
                                        type="number"
                                        class="form-control <?= ($validation->hasError('price')) ? 'is-invalid' : ''; ?>"
                                        id="price"
                                        name="price"
                                        value="<?= (old('price')) ?? $create ? 0 : $product['price']; ?>"
                                        min="0"
                                        required />
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('price'); ?>
                                    </div>
                                </span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <span><label for="stock" class="">Stock Produk</label></span>
                                <span class=" pl-1"><input
                                        type="number"
                                        class="form-control <?= ($validation->hasError('stock')) ? 'is-invalid' : ''; ?>"
                                        id="stock"
                                        name="stock"
                                        value="<?= (old('stock')) ?? $create ? 0 : $product['stock']; ?>"
                                        min="0"
                                        required />
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('stock'); ?>
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col pr-3">
                            <div class="row" id="weightinput">
                                <span><label for="weight" class="">Berat Produk (gram)</label></span>
                                <span class="pl-1"><input
                                        type="number"
                                        class="form-control <?= ($validation->hasError('weight')) ? 'is-invalid' : ''; ?>"
                                        id="weight"
                                        name="weight"
                                        value="<?= (old('weight')) ?? $create ? 0 : $product['weight']; ?>"
                                        min="0"
                                        required />
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('weight'); ?>
                                    </div>
                                </span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <!-- empty placeholder -->
                                <?php if ($editAsAdmin && false): ?>
                                    <span><label for="id_user" class="">Seller ID</label></span>
                                    <span class="pl-1"><input
                                            type="number"
                                            class="form-control"
                                            id="id_user"
                                            name="id_user"
                                            value="<?= (old('id_user')) ?? $create ? 0 : $product['id_user']; ?>"
                                            min="0" />
                                    </span>

                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <span><label for="description" class="">Deskripsi Produk</label></span>
                        <span class=" pl-1"><textarea
                                type="textbox"
                                class="form-control <?= ($validation->hasError('description')) ? 'is-invalid' : ''; ?>"
                                id="description"
                                name="description"
                                maxlength="255"
                                minlength="30"
                                required><?= (old('description')) ?? $create ? '' : $product['description']; ?></textarea>
                            <div class="invalid-feedback">
                                <?= $validation->getError('description'); ?>
                            </div>
                        </span>
                    </div>

                    <?php if (true): ?>
                        <?php $missingdata = []; ?>
                        <?php $missingdata['ktp']         = empty(user()->ktp); ?>
                        <?php $missingdata['shopname']    = empty(user()->shopname); ?>
                        <?php $missingdata['phone']       = empty(user()->phone); ?>
                        <?php $missingdata['address']     = empty(user()->street_address); ?>
                        <?php $missingdata['postalcode']  = empty(user()->postalcode); ?>

                        <?php if (!empty(array_filter(array_values($missingdata)))): ?>
                            <div class="row mb-3 text-center">
                                <p>Silahkan isi data dibawah ini dengan benar:</p>
                            </div>
                        <?php endif; ?>

                        <!-- bila user belum mengisi ktp -->
                        <?php if ($missingdata['ktp']) : ?>
                            <div class="row mb-3">
                                <span><label for="ktp" class="">No. KTP</label></span>
                                <span class=" pl-1"><input
                                        type="text"
                                        class="form-control <?= ($validation->hasError('ktp')) ? 'is-invalid' : ''; ?>"
                                        id="ktp"
                                        name="ktp"
                                        maxlength="20"
                                        value="<?= old('ktp'); ?>"
                                        required />
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('ktp'); ?>
                                    </div>
                                </span>
                            </div>
                        <?php endif; ?>


                        <!-- bila user belum mengisi nama toko -->
                        <?php if ($missingdata['shopname']) : ?>
                            <div class="row mb-3">
                                <span><label for="shopname" class="">Kios Agen</label></span>
                                <span class=" pl-1"><input
                                        type="text"
                                        class="form-control <?= ($validation->hasError('shopname')) ? 'is-invalid' : ''; ?>"
                                        id="shopname"
                                        name="shopname"
                                        maxlength="30"
                                        value="<?= old('shopname'); ?>"
                                        required />
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('shopname'); ?>
                                    </div>
                                </span>
                            </div>
                        <?php endif; ?>


                        <!-- bila user belum mengisi phone -->
                        <?php if ($missingdata['phone']) : ?>
                            <div class="row mb-3">
                                <span><label for="phone" class="">No. WhatsApp</label></span>
                                <span class=" pl-1"><input
                                        type="text"
                                        class="form-control <?= ($validation->hasError('phone')) ? 'is-invalid' : ''; ?>"
                                        id="phone"
                                        name="phone"
                                        maxlength="20"
                                        value="<?= old('phone'); ?>"
                                        required />
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('phone'); ?>
                                    </div>
                                </span>
                            </div>
                        <?php endif; ?>

                        <!-- bila user belum mengisi alamat -->
                        <?php if ($missingdata['address']) : ?>
                            <div class="row mb-3">
                                <span><label for="description" class="">Alamat Penjual</label></span>

                                <span class=" pl-1"><textarea
                                        type="textbox"
                                        class="form-control <?= ($validation->hasError('street_address')) ? 'is-invalid' : ''; ?>"
                                        id="street_address"
                                        name="street_address"
                                        maxlength="255"
                                        required><?= old('street_address'); ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('street_address'); ?>
                                    </div>
                                </span>
                            </div>
                        <?php endif; ?>

                        <!-- pos kode -->
                        <?php if (empty(user()->postalcode)) : ?>
                            <div class="row mb-3">
                                <span><label for="postalcode" class="">Pos Kode</label></span>
                                <span class=" pl-1"><input
                                        type="number"
                                        class="form-control <?= ($validation->hasError('postalcode')) ? 'is-invalid' : ''; ?>"
                                        id="postalcode"
                                        name="postalcode"
                                        value="<?= (old('postalcode')) ?? $product['postalcode']; ?>" />
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('postalcode'); ?>
                                    </div>
                                </span>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <button type="submit" class="btn btn-primary my-3">
                        <?= $judul; ?>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImg(file, element) {
            const cover = new FileReader();
            cover.readAsDataURL(file);
            cover.onload = function(e) {
                element.src = e.target.result;
            };
        }

        function weightformchange(value) {
            weightinput = document.querySelector('#weightinput');
            weightdata = document.querySelector('#weight');
            if (value == 0) {
                weightinput.style.display = 'flex';
            } else if (value == 1) {
                weightinput.style.display = 'flex';
            } else if (value == 2) {
                weightinput.style.display = 'flex';
            } else if (value == 3) {
                weightinput.style.display = 'flex';
            } else if (value == 4) {
                weightinput.style.display = 'none';
                weightdata.value = 0;
            } else if (value == 5) {
                weightinput.style.display = 'none';
                weightdata.value = 0;
            };
        }
        weightformchange(document.querySelector('#type').value);
    </script>



<?php endif; ?>
<?= $this->endSection(); ?>