<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>VSC Admin Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets/images/favicon.png'); ?>">
    <link href="<?php echo base_url('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/fullcalendar/css/fullcalendar.min.css'); ?>" rel="stylesheet">
    <!-- Datatable -->
    <link href="<?php echo base_url('assets/vendor/datatables/css/jquery.dataTables.min.css'); ?>" rel="stylesheet">
    <!-- Summernote -->
    <link href="<?php echo base_url('assets/vendor/summernote/summernote.css'); ?>" rel="stylesheet">

    <!-- Daterange picker -->
    <link href="<?php echo base_url('assset/vendor/bootstrap-daterangepicker/daterangepicker.css'); ?>" rel="stylesheet">
    <!-- Clockpicker -->
    <link href="<?php echo base_url('assset/vendor/clockpicker/css/bootstrap-clockpicker.min.css'); ?>" rel="stylesheet">

    <!-- Pick date -->
    <link rel="stylesheet" href="<?php echo base_url('assset/vendor/pickadate/themes/default.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assset/vendor/pickadate/themes/default.date.css'); ?>">
    <style>
        .page-titles {
            margin-bottom: 15px !important;
        }

        .deznav .menu-tabs li #cal-menu.active svg path {
            fill: #194A92;
        }

        #toolbarContainer {
            display: none !important;
        }
    </style>
</head>

<body>

    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>

    <div id="main-wrapper">
        <div class="nav-header">
            <a href="<?= base_url('admin/dashboard/' . $token) ?>" class="brand-logo">
                <img class="logo-abbr" src="<?php echo base_url('assets/logo.png'); ?>" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>