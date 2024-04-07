<?php

namespace Imynely\Pay\Providers;

use App\Payment;
use Imynely\Pay\PaymentStatus;
use Imynely\Pay\Penalty;

class PayouProvider extends AbstractProvider
{
    /**
     *
     * @var \App\Payment
     */
    protected $payment;


    private const PAY_STATUS = [
        'success' => PaymentStatus::PAID,
        'error' => PaymentStatus::ERROR,
    ];


    public function createTransaction(float $amount, int $penalty = null): Payment
    {
        return $this->buildTransaction($amount, $penalty, function (Payment $payment) {
            $data = $this->payCredentials($payment->real_amount, $payment->id);

            $payment->update(['url' => $this->config->api_url() . http_build_query($data)]);

            return $payment;
        });
    }

    public function createCallback(): Payment
    {
        return $this->onInvalidHash(function () {

            throw new \Exception("Invalid hash", 403);
        })->onNotFound(function () {

            throw new \Exception("Payment not found", 404);
        })->onAlreadyPaid(function () {

            throw new \Exception("Payment already paid", 200);
        })->onError(function () {
            $this->payment()->update(['status' => PaymentStatus::ERROR]);

            throw new \Exception("Payment not paid", 400);
        })->onSuccess(function () {

            $this->payment()->update([
                'paid_amount' => (int) $this->request->AMOUNT,
                'status' => PaymentStatus::PAID
            ]);
        })->onPenalty(function () {

            $this->payment()->penalty->update(['status' => Penalty::PAID]);
        })->responce($this->payment()->toArray());
    }


    private function buildTransaction(float $amount, int $penalty = null, \Closure $transaction)
    {
        $data = $this->payAttributes($amount, $penalty);

        if (($payment = $this->create($data)) === false) {

            throw new \Exception("Cannot create payment transaction", 1);
        }

        return $transaction($payment);
    }

    function onNotFound(\Closure $notFound): self
    {
        if (!$this->payment()) {
            $notFound();
        }

        return $this;
    }

    function onAlreadyPaid(\Closure $alreadyPayd): self
    {
        if ($this->payment()->status === PaymentStatus::PAID) {
            $alreadyPayd();
        }

        return $this;
    }

    private function onInvalidHash(\Closure $invalidHash): self
    {
        if ($this->callbackHash() !== $this->request->SIGN) {
            $invalidHash();
        }

        return $this;
    }

    private function onSuccess(\Closure $success): self
    {
        if ($this->status() === PaymentStatus::PAID) {
            $success();
        }

        return $this;
    }

    private function onError(\Closure $error): self
    {
        if ($this->status() === PaymentStatus::PAID) {
            $error();
        }

        return $this;
    }

    private function onPenalty(\Closure $penalty): self
    {
        if ($this->payment()->penalty) {
            $penalty();
        }

        return $this;
    }

    private function payment(): \App\Payment|null
    {
        if (!$this->payment) {
            $this->payment = $this->getPayment($this->request->MERCHANT_ORDER_ID);
        }

        return $this->payment;
    }

    private function status(): int
    {
        return self::PAY_STATUS[$this->request->status];
    }

    private function responce(mixed $responce): mixed
    {
        return $responce;
    }

    private function payCredentials(float $amount, int $transaction_id): array
    {
        return [
            'id' => $this->config->client_id(),
            'summ' => $amount,
            'order_id' => $transaction_id,
            'customer_id' => $transaction_id,
            'hash' => $this->payingHash($amount, $transaction_id),
            'sistems' => $this->config->gateway()->system_name,
            'Coment' => "You deposit funds into your " . env('APP_NAME') . " account",
            'user_email' => $this->request->user()->username
        ];
    }


    private function payingHash(float $amount, int $transaction_id): string
    {
        return md5(
            $this->config->client_id() . ":" . $amount . ":" .
                $this->config->client_secret() . ":" .
                $this->config->gateway()->system_name . ":" . $transaction_id
        );
    }

    private function callbackHash(): string
    {
        return md5(
            $this->config->client_id() . ':' . $this->request->AMOUNT . ':' .
                $this->config->client_secret() . ":" . $this->request->status . ':' .
                $this->request->intid . ':' . $this->request->MERCHANT_ORDER_ID
        );
    }
}
