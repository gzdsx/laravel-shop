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

    public function q($q){
        return $this->where('subject','like',"%$q%")
            ->orWhere('transaction_no','like',"%$q%");
    }

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
        if ($type == 'all') return $this;
        return $this->where('pay_type', $type);
    }

    public function transactionNo($transaction_no)
    {
        return $this->where('transaction_no', $transaction_no);
    }

    public function transactionType($type){
        if ($type == 'all') return $this;
        return $this->where('transaction_type', $type);
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

    public function dateRange($range){
        if ($range == '3days'){
            return $this->whereDate('created_at','>', now()->subDays(3));
        }

        if ($range == '7days'){
            return $this->whereDate('created_at','>', now()->subDays(7));
        }

        if ($range == 'oneMonth'){
            return $this->whereDate('created_at','>', now()->subDays(30));
        }

        if ($range == 'threeMonth'){
            return $this->whereDate('created_at','>', now()->subDays(90));
        }

        if ($range == 'oneYear'){
            return $this->whereDate('created_at','>', now()->subDays(365));
        }

        return $this;
    }
}
