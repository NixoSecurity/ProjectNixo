<?php

namespace App\Controller;

use App\Entity\Partner;
use App\Form\PartnerFormType;
use App\Repository\PartnerRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PartnerController extends AbstractController
{
    #[Route('/admin/partner', name: 'app_adminPartner')]
    public function index(PartnerRepository $partnerRepository,PaginatorInterface $paginatorInterface,Request $request): Response
    {
        $partners = $paginatorInterface->paginate(
            $partnerRepository->findAll(),
            $request->query->getInt('page',1),5
        );
       
        return $this->render('partner/index.html.twig', [
            'partners'=> $partners
        ]);
    }

    // PARTNER ADMIN SECTION

    
    #[Route('/admin/partner/new', name: 'app_admin_newPartner')]
    public function addPartner(Request $request, PartnerRepository $partnerRepository): Response
    {
        $partner = new Partner;
        $form = $this->createForm(PartnerFormType::class, $partner);
        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid()) {
            $partnerRepository->add($partner, true);
            $this->addFlash('success', 'Le partenaire à bien été enregistrée');
        
            return $this->redirectToRoute('app_admin');
        }
        return $this->render('partner/newPartner.html.twig', [
            'form'=> $form->createView()
        ]);
    }

    #[Route('/admin/partner/edit/{id}', name: 'app_admin_editPartner', requirements: ['id' => '\d+'])]
    public function updatePartner(Partner $partner, Request $request, PartnerRepository $partnerRepository): Response
    {
        $form = $this->createForm(PartnerFormType::class, $partner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $partnerRepository->add($partner, true);

            $this->addFlash('success', 'Le partenaire:' . $partner->getTitle() . 'à bien été modifié !');
            return $this->redirectToRoute('app_admin');
        }

        return $this->render('partner/editPartner.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/partner/delete/{id}', name: 'app_admin_deletePartner', requirements: ['id' => '\d+'])]
    public function deletePartner(Partner $partner, Request $request, PartnerRepository $partnerRepository): Response
    {
        $tokenCsrf = $request->request->get('token');
        if ($this->isCsrfTokenValid('delete-partner-' . $partner->getId(), $tokenCsrf)) {
            $partnerRepository->remove($partner, true);
            $this->addFlash('success', 'Le partenaire à bien été supprimé');
            $success = true;
        }

        return $this->redirectToRoute('app_admin', [
            'success' => $success
        ]);
    }

    

}
