<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale:1.0">
    <link rel="stylesheet" href="<?php echo base_url('complements/styles/secondary/form/user.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('complements/styles/main/home/navbar.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="website icon" type="png" href="<?php echo base_url('complements/styles/images/NVS.png'); ?>">

    <!-- cursor -->
    <div class="cursor"></div>

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

    <script>
        const lightImage = "<?= base_url('complements/styles/images/polygon.jpg'); ?>";
        const darkImage = "<?= base_url('complements/styles/images/lines.jpg'); ?>";
    </script>

    <!-- menu section ends here -->