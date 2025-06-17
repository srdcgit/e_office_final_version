<?php
if(!function_exists('format_date')){
    function format_date($date){
        return \Carbon\Carbon::createFromFormat('Y-m-d', $date);
    }
}
if(!function_exists('format_datetime')){
    function format_datetime($datetime){
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->format('d/M/Y H:i:s');
    }
}


if (! function_exists('getCategoryName')) {
    function getCategoryName($id)
    {
        $category = \App\Models\Category::find($id);
        return $category ? $category->name : 'name';
    }
}
function app_clean_html_content($content)
{
    //remove script tags
    $content = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $content);
    //remove style tags
    return preg_replace('#<style(.*?)>(.*?)</style>#is', '', $content);

}
