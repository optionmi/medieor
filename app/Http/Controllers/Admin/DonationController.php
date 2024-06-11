<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\DonationRepository;

class DonationController extends Controller
{

    public $donation;
    public function __construct(DonationRepository $donation)
    {
        $this->donation =  $donation;
    }

    public function index()
    {
        return view('admin.donations.index');
    }

    public function datatable()
    {
        $start = request()->get('start');
        $length = request()->get('length');
        $sortColumn = request()->get('order')[0]['name'] ?? 'id';
        $sortDirection = request()->get('order')[0]['dir'] ?? 'asc';
        $searchValue = request()->get('search')['value'];

        $count = $this->donation->paginated($start, $length, $sortColumn, $sortDirection, $searchValue, true);
        $donations = $this->donation->paginated($start, $length, $sortColumn, $sortDirection, $searchValue);

        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $donations
        );

        return response()->json($data);
    }
}
