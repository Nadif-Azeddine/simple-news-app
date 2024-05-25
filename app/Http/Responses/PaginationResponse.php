<?php

namespace App\Http\Responses;

class PaginationResponse
{
    public $total;
    public $currentPage;
    public $perPage;
    public $data;

    public function __construct($total, $currentPage, $perPage, $data)
    {
        $this->total = $total;
        $this->currentPage = $currentPage;
        $this->perPage = $perPage;
        $this->data = $data;
    }
}