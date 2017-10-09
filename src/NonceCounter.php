<?php

class NonceCounter
{
    private $DS = '/';
    protected $filename, $file, $handle;

    public function index() {

        $DS = $this->DS;
        $res = '';
        $filename = __DIR__ . $DS . "nonce.txt";

        if (file_exists($filename))
        {

            $file = file_get_contents($filename, FILE_USE_INCLUDE_PATH);

            if(strlen((int)$file) <= 10)
            {

                if ((int)$file === 2147483646 || (int)$file > 2147483646)
                {
                    echo 'No valid key anymore';
                    exit;
                }
                else
                {
                    $res = ((int)$file)+1;
                    $handle = fopen($filename, "w+b");
                    fwrite($handle, $res);
                    fclose($handle);
                }
            }
            else
            {
                echo 'Something wrong with file length';
                exit;
            }
        }
        else
        {
            $res = '1';
            $handle = fopen($filename, "w+b");
            fwrite($handle, '1');
            fclose($handle);
        }

        return $res;
    }
}