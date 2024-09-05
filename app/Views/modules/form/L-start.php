<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale:1.0">
    <link rel="website icon" type="png" href="<?php echo base_url('complements/styles/images/NVS.png'); ?>">
    <!-- Librarys -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo base_url('complements/styles/secondary/form/start.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('complements/styles/secondary/form/form.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('complements/styles/main/home/navbar.css'); ?>">
    <title>| Log In |</title>
</head>

<body>
    <!-- Session message -->
    <?php if (session()->getFlashdata('error')) : ?>
    <div class="message error"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('success')) : ?>
    <div class="message success"><?= session()->getFlashdata('success'); ?></div>
    <?php endif; ?>

    <!-- cursor -->
    <div class="cursor"></div>

    <!-- Implementation of Mayus Warning -->
    <div id="caps-lock-warning-password" class="caps-lock-warning">
        <i class="fas fa-lock"></i> Caps Lock is on
    </div>

    <!-- navbar section starts here -->
    <nav id="navbar">
        <div class="logo"><a href="<?= base_url('/'); ?>">NVS</a></div>
        <div id="menuToggle" class="menu-icon">
            <span class="menu-icon-bar"></span>
            <span class="menu-icon-bar"></span>
            <span class="menu-icon-bar"></span>
        </div>
    </nav>
    <!-- navbar section ends here -->

    <!-- menu section starts here -->
    <div id="overlayNav">
        <div class="overlay-content">
            <div class="overlay-left">
                <div class="overlay-video">
                    <img id="modeImage" alt="Video">
                    <div class="video-controls">
                        <span>00: 13: 49: 12: 45: 02</span>
                    </div>
                </div>
            </div>
            <div class="overlay-right">
                <ul>
                    <li><a href="<?= base_url('home-animation'); ?>">Home</a></li>
                </ul>
                <button class="cta-button">Download</button>
                <hr class="line">
                <ul>
                    <li><a id="modeToggle" href="javascript:void(0);">Dark</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- menu section ends here -->