<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $total = Payment::sum('amount');
        return view('payments', [
            'payments' => [
                'total' => $total,
                'records' => Payment::all(),
                'volume' => count(Payment::all())
            ]
        ]);
    }
}
