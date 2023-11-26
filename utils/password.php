<?php

function hashPassword($password) {
    // Hash the password using the default bcrypt algorithm
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    return $hashedPassword;
}

function verifyPassword($password, $hashedPassword) {
    // Verify if the given password matches the hashed password
    $isPasswordValid = password_verify($password, $hashedPassword);
    return $isPasswordValid;
}