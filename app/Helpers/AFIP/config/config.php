<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Production or Testing
    |--------------------------------------------------------------------------
    */
    'production' => false,

    /*
    |--------------------------------------------------------------------------
    | CUIT (11 digits without hyphens)
    |--------------------------------------------------------------------------
    */
    'cuit' => 20293599948,

    /*
    |--------------------------------------------------------------------------
    | Certificate file path
    |--------------------------------------------------------------------------
    */
    'certificate_file' => "file://" . storage_path('certification/sawmill_cert.pem'),

    /*
    |--------------------------------------------------------------------------
    | Private key file path
    |--------------------------------------------------------------------------
    */
    'private_key' => 'file://' . storage_path('certification/sawmill_sandbox'),

    /*
    |--------------------------------------------------------------------------
    | Configuration variables related to Production Environment
    |--------------------------------------------------------------------------
    */
    'wsaa_pro' => 'https://wsaa.afip.gov.ar/ws/services/LoginCms',
    'wsaa_wsdl_pro' => "https://wsaa.afip.gov.ar/ws/services/LoginCms?WSDL",
    'wsfe_pro' => "https://servicios1.afip.gov.ar/wsfev1/service.asmx",
    'wsfe_wsdl_pro' => "https://servicios1.afip.gov.ar/wsfev1/service.asmx?WSDL",

    /*
    |--------------------------------------------------------------------------
    | Configuration variables related to Testing Environment
    |--------------------------------------------------------------------------
    */
    'wsaa_dev' => 'https://wsaahomo.afip.gov.ar/ws/services/LoginCms',
    'wsaa_wsdl_dev' => "https://wsaahomo.afip.gov.ar/ws/services/LoginCms?WSDL",
    'wsfe_dev' => "https://wswhomo.afip.gov.ar/wsfev1/service.asmx",
    'wsfe_wsdl_dev' => "https://wswhomo.afip.gov.ar/wsfev1/service.asmx?WSDL",
];