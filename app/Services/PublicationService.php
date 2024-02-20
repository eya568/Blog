<?php
namespace App\Services;

use App\Models\Publication;

class PublicationService
{
    public function deletePublication(Publication $publication)
    {
        if($publication->likes()->exists()){
            $publication->likes()->delete();
        }
        if($publication->reports()->exists()){
            $publication->reports()->delete();
        }
        if($publication->comments()->exists()){
            $publication->comments()->delete();
        }
        $publication->delete();
    }
}
