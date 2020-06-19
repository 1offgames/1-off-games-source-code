<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

function navbar()
{
  //checks to see if the userID & admin session var's have been set yet
  if (!isset($_SESSION["userName"])) {
    $_SESSION["userName"] = 'guest';
    $userName = $_SESSION["userName"];
  } else {
    $userName = $_SESSION["userName"];
  }
  if (!isset($_SESSION["admin"])) {
    $_SESSION["admin"] = 'no';
  }
  //checks to see if userID is set
  if (!isset($_SESSION["userID"])) {
    $_SESSION["userID"] = 0;
  }


  if ($_SESSION["admin"] == "yes") {
    $element = "
      <nav class='navbar navbar-expand-lg navbar-dark bg-dark fixed-top header-height navbar-position'>
        <div id='navbar-dropdown' class='container p-0'>
          <a class='navbar-brand' href='index.php'><img src='./img/1offgames_logo_white_trimmed_navbar.png' /></a>
          <button
            class='navbar-toggler'
            type='button'
            data-toggle='collapse'
            data-target='#navbarResponsive'
            aria-controls='navbarResponsive'
            aria-expanded='false'
            aria-label='Toggle navigation'
          >
            <span class='navbar-toggler-icon'></span>
          </button>
          <div class='collapse navbar-collapse' id='navbarResponsive'>
            <ul class='navbar-nav ml-auto'>
              <li class='nav-item'>
                <a class='nav-link' href='products.php'><i class='fa fa-tag fa-2x align-middle' aria-hidden='true'></i>&nbsp; View Products</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='cart.php'><i class='fa fa-shopping-cart fa-2x align-middle'></i>&nbsp; Cart</a>
              </li>
              <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                  <i class='fa fa-user fa-2x align-middle'></i>&nbsp; $userName
                </a>
                <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                  <a class='dropdown-item' href='addProduct.php'><i class='fa fa-plus-circle fa-2x align-middle'></i>&nbsp; Add New Product</a>
                  <a class='dropdown-item' href='usersettings.php'><i class='fa fa-cog fa-2x align-middle'></i>&nbsp; Settings</a>
                  <a class='dropdown-item' href='orderhistory.php'><i class='fa fa-history fa-2x align-middle'></i>&nbsp; Order History</a>
                  <div class='dropdown-divider'></div>
                  <a class='dropdown-item' href='php/logout.php'><i class='fa fa-sign-out fa-2x align-middle'></i>&nbsp Log out</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    ";
  } else if ($_SESSION["userID"] != 0) {
    $element = "
      <nav class='navbar navbar-expand-lg navbar-dark bg-dark fixed-top header-height navbar-position'>
        <div id='navbar-dropdown' class='container p-0'>
          <a class='navbar-brand' href='index.php'><img src='./img/1offgames_logo_white_trimmed_navbar.png' /></a>
          <button
            class='navbar-toggler'
            type='button'
            data-toggle='collapse'
            data-target='#navbarResponsive'
            aria-controls='navbarResponsive'
            aria-expanded='false'
            aria-label='Toggle navigation'
          >
            <span class='navbar-toggler-icon'></span>
          </button>
          <div class='collapse navbar-collapse' id='navbarResponsive'>
            <ul class='navbar-nav ml-auto'>
              <li class='nav-item'>
                <a class='nav-link' href='products.php'><i class='fa fa-tag fa-2x align-middle' aria-hidden='true'></i>&nbsp; View Products</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='cart.php'><i class='fa fa-shopping-cart fa-2x align-middle'></i>&nbsp; Cart</a>
              </li>
              <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                  <i class='fa fa-user fa-2x align-middle'></i>&nbsp; $userName
                </a>
                <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                  <a class='dropdown-item' href='usersettings.php'><i class='fa fa-cog fa-2x align-middle'></i>&nbsp; Settings</a>
                  <a class='dropdown-item' href='orderhistory.php'><i class='fa fa-history fa-2x align-middle'></i>&nbsp; Order History</a>
                  <div class='dropdown-divider'></div>
                  <a class='dropdown-item' href='php/logout.php'><i class='fa fa-sign-out fa-2x align-middle'></i>&nbsp Log out</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    ";
  } else {
    $element = "
      <nav class='navbar navbar-expand-lg navbar-dark bg-dark fixed-top header-height navbar-position'>
        <div id='navbar-dropdown' class='container p-0'>
          <a class='navbar-brand' href='index.php'><img src='./img/1offgames_logo_white_trimmed_navbar.png' /></a>
          <button
            class='navbar-toggler'
            type='button'
            data-toggle='collapse'
            data-target='#navbarResponsive'
            aria-controls='navbarResponsive'
            aria-expanded='false'
            aria-label='Toggle navigation'
          >
            <span class='navbar-toggler-icon'></span>
          </button>
          <div class='collapse navbar-collapse' id='navbarResponsive'>
            <ul class='navbar-nav ml-auto'>
              <li class='nav-item'>
                <a class='nav-link' href='products.php'><i class='fa fa-tag fa-2x align-middle' aria-hidden='true'></i>&nbsp; View Products</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='login.php'><i class='fa fa-sign-in fa-2x align-middle'></i>&nbsp Login</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='register.php'><i class='fa fa-user-plus fa-2x align-middle'></i>&nbsp Register</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    ";
  }

  echo $element;
}
