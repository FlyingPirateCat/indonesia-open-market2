<?php $is_admin = (logged_in() && in_groups('admin') && ($user->name != 'admin')); ?>
<?php $is_self = (logged_in() && $user->userid == user_id()); ?>
<?php if ($is_self): ?>
    <?= $this->extend('layout/account-template'); ?>
<?php else: ?>
    <?= $this->extend('layout/page-template'); ?>
<?php endif; ?>


<?= $this->section('content'); ?>
<div class="container-fluid ">
    <div class="row">
        <div class="col-8 my-4 mx-auto">

            <!-- Page Heading -->

            <h1 class=" text_outline_1 text-white"
                style="text-shadow: 3px 3px 0 #000;">
                User Detail
            </h1>
        </div>
    </div>

    <?php $permitted = logged_in() and $auth->hasPermission('manage-profile', user_id()); ?>
    <?php $superpermitted = logged_in() and $auth->hasPermission('manage-user', user_id()); ?>
    <?php $is_agen = $auth->hasPermission('crud-product', $user->userid); ?>

    <?php $changeable = ($is_admin || $is_self); ?>

    <div class="row">
        <div class="col-8 mx-auto">
            <?= $this->include('layout/page-flashdata'); ?>
            <form action="<?= base_url('user/update_profile'); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>

                <input type="hidden" name="userid" value="<?= $user->userid; ?>">
                <input type="hidden" name="user_oldimage" value="<?= $user->user_image; ?>">
                <input type="hidden" name="user_role" value="<?= $user->name; ?>">
                <div class="card mb-4 col-12 px-5 bg-light bg-opacity-50">


                    <div class="row g-0">
                        <div class="col-md-3 text-center p-3 mt-5">
                            <img src="/img/user/<?= $user->user_image; ?>"
                                onerror="if 
                                (this.src!='/img/product/not-found.jpg'){
                                 this.src='/img/product/not-found.jpg';}"
                                class="img-fluid w-100 border border-2 rounded-3 label-img" alt="...">
                            <?php if ($changeable): ?>
                                <input type="file" class="form-control"
                                    onchange="previewImg(this.files[0],document.querySelector('.label-img'))"
                                    id="user_image" name="user_image" accept="image/png,  image/jpeg, image/jpg">
                            <?php endif; ?>
                        </div>
                        <div class="col-md-9">
                            <?php if ($superpermitted && false): ?>
                                <button type="button" class="btn btn-success float-right" id="ban">
                                    <i class="far fa-credit-card"></i><small> Ban</small>
                                </button>
                                <button type="button" class="btn btn-success float-right" id="unban">
                                    <i class="far fa-credit-card"></i><small> Unban</small>
                                </button>
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title text-center notranslate">
                                    <span class="badge 
                                    badge-<?= ($user->name == 'admin') ? 'success' : 'warning'; ?>">
                                        <?= $user->name; ?>
                                    </span> <b>@<?= $user->username; ?></b>
                                </h5>
                                <table class="table mt-3 " style="--bs-bg-opacity: 0.5">
                                    <thead>
                                        <tr>
                                            <td class="align-middle bg-light bg-opacity-10 text-right" width="30%"> <span class="card-text"><b>Nama Lengkap:</b></span></td>
                                            <td class="align-middle bg-light bg-opacity-10 notranslate" width="70%">
                                                <?php if ($changeable): ?>
                                                    <input type="text" class="form-control notranslate" id="fullname" name="fullname" value="<?= $user->fullname; ?>" />
                                                <?php else: ?>
                                                    <?= $user->fullname; ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>

                                        <?php if ($is_admin): ?>
                                            <tr>
                                                <td class="align-middle bg-light bg-opacity-10 text-right"> <span class="card-text"><b>Role:</b></span></td>
                                                <td class="align-middle bg-light bg-opacity-10 notranslate">

                                                    <select class="form-select"
                                                        name="role" id="role">
                                                        <option <?= ($user->name == 'agen') ? 'selected' : '' ?> value="agen">Agen</option>
                                                        <option <?= ($user->name == 'user') ? 'selected' : '' ?> value="user">User</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        <?php endif; ?>

                                        <tr>
                                            <td class="align-middle bg-light bg-opacity-10 text-right"> <span class="card-text"><b>Email:</b></span></td>
                                            <td class="align-middle bg-light bg-opacity-10 notranslate">

                                                <?php if ($is_admin && false): ?>
                                                    <input type="text" class="form-control" id="email" name="email" value="<?= $user->email; ?>" />
                                                <?php else: ?>

                                                    <?php if ($is_self): ?>
                                                        <?= $user->email; ?>
                                                    <?php else : ?>
                                                        <?= empty($user->email) ? '' : 'Private'; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle bg-light bg-opacity-10 text-right"> <span class="card-text"><b>Jenis Kelamin:</b></span></td>
                                            <td class="align-middle bg-light bg-opacity-10">

                                                <?php if ($changeable): ?>
                                                    <select class="form-select"
                                                        name="gender" id="gender">
                                                        <option <?= ($user->gender == '0') ? 'selected' : '' ?> value="0">Tidak dirinci</option>
                                                        <option <?= ($user->gender == '1') ? 'selected' : '' ?> value="1">Laki-laki</option>
                                                        <option <?= ($user->gender == '2') ? 'selected' : '' ?> value="2">Perempuan</option>
                                                    </select>
                                                <?php else: ?>
                                                    <?php
                                                    $gender = 'Tidak dirinci';
                                                    if ($user->gender == 1) {
                                                        $gender = 'Laki-Laki';
                                                    } elseif ($user->gender == 2) {
                                                        $gender = 'Perempuan';
                                                    } ?>
                                                    <?= $gender; ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle bg-light bg-opacity-10 text-right"> <span class="card-text"><b>Tanggal Lahir:</b></span></td>
                                            <td class="align-middle bg-light bg-opacity-10">
                                                <?php if ($changeable): ?>
                                                    <input id="birthdate" name="birthdate" class="form-control" type="date"
                                                        value="<?= old('birthdate') ?? $user->birthdate; ?>" />
                                                <?php else: ?>
                                                    <?= $user->birthdate; ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-middle bg-light bg-opacity-10 text-right"> <span class="card-text"><b>No. KTP:</b></span></td>
                                            <td class="align-middle bg-light bg-opacity-10 notranslate">

                                                <?php if ($changeable): ?>
                                                    <input type="text" class="form-control" id="ktp" name="ktp" value="<?= old('ktp') ?? $user->ktp; ?>" />
                                                <?php else: ?>
                                                    <?php if ($is_self): ?>
                                                        <?= $user->ktp; ?>
                                                    <?php else : ?>
                                                        <?= empty($user->ktp) ? '' : 'Private'; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="align-middle bg-light bg-opacity-10 text-right"> <span class="card-text"><b>No. WhatsApp:</b></span></td>
                                            <td class="align-middle bg-light bg-opacity-10 notranslate">

                                                <?php if ($changeable): ?>
                                                    <input type="text" class="form-control" id="phone" name="phone" value="<?= old('phone') ?? $user->phone; ?>" />
                                                <?php else: ?>
                                                    <?= $user->phone; ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>

                                        <?php if ($is_agen): ?>
                                            <tr>
                                                <td class="align-middle bg-light bg-opacity-10 text-right"> <span class="card-text"><b>Kios Agen:</b></span></td>
                                                <td class="align-middle bg-light bg-opacity-10 notranslate">

                                                    <?php if ($changeable): ?>
                                                        <input type="text" class="form-control" id="shopname" name="shopname" value="<?= $user->shopname; ?>" />
                                                    <?php else: ?>
                                                        <?= $user->shopname; ?>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>

                                        <tr>
                                            <td class="align-middle bg-light bg-opacity-10 text-right"> <span class="card-text"><b>Alamat:</b></span></td>
                                            <td class="align-middle bg-light bg-opacity-10">

                                                <?php if ($changeable): ?>
                                                    <textarea
                                                        type="textbox"
                                                        class="form-control"
                                                        id="street_address"
                                                        name="street_address"
                                                        maxlength="255"><?= $user->street_address ?></textarea>
                                                <?php else: ?>
                                                    <?= $user->street_address; ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle bg-light bg-opacity-10 text-right"> <span class="card-text"><b>Kode Pos:</b></span></td>
                                            <td class="align-middle bg-light bg-opacity-10 notranslate">

                                                <?php if ($changeable): ?>
                                                    <input type="text" class="form-control" id="postalcode"
                                                        name="postalcode" value="<?= $user->postalcode; ?>" />
                                                <?php else: ?>
                                                    <?php $pos =  $user->postalcode; ?>
                                                    <?php $posdata = $kodepos->getData('kodepos', $pos) ?>
                                                    <?= $pos; ?><?= !empty($posdata) ? ' - ' . $posdata['kabupaten'] : ''; ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    </thead>
                                </table>
                                <?php if ($changeable): ?>
                                    <button type="submit" class="btn btn-primary my-3">
                                        Update Data
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>