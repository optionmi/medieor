<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function restrictedAction()
    {
        $data = [
            'error' => true,
            'message' => 'Restricted',
        ];
        return response()->json(compact('data'), 403);
    }

    /**
     * Generate data for a DataTable based on the provided repository.
     *
     * @param mixed $repository The repository used to retrieve the data.
     * @return array The generated data for the DataTable.
     */
    public function generateDataTableData($repository)
    {
        $start = request()->get('start');
        $length = request()->get('length');
        $sortColumn = request()->get('order')[0]['name'] ?? 'id';
        $sortDirection = request()->get('order')[0]['dir'] ?? 'asc';
        $searchValue = request()->get('search')['value'];

        $count = $repository->paginated($start, $length, $sortColumn, $sortDirection, $searchValue, true);
        $data = $repository->paginated($start, $length, $sortColumn, $sortDirection, $searchValue);

        return $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $data
        );
    }

    /**
     * Generates a JSON response with a boolean error flag and a message.
     *
     * @param bool $action The action status.
     * @param string $message The response message.
     * @return \Illuminate\Http\JsonResponse The JSON response.
     */
    public function jsonResponse($action, $message)
    {
        return response()->json([
            'error' => !$action,
            'message' => !$action ? 'Error' : $message,
        ], $action ? 200 : 500);
    }

    /**
     * Uploads a file to the specified directory and returns the generated filename.
     *
     * @param \Illuminate\Http\UploadedFile $file The file to be uploaded.
     * @param string $directory The directory where the file will be stored.
     * @return string The generated filename.
     */
    protected function uploadFile($file, $directory)
    {
        $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
        $file->storeAs($directory, $filename, 'public_dir');
        return $filename;
    }
}
