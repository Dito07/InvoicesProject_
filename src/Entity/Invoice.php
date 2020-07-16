<?php

namespace App\Entity;

use App\Repository\InvoiceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InvoiceRepository::class)
 */
class Invoice
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateCreated;

    /**
     * @ORM\Column(type="integer")
     */
    private $nInvoice;

    /**
     * @ORM\Column(type="integer")
     */
    private $CustomerID;

    /**
     * @ORM\OneToOne(targetEntity=InvoiceRow::class, mappedBy="invoice", cascade={"persist", "remove"})
     */
    private $invoiceRow;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getNInvoice(): ?int
    {
        return $this->nInvoice;
    }

    public function setNInvoice(int $nInvoice): self
    {
        $this->nInvoice = $nInvoice;

        return $this;
    }

    public function getCustomerID(): ?int
    {
        return $this->CustomerID;
    }

    public function setCustomerID(int $CustomerID): self
    {
        $this->CustomerID = $CustomerID;

        return $this;
    }

    public function getInvoiceRow(): ?InvoiceRow
    {
        return $this->invoiceRow;
    }

    public function setInvoiceRow(InvoiceRow $invoiceRow): self
    {
        $this->invoiceRow = $invoiceRow;

        // set the owning side of the relation if necessary
        if ($invoiceRow->getInvoice() !== $this) {
            $invoiceRow->setInvoice($this);
        }

        return $this;
    }
}
