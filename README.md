# php-aacodec

<a href="https://travis-ci.org/jfcherng/php-aacodec"><img alt="Travis (.org) branch" src="https://img.shields.io/travis/jfcherng/php-aacodec/master"></a>
<a href="https://packagist.org/packages/jfcherng/php-aacodec"><img alt="Packagist" src="https://img.shields.io/packagist/dt/jfcherng/php-aacodec"></a>
<a href="https://packagist.org/packages/jfcherng/php-aacodec"><img alt="Packagist Version" src="https://img.shields.io/packagist/v/jfcherng/php-aacodec"></a>
<a href="https://github.com/jfcherng/php-aacodec/blob/master/LICENSE"><img alt="Project license" src="https://img.shields.io/github/license/jfcherng/php-aacodec"></a>
<a href="https://github.com/jfcherng/php-aacodec/stargazers"><img alt="GitHub stars" src="https://img.shields.io/github/stars/jfcherng/php-aacodec?logo=github"></a>
<a href="https://www.paypal.me/jfcherng/5usd" title="Donate to this project using Paypal"><img src="https://img.shields.io/badge/paypal-donate-blue.svg?logo=paypal" /></a>

A PHP implementation of the [aaencode](http://utf-8.jp/public/aaencode.html).


## Installation

```bash
$ composer require jfcherng/php-aacodec
```


## Usage

After executing the following PHP code,

```php
<?php

use Jfcherng\AaCodec\Codec;

require_once __DIR__ . '/../vendor/autoload.php';

$jsCode = 'alert("hello world");';
$encodingLevel = 0; // larger to get a longer encoded js code

$encoded = Codec::encode($jsCode, $encodingLevel);
file_put_contents('encoded.js', $encoded);

$decoded = Codec::decode($encoded);
file_put_contents('decoded.js', $decoded);
```

`encoded.js` is now:

```javascript
ﾟωﾟﾉ=/｀ｍ´）ﾉ~┻━┻/['_'];o=(ﾟｰﾟ)=_=3;c=(ﾟΘﾟ)=(ﾟｰﾟ)-(ﾟｰﾟ);(ﾟДﾟ)=(ﾟΘﾟ)=(o^_^o)/(o^_^o);(ﾟДﾟ)={ﾟΘﾟ:'_',ﾟωﾟﾉ:((ﾟωﾟﾉ==3)+'_')[ﾟΘﾟ],ﾟｰﾟﾉ:(ﾟωﾟﾉ+'_')[o^_^o-(ﾟΘﾟ)],ﾟДﾟﾉ:((ﾟｰﾟ==3)+'_')[ﾟｰﾟ]};(ﾟДﾟ)[ﾟΘﾟ]=((ﾟωﾟﾉ==3)+'_')[c^_^o];(ﾟДﾟ)['c']=((ﾟДﾟ)+'_')[(ﾟｰﾟ)+(ﾟｰﾟ)-(ﾟΘﾟ)];(ﾟДﾟ)['o']=((ﾟДﾟ)+'_')[ﾟΘﾟ];(ﾟoﾟ)=(ﾟДﾟ)['c']+(ﾟДﾟ)['o']+(ﾟωﾟﾉ+'_')[ﾟΘﾟ]+((ﾟωﾟﾉ==3)+'_')[ﾟｰﾟ]+((ﾟДﾟ)+'_')[(ﾟｰﾟ)+(ﾟｰﾟ)]+((ﾟｰﾟ==3)+'_')[ﾟΘﾟ]+((ﾟｰﾟ==3)+'_')[(ﾟｰﾟ)-(ﾟΘﾟ)]+(ﾟДﾟ)['c']+((ﾟДﾟ)+'_')[(ﾟｰﾟ)+(ﾟｰﾟ)]+(ﾟДﾟ)['o']+((ﾟｰﾟ==3)+'_')[ﾟΘﾟ];(ﾟДﾟ)['_']=(o^_^o)[ﾟoﾟ][ﾟoﾟ];(ﾟεﾟ)=((ﾟｰﾟ==3)+'_')[ﾟΘﾟ]+(ﾟДﾟ).ﾟДﾟﾉ+((ﾟДﾟ)+'_')[(ﾟｰﾟ)+(ﾟｰﾟ)]+((ﾟｰﾟ==3)+'_')[o^_^o-ﾟΘﾟ]+((ﾟｰﾟ==3)+'_')[ﾟΘﾟ]+(ﾟωﾟﾉ+'_')[ﾟΘﾟ];(ﾟｰﾟ)+=(ﾟΘﾟ);(ﾟДﾟ)[ﾟεﾟ]='\\';(ﾟДﾟ).ﾟΘﾟﾉ=(ﾟДﾟ+ﾟｰﾟ)[o^_^o-(ﾟΘﾟ)];(oﾟｰﾟo)=(ﾟωﾟﾉ+'_')[c^_^o];(ﾟДﾟ)[ﾟoﾟ]='\"';(ﾟДﾟ)['_']((ﾟДﾟ)['_'](ﾟεﾟ+(ﾟДﾟ)[ﾟoﾟ]+(ﾟДﾟ)[ﾟεﾟ]+(ﾟΘﾟ)+(ﾟｰﾟ)+(ﾟΘﾟ)+(ﾟДﾟ)[ﾟεﾟ]+(ﾟΘﾟ)+((ﾟｰﾟ)+(ﾟΘﾟ))+(ﾟｰﾟ)+(ﾟДﾟ)[ﾟεﾟ]+(ﾟΘﾟ)+(ﾟｰﾟ)+((ﾟｰﾟ)+(ﾟΘﾟ))+(ﾟДﾟ)[ﾟεﾟ]+(ﾟΘﾟ)+((o^_^o)+(o^_^o))+((o^_^o)-(ﾟΘﾟ))+(ﾟДﾟ)[ﾟεﾟ]+(ﾟΘﾟ)+((o^_^o)+(o^_^o))+(ﾟｰﾟ)+(ﾟДﾟ)[ﾟεﾟ]+((ﾟｰﾟ)+(ﾟΘﾟ))+(c^_^o)+(ﾟДﾟ)[ﾟεﾟ]+(ﾟｰﾟ)+((o^_^o)-(ﾟΘﾟ))+(ﾟДﾟ)[ﾟεﾟ]+(ﾟΘﾟ)+((ﾟｰﾟ)+(ﾟΘﾟ))+(c^_^o)+(ﾟДﾟ)[ﾟεﾟ]+(ﾟΘﾟ)+(ﾟｰﾟ)+((ﾟｰﾟ)+(ﾟΘﾟ))+(ﾟДﾟ)[ﾟεﾟ]+(ﾟΘﾟ)+((ﾟｰﾟ)+(ﾟΘﾟ))+(ﾟｰﾟ)+(ﾟДﾟ)[ﾟεﾟ]+(ﾟΘﾟ)+((ﾟｰﾟ)+(ﾟΘﾟ))+(ﾟｰﾟ)+(ﾟДﾟ)[ﾟεﾟ]+(ﾟΘﾟ)+((ﾟｰﾟ)+(ﾟΘﾟ))+((ﾟｰﾟ)+(o^_^o))+(ﾟДﾟ)[ﾟεﾟ]+(ﾟｰﾟ)+(c^_^o)+(ﾟДﾟ)[ﾟεﾟ]+(ﾟΘﾟ)+((o^_^o)+(o^_^o))+((ﾟｰﾟ)+(o^_^o))+(ﾟДﾟ)[ﾟεﾟ]+(ﾟΘﾟ)+((ﾟｰﾟ)+(ﾟΘﾟ))+((ﾟｰﾟ)+(o^_^o))+(ﾟДﾟ)[ﾟεﾟ]+(ﾟΘﾟ)+((o^_^o)+(o^_^o))+((o^_^o)-(ﾟΘﾟ))+(ﾟДﾟ)[ﾟεﾟ]+(ﾟΘﾟ)+((ﾟｰﾟ)+(ﾟΘﾟ))+(ﾟｰﾟ)+(ﾟДﾟ)[ﾟεﾟ]+(ﾟΘﾟ)+(ﾟｰﾟ)+(ﾟｰﾟ)+(ﾟДﾟ)[ﾟεﾟ]+(ﾟｰﾟ)+((o^_^o)-(ﾟΘﾟ))+(ﾟДﾟ)[ﾟεﾟ]+((ﾟｰﾟ)+(ﾟΘﾟ))+(ﾟΘﾟ)+(ﾟДﾟ)[ﾟεﾟ]+((ﾟｰﾟ)+(o^_^o))+(o^_^o)+(ﾟДﾟ)[ﾟoﾟ])(ﾟΘﾟ))('_');
```

`decoded.js` is now:

```javascript
alert("hello world");
```
