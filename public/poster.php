<?php
 declare(strict_types=1);

 use Entity\Exception\EntityNotFoundException;
 use Entity\Poster;

 try {
     $id =intval($_GET['posterId']);
     $cover = Poster::findById(intval($_GET['posterId']));
     header('Content-type:image/jpeg');
     echo($cover->getJpeg());
 }catch (EntityNotFoundException){
     http_response_code(404);
 }catch (Exception){
     http_response_code(500);
 }