<?php
namespace App\Traits;

trait FloatTrait
{

    /**
     * Default precision for function results
     *
     * @var integer
     */
    protected $scale = 2;

    /**
     * Default precision for BCMath functions
     *
     * @var integer
     */
    protected $bcMathScale = 10;

    /**
     * Rounding calculation values
     *
     * @param string $valueToRound
     * @param integer|null $scale
     *
     * @return float
     */
    protected function round(string $valueToRound, ?int $scale = null): float
    {
        if ($scale === null) {
            $scale = $this->scale;
        }

        $result = $valueToRound;

        if (strpos($valueToRound, '.') !== false) {
            if ($valueToRound[0] != '-') {
                $result = bcadd($valueToRound, '0.' . str_repeat('0', $scale) . '5', $scale);
            } else {
                $result = bcsub($valueToRound, '0.' . str_repeat('0', $scale) . '5', $scale);
            }
        }

        return $result;
    }

    /**
     * Add floats
     *
     * @param float|null $firstElement
     * @param float|null $secondElement
     * @param integer|null $scale
     *
     * @return float
     */
    protected function add(?float $firstElement, ?float $secondElement, ?int $scale = null): float
    {
        $result = bcadd($firstElement, $secondElement, $this->bcMathScale);

        return $this->round($result, $scale);
    }

    /**
     * Substract floats
     *
     * @param float|null $firstElement
     * @param float|null $secondElement
     * @param integer|null $scale
     *
     * @return float
     */
    protected function substract(?float $firstElement, ?float $secondElement, ?int $scale = null): float
    {
        $result = bcsub($firstElement, $secondElement, $this->bcMathScale);

        return $this->round($result, $scale);
    }

    /**
     * Alias for `substract` function
     *
     * @param float|null $firstElement
     * @param float|null $secondElement
     * @param integer|null $scale
     *
     * @return float
     */
    protected function sub(?float $firstElement, float $secondElement, ?int $scale = null): float
    {
        return $this->substract($firstElement, $secondElement, $scale);
    }

    /**
     * Multiply floats
     *
     * @param float|null $firstElement
     * @param float|null $secondElement
     * @param integer|null $scale
     *
     * @return float
     */
    protected function multiply(?float $firstElement, ?float $secondElement, ?int $scale = null): float
    {
        $result = bcmul($firstElement, $secondElement, $this->bcMathScale);

        return $this->round($result, $scale);
    }

    /**
     * Alias for `multiply` function
     *
     * @param float|null $firstElement
     * @param float|null $secondElement
     * @param integer|null $scale
     *
     * @return float
     */
    protected function mul(?float $firstElement, ?float $secondElement, ?int $scale = null): float
    {
        return $this->multiply($firstElement, $secondElement, $scale);
    }

    /**
     * Divide floats
     *
     * @param float|null $firstElement
     * @param float|null $secondElement
     * @param integer|null $scale
     *
     * @return float
     */
    protected function divide(?float $firstElement, ?float $secondElement, ?int $scale = null): float
    {
        $result = bcdiv($firstElement, $secondElement, $this->bcMathScale);

        return $this->round($result, $scale);
    }

    /**
     * Alias for `divide` function
     *
     * @param float|null $firstElement
     * @param float|null $secondElement
     * @param integer|null $scale
     *
     * @return float
     */
    protected function div(?float $firstElement, ?float $secondElement, ?int $scale = null): float
    {
        return $this->divide($firstElement, $secondElement, $scale);
    }
}