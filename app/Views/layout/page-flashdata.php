<?php if (session()->getFlashdata('Failure')) : ?>
    <div class="alert alert-danger" role="alert">
        <?= session()->getFlashdata('Failure'); ?>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('Success')) : ?>
    <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('Success'); ?>
    </div>
<?php endif; ?>