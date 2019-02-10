<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Service\FileManager;
use App\Utils\PhotoManager;
use App\Service\EntityWithPhotoManagerInterface;
use App\Exception\NoFileException;
use App\Excepton\NoResulutionException;

class BaseController extends Controller
{

    protected function processEntityWithPhoto(Request $request, EntityWithPhotoManagerInterface $entityManager, $entity, $form, $route, $view, $action, $form_name, FileManager $fileManager)
    {
        $alert = '';
        $form->handleRequest($request);
        $photo_file = $request->files->get($formName)['photo_file'];

        if ($form->isSubmitted() && $form->isValid()) {        
            try {
                $photo = $fileManager->saveFile($photo_file, $entityManager->getBasePhotoDirectory());
                $this->resizePhoto($photo_file->getFileNameWithExtension(), $entityManager->getBasePhotoDirectory(), $entityManager->getThumbSizes());
            
                if ($action == 'create') {
                    $entityManager->create($entity, $photo);
                } else {
                    $entityManager->update($product, $photo);
                }
    
                return $this->redirectToRoute($route, ['alert' => 'saved']);
            }
            catch(NoFileException $nfe)
            {
                $alert = 'Problem with photo';
            }           
        }

        return $this->render($view, [
            'entity' => $entity,
            'form' => $form->createView(),
            'alert' => $alert
        ]);
    }

    private function resizePhoto(string $file_name, string $base_directory, array $sizes)
    {
        try {
            $phtotoManager = new PhotoManager();
            $phtotoManager->resizePhoto($file_name, $base_directory, $sizes);
        }
        catch(NoResolutionException $nre)
        {
            //Log lack with resolution
        }
    }

    protected function processEntity(Request $request, $entityManager, $entity, $form, $route, $view, $action)
    {
        $alert = '';
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($action == 'create') {
                $entityManager->create($entity);
            } else {
                $entityManager->update($product);
            }

            return $this->redirectToRoute($route, ['alert' => 'saved']);
        }

        return $this->render($view, [
            'entity' => $entity,
            'form' => $form->createView(),
            'alert' => $alert
        ]);
    }
}