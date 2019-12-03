<?php
declare(strict_types=1);

namespace Application\Command;

class CreateVisitor
{
    private $gId;
    private $variant;
    private $country;

    public function __construct(string $gId, string $variant, string $country)
    {
        $this->gId = $gId;
        $this->variant = $variant;
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getGId(): string
    {
        return str_replace('GA1.2.', '', $this->gId);
    }

    /**
     * @return string
     */
    public function getVariant(): string
    {
        return $this->variant;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }


}