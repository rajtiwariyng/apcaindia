<?php

namespace App\Http\Controllers\Admin\Concerns;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Shared admin list-action behavior (status toggle + delete).
 *
 * These two endpoints were byte-identical across every legacy admin module, so
 * they live here once. A controller using this trait must define:
 *   protected string $model;  // Eloquent model class (e.g. Blog::class)
 *   protected string $table;  // the legacy table name the delete endpoint guards on
 */
trait AdminCrudActions
{
    /**
     * Toggle a row's status by its uniqueid. Mirrors the legacy *_status method
     * (no response body on success, matching the original).
     */
    public function changeStatus(Request $request): void
    {
        $id = trim((string) $request->input('id'));
        $status = trim((string) $request->input('status'));

        if ($id !== '') {
            ($this->model)::where('uniqueid', '=', $id)->update(['status' => $status]);
        }
    }

    /**
     * Delete a row. Mirrors the legacy delete*data method: the request supplies
     * the table/column/value; deletion only proceeds when the table matches the
     * controller's guarded table.
     */
    public function deleteData(Request $request): JsonResponse
    {
        $useridd = trim((string) $request->input('useridd'));
        $table = trim((string) $request->input('table'));
        $colmn = trim((string) $request->input('colmn'));

        $deleted = 0;
        if ($table === $this->table) {
            $deleted = ($this->model)::where($colmn, '=', $useridd)->delete();
        }

        if ($deleted) {
            return response()->json(['status' => '200', 'msg' => 'Data successfully deleted.']);
        }

        return response()->json(['status' => '401', 'msg' => 'Something went wrong,please try again!']);
    }
}
