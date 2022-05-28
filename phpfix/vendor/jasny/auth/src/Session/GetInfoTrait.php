<?php

declare(strict_types=1);

namespace Jasny\Auth\Session;

/**
 * Get to get info from data.
 */
trait GetInfoTrait
{
    /**
     * @param array<string,mixed>|\ArrayAccess<string,mixed> $data
     * @return array{user:mixed,context:mixed,checksum:string|null,timestamp:\DateTimeInterface|null}
     */
    private function getInfoFromData($data): array
    {
        $timestamp = $data['timestamp'] ?? null;

        try {
            if ($timestamp !== null && !($timestamp instanceof \DateTimeInterface)) {
                $timestamp = new \DateTimeImmutable('@' . $data['timestamp']);
            }
        } catch (\Throwable $exception) {
            trigger_error($exception->getMessage(), E_USER_WARNING);
            $timestamp = null;
        }

        return [
            'user' => $data['user'] ?? null,
            'context' => $data['context'] ?? null,
            'checksum' => $data['checksum'] ?? null,
            'timestamp' => $timestamp,
        ];
    }
}
