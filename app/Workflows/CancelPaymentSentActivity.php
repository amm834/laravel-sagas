<?php

namespace App\Workflows;

use App\Models\Leger;
use Illuminate\Support\Facades\DB;
use Workflow\Activity;

class CancelPaymentSentActivity extends Activity
{
    public function execute($id): void
    {
        try {
            DB::beginTransaction();
            Leger::destroy($id);
            DB::commit();
        } catch (\Throwable $throwable) {
            DB::rollBack();
            throw $throwable;
        }
    }
}
