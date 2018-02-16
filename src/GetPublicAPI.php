<?php
namespace yobit\net\php\api\src;

class GetPublicAPI
{
    private $DS = '/';
    private $scheme = 'https';
    private $host;

    public function __construct($host, $meth, $coin, $market, $limit=null)
    {
        $this->host = $host;
        $this->response(
            $this->query(
                $this->body($meth, $coin, $market, $limit=null)
            )
        );
    }

    private function query($url)
    {
        return \file_get_contents(\htmlspecialchars($url), FILE_USE_INCLUDE_PATH);
    }

    private function response($res)
    {
        return \json_decode( $res, true );
    }

    private function body($meth, $coin, $market, $limit=null)
    {
        $url = '';
        $scheme = $this->scheme;
        $host = $this->host;
        $DS = $this->DS;

        if ($host == 'yobit.net' || $host == 'yobit.io')
        {
            $url = $scheme.':'.$DS.$DS.$host.$DS.'api'.$DS.'3'.$DS.$meth.$DS.$coin.'_'.$market;

            if($meth == 'info') {
                $url = $scheme.':'.$DS.$DS.$host.$DS.'api'.$DS.'3'.$DS.$meth;
            }
            if ( !is_null($limit) && ($meth == 'depth' || $meth == 'trades') )
            {
                $url = $scheme.':'.$DS.$DS.$host.$DS.'api'.$DS.'3'.$DS.$meth.$DS.$coin.'_'.$market.'?limit='.$limit;
            }
        }
        return $url;
    }
}