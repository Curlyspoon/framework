<?php

namespace Curlyspoon\Framework\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Curlyspoon\Framework\Http\Responses\PageResponse;

class PageController extends Controller
{
    public function getShow(Request $request, string $page = 'home'): Response
    {
        return new PageResponse($page);
    }
}
