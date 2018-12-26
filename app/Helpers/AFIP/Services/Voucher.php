<?php

namespace App\Helpers\AFIP\Services;

class Voucher
{
    /**
    * The voucher number.
    *
    * @var integer
    */
    private $voucherNumber;

    /**
    * The voucher type.
    *
    * @var integer
    */
    private $voucherType;

    /**
    * The point sale.
    *
    * @var integer
    */
    private $pointSale;

    /**
    * The document type.
    *
    * @var integer
    */
    private $documentType;

    /**
    * The document number.
    *
    * @var integer
    */
    private $documentNumber;

    /**
    * date.
    *
    * @var string
    */
    private $date;

    /**
    * The currency type.
    *
    * @var string
    */
    private $currencyType;

    /**
    * The currency trading.
    *
    * @var integer
    */
    private $currencyTrading;

    /**
    * from date.
    *
    * @var string
    */
    private $fromDate;
    
    /**
    * to date.
    *
    * @var string
    */
    private $toDate;

    /**
    * expiration date.
    *
    * @var string
    */
    private $expirationDate;

    //protected $conceptType;
    private $concepts = [];

    /**
    * Set or Get voucher number.
    *
    * @return object current instance.
    */
    public function voucherNumber($voucherNumber = null)
    {
        if (is_null($voucherNumber)) {
            return $this->voucherNumber;
        }

        $this->voucherNumber = $voucherNumber;
        return $this;
    }

    /**
    * Set or Get voucher type.
    *
    * @return object current instance.
    */
    public function voucherType($voucherType = null)
    {
        if (is_null($voucherType)) {
            return $this->voucherType;
        }

        $this->voucherType = $voucherType;
        return $this;
    }

    /**
    * Set or Get point sale.
    *
    * @return object current instance.
    */
    public function pointSale($pointSale = null)
    {
        if (is_null($pointSale)) {
            return $this->pointSale;
        }

        $this->pointSale = $pointSale;
        return $this;
    }

    /**
    * Set or Get document type.
    *
    * @return object current instance.
    */
    public function documentType($documentType = null)
    {
        if (is_null($documentType)) {
            return $this->documentType;
        }

        $this->documentType = $documentType;
        return $this;
    }

    /**
    * Set or Get document number.
    *
    * @return object current instance.
    */
    public function documentNumber($documentNumber = null)
    {
        if (is_null($documentNumber)) {
            return $this->documentNumber;
        }

        $this->documentNumber = $documentNumber;
        return $this;
    }

    /**
    * Set or Get date.
    *
    * @return object current instance.
    */
    public function date($date = null)
    {
        if (is_null($date)) {
            return $this->date;
        }

        $this->date = $date;
        return $this;
    }

    /**
    * Set or Get currency type.
    *
    * @return object current instance.
    */
    public function currencyType($currencyType = null)
    {
        if (is_null($currencyType)) {
            return $this->currencyType;
        }

        $this->currencyType = $currencyType;
        return $this;
    }

    /**
    * Set or Get currency trading.
    *
    * @return object current instance.
    */
    public function currencyTrading($currencyTrading = null)
    {
        if (is_null($currencyTrading)) {
            return $this->currencyTrading;
        }

        $this->currencyTrading = $currencyTrading;
        return $this;
    }

    /**
    * Set or Get from date.
    *
    * @return object current instance.
    */
    public function fromDate($fromDate = null)
    {
        if (is_null($fromDate)) {
            return $this->fromDate;
        }

        $this->fromDate = $fromDate;
        return $this;
    }

    /**
    * Set or Get to date.
    *
    * @return object current instance.
    */
    public function toDate($toDate = null)
    {
        if (is_null($toDate)) {
            return $this->toDate;
        }

        $this->toDate = $toDate;
        return $this;
    }

    /**
    * Set or Get expiration date.
    *
    * @return object current instance.
    */
    public function expirationDate($expirationDate = null)
    {
        if (is_null($expirationDate)) {
            return $this->expirationDate;
        }

        $this->expirationDate = $expirationDate;
        return $this;
    }

    /**
    * Add a concept to the voucher.
    * 
    * @param AFIP/Services/Concept $concept
    *
    * @return void
    */
    public function addConcept($concept)
    {
        $this->concepts[] = $concept;
    }

    /**
    * Iterate over concepts array and sum an specific attribute.
    *
    * @param string $attribute
    *
    * @return double
    */
    private function sumTotal($attribute)
    {
        $total = 0;
        foreach ($this->concepts as $concept) {
            $total += $concept->$attribute();
        }

        return $total;
    }

    /**
    * Get total.
    *
    * @return double
    */
    public function total()
    {
        return $this->sumTotal('total');
    }

    /**
    * Get total tax.
    *
    * @return double
    */
    public function totalTax()
    {
        return $this->sumTotal('taxNet');
    }

    /**
    * Get total tax untaxed.
    *
    * @return double
    */
    public function totalTaxUntaxed()
    {
        return $this->sumTotal('taxUntaxed');
    }

    /**
    * Get total tax exemp.
    *
    * @return double
    */
    public function totalTaxExemp()
    {
        return $this->sumTotal('taxExemp');
    }

    /**
    * Get total tax iva.
    *
    * @return double
    */
    public function totalTaxIva()
    {
        return $this->sumTotal('taxIva');
    }

    /**
    * @todo refactor
    */
    public function getRequest()
    {
        $tiposIva = array();
        $ivaTypes = [];

        foreach ($this->concepts as $concept) {
            if (!isset($ivaTypes[$concept->ivaType()]['BaseImp'])) 
                $ivaTypes[$concept->ivaType()]['BaseImp'] = 0;
            if (!isset($ivaTypes[$concept->ivaType()]['Importe'])) 
                $ivaTypes[$concept->ivaType()]['Importe'] = 0;

            $ivaTypes[$concept->ivaType()]['BaseImp'] += $concept->taxNet();
            $ivaTypes[$concept->ivaType()]['Importe'] += $concept->taxIva();
        }

        foreach ($ivaTypes as $tipoIva => $datos) {
            $IVA['AlicIva'][] = ['Id' => $tipoIva, 'BaseImp' => $datos['BaseImp'], 'Importe' => $datos['Importe']];
        }

        $request = [
            'Concepto' => 3,
            'DocTipo' => $this->documentType(),
            'DocNro' => $this->documentNumber(),
            'CbteDesde' => $this->voucherNumber(),
            'CbteHasta' => $this->voucherNumber(),
            'CbteFch' => $this->date(),
            'ImpTotal' => $this->total(),
            'ImpTotConc' => $this->totalTaxUntaxed(),
            'ImpNeto' => $this->totalTax(),
            'ImpOpEx'=> $this->totalTaxExemp(),
            'ImpIVA' => $this->totalTaxIva(),
            'ImpTrib' => 0,
            'FchServDesde' => $this->fromDate(),
            'FchServHasta' => $this->toDate(),
            'FchVtoPago' => $this->expirationDate(),
            'MonId'=> $this->currencyType(),
            'MonCotiz'=> $this->currencyTrading(),
            'Iva' => $IVA
        ];

        $feCabReq = ['CantReg' => 1, 'PtoVta' => $this->pointSale(), 'CbteTipo' => $this->voucherType()];

        $feDetReq['FECAEDetRequest'][] = $request;

        $request['FeCAEReq'] = ['FeCabReq' => $feCabReq, 'FeDetReq' => $feDetReq];

        return $request;
    }
}