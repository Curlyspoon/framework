<?php

namespace Curlyspoon\Framework\Http\Controllers;

use Curlyspoon\Framework\Http\Responses\PageResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PageController extends Controller
{
    public function getShow(Request $request, string $page = 'home'): Response
    {
        return new PageResponse($page);
    }
}
