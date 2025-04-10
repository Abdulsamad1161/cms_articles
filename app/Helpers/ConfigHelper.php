<?php

use App\Models\ConfigApp;

if (!function_exists('getLogoUrl')) {
  function getLogoUrl()
  {
    $config = ConfigApp::first();
    return $config ? $config->companyLogo : null;
  }
}
