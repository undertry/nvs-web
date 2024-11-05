<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale:1.0">
    <link rel="website icon" type="png" href="<?php echo base_url('complements/styles/images/NVS.png'); ?>">
    <!-- Librarys -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo base_url('complements/styles/secondary/form/start.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('complements/styles/secondary/form/form.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('complements/styles/main/home/navbar.css'); ?>">
    <title>| Sign Up |</title>
</head>

<body>
    <!-- Session message -->
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="message error"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="message success"><?= session()->getFlashdata('success'); ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error') === 'The passwords do not match.') : ?>
    <?php endif; ?>

    <!-- cursor -->
    <div class="cursor"></div>

    <!-- Implementation of Mayus Warning -->
    <div id="caps-lock-warning-password" class="caps-lock-warning">
        <i class="fas fa-lock"></i> Caps Lock is on
    </div>

    <!-- Password popup -->
    <div id="passwordPopup" class="password-popup">
        <p>Your password must be at least <span>8 characters long</span>, contain <span>1 uppercase letter</span>, and include a <span>special character</span>.</p>
    </div>
    </div>