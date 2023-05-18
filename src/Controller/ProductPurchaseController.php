<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\ProductPurchaseType;
use App\Service\TaxCalculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductPurchaseController extends AbstractController
{
    #[Route('/purchase', name: 'purchase_form')]
    public function purchaseForm(Request $request, TaxCalculator $calculator): Response
    {
        $form = $this->createForm(ProductPurchaseType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            // Compute the final price
            $finalPrice = $calculator->calculateFinalPrice(
                $data['product'],
                $data['taxNumber']
            );

            // Redirect to a success page or render a template with the result
            return $this->render('product_purchase/result.html.twig', [
                'finalPrice' => $finalPrice,
            ]);
        }

        return $this->render('product_purchase/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
