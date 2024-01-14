<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Link\LinkService;
use App\Services\Url\UrlService;

/**
 * Class HomeController
 */
class HomeController extends Controller
{
    /**
     * The LinkService instance.
     *
     * @var LinkService
     */
    protected $linkService;

    /**
     * The UrlService instance.
     *
     * @var UrlService
     */
    protected $urlService;

    /**
     * HomeController constructor.
     *
     * @param LinkService $linkService
     * @param UrlService $urlService
     */
    public function __construct(LinkService $linkService, UrlService $urlService)
    {
        $this->linkService = $linkService;
        $this->urlService = $urlService;
    }

    /**
     * Display the application homepage.
     *
     * @param \Illuminate\Http\Request $request
     * @param string|null $shortUrl
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request, $shortUrl = null)
    {
        if ($this->urlService->isValidShortUrl($shortUrl)) {
            $link = $this->linkService->getLinkByIdentifier($shortUrl);

            return $link
                ? redirect()->away($link->url)
                : view('app');
        }

        return view('app');
    }
}
