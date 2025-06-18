<?php

    header("Access-Control-Allow-Origin: *");

    session_start();
    
    // Create image
    $width = 150;
    $height = 50;
    $image = imagecreatetruecolor($width, $height);
    
    // Random background color
    $bgColor = imagecolorallocate($image, rand(220, 255), rand(220, 255), rand(220, 255));
    imagefill($image, 0, 0, $bgColor);
    
    // Array of fonts
    $fonts = [
        __DIR__ . '/assets/fonts/Acme.ttf',
        __DIR__ . '/assets/fonts/Merriweather.ttf',
        __DIR__ . '/assets/fonts/Ubuntu.ttf'
    ];
    
    // Generate random captcha text
    $captchaText = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789'), 0, 4);
    $_SESSION['captcha'] = $captchaText;  // Store in session
    
    // Draw random scribbles
    for ($i = 0; $i < 20; $i++) {
        $lineColor = imagecolorallocate($image, rand(100, 255), rand(100, 255), rand(100, 255));
        imageline(
            $image,
            rand(0, $width), rand(0, $height),
            rand(0, $width), rand(0, $height),
            $lineColor
        );
    }
    
    // Add colorful and random text
    for ($i = 0; $i < strlen($captchaText); $i++) {
        $fontFile = $fonts[array_rand($fonts)];
        $fontSize = rand(20, 30);
        $angle = rand(-30, 30);
        $x = 20 + ($i * 30);
        $y = rand(30, 40);
        $textColor = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
        imagettftext($image, $fontSize, $angle, $x, $y, $textColor, $fontFile, $captchaText[$i]);
    }
    
    // Output the image
    header('Content-Type: image/png');
    imagepng($image);
    imagedestroy($image);
