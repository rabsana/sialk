<?php

namespace Rabsana\Sialk\Support;

use Rabsana\Sialk\Contracts\Support\MathInterface;

class Math implements MathInterface
{
    /**
     * {@inheritDoc}
     */
    public function add(string $num1, string $num2, int $scale): string
    {
        return bcadd($this->exp2str($num1), $this->exp2str($num2), $scale);
    }

    /**
     * {@inheritDoc}
     */
    public function sub(string $num1, string $num2, int $scale): string
    {
        return bcsub($this->exp2str($num1), $this->exp2str($num2), $scale);
    }

    /**
     * {@inheritDoc}
     */
    public function mul(string $num1, string $num2, int $scale): string
    {
        return bcmul($this->exp2str($num1), $this->exp2str($num2), $scale);
    }

    /**
     * {@inheritDoc}
     */
    public function pow(string $num, string $exponent, int $scale): string
    {
        return bcpow($this->exp2str($num), $exponent, $scale);
    }

    /**
     * {@inheritDoc}
     */
    public function div(string $num1, string $num2, int $scale): string
    {
        return bcdiv($this->exp2str($num1), $this->exp2str($num2), $scale);
    }

    /**
     * {@inheritDoc}
     */
    public function comp(string $num1, string $num2, int $scale): int
    {
        return bccomp($this->exp2str($num1), $this->exp2str($num2), $scale);
    }

    /**
     * {@inheritDoc}
     */
    public function gt(string $num1, string $num2, int $scale): bool
    {
        return bccomp($this->exp2str($num1), $this->exp2str($num2), $scale) === 1;
    }

    /**
     * {@inheritDoc}
     */
    public function gte(string $num1, string $num2, int $scale): bool
    {
        return bccomp($this->exp2str($num1), $this->exp2str($num2), $scale) === 1 || bccomp($this->exp2str($num1), $this->exp2str($num2), $scale) === 0;
    }

    /**
     * {@inheritDoc}
     */
    public function lt(string $num1, string $num2, int $scale): bool
    {
        return bccomp($this->exp2str($num1), $this->exp2str($num2), $scale) === -1;
    }

    /**
     * {@inheritDoc}
     */
    public function lte(string $num1, string $num2, int $scale): bool
    {
        return bccomp($this->exp2str($num1), $this->exp2str($num2), $scale) === -1 || bccomp($this->exp2str($num1), $this->exp2str($num2), $scale) === 0;
    }

    /**
     * {@inheritDoc}
     */
    public function eq(string $num1, string $num2, int $scale): bool
    {
        return bccomp($this->exp2str($num1), $this->exp2str($num2), $scale) === 0;
    }

    /**
     * {@inheritDoc}
     */
    public function format(string $num, int $decimals): string
    {
        $parts = explode('.', $this->exp2str($num));

        if (count($parts) > 1) {
            $decimalsLength = strlen($parts[1]);
        } else {
            $decimalsLength = 0;
        }

        return number_format($this->exp2str($num), min($decimals, $decimalsLength));
    }

    protected function exp2str($e)
    {
        $e = strtoupper($e);

        if (strpos($e, 'E') === false) {
            return $e;
        }

        $parts = explode('E', $e);

        $p = abs($parts[1]);

        $partsDecimal = explode('.', $parts[0]);

        $decimalsCount = 0;

        if (! empty($partsDecimal[1])) {
            $decimalsCount = strlen($partsDecimal[1]);
        }

        if ($parts[1] >= 0) {
            $ppp = $decimalsCount > $p ? $decimalsCount - $p : 0;
            $ee = bcpow(10, $parts[1], $ppp);

            return bcmul(
                $parts[0],
                $ee,
                $ppp,
            );
        } else {
            $ee = bcpow(10, $parts[1], $p + $decimalsCount);

            return bcmul(
                $parts[0],
                $ee,
                $p + $decimalsCount,
            );
        }
    }
}
