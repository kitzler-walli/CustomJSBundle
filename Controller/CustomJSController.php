<?php

/*
 * This file is part of the Kimai CustomJSBundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KimaiPlugin\CustomJSBundle\Controller;

use App\Controller\AbstractController;
use KimaiPlugin\CustomJSBundle\Entity\CustomJS;
use KimaiPlugin\CustomJSBundle\Form\CustomJSType;
use KimaiPlugin\CustomJSBundle\Repository\CustomJSRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/admin/custom-js")
 * @Security("is_granted('edit_custom_js')")
 */
class CustomJSController extends AbstractController
{
    /**
     * @var CustomJSRepository
     */
    protected $repository;

    /**
     * @param CustomJSRepository $repository
     */
    public function __construct(CustomJSRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route(path="", name="custom_js", methods={"GET", "POST"})

     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $entity = $this->repository->getCustomJS();

        $form = $this->getEditForm($entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var CustomJS $entity */
            $entity = $form->getData();
            try {
                $this->repository->saveCustomJS($entity);
                $this->flashSuccess('action.update.success');
            } catch (\Exception $ex) {
                $this->flashError($ex->getMessage());
            }
        }

        return $this->render('@CustomJS/index.html.twig', [
            'entity' => $entity,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param CustomJS $entity
     * @return \Symfony\Component\Form\FormInterface
     */
    protected function getEditForm(CustomJS $entity)
    {
        return $this->createForm(CustomJSType::class, $entity, [
            'action' => $this->generateUrl('custom_js'),
        ]);
    }
}
