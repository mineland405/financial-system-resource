<?php 
use Illuminate\Support\Str;
use Mineland405\FinancialSystemResource\Models\Order;

if(!function_exists('_avatar')) {
    /**
     * Generate member avatar string on Main Page
     * If member has not avatar, return default image
     */
    function _avatar($avatar) {
        if(empty($avatar))
            return asset('images/empty.jpg');
        else
            return asset('storage/' . $avatar);
    }
}

if(!function_exists('_member_avatar')) {
    /**
     * Generate member avatar string on Admin Page
     * If member has not avatar, return default image
     */
    function _member_avatar($avatar) {
        if(empty($avatar))
            return config('app.main_url') . '/images/empty.jpg';
        else
            return config('app.main_url') . '/storage/' . $avatar;
    }
}

if(!function_exists('_generate_referral_code')) {
    /**
     * Generate referral_code
     */
    function _generate_referral_code() {
        return Str::upper(Str::random(6));
    }
}

if(!function_exists('_generate_referral_link')) {
    /**
     * Generate referral_link
     */
    function _generate_referral_link() {
        return Str::random(17);
    }
}

if(!function_exists('_get_referral_full_link')) {
    /**
     * Get referral link
     */
    function _get_referral_full_link($referralCodeLink) {
        return route('referral', ['presenter' => $referralCodeLink]);
    }
}

if(!function_exists('_payment_method_label')) {
    /**
     * Return order payment method label
     */
    function _payment_method_label($method) {
        $order = new Order();
        return $order::PAYMENT_METHODS[$method];
    }
}

if(!function_exists('_order_status_label')) {
    /**
     * Return order status label
     */
    function _order_status_label($method) {
        $order = new Order();
        return $order::STATUS[$method];
    }
}

if(!function_exists('_order_status_description')) {
    /**
     * Return order status description
     */
    function _order_status_description($method) {
        $order = new Order();
        return $order::STATUS_DESCRIPTION[$method];
    }
}

if(!function_exists('_order_type_label')) {
    /**
     * Return order type label
     */
    function _order_type_label($type) {
        return $type === 'new' ? 'Buy new Package' : 'Extend Package using time';
    }
}

if(!function_exists('_main_route')) {
    /**
     * Return Admin Site URL
     */
    function _main_route($routeName, $seq = null) {
        $mainUrl = config('define.main_url')[$routeName];
        $includeSeqUrl = str_replace('{seq}', $seq, $mainUrl);

        return url(config('app.main_url') . '/' . $includeSeqUrl);
    }
}
