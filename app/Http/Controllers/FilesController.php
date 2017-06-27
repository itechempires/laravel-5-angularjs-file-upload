<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use Symfony\Component\HttpKernel\Tests\Debug\FileLinkFormatterTest;
use Validator;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    /**
     * Load Files View
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function files()
    {
        return view('files');
    }

    /**
     * List Uploaded files
     *
     * @return array
     */
    public function listFiles()
    {
        return ['files' => File::all()];
    }


    /**
     * Upload new File
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request)
    {
        $validator = Validator::make($request->file(), [
            'image_file' => 'required|image|max:50',
        ]);

        if ($validator->fails()) {

            $errors = [];
            foreach ($validator->messages()->all() as $error) {
                array_push($errors, $error);
            }

            return response()->json(['errors' => $errors, 'status' => 400], 400);
        }

        $file = File::create([
            'name' => $request->file('image_file')->getClientOriginalName(),
            'type' => $request->file('image_file')->extension(),
            'size' => $request->file('image_file')->getClientSize(),
        ]);

        $request->file('image_file')->move(__DIR__ . '/../../../image_uploads/', $file->id . '.' . $file->type);

        return response()->json(['errors' => [], 'files' => File::all(), 'status' => 200], 200);
    }

    /**
     * Delete existing file from the server
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        Storage::delete(__DIR__ . '/../../../image_uploads/' . $request->input('id'));

        File::find($request->input('id'))->delete();

        return response()->json(['errors' => [], 'message' => 'File Successfully deleted!', 'status' => 200], 200);
    }
}
