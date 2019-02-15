<?php

namespace App\Controller\Admin;

use App\Controller\Admin\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\TextContentManager;

/**
 * @Route("/admin/text_content")
 */
class TextContentController extends BaseController
{
    public function index(Request $request, TextContentManager $manager) : Response
    {
        $alert = $request->query->get('alert');

        $contents = $manager->getAll();

        return $this->render('admin/text_content/index.html.twig', ['contents' => $contents(), 'alert' => $alert]);
        
        
    }
}