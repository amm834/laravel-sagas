<?php

namespace App\Http\Controllers;

use App\Models\Leger;
use App\Workflows\PaymentWorkflow;
use Illuminate\Support\Str;
use Workflow\WorkflowStub;

class PaymentController extends Controller
{

    public function __invoke()
    {
        try {
            $workflow = WorkflowStub::make(PaymentWorkflow::class);
            $workflow->start([
                'from_user_id' => 1,
                'to_user_id' => 2,
                'identifier' => Str::uuid(),
                'amount' => 100,
                'type' => 'transfer',
            ]);

            return response()->json([
                'message' => 'Payment sent successfully',
                'payments' => Leger::all(),
            ]);
        } catch (\Throwable $throwable) {
            return response()->json([
                'message' => $throwable->getMessage(),
                'trace' => $throwable->getTraceAsString(),
            ], 500, [
                'Content-Type' => 'application/json',
            ]);
        }

    }

}
