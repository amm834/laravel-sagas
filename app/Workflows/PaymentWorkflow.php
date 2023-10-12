<?php

namespace App\Workflows;

use Workflow\ActivityStub;
use Workflow\Workflow;
use Workflow\WorkflowStub;
use function Pest\Laravel\from;

class PaymentWorkflow extends Workflow
{
    /**
     * @throws \Throwable
     */
    public function execute(array $data)
    {
        try {
            $paymentId = yield ActivityStub::make(PaymentSentActivity::class, $data);
            $this->addCompensation(fn() => ActivityStub::make(CancelPaymentSentActivity::class, $paymentId));

        } catch (\Throwable $throwable) {
            yield from $this->compensate();

            $this->release();
            throw $throwable;
        }

        return 'workflow completed';
    }
}
