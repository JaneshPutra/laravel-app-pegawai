<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ManagerNotification extends Notification
{
    use Queueable;

    protected string $message;

    // opsional: jika ingin struktur spesifik salary
    protected ?string $periode = null;
    protected ?int $total = null;
    protected ?string $type = null; // misal: 'salary' | 'leave-approved' | 'leave-rejected' | 'announcement'

    /**
     * Constructor fleksibel:
     * - Kirim hanya $message untuk umum
     * - Atau kirim $type, $periode, $total untuk salary
     */
    public function __construct(string $message, ?string $type = null, ?string $periode = null, ?int $total = null)
    {
        $this->message = $message;
        $this->type = $type;
        $this->periode = $periode;
        $this->total = $total;
    }

    public function via($notifiable): array
    {
        return ['database']; // tambah 'broadcast' atau 'mail' kalau perlu
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->message,
            'periode' => $this->periode,
            'type' => $this->type,
            'url' => $this->type === 'salary'
                ? route('salaries.my') // atau route detail salary
                : route('leaves.my'),  // contoh untuk izin
        ];
    }
}
