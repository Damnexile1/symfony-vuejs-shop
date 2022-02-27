<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\EditProductFormType;
use SebastianBergmann\CodeCoverage\Report\Text;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", methods="GET", name="homepage")
     */
    public function index(Request $request): Response
    {
//      $entityManager = $this->getDoctrine()->getManager();
//      $productList = $entityManager->getRepository(Product::class)->findAll();
//      dd($productList);

      return $this->render('main/default/index.html.twig', []);
    }



  /**
   * @Route("/editProduct/{id}", methods="GET|POST", name="editProduct", requirements={"id"="\d+"})
   * @Route("/addProduct", methods="GET|POST", name="addProduct")
   */
  public function editProduct(Request $request, int $id=null): Response
  {
    $entityManager = $this->getDoctrine()->getManager();

    if($id)
    {
      $product = $this->getDoctrine()->getManager()->getRepository(Product::class)->find($id);
    }
    else{
      $product = new Product();
    }

    $form = $this->createForm(EditProductFormType::class, $product);

    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid())
    {
        $entityManager->persist($product);
        $entityManager->flush();

        return $this->redirectToRoute('editProduct', [ 'id' => $product->getId()]);
    }

    return $this->render('main/default/editProduct.html.twig', [
      'form' => $form->createView()
    ]);
  }
}
