<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once('alert.component.php');

// Checks to see if product was successfully added, returns an alert
function confirmation()
{
    if (!isset($_SESSION["addedProduct"])) {
        $_SESSION["addedProduct"] = 'not in use';
    }

    if ($_SESSION["addedProduct"] == 'true') {
        unset($_SESSION["addedProduct"]);
        alert('Product was added successfully.', 'alert-success');
    } elseif ($_SESSION["addedProduct"] == "false") {
        unset($_SESSION["addedProduct"]);
        alert('Product already exists for this console.', 'alert-danger');
    }
}

// Checks to see if new account was successfully created, returns an alert
function userReg()
{
    if (!isset($_SESSION["addedUser"])) {
        $_SESSION["addedUser"] = 'not in use';
    }

    if ($_SESSION["addedUser"] == "true") {
        unset($_SESSION["addedUser"]);
        alert('New account successfully created.', 'alert-success');
    } elseif ($_SESSION["addedUser"] == "false") {
        unset($_SESSION["addedUser"]);
        alert('Username is already taken. Please choose a different name', 'alert-danger');
    }
}

// Checks to see if user successfully logged in, returns an alert
function userLog()
{
    if (!isset($_SESSION["userLogged"])) {
        $_SESSION["userLogged"] = 'not in use';
    }

    if ($_SESSION["userLogged"] == "true") {
        unset($_SESSION["userLogged"]);
        alert('Logged in successfully.', 'alert-success');
    } elseif ($_SESSION["userLogged"] == "false") {
        unset($_SESSION["userLogged"]);
        alert('Incorrect username or password. Please try again.', 'alert-danger');
    }
}

// Checks to see if user accepted TOS
function privacyPolicyStatus()
{
    if (!isset($_SESSION["privacyPolicyStatus"])) {
        $_SESSION["privacyPolicyStatus"] = 'not in use';
    }

    if ($_SESSION["privacyPolicyStatus"] == "accepted") {
        unset($_SESSION["privacyPolicyStatus"]);
        alert('Successfully accepted the Privacy Policy. If you would like to change this, please go to user settings.', 'alert-success');
    }
}

// Checks to see if user successfully updated profile
function updatedSettings()
{
    if (!isset($_SESSION["userSettings"])) {
        $_SESSION["userSettings"] = 'not in use';
    }

    if ($_SESSION["userSettings"] == "true") {
        unset($_SESSION["userSettings"]);
        alert('Successfully updated your settings.', 'alert-success');
    } elseif ($_SESSION["userSettings"] == "false") {
        unset($_SESSION["userSettings"]);
        alert('Something went wrong. Please try again.', 'alert-danger');
    }
}
