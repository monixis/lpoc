<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('pagination') )
{
    function pagination($total_rows, $per_page,  $url = null, $uri_segment = 3)
    {
        $ci =& get_instance();
        if (is_null($url)) {
            $segment[] = $ci->router->method;
           // $url = implode("&", $segment);
        }
        //  $baseUrl = "http://localhost/useagreement/?c=usragr&m=pages";
        $baseUrl =  base_url("?c=lpoc&m=pages");
        $config['base_url']    = $baseUrl;
        $config['total_rows']  = $total_rows;
        $config['uri_segment'] = $uri_segment;
        $config['per_page']    = $per_page;
        $ci->load->library('pagination');
        $ci->pagination->initialize($config);
        return $ci->pagination->create_links();
    }
}