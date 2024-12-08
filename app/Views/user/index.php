<?= $this->extend('layout/account-template'); ?>
<?= $this->section('content'); ?>
<div class="container my-3">
    <div class="row">
        <div class="col">
            <h1 class="mt-2 text_outline_1 text-white"
                style="text-shadow: 3px 3px 0 #000;">
                Welcome back, <span class="notranslate"><?= user()->username; ?></span>
            </h1>


            <?= $this->include('layout/page-flashdata'); ?>
            <form action="user/update_profile" method="post" enctype="multipart/form-data" style="display:none;">
                <?= csrf_field(); ?>
                <div class="card mb-3 bg-light bg-opacity-50">
                    <div class="row g-0">
                        <div class="col-md-4 text-center p-3 mt-5">
                            <img src="/img/user/<?= user()->user_image; ?>"
                                onerror="if 
                                (this.src!='/img/product/not-found.jpg'){
                                 this.src='/img/product/not-found.jpg';}"
                                class="img-fluid w-100 border border-2 rounded-3 label-img" alt="...">
                            <input type="file" class="form-control"
                                onchange="previewImg(this.files[0],document.querySelector('.label-img'))"
                                id="user_image" name="user_image" accept="image/png,  image/jpeg, image/jpg">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title text-center"><b>@<?= user()->username; ?></b></h5>
                                <table class="table mt-3 " style="--bs-bg-opacity: 0.5">
                                    <thead>
                                        <tr>
                                            <td class="align-middle bg-light bg-opacity-10 text-right" width="25%"> <span class="card-text"><b>Nama Lengkap:</b></span></td>
                                            <td class="align-middle bg-light bg-opacity-10" width="75%">
                                                <input type="text" class="form-control" id="fullname" name="fullname" value="<?= user()->fullname; ?>" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle bg-light bg-opacity-10 text-right"> <span class="card-text"><b>Email:</b></span></td>
                                            <td class="align-middle bg-light bg-opacity-10"><?= user()->email; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle bg-light bg-opacity-10 text-right"> <span class="card-text"><b>Jenis Kelamin:</b></span></td>
                                            <td class="align-middle bg-light bg-opacity-10">
                                                <select class="form-select"
                                                    name="gender" id="gender">
                                                    <option <?= (user()->gender == '0') ? 'selected' : '' ?> value="0">Not Specified</option>
                                                    <option <?= (user()->gender == '1') ? 'selected' : '' ?> value="1">Laki-laki</option>
                                                    <option <?= (user()->gender == '2') ? 'selected' : '' ?> value="2">Perempuan</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle bg-light bg-opacity-10 text-right"> <span class="card-text"><b>Tanggal Lahir:</b></span></td>
                                            <td class="align-middle bg-light bg-opacity-10"><input id="birthdate" name="birthdate" class="form-control" type="date"
                                                    value="<?= old('birthdate') ?? user()->birthdate; ?>" /></td>
                                        </tr>

                                        <tr>
                                            <td class="align-middle bg-light bg-opacity-10 text-right"> <span class="card-text"><b>No. KTP:</b></span></td>
                                            <td class="align-middle bg-light bg-opacity-10">
                                                <input type="text" class="form-control" id="ktp" name="ktp" value="<?= user()->ktp; ?>" />
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-middle bg-light bg-opacity-10 text-right"> <span class="card-text"><b>No. WhatsApp:</b></span></td>
                                            <td class="align-middle bg-light bg-opacity-10">
                                                <input type="text" class="form-control" id="phone" name="phone" value="<?= user()->phone; ?>" />
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-middle bg-light bg-opacity-10 text-right"> <span class="card-text"><b>Nama Toko:</b></span></td>
                                            <td class="align-middle bg-light bg-opacity-10">
                                                <input type="text" class="form-control" id="shopname" name="shopname" value="<?= user()->shopname; ?>" />
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-middle bg-light bg-opacity-10 text-right"> <span class="card-text"><b>Alamat:</b></span></td>
                                            <td class="align-middle bg-light bg-opacity-10">
                                                <textarea
                                                    type="textbox"
                                                    class="form-control"
                                                    id="street_address"
                                                    name="street_address"
                                                    maxlength="255"><?= user()->street_address ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle bg-light bg-opacity-10 text-right"> <span class="card-text"><b>Kode Pos:</b></span></td>
                                            <td class="align-middle bg-light bg-opacity-10">
                                                <input type="text" class="form-control" id="postalcode" name="postalcode" value="<?= user()->postalcode; ?>" />
                                            </td>
                                        </tr>
                                    </thead>
                                </table>
                                <button type="submit" class="btn btn-primary my-3">
                                    Update Data
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>