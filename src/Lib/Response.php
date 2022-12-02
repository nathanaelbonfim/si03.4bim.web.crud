<?php

namespace Phphademic\Lib;

/**
 * Class Response PSR-7 Response
 */
class Response
{
    protected string $content;
    protected int $status;

    public const HTTP_OK = 200;
    public const HTTP_CREATED = 201;
    public const HTTP_NO_CONTENT = 204;
    public const HTTP_BAD_REQUEST = 400;
    public const HTTP_UNAUTHORIZED = 401;
    public const HTTP_FORBIDDEN = 403;
    public const HTTP_NOT_FOUND = 404;
    public const HTTP_METHOD_NOT_ALLOWED = 405;
    public const HTTP_INTERNAL_SERVER_ERROR = 500;

    public const HTTP_STATUS_TEXT = [
        self::HTTP_OK => 'OK',
        self::HTTP_CREATED => 'Created',
        self::HTTP_NO_CONTENT => 'No Content',
        self::HTTP_BAD_REQUEST => 'Bad Request',
        self::HTTP_UNAUTHORIZED => 'Unauthorized',
        self::HTTP_FORBIDDEN => 'Forbidden',
        self::HTTP_NOT_FOUND => 'Not Found',
        self::HTTP_METHOD_NOT_ALLOWED => 'Method Not Allowed',
        self::HTTP_INTERNAL_SERVER_ERROR => 'Internal Server Error',
    ];

    public function __construct(string $content, int $status = 200)
    {
        $this->content = $content;
        $this->status = $status;
    }

    public function send(): void
    {
        http_response_code($this->status);
        echo $this->content;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function toJson(): string
    {
        return json_encode($this->content);
    }

    public function isError(): bool
    {
        return $this->status >= 400;
    }

    public function isOk(): bool
    {
        return $this->status >= 200 && $this->status < 300;
    }

    public function isRedirect(): bool
    {
        return $this->status >= 300 && $this->status < 400;
    }
}