<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * class MpesaDonation

    @property transaction_type
    @property trans_id
    @property trans_time
    @property trans_amount
    @property business_short_code
    @property bill_ref_number
    @property org_account_balance
    @property msisdn
    @property first_name
    @property middle_name
    @property last_name

 **/
class MpesaDonation extends Model
{
    protected $guarded = [];
}
