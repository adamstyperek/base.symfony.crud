<?php

namespace App\Controller\Admin;

use App\Controller\Admin\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\TextContentManager;
use App\Form\TextContentType;

/**
 * @Route("/admin/text_content")
 */
class TextContentController extends BaseController
{

    /**
     * @Route("/", name="admin_text_content_index", methods="GET")
     */
    public function index(Request $request, TextContentManager $manager) : Response
    {
        $alert = $request->query->get('alert');

        $contents = $manager->getAll();

        return $this->render('admin/text_content/index.html.twig', ['contents' => $contents(), 'alert' => $alert]);
                
    }

    /**
     * @Route("/{id}/edit", name="admin_text_content_edit", methods="GET|POST")
     */
    public function edit(Request $request, TextContent $content, TextContentManager $manager): Response
    {
        $form = $this->createForm(TextContentType::class, $textContent);
        return $this->processEntity($request, $manager, $content, $form, 'admin_text_content_index', 'admin/text_content/edit.html.twig', 'edit');        
    }
}