<?php

// Function to redirect with a message
function redirectWithMessage($page, $message) {
    // Check if the URL already has parameters
    $separator = (parse_url($page, PHP_URL_QUERY) == null) ? '?' : '&';
    
    // Redirect to the specified page with the message parameter
    header("Location: $page" . $separator . "message=" . urlencode($message));
    exit();
}