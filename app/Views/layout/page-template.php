<!doctype html>
<html lang>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title><?= $title ?? 'Indonesia OpenMarket'; ?></title>

  <?= $this->include('layout/page-linkstyle'); ?>

</head>

<body>


  <div class="min-vh-100 pb-2 header_background overflow-scroll">

    <?= $this->include('layout/page-navbar'); ?>
    <?= $this->renderSection('content'); ?>
    <?= $this->include('layout/account-navlogoutmodal'); ?>
  </div>



  <?= $this->include('layout/page-footer'); ?>
  <?= $this->include('layout/page-linkscript'); ?>
</body>

</html>