<?php namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class TransactionFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function subject($subject)
    {
        return $this->where('subject', 'like', "%$subject%");
    }

    public function payerName($name)
    {
        return $this->where('payer_name', '=', $name);
    }

    public function payeeName($name)
    {
        return $this->where('payee_name', '=', $name);
    }

    public function payState($state)
    {
        if ($state == 'paid') {
            return $this->where('pay_state', 1);
        }
        if ($state == 'unpaid') {
            return $this->where('pay_state', 0);
        }
        if (is_numeric($state)){
            return $this->where('pay_state', $state);
        }
        return $this;
    }

    public function minAmount($amount)
    {
        return $this->where('amount', '>', floatval($amount));
    }

    public function maxAmount($amount)
    {
        return $this->where('amount', '<', floatval($amount));
    }

    public function payType($type)
    {
        return $this->where('pay_type', $type);
    }

    public function transactionNo($transaction_no)
    {
        return $this->where('transaction_no', $transaction_no);
    }

    public function timeBegin($time)
    {
        if ($time) {
            return $this->where('created_at', '>', strtotime($time));
        }
        return $this;
    }

    public function timeEnd($time)
    {
        if ($time) {
            return $this->where('created_at', '<', strtotime($time) + 86400);
        }
        return $this;
    }
}
