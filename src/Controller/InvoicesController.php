<?php

namespace App\Controller;

use App\Entity\Invoice;
use App\Entity\InvoiceRow;
use App\Form\InvoicesFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class InvoicesController extends AbstractController
{
    /**
     * @Route("/invoices/add", name="invoices")
     */
    public function add(Request $request)
    {
        $invoice = new Invoice();
        $invoiceRow = new InvoiceRow();


        $form = $this->createForm(InvoicesFormType::class, $invoiceRow);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $invoice->setDateCreated(new \DateTime());
            $invoice->setNInvoice(random_int(10, 1000));
            $invoice->setInvoiceRow($invoiceRow);
            $invoice->setCustomerID(random_int(10,1000));

            $invoiceRow = $form->getData();


            $invoiceRow->setInvoice($invoice);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($invoice);
            $entityManager->persist($invoiceRow);
            $entityManager->flush();


            return $this->redirectToRoute("successfully_loaded") ;

        }
            return $this->render('invoice/newInvoice.html.twig', [
            'form' => $form->createView(),
        ]);


    }


    /**
     * @Route("/invoices/see/{@id}", name="see_invoice")
     */
    public function seeInvoice($id){



    }

}
