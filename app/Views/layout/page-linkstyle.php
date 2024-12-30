<!-- Custom fonts for this template-->
<link href="<?= base_url(); ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

<!-- Custom styles for this template-->
<link href="<?= base_url('/css/sb-admin-2.min.css'); ?>" rel="stylesheet">



<link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous" />



<!-- My Css -->
<link rel="stylesheet" href="<?= base_url('css/style.css'); ?>" />
<style>
    html {
        scroll-behavior: smooth;
    }

    .header_background {
        background-image: url(<?= base_url('/img/header-bg.jpg'); ?>);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
    }

    .text_outline_1 {
        text-shadow:
            -1px -1px 0 #000,
            1px -1px 0 #000,
            -1px 1px 0 #000,
            1px 1px 0 #000;
    }

    .line {
        border-bottom: 3px solid #000;
        width: 100%;
    }

    .line-light {
        width: 100%;
        border-bottom: 1px solid #949597;
    }

    .line-end {
        width: 100%;
        border-bottom: 3px solid #f0c29e;
    }

    .data {
        background-color: #dcdddf;
        padding-left: 45px;
    }

    .data .data-box {
        margin-top: 60px;
    }

    .data .data-box .data-separator {
        border-top: 1px solid #949597;
        width: 10%;
    }


    .without-margin {
        margin: 0 !important;
    }

    /* To break in pages, please use this class */
    /* https://github.com/barryvdh/laravel-snappy/issues/2 */
    .page {
        page-break-after: always;
        page-break-inside: avoid;
    }
</style>

<style>
    .cell-1 {
        border-collapse: separate;
        border-spacing: 0 4em;
        background: #fff;
        border-bottom: 5px solid transparent;
        /*background-color: gold;*/
        background-clip: padding-box;
    }

    .toggle-btn {
        width: 40px;
        height: 21px;
        background: grey;
        border-radius: 50px;
        padding: 3px;
        cursor: pointer;
        -webkit-transition: all 0.3s 0.1s ease-in-out;
        -moz-transition: all 0.3s 0.1s ease-in-out;
        -o-transition: all 0.3s 0.1s ease-in-out;
        transition: all 0.3s 0.1s ease-in-out;
    }

    .toggle-btn>.inner-circle {
        width: 15px;
        height: 15px;
        background: #fff;
        border-radius: 50%;
        -webkit-transition: all 0.3s 0.1s ease-in-out;
        -moz-transition: all 0.3s 0.1s ease-in-out;
        -o-transition: all 0.3s 0.1s ease-in-out;
        transition: all 0.3s 0.1s ease-in-out;
    }

    .toggle-btn.active {
        background: blue !important;
    }

    .toggle-btn.active>.inner-circle {
        margin-left: 19px;
    }
</style>