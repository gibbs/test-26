<?php

namespace App\Services;

use Illuminate\Container\Attributes\Config;

final readonly class Imgproxy
{
    /**
     * Widths (avatars are 300x300)
     */
    private const array WIDTHS = [160, 240, 300];

    public function __construct(
        #[Config('services.imgproxy.url')] private ?string $url,
        #[Config('services.imgproxy.key')] private ?string $key,
        #[Config('services.imgproxy.salt')] private ?string $salt,
    ) {}

    /**
     * Return the srcset for an image
     */
    public function srcset(string $source): string
    {
        // Return empty when disabled
        if (! $this->url) {
            return '';
        }

        $srcset = [];

        foreach (self::WIDTHS as $width) {
            $srcset[] = $this->url($source, $width).' '.$width.'w';
        }

        return implode(', ', $srcset);
    }

    /**
     * Return a square image URL at the given width
     */
    public function url(string $source, int $width): string
    {
        $path = vsprintf('/rs:fill:%s:%s/%s', [
            $width,
            $width,
            $this->encode($source),
        ]);

        return rtrim((string) $this->url, '/').'/'.$this->sign($path).$path;
    }

    /**
     * Sign request
     *
     * @see https://docs.imgproxy.net/usage/signing_url
     */
    private function sign(string $path): string
    {
        // Return insecure
        if (! $this->key || ! $this->salt) {
            return 'insecure';
        }

        return $this->encode(hash_hmac('sha256', hex2bin($this->salt).$path, (string) hex2bin($this->key), true));
    }

    private function encode(string $value): string
    {
        return rtrim(strtr(base64_encode($value), '+/', '-_'), '=');
    }
}
