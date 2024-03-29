<?php

/*
 * This file is part of the ColorJet package.
 *
 * (c) Arjuna Coding <arjunacoding@gmail.com>
 *
 */

namespace ArjunaCoding\ColorJet\Formats;

use ArjunaCoding\ColorJet\ColorJet;
use ArjunaCoding\ColorJet\Exceptions\InvalidArgumentException;

/**
 * CMY represents the CMY color format
 *
 *
 * @author Arjuna Coding <arjunacoding@gmail.com>
 */
class CMY extends ColorJet
{

    /**
     * The cyan
     * @var float
     */
    public $cyan;

    /**
     * The magenta
     * @var float
     */
    public $magenta;

    /**
     * The yellow
     * @var float
     */
    public $yellow;

    /**
     * Create a new CIELab color
     *
     * @param float $cyan The cyan
     * @param float $magenta The magenta
     * @param float $yellow The yellow
     */
    public function __construct($cyan, $magenta, $yellow)
    {
        $this->toSelf = "toCMY";
        $this->cyan = round($cyan,2);
        $this->magenta = round($magenta,2);
        $this->yellow = round($yellow,2);
    }

    public static function create($cyan, $magenta, $yellow)
    {
        return new CMY($cyan, $magenta, $yellow);
    }


    /**
     * Get the amount of Cyan
     *
     * @return int The amount of cyan
     */
    public function getCyan()
    {
        return $this->cyan;
    }


    /**
     * Get the amount of Magenta
     *
     * @return int The amount of magenta
     */
    public function getMagenta()
    {
        return $this->magenta;
    }


    /**
     * Get the amount of Yellow
     *
     * @return int The amount of yellow
     */
    public function getYellow()
    {
        return $this->yellow;
    }


    /**
     * Convert the color to Hex format
     *
     * @return \ArjunaCoding\ColorJet\Formats\Hex the color in Hex format
     */
    public function toHex()
    {
        return $this->toRGB()->toHex();
    }

    /**
     * Convert the color to RGB format
     *
     * @return \ArjunaCoding\ColorJet\Formats\RGB the color in RGB format
     */
    public function toRGB()
    {
        $red = (1 - $this->cyan) * 255;
        $green = (1 - $this->magenta) * 255;
        $blue = (1 - $this->yellow) * 255;
        return new RGB($red, $green, $blue);
    }

    /**
     * Convert the color to XYZ format
     *
     * @return \ArjunaCoding\ColorJet\Formats\XYZ the color in XYZ format
     */
    public function toXYZ()
    {
        return $this->toRGB()->toXYZ();
    }

    /**
     * Convert the color to Yxy format
     *
     * @return \ArjunaCoding\ColorJet\Formats\Yxy the color in Yxy format
     */
    public function toYxy()
    {
        return $this->toXYZ()->toYxy();
    }

    /**
     * Convert the color to HSL format
     *
     * @return \ArjunaCoding\ColorJet\Formats\HSL the color in HSL format
     */
    public function toHSL()
    {
        return $this->toHSV()->toHSL();
    }

    /**
     * Convert the color to HSV format
     *
     * @return \ArjunaCoding\ColorJet\Formats\HSV the color in HSV format
     */
    public function toHSV()
    {
        return $this->toRGB()->toHSV();
    }

    /**
     * Convert the color to CMY format
     *
     * @return \ArjunaCoding\ColorJet\Formats\CMY the color in CMY format
     */
    public function toCMY()
    {
        return $this;
    }

    /**
     * Convert the color to CMYK format
     *
     * @return \ArjunaCoding\ColorJet\Formats\CMYK the color in CMYK format
     */
    public function toCMYK()
    {
        $var_K = 1;
        $cyan = $this->cyan;
        $magenta = $this->magenta;
        $yellow = $this->yellow;
        if ($cyan < $var_K) {
            $var_K = $cyan;
        }
        if ($magenta < $var_K) {
            $var_K = $magenta;
        }
        if ($yellow < $var_K) {
            $var_K = $yellow;
        }
        if ($var_K == 1) {
            $cyan = 0;
            $magenta = 0;
            $yellow = 0;
        } else {
            $cyan = ($cyan - $var_K) / (1 - $var_K);
            $magenta = ($magenta - $var_K) / (1 - $var_K);
            $yellow = ($yellow - $var_K) / (1 - $var_K);
        }

        $key = $var_K;

        return new CMYK($cyan, $magenta, $yellow, $key);
    }

    /**
     * Convert the color to CIELab format
     *
     * @return \ArjunaCoding\ColorJet\Formats\CIELab the color in CIELab format
     */
    public function toCIELab()
    {
        return $this->toRGB()->toCIELab();
    }

    /**
     * Convert the color to CIELCh format
     *
     * @return \ArjunaCoding\ColorJet\Formats\CIELCh the color in CIELCh format
     */
    public function toCIELCh()
    {
        return $this->toCIELab()->toCIELCh();
    }

    /**
     * A string representation of this color in the current format
     *
     * @return string The color in format: $cyan,$magenta,$yellow
     */
    public function __toString()
    {
        return sprintf('%01.4f, %01.4f, %01.4f', $this->cyan, $this->magenta, $this->yellow);
    }
}
