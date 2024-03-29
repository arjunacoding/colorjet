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
 * CIELCh represents the CIELCh color format
 *
 *
 * @author Arjuna Coding <arjunacoding@gmail.com>
 */
class CIELCh extends ColorJet
{

    /**
     * The lightness
     * @var float
     */
    public $lightness;

    /**
     * The chroma
     * @var float
     */
    public $chroma;

    /**
     * The hue
     * @var float
     */
    public $hue;

    /**
     * Create a new CIELCh color
     *
     * @param float $lightness The lightness
     * @param float $chroma The chroma
     * @param float $hue The hue
     */
    public function __construct($lightness, $chroma, $hue)
    {
        $this->toSelf = "toCIELCh";
        $this->lightness = round($lightness,4);
        $this->chroma = round($chroma,4);
        $this->hue = fmod($hue, 360);
        if ($this->hue < 0) {
            $this->hue += 360;
        }
    }

    /**
     * Convert the color to Hex format
     *
     * @return \ArjunaCoding\ColorJet\Formats\Hex the color in Hex format
     */
    public function toHex()
    {
        return $this->toCIELab()->toHex();
    }

    /**
     * Convert the color to RGB format
     *
     * @return \ArjunaCoding\ColorJet\Formats\RGB the color in RGB format
     */
    public function toRGB()
    {
        return $this->toCIELab()->toRGB();
    }

    /**
     * Convert the color to XYZ format
     *
     * @return \ArjunaCoding\ColorJet\Formats\XYZ the color in XYZ format
     */
    public function toXYZ()
    {
        return $this->toCIELab()->toXYZ();
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
        return $this->toCIELab()->toHSV();
    }

    /**
     * Convert the color to CMY format
     *
     * @return \ArjunaCoding\ColorJet\Formats\CMY the color in CMY format
     */
    public function toCMY()
    {
        return $this->toCIELab()->toCMY();
    }

    /**
     * Convert the color to CMYK format
     *
     * @return \ArjunaCoding\ColorJet\Formats\CMYK the color in CMYK format
     */
    public function toCMYK()
    {
        return $this->toCIELab()->toCMYK();
    }

    /**
     * Convert the color to CIELab format
     *
     * @return \ArjunaCoding\ColorJet\Formats\CIELab the color in CIELab format
     */
    public function toCIELab()
    {
        $hradi = $this->hue * (pi() / 180);
        $a_dimension = cos($hradi) * $this->chroma;
        $b_dimension = sin($hradi) * $this->chroma;
        return new CIELab($this->lightness, $a_dimension, $b_dimension);
    }

    /**
     * Convert the color to CIELCh format
     *
     * @return \ArjunaCoding\ColorJet\Formats\CIELCh the color in CIELCh format
     */
    public function toCIELCh()
    {
        return $this;
    }

    /**
     * A string representation of this color in the current format
     *
     * @return string The color in format: $lightness,$chroma,$hue
     */
    public function __toString()
    {
        return sprintf('%01.4f, %01.4f, %01.4f', $this->lightness, $this->chroma, $this->hue);
    }
}
