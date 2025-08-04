<?php
namespace App\Helpers;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ApiResponseHelper
{
    public static function success(string $messageKey = 'messages.default_success', $data = null, int $status = 200)
    {
        return response()->json([
            'status'  => true,
            'message' => __($messageKey),
            'data'    => $data,
        ], $status);
    }

    public static function error(string $messageKey = 'messages.default_error', int $status = 400, $errors = null)
    {
        return response()->json([
            'status'  => false,
            'message' => __($messageKey),
            'errors'  => $errors,
        ], $status);
    }

    public static function paginated(LengthAwarePaginator $items, string $messageKey = 'messages.default_success', int $status = 200, array $extra = [])
    {
        return response()->json(array_merge([
            'status'  => true,
            'message' => __($messageKey),
            'data'    => $items->items(),
            'pagination' => [
                'current_page' => $items->currentPage(),
                'per_page'     => $items->perPage(),
                'total'        => $items->total(),
                'last_page'    => $items->lastPage(),
            ]
        ], $extra), $status);
    }
}
