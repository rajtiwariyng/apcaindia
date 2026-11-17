<?php

namespace App\Services;

use App\Exceptions\ImageUploadException;
use Illuminate\Http\UploadedFile;

/**
 * Centralised image-upload handling, extracted verbatim (in behavior) from the
 * legacy admin controllers' inline upload blocks.
 *
 * Rules preserved exactly from the legacy code:
 *  - If the submitted image name equals the existing path, keep the existing
 *    file (no new upload).
 *  - Allowed extensions: jpg, jpeg, png (case-sensitive, as in the legacy
 *    string comparison).
 *  - Max size: must be < 2,048,000 bytes ("less than 2mb").
 *  - Stored filename: uniqid() . '_' . originalClientName, moved into
 *    public/assets/upload/{subDir}/.
 *
 * Failures throw ImageUploadException carrying the exact legacy message.
 */
class ImageUploadService
{
    /**
     * Resolve the filename to persist for an image field.
     *
     * @param  UploadedFile|null  $file  The uploaded file (request->file('...')).
     * @param  string|null  $imageName  Submitted current image name.
     * @param  string|null  $imagePath  Submitted current image path.
     * @param  string  $subDir  Sub-directory under assets/upload/.
     *
     * @throws ImageUploadException
     */
    public function resolve(?UploadedFile $file, ?string $imageName, ?string $imagePath, string $subDir): string
    {
        // Unchanged image: keep the existing filename, no upload performed.
        if ($imageName === $imagePath) {
            return (string) $imageName;
        }

        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $size = $file->getSize();

        if ($extension !== 'jpg' && $extension !== 'jpeg' && $extension !== 'png') {
            throw new ImageUploadException('Upload only jpeg,jpg or png file');
        }

        if ($size >= 2048000) {
            throw new ImageUploadException('Image size should be less than 2mb');
        }

        $filename = uniqid().'_'.$originalName;

        try {
            $file->move(public_path('assets/upload/'.$subDir), $filename);
        } catch (\Throwable $e) {
            throw new ImageUploadException('Unable to upload image, please try again');
        }

        return $filename;
    }

    /**
     * Generic validate-and-store for arbitrary file types (image, video, pdf).
     *
     * The caller decides the allowed extensions, max byte size and the exact
     * user-facing messages, so each legacy endpoint keeps its original wording.
     *
     * @param  string[]  $allowedExtensions
     * @param  array{ext:string,size:string,move:string}  $messages
     *
     * @throws ImageUploadException
     */
    public function store(UploadedFile $file, string $subDir, array $allowedExtensions, int $maxBytes, array $messages): string
    {
        $extension = $file->getClientOriginalExtension();

        if (! in_array($extension, $allowedExtensions, true)) {
            throw new ImageUploadException($messages['ext']);
        }

        if ($file->getSize() >= $maxBytes) {
            throw new ImageUploadException($messages['size']);
        }

        $filename = uniqid().'_'.$file->getClientOriginalName();

        try {
            $file->move(public_path('assets/upload/'.$subDir), $filename);
        } catch (\Throwable $e) {
            throw new ImageUploadException($messages['move']);
        }

        return $filename;
    }
}
