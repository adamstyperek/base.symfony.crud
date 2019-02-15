<?php

namespace App\Controller\Front;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Service\TextContentManager;


class TextContentController extends Controller
{
    public function textContent(string $name, TextContentManager $manager)
    {
        $content = $manager->findTextContentByName($name);
        
        return $this->render('front/text_content/content.html.twig', [
            'content' => $content
        ]);
    }
}