<?php

namespace App\Exceptions;

use RuntimeException;

/**
 * Thrown by ImageUploadService when an upload fails validation or storage.
 *
 * The message carries the exact user-facing text the legacy app returned, so
 * controllers can surface it in the same JSON shape the front-end expects.
 */
class ImageUploadException extends RuntimeException {}
