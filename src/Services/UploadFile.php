<?php

namespace App\Services;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UploadFile extends AbstractController
{

    // génération de nom d'image de façon aléatoire
    public function generateName($length = 20)
    {
        $code = "az4ertyaz12ertya2zert5y";
        $result = "";

        while (strlen($result) < 20) {
            $result .= $code[rand(0, strlen($code) - 1)];
        }

        return $result;
    }

    // sauvegarde de l'image
    public function saveFile($file)
    {
        $filename = $file->getClientOriginalName();
        $file->move($this->getParameter('image_dir'), $filename);
        return $filename;
    }

    // Update image
    public function updateFile($file, $oldFile) {
        $filename = $this->saveFile($file);
        unlink($this->getParameter('image_dir').'/'.$oldFile);
        return $filename;
    }
}
