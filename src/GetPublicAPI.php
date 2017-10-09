<?php

class GetPublicAPI
{

    private $DS = '/';
    protected $scheme = 'https';
    protected $host = 'yobit.net';

    public function getUrl( $meth, $coin=null, $market=null, $limit=null )
    {
        $url = '';
        $scheme = $this->scheme;
        $host = $this->host;
        $DS = $this->DS;

        if ( $host == 'yobit.net' || $host == 'yobit.io' )
        {

            $url = $scheme.':'.$DS.$DS.$host.$DS.'api'.$DS.'3'.$DS.$meth.$DS.$coin.'_'.$market;

            if ( $meth == 'info' )
            {
                $url = $scheme.':'.$DS.$DS.$host.$DS.'api'.$DS.'3'.$DS.$meth;
            }
            if ( !is_null($limit) && ($meth == 'depth' || $meth == 'trades') )
            {
                $url = $scheme.':'.$DS.$DS.$host.$DS.'api'.$DS.'3'.$DS.$meth.$DS.$coin.'_'.$market.'?limit='.$limit;
            }
        }
        return $url;
    }

    public function getQuery( $url )
    {
        return file_get_contents(htmlspecialchars($url), FILE_USE_INCLUDE_PATH);
    }

    public function getJsonData( $res )
    {
        return json_decode( $res, true );
    }

    public function getJsonImagination( $data )
    {
        global $view;
        $view->index('pattern', $data);
    }

}