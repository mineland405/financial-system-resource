<?php 
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Mineland405\FinancialSystemResource\Models\MasterPage;

if(!function_exists('_is_subdomain')) {
    /**
     * Check if current url or $url is a subdomain
     */
    function _is_subdomain($url = null) {
        if(is_null($url))
            $url = request()->url();
        $host = request()->server('SERVER_NAME');
        $info = parse_url($url);
        if ($info['host'] == $host)
            return false;
        return true;
    }
}

if(!function_exists('_is_master_page')) {
    /**
     * Check if current url is a master page url
     */
    function _is_master_page() {
        return request()->is(config('app.path.master') . '/*');
    }
}

if(!function_exists('_page_id')) {
    /**
     * Get page_id from route
     */
    function _page_id() {
        return Route::current()->parameter('pageid');
    }
}

if(!function_exists('_master_page_id')) {
    /**
     * Get id of Master Page
     */
    function _master_page_id() {
        if(_is_subdomain() && !is_null(_page_id())) {
            return MasterPage::isAvailable()->where('page_id', _page_id())->first()->id;
        }
        
        return NULL;
    }
}

if(!function_exists('_set_default_parameter_url')) {
    /**
     * Set default pageid to all route
     */
    function _set_default_parameter_url() {
        $pageId = Route::current()->parameter('pageid');
        URL::defaults(['pageid' => $pageId]);
    }
}

if(!function_exists('_r')) {
    /**
     * Replace route name to master page route name when access in master management page
     */
    function _r($routeName) {
        if(_is_master_page())
            return 'master.' . $routeName;
            
        return $routeName;
    }
}
