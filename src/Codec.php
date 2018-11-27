<?php

declare(strict_types=1);

namespace Jfcherng\AaCodec;

/**
 * Class for encode/decode JavaScript codes in "Japanese style emoticons" form.
 *
 * @author Andrey Izman <izmanw@gmail.com>
 * @author Jack Cherng <jfcherng@gmail.com>
 *
 * @see http://utf-8.jp/public/aaencode.html
 *
 * @license MIT
 */
class Codec
{
    /**
     * @var string
     */
    const CODE_BEGIN = "ﾟωﾟﾉ=/｀ｍ´）ﾉ~┻━┻/['_'];o=(ﾟｰﾟ)=_=3;c=(ﾟΘﾟ)=(ﾟｰﾟ)-(ﾟｰﾟ);(ﾟДﾟ)=(ﾟΘﾟ)=(o^_^o)/(o^_^o);(ﾟДﾟ)={ﾟΘﾟ:'_',ﾟωﾟﾉ:((ﾟωﾟﾉ==3)+'_')[ﾟΘﾟ],ﾟｰﾟﾉ:(ﾟωﾟﾉ+'_')[o^_^o-(ﾟΘﾟ)],ﾟДﾟﾉ:((ﾟｰﾟ==3)+'_')[ﾟｰﾟ]};(ﾟДﾟ)[ﾟΘﾟ]=((ﾟωﾟﾉ==3)+'_')[c^_^o];(ﾟДﾟ)['c']=((ﾟДﾟ)+'_')[(ﾟｰﾟ)+(ﾟｰﾟ)-(ﾟΘﾟ)];(ﾟДﾟ)['o']=((ﾟДﾟ)+'_')[ﾟΘﾟ];(ﾟoﾟ)=(ﾟДﾟ)['c']+(ﾟДﾟ)['o']+(ﾟωﾟﾉ+'_')[ﾟΘﾟ]+((ﾟωﾟﾉ==3)+'_')[ﾟｰﾟ]+((ﾟДﾟ)+'_')[(ﾟｰﾟ)+(ﾟｰﾟ)]+((ﾟｰﾟ==3)+'_')[ﾟΘﾟ]+((ﾟｰﾟ==3)+'_')[(ﾟｰﾟ)-(ﾟΘﾟ)]+(ﾟДﾟ)['c']+((ﾟДﾟ)+'_')[(ﾟｰﾟ)+(ﾟｰﾟ)]+(ﾟДﾟ)['o']+((ﾟｰﾟ==3)+'_')[ﾟΘﾟ];(ﾟДﾟ)['_']=(o^_^o)[ﾟoﾟ][ﾟoﾟ];(ﾟεﾟ)=((ﾟｰﾟ==3)+'_')[ﾟΘﾟ]+(ﾟДﾟ).ﾟДﾟﾉ+((ﾟДﾟ)+'_')[(ﾟｰﾟ)+(ﾟｰﾟ)]+((ﾟｰﾟ==3)+'_')[o^_^o-ﾟΘﾟ]+((ﾟｰﾟ==3)+'_')[ﾟΘﾟ]+(ﾟωﾟﾉ+'_')[ﾟΘﾟ];(ﾟｰﾟ)+=(ﾟΘﾟ);(ﾟДﾟ)[ﾟεﾟ]='\\\\';(ﾟДﾟ).ﾟΘﾟﾉ=(ﾟДﾟ+ﾟｰﾟ)[o^_^o-(ﾟΘﾟ)];(oﾟｰﾟo)=(ﾟωﾟﾉ+'_')[c^_^o];(ﾟДﾟ)[ﾟoﾟ]='\\\"';(ﾟДﾟ)['_']((ﾟДﾟ)['_'](ﾟεﾟ+(ﾟДﾟ)[ﾟoﾟ]+";

    /**
     * @var string
     */
    const CODE_END = "(ﾟДﾟ)[ﾟoﾟ])(ﾟΘﾟ))('_');";

    /**
     * @var string[]
     */
    const BYTES = [
        '(c^_^o)',
        '(ﾟΘﾟ)',
        '((o^_^o)-(ﾟΘﾟ))',
        '(o^_^o)',
        '(ﾟｰﾟ)',
        '((ﾟｰﾟ)+(ﾟΘﾟ))',
        '((o^_^o)+(o^_^o))',
        '((ﾟｰﾟ)+(o^_^o))',
        '((ﾟｰﾟ)+(ﾟｰﾟ))',
        '((ﾟｰﾟ)+(ﾟｰﾟ)+(ﾟΘﾟ))',
        '(ﾟДﾟ).ﾟωﾟﾉ',
        '(ﾟДﾟ).ﾟΘﾟﾉ',
        "(ﾟДﾟ)['c']",
        '(ﾟДﾟ).ﾟｰﾟﾉ',
        '(ﾟДﾟ).ﾟДﾟﾉ',
        '(ﾟДﾟ)[ﾟΘﾟ]',
    ];

    /**
     * Encode JavaScript code into it's "Japanese style emoticons" form.
     *
     * @param string $js    the JavaScript code
     * @param int    $level larger = longer encoded code
     *
     * @return string
     */
    public static function encode(string $js, int $level = 0): string
    {
        $js = static::unifyJavascript($js);

        $result = '';

        for ($i = 0, $len = \mb_strlen($js, 'UTF-8'); $i < $len; ++$i) {
            $text = '(ﾟДﾟ)[ﾟεﾟ]+';

            $code = \unpack('N', \mb_convert_encoding(
                \mb_substr($js, $i, 1, 'UTF-8'),
                'UCS-4BE',
                'UTF-8'
            ))[1];

            if ($code < 128) {
                $text .= \preg_replace_callback(
                    '/[0-7]++/uS',
                    function (array $matches) use ($level): string {
                        $bytes = \array_map('intval', \str_split($matches[0]));
                        $replaceds = \array_map(
                            $level > 0 ? function (int $byte) use ($level): string {
                                return static::randomize($byte, $level);
                            } : function (int $byte) use ($level): string {
                                return static::BYTES[$byte];
                            },
                            $bytes
                        );

                        return \implode('+', $replaceds) . '+';
                    },
                    \decoct($code)
                );
            } else {
                $text .= '(oﾟｰﾟo)+';

                $hex = \str_split(\substr('000' . \dechex($code), -4));
                foreach ($hex as $digit) {
                    $text .= static::BYTES[\hexdec($digit)] . '+';
                }
            }

            $result .= $text;
        }

        return static::CODE_BEGIN . $result . static::CODE_END;
    }

    /**
     * Decode encoded JavaScript codes.
     *
     * @param string $js the encoded JavaScript code
     *
     * @throws UndecodableException if the JavaScript is undecodable
     *
     * @return string the decoded JavaScript code
     */
    public static function decode(string $js): string
    {
        if (($js = \trim($js)) === '') {
            return '';
        }

        if (!static::isAaEncoded($js, $start, $next, $encoded)) {
            throw new UndecodableException('the input JavaScript is not decodable.');
        }

        $decoded = static::unifyJavascript(static::deobfuscate($encoded));

        return \mb_substr($js, 0, $start, 'UTF-8')
            . $decoded
            . static::decode(\mb_substr($js, $next, null, 'UTF-8'));
    }

    /**
     * Check JavaScript code is encoded or not.
     *
     * @param string      $js       the JavaScript code
     * @param null|int    &$start
     * @param null|int    &$next
     * @param null|string &$encoded
     *
     * @return bool
     */
    public static function isAaEncoded(string $js, ?int &$start = null, ?int &$next = null, ?string &$encoded = null): bool
    {
        /**
         * Searches for the first match.
         *
         * @param string $haystack The haystack
         * @param string $needle   The needle
         * @param int    $offset   The offset
         *
         * @return null|int[] [begin, end] or null if not found
         */
        $find = function (string $haystack, string $needle, int $offset = 0): ?array {
            $matches = [];
            for ($i = 0; $i < 6 && $offset !== false; ++$i) {
                if (($offset = \mb_strpos($haystack, $needle, $offset, 'UTF-8')) !== false) {
                    $matches[] = $offset;
                    ++$offset;
                }
            }

            return \count($matches) >= 6 ? [$matches[4], $matches[5]] : null;
        };

        $start = -1;
        while (($start = \mb_strpos($js, 'ﾟωﾟﾉ', $start + 1, 'UTF-8')) !== false) {
            $clear = \preg_replace(
                ['/\/\*.*?\*\//uS', '/[\x03-\x20]++/uS'],
                '',
                \mb_substr($js, $start, null, 'UTF-8')
            );

            $len = \mb_strlen(static::CODE_BEGIN, 'UTF-8');
            if (
                \mb_substr($clear, 0, $len, 'UTF-8') === static::CODE_BEGIN &&
                \mb_strpos($clear, static::CODE_END, $len, 'UTF-8') !== false &&
                ($matches = $find($js, 'ﾟoﾟ', $start))
            ) {
                [$beginAt, $endAt] = $matches;
                $beginAt = \mb_strpos($js, '+', $beginAt, 'UTF-8');
                $endAt = \mb_strrpos($js, '(', -\mb_strlen($js, 'UTF-8') + $endAt, 'UTF-8');

                $next = \mb_strpos($js, ';', $endAt + 1, 'UTF-8') + 1;
                $encoded = \preg_replace(
                    '/[\x03-\x20]++/uS',
                    '',
                    \mb_substr($js, $beginAt, $endAt - $beginAt, 'UTF-8')
                );

                return true;
            }
        }

        return false;
    }

    /**
     * @param int $byte
     * @param int $level larger = longer encoded code
     *
     * @return string
     */
    protected static function randomize(int $byte, int $level): string
    {
        static $random = [
            0 => [['+0', '-0'], ['+1', '-1'], ['+3', '-3'], ['+4', '-4']],
            1 => [['+1', '-0'], ['+3', '-1', '-1'], ['+4', '-3']],
            2 => [['+3', '-1'], ['+4', '-3', '+1'], ['+3', '+3', '-4']],
            3 => [['+3', '-0'], ['+4', '-3', '+1', '+1']],
            4 => [['+4', '+0'], ['+1', '+3'], ['+4', '-0']],
            5 => [['+3', '+1', '+1'], ['+4', '+1'], ['+3', '+3', '-1']],
            6 => [['+3', '+3'], ['+4', '+1', '+1'], ['+4', '+3', '-1']],
            7 => [['+3', '+4'], ['+3', '+3', '+1'], ['+4', '+4', '-1']],
        ];

        $byte = (string) $byte;

        for (; $level > 0; --$level) {
            $byte = \preg_replace_callback(
                '/[0-7]++/uS',
                function (array $matches) use ($random): string {
                    $digits = \str_split($matches[0]);
                    $replaced = '';

                    foreach ($digits as $digit) {
                        $numbers = $random[(int) $digit];
                        $numbers = $numbers[\array_rand($numbers)];
                        \shuffle($numbers);
                        $replaced .= '(' . \ltrim(\implode('', $numbers), '+') . ')';
                    }

                    return $replaced;
                },
                $byte
            );
        }

        $byte = \str_replace('+-', '-', $byte);

        return \strtr($byte, static::BYTES);
    }

    /**
     * @param string $js the JavaScript code
     *
     * @return string
     */
    protected static function deobfuscate(string $js): string
    {
        static $hex = '(oﾟｰﾟo)+';
        static $natives = [
            '-~' => '1+',
            '!' => '1',
            '[]' => '0',
        ];

        $chars = [];
        $hexLen = \mb_strlen($hex, 'UTF-8');

        $convert = function (string $block, callable $func): string {
            do {
                $block = \preg_replace_callback(
                    '/\([0-9\-+*\/]++\)/uS',
                    function (array $matches): float {
                        return eval("return {$matches[0]};");
                    },
                    $block,
                    -1,
                    $count
                );
            } while ($count > 0);

            $split = [];
            foreach (\explode('+', \trim($block, '+')) as $num) {
                if ($num === '') {
                    continue;
                }

                $split[] = $func((int) \trim($num));
            }

            return \implode('', $split);
        };

        foreach (static::BYTES as $byte => $search) {
            $js = \implode((string) $byte, \mb_split(\preg_quote($search), $js));
        }

        foreach (\mb_split(\preg_quote('(ﾟДﾟ)[ﾟεﾟ]+'), $js) as $block) {
            if (($block = static::trimExtraChars(\strtr($block, $natives), '+')) === '') {
                continue;
            }

            $code = \mb_substr($block, 0, $hexLen, 'UTF-8') === $hex
                ? \hexdec($convert(\mb_substr($block, $hexLen, null, 'UTF-8'), 'dechex'))
                : \octdec($convert($block, 'decoct'));

            $chars[] = \mb_convert_encoding("&#{$code};", 'UTF-8', 'HTML-ENTITIES');
        }

        return \implode('', $chars);
    }

    /**
     * Append a trailing semicolon to a string.
     *
     * @param string $str The string
     *
     * @return string
     */
    protected static function unifyJavascript(string $str): string
    {
        return static::trimExtraChars($str, ';') . ';';
    }

    /**
     * PHP trim() but easier to set extra trimed chars.
     *
     * @param string $str        the string
     * @param string $extraChars the extra characters
     *
     * @return string
     */
    protected static function trimExtraChars(string $str, string $extraChars = '')
    {
        return \trim($str, " \t\n\r\0\x0B{$extraChars}");
    }
}
