<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ScoreRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     denormalizationContext={"groups"={"score:write"}},
 *     normalizationContext={"groups"={"score:read"}},
 *     collectionOperations={
 *          "post"={},
 *          "calculate-class-average"={
 *              "method"="GET",
 *              "path"="/scores/average",
 *              "controller"=App\Controller\CalculateClassAverage::class
 *          },
 *      },
 *     itemOperations={"get"}
 * )
 * @ORM\Entity(repositoryClass=ScoreRepository::class)
 * @UniqueEntity(
 *     fields={"course"},
 *     message="This course already exists"
 * )
 */
class Score
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="float")
     * @Assert\Range(min="0", max="20")
     * @Assert\NotBlank(message="Course value is required")
     * @Groups({"score:write", "score:read", "student:read"})
     */
    private float $value;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Course name is required")
     * @Groups({"score:write", "score:read", "student:read"})
     */
    private string $course;

    /**
     * @ORM\ManyToOne(targetEntity=Student::class, inversedBy="scores")
     * @ORM\JoinColumn(nullable=false)
     *
     * @Groups({"score:write"})
     */
    private Student $student;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getCourse(): ?string
    {
        return $this->course;
    }

    public function setCourse(string $course): self
    {
        $this->course = $course;

        return $this;
    }

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(?Student $student): self
    {
        $this->student = $student;

        return $this;
    }
}
