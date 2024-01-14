<?php

namespace App\Http\Controllers\Api\V1;

use Throwable;
use App\Http\Controllers\Controller;
use App\Http\Requests\LinkCreateRequest;
use App\Services\Link\LinkService;
use App\Services\Url\UrlService;
use Illuminate\Http\JsonResponse;
use App\Traits\UseLogger;

class LinkController extends Controller
{
    use UseLogger;

    protected $linkService;
    protected $urlService;

    public function __construct(LinkService $linkService, UrlService $urlService)
    {
        $this->linkService = $linkService;
        $this->urlService = $urlService;
    }

    /**
     * Create a new link based on the provided data.
     *
     * @param LinkCreateRequest $request
     * @return JsonResponse
     */
    public function create(LinkCreateRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $url = $validatedData['url'];

            $existingLink = $this->linkService->getLinkByUrl($url);
            if ($existingLink) {
                return $this->jsonResponse('Link already exists', [
                    'url' => $this->urlService->generateUrl($existingLink->identifier)
                ], 200);
            }

            $isSafe = $this->urlService->lookup($url);

            if (isset($isSafe['error'])) {
                return $this->jsonResponse(
                    'An error occurred',
                    ['error' => 'Something went wrong, please try again later'],
                    400
                );
            }

            if (count($isSafe['matches']) > 0) {
                return $this->jsonResponse(
                    'An error occurred',
                    ['error' => 'The provided URL is flagged for potential threats. For your safety, we advise against accessing this website.'],
                    400
                );
            }

            $data = $this->linkService->create($validatedData);
            $shortUrl = $this->urlService->generateUrl($data->identifier);

            return $this->jsonResponse('Link has been generated', ['url' => $shortUrl], 201);
        } catch (Throwable $throwable) {
            $this->addToLogger('LinkController ->  create Exception', $throwable);
            return $this->jsonResponse('An error occurred', ['error' => $throwable->getMessage()], 400);
        }
    }

    /**
     * Return json response.
     *
     * @param string $message
     * @param array $data
     * @param int $status
     * @return JsonResponse
     */
    protected function jsonResponse(string $message, array $data = [], int $status): JsonResponse
    {
        return response()->json(['message' => $message, 'data' => $data], $status);
    }
}
