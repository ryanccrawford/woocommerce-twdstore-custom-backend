<?php

if (!class_exists("\DVDoug\BoxPacker\Packer")) {

    require_once('loadit.php');
}

class packing_box implements \DVDoug\BoxPacker\Box {



    public function __construct(

        $reference,

        $outerWidth,

        $outerLength,

        $outerDepth,

        $emptyWeight,

        $innerWidth,

        $innerLength,

        $innerDepth,

        $maxWeight

    ) {



        $this->reference = $reference;

        $this->outerWidth = $outerWidth;

        $this->outerLength = $outerLength;

        $this->outerDepth = $outerDepth;

        $this->emptyWeight = $emptyWeight;

        $this->innerWidth = $innerWidth;

        $this->innerLength = $innerLength;

        $this->innerDepth = $innerDepth;

        $this->maxWeight = $maxWeight;

        $this->innerVolume = $this->innerWidth * $this->innerLength * $this->innerDepth;
    }



    public function getReference()

    {

        return $this->reference;
    }



    public function getOuterWidth()

    {

        return $this->outerWidth;
    }



    public function getOuterLength()

    {

        return $this->outerLength;
    }



    public function getOuterDepth()

    {

        return $this->outerDepth;
    }



    public function getEmptyWeight()

    {

        return $this->emptyWeight;
    }



    public function getInnerWidth()

    {

        return $this->innerWidth;
    }



    public function getInnerLength()

    {

        return $this->innerLength;
    }



    public function getInnerDepth()

    {

        return $this->innerDepth;
    }



    public function getInnerVolume()

    {

        return $this->innerVolume;
    }



    public function getMaxWeight()

    {

        return $this->maxWeight;
    }
}



class packing_item implements \DVDoug\BoxPacker\Item {



    private $description;

    private $width;

    private $length;

    private $depth;

    private $weight;

    private $keepFlat;

    private $volume;

    public function __construct($description, $width, $length, $depth, $weight, $keepFlat)

    {



        $this->description = $description;

        $this->width = $width;

        $this->length = $length;

        $this->depth = $depth;

        $this->weight = $weight;

        $this->keepFlat = $keepFlat;



        $this->volume = $this->width * $this->length * $this->depth;
    }



    public function getDescription()

    {

        return $this->description;
    }



    public function getWidth()

    {

        return $this->width;
    }



    public function getLength()

    {

        return $this->length;
    }



    public function getDepth()

    {

        return $this->depth;
    }



    public function getWeight()

    {

        return $this->weight;
    }



    public function getVolume()

    {

        return $this->volume;
    }



    public function getKeepFlat()

    {

        return $this->keepFlat;
    }
}
