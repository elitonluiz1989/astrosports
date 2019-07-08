<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImagesRequest;
use App\Repositories\ImageRepository;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class ImagesController extends Controller
{
    /**
     * ImageRepository class
     * 
     * @var ImageRepository
     */
    private $_image;

    /**
     * ImagesController constructor
     * 
     * @param ImageRepository $image - ImageRepository class
     */
    public function __construct(ImageRepository $image)
    {
        $this->middleware(['web', 'auth'])->except('image', 'imageByFolder');

        $this->_image = $image;
        $this->_image->imageRoute = 'storage.images.view';
    }

    /**
     * Delete a stored image
     *
     * @param ImagesRequest $request
     *
     * @return string
     */
    public function delete(ImagesRequest $request)
    {
        $images = $request->validated()['images'];

        return (string)$this->_image->delete($images);
    }

    /**
     * Format a stored image to show on browser
     *
     * @param Request $request - Request class
     * @param string  $image   - image source string
     *
     * @return \Intervention\Image\Response
     */
    public function image(Request $request, string $image)
    {
        $path = storage_path('app/images/' . $image);

        return $this->renderImage($request, $path);
    }

    /**
     * Format a stored image to show on browser, defining a folder
     *
     * @param Request $request - Request class
     * @param string $folder - images folder
     * @param string  $image   - image source string
     *
     * @return \Intervention\Image\Response
     */
    public function imageByFolder(Request $request, string $folder, string $image)
    {
        $path = storage_path("app/images/{$folder}/{$image}");

        return $this->renderImage($request, $path);
    }

    /**
     * Store an image
     *
     * @param ImagesRequest $request
     *
     * @return string
     */
    public function upload(ImagesRequest $request)
    {
        $image = $request->validated()['images'];

        return $this->_image->upload($image);
    }

    /**
     * Render a image by specified path, to showing on browser
     *
     * @param Request $request
     * @param string $path
     *
     * @return \Intervention\Image\Response
     */
    private function renderImage(Request $request, string $path)
    {
        $img = Image::make($path);

        if ($request->has('width') || $request->has('height')) {
            $width = $request->get('width') ?? $request->get('height');
            $height = $request->get('height') ?? $request->get('width');

            $img->resize(
                $width,
                $height,
                function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                }
            );
        }
        $format = $img->extension;

        /* Workaround to do the image appear.
           Before only show a 16x16 transparent square instead of image */
        ob_end_clean();

        return $img->response($format);
    }
}
