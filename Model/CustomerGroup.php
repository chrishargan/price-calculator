<?php
declare(strict_types=1);

class CustomerGroup
{
    private string $groupName;
    private int $fixDiscount;
    private int $varDiscount;

    /**
     * CustomerGroup constructor.
     * @param string $groupName
     * @param int $fixDiscount
     * @param int $varDiscount
     */
    public function __construct(string $groupName, int $fixDiscount, int $varDiscount)
    {
        $this->groupName = $groupName;
        $this->fixDiscount = $fixDiscount;
        $this->varDiscount = $varDiscount;
    }

}