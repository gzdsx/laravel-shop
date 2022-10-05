<?php namespace App\ModelFilters;

use EloquentFilter\ModelFilter;
use Illuminate\Support\Facades\Date;

class UserTransactionFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function q($q)
    {
        return $this->where('subject', 'like', "%$q%")
            ->orWhere('out_trade_no', 'like', "%$q%");
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
        if (is_numeric($state)) {
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

    public function outTradeNo($out_trade_no)
    {
        return $this->where('out_trade_no', $out_trade_no);
    }

    public function type($type)
    {
        if ($type == 'all') return $this;
        return $this->where('type', $type);
    }

    public function timeBegin($time)
    {
        if ($time) {
            return $this->whereDate('created_at', '>=', Date::make($time));
        }
        return $this;
    }

    public function timeEnd($time)
    {
        if ($time) {
            return $this->whereDate('created_at', '<=', Date::make($time));
        }
        return $this;
    }

    public function dateRange($range)
    {
        if ($range == '3days') {
            return $this->whereDate('created_at', '>', now()->subDays(3));
        }

        if ($range == '7days') {
            return $this->whereDate('created_at', '>', now()->subDays(7));
        }

        if ($range == 'oneMonth') {
            return $this->whereDate('created_at', '>', now()->subDays(30));
        }

        if ($range == 'threeMonth') {
            return $this->whereDate('created_at', '>', now()->subDays(90));
        }

        if ($range == 'oneYear') {
            return $this->whereDate('created_at', '>', now()->subDays(365));
        }

        return $this;
    }
}
