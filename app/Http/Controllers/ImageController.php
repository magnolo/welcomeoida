<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

use App\Http\Requests;
use App\Models\Photo;

class ImageController extends Controller
{
    //
    public function upload(Request $request){


      $image = $request->file('image');
      $filename  = time() . '_' . $image->getClientOriginalName();
      $path = public_path('uploads/images/' . $filename);
      $img = Image::make($image->getRealPath())->save($path);

      $photo = new Photo();
      $photo->size = $image->getSize();
      //$photo->user_id = \Auth::user()->id;
      $photo->name = $filename;
      $photo->folder = '/uploads/images';
      $photo->width = $img->width();
      $photo->height = $img->height();
      $photo->path = '/uploads/images/' . $filename;
      $photo->save();

      return $photo;
    }
}
