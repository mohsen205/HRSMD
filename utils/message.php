<?php

// Function to redirect with a message
function redirectWithMessage($page, $message) {
    header("Location: $page?message=" . urlencode($message));
    exit();
}