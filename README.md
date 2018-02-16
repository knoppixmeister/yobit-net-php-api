# yobit-net-php-api
  Simple PHP yobit.net API / PHP yobit.io API v3.0


  This respository providing assecc for the use API of the crypto-currency exchange platform yobit.net.
At first read how to get assecc in standart manual "how to use API". Don't forget change the data keys in nonce counter.

  Using:
  
    git clone https://github.com/gfijrb/yobit-net-php-api.git
    
  In your file type insert this
    
    require_once (link to yobit-net-php-api);

  Public/Trade Api
    
    use publicAPI;
    use tradeAPI;
    
  Init instance
     
    $publicApi = new publicAPI(string $host, string $meth, string $coin, string $market[, int $limit=null])
    $tradeApi = new tradeAPI(string $host, string $meth, string $coin, string $market[, int $limit=null])

  !!! *trade Api still not ready
  
  Say thanks:

    ETH (ethereum)       : 0x352b8b652a07ca4E86a09E2e490FeD71B5010B23
    IFLT (inflation coin): iNyqteZD4U7NQdHdBmBzvweyvuVw7khXvn
