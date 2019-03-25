<?php

namespace App\Controller\Admin;

use App\Controller\Admin\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\TextContentManager;
use App\Form\TextContentType;
use App\Entity\TextContent;

/**
 * @Route("/admin/text_content")
 */
class TextContentController extends BaseController
{

    const VIEWS_MAIN_PATH = 'admin/text_content/';
    const INDEX_ROUTE_NAME = 'admin_text_content_index';

    /**
     * @Route("/", name="admin_text_content_index", methods="GET")
     */
    public function index(Request $request, TextContentManager $manager) : Response
    {
        $alert = $request->query->get('alert');

        $contents = $manager->getAll();

        return $this->render(static::VIEWS_MAIN_PATH.'index.html.twig', ['contents' => $contents, 'alert' => $alert]);
                
    }

    /**
     * @Route("/{id}/edit", name="admin_text_content_edit", methods="GET|POST")
     */
    public function edit(Request $request, TextContent $content, TextContentManager $manager): Response
    {
        $form = $this->createForm(TextContentType::class, $content);
        return $this->processEntity($request, $manager, $content, $form, static::INDEX_ROUTE_NAME, static::VIEWS_MAIN_PATH.'edit.html.twig', 'edit');        
    }
}