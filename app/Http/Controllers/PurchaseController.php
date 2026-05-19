<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction; 
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        $user_id = Auth::id();

        // 2. Query dasar untuk ambil transaksi pembelian user
        $query = Transaction::where('user_id', $user_id)
            ->with(['transactionDetails.product.release', 'transactionDetails.product.seller.user']);

        // 3. Filter berdasarkan Status
        $status = $request->input('status', 'all');
        if ($status !== 'all') {
            // SQL:
            // AND status = ?
            $query->where('status', $status);
        }

        // 4. Pengaturan Pagination (Show per page)
        $perPage = $request->input('show', 50);

        // SELECT * FROM transactions WHERE user_id = 1 [AND status = ?] 
        // ORDER BY transaction_id DESC 
        // LIMIT 50 OFFSET ?
        $transactions = $query->orderBy('transaction_id', 'desc')->paginate($perPage);

        $total = $transactions->total();
        $from  = $total > 0 ? ($transactions->currentPage() - 1) * $transactions->perPage() + 1 : 0;
        $to    = min($transactions->currentPage() * $transactions->perPage(), $total);

        $statusOptions = [
            'all'       => 'All',
            'pending'   => 'Pending',
            'paid'      => 'Paid',
            'shipped'   => 'Shipped',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
        ];

        $ratingData = Review::where('user_id', $user_id)
            ->selectRaw('COUNT(*) as total, ROUND(AVG(rating), 1) as avg_rating')
            ->first();
 
        $buyerRating = null;
        if ($ratingData && $ratingData->total > 0) {
            $buyerRating = [
                'total'      => $ratingData->total,
                'avg_rating' => $ratingData->avg_rating,
            ];
        }

        return view('sell.purchases', compact(
            'transactions',
            'status',
            'perPage',
            'statusOptions',
            'total',
            'from',
            'to',
            'buyerRating' 
        ));
    }

    public function show($id)
    {
        // SQL:
        // SELECT * FROM transactions 
        // WHERE user_id = ? AND id = ? 
        // LIMIT 1
        // (Catatan: Pastikan di model Transaction, primary key-nya sudah diset jika bukan 'id')
        $transaction = Transaction::where('user_id', Auth::id())
            ->with(['transactionDetails.product.release', 'transactionDetails.product.seller'])
            ->findOrFail($id);

        return view('purchases.show', compact('transaction'));
    }
}