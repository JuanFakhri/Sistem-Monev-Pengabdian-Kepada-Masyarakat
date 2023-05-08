<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here
        if (!session()->get('log')) {
            return redirect()->to(base_url('/'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
        if ((session()->get('log')) && (session()->get('akses') == '3')) {
            return redirect()->to(base_url("/dashboard"));
        } elseif ((session()->get('log')) && (session()->get('akses') == '1')) {
            return redirect()->to('/monev_pkm');
        } elseif ((session()->get('log')) && (session()->get('akses') == '2')) {
            return redirect()->to('/monev_pkm');
        }
    }
}
