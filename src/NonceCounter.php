<?php
namespace yobit\net\php\api\src;

class NonceCounter
{
    private $DS = '/';
    protected
        $filename,
        $file,
        $handle;

    public function __construct() {

        $DS = $this->DS;
        $res = '';
        $this->filename = "nonce.txt";

        if (file_exists($this->filename)) {

            $this->file = file_get_contents($this->filename, FILE_USE_INCLUDE_PATH);

            if(strlen((int)$this->file) <= 10) {

                if ((int)$this->file === 2147483646 || (int)$this->file > 2147483646) {
                    echo 'No valid key anymore';
                    exit;

                } else {
                    $res = ((int)$this->file)+1;
                    $this->handle = fopen($this->filename, "w+b");
                    fwrite($this->handle, $res);
                    fclose($this->handle);
                }

            } else {
                echo 'Something wrong with file length';
                exit;
            }

        } else {

            $res = '1';
            $this->handle = fopen($this->filename, "w+b");
            fwrite($this->handle, '1');
            fclose($this->handle);
        }

        return $res;
    }
}