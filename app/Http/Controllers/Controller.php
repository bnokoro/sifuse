<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Return JsonResponse
     * @param $data
     * @param int $status_code
     * @return JsonResponse
     */
    private function jsonResponse($data, $status_code = 200)
    {
        return response()->json(array_merge($data, ['status_code' => $status_code,
            'code' => ($status_code == 200) ? 'OK' : 'FAILED']), $status_code);
    }

    /**
     * Some operation (save only?) has completed successfully
     * @param mixed $data
     * @return JsonResponse
     */
    public function respondWithSuccess($data)
    {
        return $this->jsonResponse(is_array($data) ? (['status' => 'success'] + $data) : ['message' => $data]);
    }

    /**
     * Respond with an Error
     *
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function respondWithError($message = 'There was an error', $code = 400)
    {
        return $this->jsonResponse(is_array($message) ? $message : ['message' => $message], $code);
    }
}
