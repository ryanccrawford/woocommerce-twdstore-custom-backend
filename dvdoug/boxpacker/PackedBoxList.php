<?php
/**
 * Box packing (3D bin packing, knapsack problem)
 * @package BoxPacker
 * @author Doug Wright
 */
namespace DVDoug\BoxPacker;

/**
 * List of possible packed box choices, ordered by utilisation (item count, volume)
 * @author Doug Wright
 * @package BoxPacker
 */
class PackedBoxList extends \SplMinHeap
{

    /**
     * Average (mean) weight of boxes
     * @var float
     */
    protected $meanWeight;

    protected $totalWeight;
    /**
     * Compare elements in order to place them correctly in the heap while sifting up.
     * @see \SplMinHeap::compare()
     */
    public function compare($boxA, $boxB)
    {
        $choice = $boxA->getItems()->count() - $boxB->getItems()->count();
        if ($choice === 0) {
            $choice = $boxB->getBox()->getInnerVolume() - $boxA->getBox()->getInnerVolume();
        }
        if ($choice === 0) {
            $choice = $boxA->getWeight() - $boxB->getWeight();
        }
        return $choice;
    }

    /**
     * Reversed version of compare
     * @return int
     */
    public function reverseCompare($boxA, $boxB)
    {
        $choice = $boxB->getItems()->count() - $boxA->getItems()->count();
        if ($choice === 0) {
            $choice = $boxA->getBox()->getInnerVolume() - $boxB->getBox()->getInnerVolume();
        }
        if ($choice === 0) {
            $choice = $boxB->getWeight() - $boxA->getWeight();
        }
        return $choice;
    }

    /**
     * Calculate the average (mean) weight of the boxes
     * @return float
     */
    public function getMeanWeight()
    {

        if (!is_null($this->meanWeight)) {
            return $this->meanWeight;
        }

        foreach (clone $this as $box) {
            $this->meanWeight += $box->getWeight();
        }

        return $this->meanWeight /= $this->count();

    }
    
    Public function getTotalWeight()
    {
        
        if (!is_null($this->totalWeight)) {
            return $this->totalWeight;
        }
        
        foreach (clone $this as $box) {
            $this->totalWeight += $box->getWeight();
        }
    
        return $this->totalWeight;
        
    }


    

    /**
     * Calculate the variance in weight between these boxes
     * @return float
     */
    public function getWeightVariance()
    {
        $mean = $this->getMeanWeight();

        $weightVariance = 0;
        foreach (clone $this as $box) {
            $weightVariance += pow($box->getWeight() - $mean, 2);
        }

        return $weightVariance / $this->count();

    }

    /**
     * Get volume utilisation of the set of packed boxes
     * @return float
     */
    public function getVolumeUtilisation()
    {
        $itemVolume = 0;
        $boxVolume = 0;

        /** @var PackedBox $box */
        foreach (clone $this as $box) {
            $boxVolume += $box->getBox()->getInnerVolume();

            /** @var Item $item */
            foreach (clone $box->getItems() as $item) {
                $itemVolume += $item->getVolume();
            }
        }

        return round($itemVolume / $boxVolume * 100, 1);
    }

    /**
     * Do a bulk insert
     * @param array $boxes
     */
    public function insertFromArray(array $boxes)
    {
        foreach ($boxes as $box) {
            $this->insert($box);
        }
    }
}
