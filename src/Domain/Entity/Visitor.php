<?php
namespace Domain\Entity;

use Application\Command\CreateVisitor;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Domain\Repository\VisitorRepository")
 */
class Visitor
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=120, unique=true)
     */
    private $gId;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $variant;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $vote;

    /**
     * @ORM\Column(type="string", length=120, nullable=true)
     */
    private $country;

    public static function fromCommand(CreateVisitor $command) : Visitor
    {
        return new self($command->getGId(), $command->getVariant(), $command->getCountry());
    }

    public function __construct(string $gId, string $variant, string $country)
    {
        $this->gId = $gId;
        $this->variant = $variant;
        $this->country = $country;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGId(): ?string
    {
        return $this->gId;
    }

    public function setGId(string $gId): self
    {
        $this->gId = $gId;

        return $this;
    }

    public function getVariant(): ?string
    {
        return $this->variant;
    }

    public function setVariant(string $variant): self
    {
        $this->variant = $variant;

        return $this;
    }

    public function getVote(): ?int
    {
        return $this->vote;
    }

    public function setVote(?int $vote): self
    {
        $this->vote = $vote;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }
}
