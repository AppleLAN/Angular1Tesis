<?php

namespace App\Helpers\AFIP;

use App\Helpers\AFIP\Services\Concept;
use App\Helpers\AFIP\Services\Voucher;
use Carbon\Carbon;
use SoapClient;

class Afip extends SoapClient
{
    /**
    * The WSAA instance.
    *
    * @var object
    */
    private $wsaa;

    /**
    * The concepts list.
    *
    * @var array
    */
    private $concepts;

    /**
    * Create a new Afip instance.
    *
    * @param string $service
    *
    * @return void
    */
    public function __construct($service)
    {
        /* if (false === true) {
            $this->wsfeUri = config('afip.wsfe_pro');
            $this->wsfeWsdlUri = config('afip.wsfe_wsdl_pro');
        } else { */
            $this->wsfeUri = 'https://wswhomo.afip.gov.ar/wsfev1/service.asmx';
            $this->wsfeWsdlUri = 'https://wswhomo.afip.gov.ar/wsfev1/service.asmx?WSDL';
        /* } */

        $this->wsaa = Wsaa::getInstance($service)->init();
        parent::SoapClient($this->wsfeWsdlUri, $this->WSFEoptions());
    }

    /**
    * Soap options.
    *
    * @return array
    */
    public function WSFEoptions()
    {
        return [
            'soap_version'   => SOAP_1_2,
            'location'       => $this->wsfeUri,
            'trace'          => 1,
            'exceptions'     => true,
          //  'stream_context' => stream_context_create(['ssl' => ['ciphers' => 'RC4-SHA']]),
            'cache_wsdl'     => WSDL_CACHE_NONE
        ];
    }

    /**
    * Request to the AFIP webservice.
    *
    * @param string $method
    * @param array $options
    *
    * @return mixed
    */
    private function request($method, $options = [])
    {
        $options = $this->wsaa->getAuth() + $options;

        $results = $this->$method($options);

        $vars = get_object_vars(current($results));

        if (array_key_exists('Errors', $vars)) {
            return $vars['Errors'];
        } elseif (array_key_exists('ResultGet', $vars)) {
            return current($vars['ResultGet']);
        }

        return $vars;
    }

    /**
    * Request to the AFIP webservice.
    *
    * @param string $method
    * @param array $options
    *
    * @return mixed
    */
    private function requestTest($method, $options = [])
    {
        $options = $this->wsaa->getAuth() + $options;

        $results = $this->$method($options);

        $vars = get_object_vars(current($results));
        return $vars;
        
        if (array_key_exists('Errors', $vars)) {
            return $vars['Errors'];
        } elseif (array_key_exists('ResultGet', $vars)) {
            return current($vars['ResultGet']);
        }

        return $vars;
    }

    /**
    * Dummy method for verification operation.
    *
    * @return array
    */
    public function serverStatus()
    {
        return $this->request('FEDummy');
    }

    /**
    * Retrieve the list of registered points of sale and their status.
    *
    * @return array
    */
    public function pointsOfSale()
    {
        return $this->request('FEParamGetPtosVenta');
    }

    /**
    * Retrieve the list of types of vouchers usable authorization service.
    *
    * @return array
    */
    public function voucherTypes()
    {
        return $this->request('FEParamGetTiposCbte');
    }

    /**
    * Retrieve the list of identifiers for the Concept field.
    *
    * @return array
    */
    public function conceptTypes()
    {
        return $this->request('FEParamGetTiposConcepto');
    }

    /**
    * Retrieve the list of types of documents used in authorization service.
    *
    * @return array
    */
    public function documentTypes()
    {
        return $this->request('FEParamGetTiposDoc');
    }

    /**
    * Retrieve the list of IVA rates used in authorization service..
    *
    * @return array
    */
    public function ivaTypes()
    {
        return $this->request('FEParamGetTiposIva');
    }

    /**
    * Retrieve the list of reusable coins authorization service.
    *
    * @return array
    */
    public function currencyRates()
    {
        return $this->request('FEParamGetTiposMonedas');
    }

    /**
    * Retrieve the list of the different taxes that can be used in the authorization service.
    *
    * @return array
    */
    public function taxTypes()
    {
        return $this->request('FEParamGetTiposTributos');
    }

    /**
    * Return the last proof approved for the type of voucher.
    *
    * @return array
    */
    public function lastVoucher($pointSale, $type)
    {
        return $this->request('FECompUltimoAutorizado', [
            'PtoVta' => $pointSale,
            'CbteTipo' => $type
        ]);
    }
    /**
    * Return the last proof approved for the type of voucher.
    *
    * @return array
    */
    public function findCAE($pointSale, $type, $number)
    {
        return $this->requestTest('FECompConsultar', [
            'FeCompConsReq' => [
              'CbteTipo' => $type,
              'CbteNro' => $number,
              'PtoVta' => $pointSale
            ]

        ]);
    }
    public function requestCAE($request)
    {
        return $this->request('FECAESolicitar', $request);
    }

    /**
    * Add a new concept.
    *
    * @example ['concept_type' => 1,'tax_net' => 0,'tax_untaxed' => 0,'tax_exempt' => 0,'tax_iva' => 0,'iva_type' => 3]
    *
    * @return App\Helpers\AFIP\Services\Concept
    */
    public function concept()
    {
        return new Concept;
    }

    /**
    * Add a new voucher;
    *
    * @return App\Helpers\AFIP\Services\Voucher
    */
    public function voucher()
    {
        return new Voucher;
    }
}
