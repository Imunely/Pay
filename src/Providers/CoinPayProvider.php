<?php

namespace Imynely\Pay\Providers;

use App\Payment;

class CoinPayProvider extends AbstractProvider
{

    public function createTransaction(float $amount, int $penalty = null): Payment
    {
        return $this->buildTransaction($amount, $penalty, function (Payment $payment) {
            $data = $this->payCredentials($payment->amount, $payment->id);

            $payment->update(['url' => $this->config->api_url() . http_build_query($data)]);

            return $payment;
        });
    }

    public function createCallback(): Payment
    {
        return $this->createTransaction(11, 21);
    }

    private function buildTransaction(float $amount, int $penalty = null, \Closure $action)
    {
        $data = $this->payAttributes($amount, $penalty);

        if (($payment = $this->create($data)) === false) {

            throw new \Exception("Cannot create payment transaction", 1);
        }

        return $action($payment);
    }

    private function payCredentials(float $amount, int $transaction_id): array
    {
        return [
            'id' => $this->config->client_id(),
            'summ' => $amount,
            'order_id' => $transaction_id,
            'customer_id' => $transaction_id,
            'hash' => md5($this->config->client_id() . ":" . $amount . ":" . $this->config->client_secret() . ":" . $this->config->gateway()->system_name . ":" . $transaction_id),
            'sistems' => $this->config->gateway()->system_name,
            'Coment' => "You deposit funds into your " . env('APP_NAME') . " account",
            'user_email' => $this->request->user()->username
        ];
    }
}
