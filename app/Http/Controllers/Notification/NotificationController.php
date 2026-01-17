<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Notification\NotificationManager;
use App\Http\Requests\Notification\NotificationStoreRequest;

class NotificationController extends Controller
{
    public function __construct(
        private readonly NotificationManager $notificationManager
    ) {}

    /**
     * @param NotificationStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(NotificationStoreRequest $request): Response
    {
        $data = $request->validated();

        $result = $this->notificationManager
            ->driver($data['channel'])
            ->send($data['to'], $data['message']);

        if (! $result) {
            return response()->json(
                ['message' => 'Something went wrong!'],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        return response()->json(
            ['message' => 'Message sent successfuly!'],
            Response::HTTP_OK
        );
    }
}
