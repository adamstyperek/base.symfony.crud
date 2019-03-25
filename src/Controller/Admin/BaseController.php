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
    protected function processEntityWithPhoto(Request $request, EntityWithPhotoManagerInterface $entityManager, $entity, $form, $route, $view, $action, $form_name, FileManager $fileManager, ?array $route_params = [], $parent = null)
    {
        $alert = '';
        $form->handleRequest($request);
        $photo_file = $request->files->get($form_name)['photo_file'];
        $photo = null;
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                if ($photo_file) {
                    $photo = $fileManager->saveFile($photo_file, $entityManager->getBasePhotoDirectory());
                    $this->resizePhoto($photo->getFileNameWithExtension(), $entityManager->getBasePhotoDirectory(), $entityManager->getThumbSizes());
                }
            
                if ($action == 'create') {
                    $entityManager->create($entity, $photo);
                } else {
                    $entityManager->update($entity, $photo);
                }
                
                $route_params['alert'] = 'saved';
                return $this->redirectToRoute($route, $route_params);
            } catch (NoFileException $nfe) {
                $alert = 'Problem with photo';
            }
        }

        return $this->render($view, [
            'entity' => $entity,
            'form' => $form->createView(),
            'alert' => $alert,
            'parent' => $parent
        ]);
    }

    protected function resizePhoto(string $file_name, string $base_directory, array $sizes)
    {
        try {
            $phtotoManager = new PhotoManager();
            $phtotoManager->resizePhoto($file_name, $base_directory, $sizes);
        } catch (NoResolutionException $nre) {
            //Log lack with resolution
        }
    }

    protected function processEntity(Request $request, $entityManager, $entity, $form, $route, $view, $action, ?array $route_params = [], $parent = null)
    {
        $alert = '';
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($action == 'create') {
                $entityManager->create($entity);
            } else {
                $entityManager->update($entity);
            }
            
            $route_params['alert'] = 'saved';
            return $this->redirectToRoute($route, $route_params);
        }
        return $this->render($view, [
            'entity' => $entity,
            'form' => $form->createView(),
            'alert' => $alert,
            'parent' => $parent
        ]);
    }
}
