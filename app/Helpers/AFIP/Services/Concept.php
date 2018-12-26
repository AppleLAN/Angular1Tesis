<?php

namespace App\Helpers\AFIP\Services;

class Concept
{
    /**
    * The concept type.
    *
    * @var integer
    */
    private $conceptType;

    /**
    * The tax net.
    *
    * @var integer
    */
    private $taxNet;
    
    /**
    * The tax untaxed.
    *
    * @var integer
    */
    private $taxUntaxed;
    
    /**
    * The tax exemp.
    *
    * @var integer
    */
    private $taxExemp;
    
    /**
    * The tax iva.
    *
    * @var integer
    */
    private $taxIva;
    
    /**
    * The iva type.
    *
    * @var integer
    */
    private $ivaType;

    /**
    * Set or Get concept type.
    *
    * @return object current instance.
    */
    public function conceptType($conceptType = null)
    {
        if (is_null($conceptType)) {
            return $this->conceptType;
        }

        $this->conceptType = $conceptType;
        return $this;
    }

    /**
    * Set or Get tax net.
    *
    * @return object current instance.
    */
    public function taxNet($taxNet = null)
    {
        if (is_null($taxNet)) {
            return $this->taxNet;
        }

        $this->taxNet = $taxNet;
        return $this;
    }

    /**
    * Set or Get tax untaxed.
    *
    * @return object current instance.
    */
    public function taxUntaxed($taxUntaxed = null)
    {
        if (is_null($taxUntaxed)) {
            return $this->taxUntaxed;
        }

        $this->taxUntaxed = $taxUntaxed;
        return $this;
    }

    /**
    * Set or Get tax exemp.
    *
    * @return object current instance.
    */
    public function taxExemp($taxExemp = null)
    {
        if (is_null($taxExemp)) {
            return $this->taxExemp;
        }

        $this->taxExemp = $taxExemp;
        return $this;
    }

    /**
    * Set or Get tax iva.
    *
    * @return object current instance.
    */
    public function taxIva($taxIva = null)
    {
        if (is_null($taxIva)) {
            return $this->taxIva;
        }

        $this->taxIva = $taxIva;
        return $this;
    }

    /**
    * Set or Get iva type.
    *
    * @return object current instance.
    */
    public function ivaType($ivaType = null)
    {
        if (is_null($ivaType)) {
            return $this->ivaType;
        }

        $this->ivaType = $ivaType;
        return $this;
    }

    /**
    * Sum all taxes and returns its total.
    *
    * @return double
    */
    public function total()
    {
        return $this->taxNet() + $this->taxUntaxed() + $this->taxExemp() + $this->taxIva();
    }
}
