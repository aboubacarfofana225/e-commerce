<?php

if (!VcvEnv::has('VCV_ENV_ADDONS_ID')) {
    VcvEnv::set(
        'VCV_ENV_ADDONS_ID',
        isset($_SERVER['ENV_VCV_ENV_ADDONS_ID']) ? $_SERVER['ENV_VCV_ENV_ADDONS_ID'] : 'account'
    );
}

if (!VcvEnv::has('VCV_ENV_HUB_DOWNLOAD')) {
    VcvEnv::set('VCV_ENV_HUB_DOWNLOAD', true);
}

if (!VcvEnv::has('VCV_ENV_EXTENSION_DOWNLOAD')) {
    VcvEnv::set('VCV_ENV_EXTENSION_DOWNLOAD', true);
}

if (!VcvEnv::has('VCV_HUB_URL')) {
    VcvEnv::set('VCV_HUB_URL', defined('VCV_HUB_URL') ? constant('VCV_HUB_URL') : 'https://my.visualcomposer.com');
}

if (!VcvEnv::has('VCV_TOKEN_URL')) {
    VcvEnv::set(
        'VCV_TOKEN_URL',
        defined('VCV_TOKEN_URL') ? constant('VCV_TOKEN_URL') : 'https://my.visualcomposer.com/authorization-token'
    );
}

if (!VcvEnv::has('VCV_PREMIUM_TOKEN_URL')) {
    VcvEnv::set(
        'VCV_PREMIUM_TOKEN_URL',
        defined('VCV_PREMIUM_TOKEN_URL') ? constant('VCV_PREMIUM_TOKEN_URL') : 'https://my.visualcomposer.com//authorization-token'
    );
}

if (!VcvEnv::has('VCV_API_URL')) {
    VcvEnv::set('VCV_API_URL', defined('VCV_API_URL') ? constant('VCV_API_URL') : 'https://api.visualcomposer.com');
}

if (!VcvEnv::has('VCV_ACTIVATE_LICENSE_URL')) {
    VcvEnv::set(
        'VCV_ACTIVATE_LICENSE_URL',
        defined('VCV_ACTIVATE_LICENSE_URL') ? constant('VCV_ACTIVATE_LICENSE_URL') : 'https://my.visualcomposer.com/?edd_action=activate_license&item_name=Visual%20Composer'
    );
}

if (!VcvEnv::has('VCV_DEBUG')) {
    VcvEnv::set('VCV_DEBUG', defined('VCV_DEBUG') ? constant('VCV_DEBUG') : false);
}

if (!VcvEnv::has('VCV_FIX_CURL_JSON_DOWNLOAD')) {
    // Disabled temporary
    VcvEnv::set('VCV_FIX_CURL_JSON_DOWNLOAD', false);
}

if (!VcvEnv::has('VCV_TF_ASSETS_IN_UPLOADS')) {
    VcvEnv::set('VCV_TF_ASSETS_IN_UPLOADS', true);
}

if (!VcvEnv::has('VCV_TF_ASSETS_URLS_FACTORY_RESET')) {
    VcvEnv::set('VCV_TF_ASSETS_URLS_FACTORY_RESET', true);
}

// Disabled until all php elements updated
if (!VcvEnv::has('VCV_ENV_ELEMENTS_FILES_NOGLOB')) {
    VcvEnv::set('VCV_ENV_ELEMENTS_FILES_NOGLOB', false);
}

if (!VcvEnv::has('VCV_TF_BLANK_PAGE_BOXED')) {
    VcvEnv::set('VCV_TF_BLANK_PAGE_BOXED', true);
}

if (!VcvEnv::has('VCV_FT_INITIAL_CSS_LOAD')) {
    VcvEnv::set('VCV_FT_INITIAL_CSS_LOAD', true);
}

if (!VcvEnv::has('VCV_TF_CSS_CHECKSUM')) {
    VcvEnv::set('VCV_TF_CSS_CHECKSUM', true);
}

if (!VcvEnv::has('VCV_FT_TEMPLATE_DATA_ASYNC')) {
    VcvEnv::set('VCV_FT_TEMPLATE_DATA_ASYNC', true);
}

if (!VcvEnv::has('VCV_FT_ASSETS_INSIDE_PLUGIN')) {
    VcvEnv::set('VCV_FT_ASSETS_INSIDE_PLUGIN', true);
}

if (!VcvEnv::has('VCV_FT_DEFAULT_ELEMENTS_INSIDE_PLUGIN')) {
    VcvEnv::set('VCV_FT_DEFAULT_ELEMENTS_INSIDE_PLUGIN', true);
}

if (!VcvEnv::has('VCV_ENV_FT_SYSTEM_CHECK_LIST')) {
    VcvEnv::set('VCV_ENV_FT_SYSTEM_CHECK_LIST', true);
}

if (!VcvEnv::has('VCV_ENV_FT_GLOBAL_CSS_JS_SETTINGS')) {
    VcvEnv::set('VCV_ENV_FT_GLOBAL_CSS_JS_SETTINGS', true);
}


if (!VcvEnv::has('VCV_JS_THEME_LAYOUTS')) {
    VcvEnv::set('VCV_JS_THEME_LAYOUTS', false); // SEE the devAddons/themeEditor/themeEditor/src/*.js files
}



if (!VcvEnv::has('VCV_JS_THEME_EDITOR')) {
    VcvEnv::set('VCV_JS_THEME_EDITOR', false); // SEE the devAddons/themeEditor/themeEditor/src/*.js files
}


if (!VcvEnv::has('VCV_JS_ARCHIVE_TEMPLATE')) {
    VcvEnv::set('VCV_JS_ARCHIVE_TEMPLATE', false);
}


if (!VcvEnv::has('VCV_JS_SAVE_ZIP')) {
    VcvEnv::set('VCV_JS_SAVE_ZIP', true);
}


if (!VcvEnv::has('VCV_JS_FT_ROW_COLUMN_LOGIC_REFACTOR')) {
    VcvEnv::set('VCV_JS_FT_ROW_COLUMN_LOGIC_REFACTOR', false);
}

if (!VcvEnv::has('VCV_JS_FT_DYNAMIC_FIELDS')) {
    VcvEnv::set('VCV_JS_FT_DYNAMIC_FIELDS', false); // Must be false! SEE the devAddons/dynamicFields/ env files
}

if (!VcvEnv::has('VCV_ACCOUNT_URL')) {
    VcvEnv::set('VCV_ACCOUNT_URL', 'https://account.visualcomposer.io');
}
