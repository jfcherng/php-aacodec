<?php

declare(strict_types=1);

namespace Jfcherng\AaCodec\Test;

use Jfcherng\AaCodec\Codec;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * @covers \Jfcherng\AaCodec
 */
final class CodecTest extends TestCase
{
    /**
     * Provides testcases.
     *
     * @return array the testcases
     */
    public function javascriptProvider(): array
    {
        return [
            // the first testcase
            [
                // the first arg of the first testcase
                [
                    // decoded javascript
                    'd' => 'alert("hello world");',
                    // encoded javascript
                    'e' => "ﾟωﾟﾉ=/｀ｍ´）ﾉ~┻━┻/['_'];o=(ﾟｰﾟ)=_=3;c=(ﾟΘﾟ)=(ﾟｰﾟ)-(ﾟｰﾟ);(ﾟДﾟ)=(ﾟΘﾟ)=(o^_^o)/(o^_^o);(ﾟДﾟ)={ﾟΘﾟ:'_',ﾟωﾟﾉ:((ﾟωﾟﾉ==3)+'_')[ﾟΘﾟ],ﾟｰﾟﾉ:(ﾟωﾟﾉ+'_')[o^_^o-(ﾟΘﾟ)],ﾟДﾟﾉ:((ﾟｰﾟ==3)+'_')[ﾟｰﾟ]};(ﾟДﾟ)[ﾟΘﾟ]=((ﾟωﾟﾉ==3)+'_')[c^_^o];(ﾟДﾟ)['c']=((ﾟДﾟ)+'_')[(ﾟｰﾟ)+(ﾟｰﾟ)-(ﾟΘﾟ)];(ﾟДﾟ)['o']=((ﾟДﾟ)+'_')[ﾟΘﾟ];(ﾟoﾟ)=(ﾟДﾟ)['c']+(ﾟДﾟ)['o']+(ﾟωﾟﾉ+'_')[ﾟΘﾟ]+((ﾟωﾟﾉ==3)+'_')[ﾟｰﾟ]+((ﾟДﾟ)+'_')[(ﾟｰﾟ)+(ﾟｰﾟ)]+((ﾟｰﾟ==3)+'_')[ﾟΘﾟ]+((ﾟｰﾟ==3)+'_')[(ﾟｰﾟ)-(ﾟΘﾟ)]+(ﾟДﾟ)['c']+((ﾟДﾟ)+'_')[(ﾟｰﾟ)+(ﾟｰﾟ)]+(ﾟДﾟ)['o']+((ﾟｰﾟ==3)+'_')[ﾟΘﾟ];(ﾟДﾟ)['_']=(o^_^o)[ﾟoﾟ][ﾟoﾟ];(ﾟεﾟ)=((ﾟｰﾟ==3)+'_')[ﾟΘﾟ]+(ﾟДﾟ).ﾟДﾟﾉ+((ﾟДﾟ)+'_')[(ﾟｰﾟ)+(ﾟｰﾟ)]+((ﾟｰﾟ==3)+'_')[o^_^o-ﾟΘﾟ]+((ﾟｰﾟ==3)+'_')[ﾟΘﾟ]+(ﾟωﾟﾉ+'_')[ﾟΘﾟ];(ﾟｰﾟ)+=(ﾟΘﾟ);(ﾟДﾟ)[ﾟεﾟ]='\\\\';(ﾟДﾟ).ﾟΘﾟﾉ=(ﾟДﾟ+ﾟｰﾟ)[o^_^o-(ﾟΘﾟ)];(oﾟｰﾟo)=(ﾟωﾟﾉ+'_')[c^_^o];(ﾟДﾟ)[ﾟoﾟ]='\\\"';(ﾟДﾟ)['_']((ﾟДﾟ)['_'](ﾟεﾟ+(ﾟДﾟ)[ﾟoﾟ]+(ﾟДﾟ)[ﾟεﾟ]+(ﾟΘﾟ)+(ﾟｰﾟ)+(ﾟΘﾟ)+(ﾟДﾟ)[ﾟεﾟ]+(ﾟΘﾟ)+((ﾟｰﾟ)+(ﾟΘﾟ))+(ﾟｰﾟ)+(ﾟДﾟ)[ﾟεﾟ]+(ﾟΘﾟ)+(ﾟｰﾟ)+((ﾟｰﾟ)+(ﾟΘﾟ))+(ﾟДﾟ)[ﾟεﾟ]+(ﾟΘﾟ)+((o^_^o)+(o^_^o))+((o^_^o)-(ﾟΘﾟ))+(ﾟДﾟ)[ﾟεﾟ]+(ﾟΘﾟ)+((o^_^o)+(o^_^o))+(ﾟｰﾟ)+(ﾟДﾟ)[ﾟεﾟ]+((ﾟｰﾟ)+(ﾟΘﾟ))+(c^_^o)+(ﾟДﾟ)[ﾟεﾟ]+(ﾟｰﾟ)+((o^_^o)-(ﾟΘﾟ))+(ﾟДﾟ)[ﾟεﾟ]+(ﾟΘﾟ)+((ﾟｰﾟ)+(ﾟΘﾟ))+(c^_^o)+(ﾟДﾟ)[ﾟεﾟ]+(ﾟΘﾟ)+(ﾟｰﾟ)+((ﾟｰﾟ)+(ﾟΘﾟ))+(ﾟДﾟ)[ﾟεﾟ]+(ﾟΘﾟ)+((ﾟｰﾟ)+(ﾟΘﾟ))+(ﾟｰﾟ)+(ﾟДﾟ)[ﾟεﾟ]+(ﾟΘﾟ)+((ﾟｰﾟ)+(ﾟΘﾟ))+(ﾟｰﾟ)+(ﾟДﾟ)[ﾟεﾟ]+(ﾟΘﾟ)+((ﾟｰﾟ)+(ﾟΘﾟ))+((ﾟｰﾟ)+(o^_^o))+(ﾟДﾟ)[ﾟεﾟ]+(ﾟｰﾟ)+(c^_^o)+(ﾟДﾟ)[ﾟεﾟ]+(ﾟΘﾟ)+((o^_^o)+(o^_^o))+((ﾟｰﾟ)+(o^_^o))+(ﾟДﾟ)[ﾟεﾟ]+(ﾟΘﾟ)+((ﾟｰﾟ)+(ﾟΘﾟ))+((ﾟｰﾟ)+(o^_^o))+(ﾟДﾟ)[ﾟεﾟ]+(ﾟΘﾟ)+((o^_^o)+(o^_^o))+((o^_^o)-(ﾟΘﾟ))+(ﾟДﾟ)[ﾟεﾟ]+(ﾟΘﾟ)+((ﾟｰﾟ)+(ﾟΘﾟ))+(ﾟｰﾟ)+(ﾟДﾟ)[ﾟεﾟ]+(ﾟΘﾟ)+(ﾟｰﾟ)+(ﾟｰﾟ)+(ﾟДﾟ)[ﾟεﾟ]+(ﾟｰﾟ)+((o^_^o)-(ﾟΘﾟ))+(ﾟДﾟ)[ﾟεﾟ]+((ﾟｰﾟ)+(ﾟΘﾟ))+(ﾟΘﾟ)+(ﾟДﾟ)[ﾟεﾟ]+((ﾟｰﾟ)+(o^_^o))+(o^_^o)+(ﾟДﾟ)[ﾟoﾟ])(ﾟΘﾟ))('_');",
                ],
            ],
            // more testcases...
        ];
    }

    /**
     * Test Codec::encode().
     *
     * @dataProvider javascriptProvider
     *
     * @param string[] $testcase The testcase
     */
    public function testEncode(array $testcase): void
    {
        $this->assertTrue($this->isJsEqual(
            Codec::encode($testcase['d'], 0),
            $testcase['e']
        ));
    }

    /**
     * Test Codec::decode().
     *
     * @dataProvider javascriptProvider
     *
     * @param string[] $testcase The testcase
     */
    public function testDecode(array $testcase): void
    {
        $this->assertTrue($this->isJsEqual(
            Codec::decode($testcase['e']),
            $testcase['d']
        ));
    }

    /**
     * Test Codec::decode() failed.
     *
     * @dataProvider javascriptProvider
     *
     * @param string[] $testcase The testcase
     */
    public function testDecodeFailed(array $testcase): void
    {
        $this->expectException(RuntimeException::class);
        $this->assertNotSame(Codec::decode($testcase['d']), true);
    }

    /**
     * Test Codec::isAaEncoded().
     *
     * @dataProvider javascriptProvider
     *
     * @param string[] $testcase The testcase
     */
    public function testIsAaEncoded(array $testcase): void
    {
        $this->assertTrue(Codec::isAaEncoded($testcase['e']));
        $this->assertFalse(Codec::isAaEncoded($testcase['d']));
    }

    protected function isJsEqual(string $a, string $b): bool
    {
        $args = \array_map([$this, 'unifyJavascript'], \func_get_args());

        return $args[0] === $args[1];
    }

    /**
     * Append a trailing semicolon to a string.
     *
     * @param string $str The string
     *
     * @return string
     */
    protected function unifyJavascript(string $str): string
    {
        return \trim($str, " \t\n\r\0\x0B;") . ';';
    }
}
