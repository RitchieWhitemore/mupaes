<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Models\Page;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::all();

        return view('admin.page.index', ['pages' => $pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page.create');
    }

    /**
     * @param PageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    public function store(PageRequest $request)
    {
        $page = Page::create($request->all());
        $page->uploadImage('image', $request, 'images');

        return redirect()->route('admin.pages.show', compact('page'));
    }

    /**
     * @param Page $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Page $page)
    {
        return view('admin.page.show', ['model' => $page]);
    }

    /**
     * @param Page $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Page $page)
    {
        return view('admin.page.edit', ['model' => $page]);
    }

    /**
     * @param PageRequest $request
     * @param Page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    public function update(PageRequest $request, Page $page)
    {
        $page->update($request->all());
        $page->uploadImage('image', $request, 'images');

        return redirect()->route('admin.pages.show', $page);
    }

    /**
     * @param Page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index');
    }


    public function upload(Request $request, Page $page)
    {
        $mimeTypes = ['image/jpeg', 'image/png'];
        $file = $page
            ->addMediaFromRequest('files')->toMediaCollection('gallery');

        return response()->json([
            'files' => [
                [
                    "name" => $file->name,
                    "size" => $file->size,
                    "url" => $file->getUrl(),
                    "thumbnailUrl" => in_array($file->mime_type, $mimeTypes) ? $file->getUrl('thumb-admin') : '',
                    "deleteUrl" => route('admin.page.deleteFile', ['file' => $file->id]),
                    "deleteType" => "DELETE"
                ],
            ]
        ], 200);
    }

    public function getFiles(Page $page)
    {
        $files = [];

        $mimeTypes = ['image/jpeg', 'image/png'];

        foreach ($page->getMedia('gallery') as $media) {
            /**
             * @var $media Media
             */

            $files[] = [
                "name" => $media->name,
                "size" => $media->size,
                "url" => $media->getUrl(),
                "thumbnailUrl" => in_array($media->mime_type, $mimeTypes) ? $media->getUrl('thumb-admin') : '',
                "deleteUrl" => route('admin.page.deleteFile', ['file' => $media->id]),
                "deleteType" => "DELETE"
            ];
        }

        return response()->json([
            'files' => $files,
        ], 200);
    }

    public function deleteFile(Page $page, Media $file)
    {
        $file->delete();
        return response()->json([
            'result' => true,
        ], 200);
    }
}
