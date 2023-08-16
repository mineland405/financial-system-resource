<?php 
use Illuminate\Support\Facades\DB;
use Mineland405\FinancialSystemResource\Models\Option;

if(!function_exists('_get_option')) {
    /**
     * Get Option by name
     */
    function _get_option($name) {
        return Option::where('name', $name)->first()->value ?? null;
    }
}

if(!function_exists('_set_option')) {
    /**
     * Set Option by name
     */
    function _set_option($name, $value) {
        Option::updateOrCreate(
            ['name' => $name],
            ['value' => $value]
        );
    }
}

if(!function_exists('_delete_option')) {
    /**
     * Destroy Option
     */
    function _delete_option($name) {
        Option::where('name', $name)->delete();
    }
}

if(!function_exists('_log_activity')) {
    /**
     * Log Activity
     */
    function _log_activity($activity, $data = null) {
        DB::table('log_activities')->insert([
            'user_id' => Auth::user()->id,
            'activity' => $activity,
            'data' => $data ? json_encode($data) : null,
            'ip' => request()->ip(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}