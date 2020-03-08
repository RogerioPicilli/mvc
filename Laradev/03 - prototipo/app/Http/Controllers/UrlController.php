<?php

namespace LaraDev\Http\Controllers;

use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\Stub\Exception;

class UrlController extends Controller
{
    public function index()
    {



        $url = "http://maxidoc.com.br";
        if($this->isUrlValida($url)){
            echo 'Existe';
        } else {
            echo 'Não existe';
        }
        
        die;
        
        
        $this->isSsl($url);

        echo 'Voltei';

        die;

        $url_1 = 'maxidoc.com.br';
        if(checkdnsrr($url_1))
        {
            echo 'O domínio existe';
        } else {
            echo 'O domínio NÃO exsite';
        }

        $ret = dns_get_record($url_1);
        dd($ret);

        die;

        $url_3 = 'https://meumedico.com.br';
        $url_4 = 'https://www.meumedico.com.br';

        $headers_3 = @get_headers($url_3);
        $this->ssl($url_3);

        $headers_4 = @get_headers($url_4);
        $this->ssl($url_4);

        die;

        return view('url.index');
    }

    public function isUrlValida($url) 
    {
        $headers = @get_headers($url);
        if(strpos($headers[0],'404') === false)
        {
            echo "URL Exists";
            return true;
        }
        else
        {
            echo "URL Not Exists";
            return false;
        }
    }

    public function ssl($url)
    {
        $orignal_parse = parse_url($url, PHP_URL_HOST);
        $get = stream_context_create(array("ssl" => array("capture_peer_cert" => true)));
        $read = stream_socket_client("ssl://" . $orignal_parse . ":443", $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $get);
        $cert = stream_context_get_params($read);
        $certinfo = openssl_x509_parse($cert['options']['ssl']['peer_certificate']);

        if($certinfo){
            dd($certinfo);
        } else {
            echo 'Não achei nada...';
        }
        
    }

    public function isSsl($url) 
    {
        try {
            $stream = stream_context_create (array("ssl" => array("capture_peer_cert" => true)));
            $read = fopen("https://" . $url, "rb", false, $stream);
            $cont = stream_context_get_params($read);
            $var = ($cont["options"]["ssl"]["peer_certificate"]);
            $result = (!is_null($var)) ? true : false;
    
            dd($result);
    
        }
        catch(Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }

        die;



    }
}
