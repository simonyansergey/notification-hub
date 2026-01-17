<?php

namespace App\Http\Controllers\Notification;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\NotificationInterface;
use App\Http\Requests\Notification\NotificationStoreRequest;
use Symfony\Component\HttpFoundation\Response;

class NotificationController extends Controller
{
    public function __construct(
        private readonly NotificationInterface $notification
    ) {}

    /**
     * @param NotificationStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(NotificationStoreRequest $request): Response
    {
        $data = $request->validated();

        $result = $this->notification->send($data['to'], $data['message']);

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
