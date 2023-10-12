<?php

namespace App\Workflows;

use App\Models\Leger;
use Illuminate\Support\Facades\DB;
use Workflow\Activity;

class PaymentSentActivity extends Activity
{
    public function execute(array $data)
    {
        try {
//            throw new \Exception('Payment sent activity failed');
            DB::beginTransaction();
            if (isset($data['id'])) {
                $leger = Leger::find($data['id']);
                $leger->update([
                    ...$data,
                ]);
            } else {
                $leger = Leger::create([
                    ...$data,
                ]);
            }
            DB::commit();
        } catch (\Throwable $throwable) {
            DB::rollBack();
            throw $throwable;
        }


        return $leger->id;
    }
}
