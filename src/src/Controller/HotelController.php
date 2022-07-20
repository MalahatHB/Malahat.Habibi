<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Form\HotelType;
use App\Hotel\SearchService;
use App\Repository\HotelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HotelController extends AbstractController {

    /**
     * @Route("/{_locale}/hotel", name="app_hotel_index", methods={"GET"}, defaults={"_locale":"en"}, requirements={"_locale":"en|de"})
     */
    public function index(HotelRepository $hotelRepository): Response {
        return $this->render('hotel/index.html.twig', [
            'hotels' => $hotelRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{_locale}/hotel/new", name="app_hotel_new", methods={"GET","POST"}, defaults={"_locale":"en"}, requirements={"_locale":"en|de"})
     */
    public function new(Request $request, HotelRepository $hotelRepository): Response {
        $hotel = new Hotel();
        $form = $this->createForm(HotelType::class, $hotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hotelRepository->add($hotel);
            return $this->redirectToRoute('app_hotel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hotel/new.html.twig', [
            'hotel' => $hotel,
            'form'  => $form,
        ]);
    }

    /**
     * @Route("/{_locale}/hotel/search", name="app_hotel_search", methods={"GET"}, defaults={"_locale":"en"}, requirements={"_locale":"en|de"})
     */
    public function search(Request $request, SearchService $hotelSearchService): Response {
        $query = $request->query->get('q');

        return $this->render('hotel/index.html.twig', [
            'q'      => $query,
            'hotels' => $hotelSearchService->search($query),
        ]);
    }

    /**
     * @Route("/{_locale}/hotel/{id}", name="app_hotel_show", methods={"GET"}, defaults={"_locale":"en"}, requirements={"_locale":"en|de"})
     */
    public function show(Hotel $hotel): Response {
        return $this->render('hotel/show.html.twig', [
            'hotel' => $hotel,
        ]);
    }

    /**
     * @Route("/{_locale}/hotel/{id}/edit", name="app_hotel_edit", methods={"GET","POST"}, defaults={"_locale":"en"}, requirements={"_locale":"en|de"})
     */
    public function edit(Request $request, Hotel $hotel, HotelRepository $hotelRepository): Response {
        $this->denyAccessUnlessGranted('edit', $hotel);
        $form = $this->createForm(HotelType::class, $hotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $hotelRepository->add($hotel);
            return $this->redirectToRoute('app_hotel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hotel/edit.html.twig', [
            'hotel' => $hotel,
            'form'  => $form,
        ]);
    }

    /**
     * @Route("/{_locale}/hotel/{id}", name=app_hotel_delete, methods={"POST"}, defaults={"_locale":"en"}, requirements={"_locale":"en|de"})
     */
    public function delete(Request $request, Hotel $hotel, HotelRepository $hotelRepository): Response {
        if ($this->isCsrfTokenValid('delete'.$hotel->getId(), $request->request->get('_token'))) {
            $hotelRepository->remove($hotel);
        }

        return $this->redirectToRoute('app_hotel_index', [], Response::HTTP_SEE_OTHER);
    }
}