<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class LowStockAlert extends Notification
{
    use Queueable;
    private $product;

    public function __construct($product)
    {
        $this->product = $product;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Low Stock Alert')
            ->line("The stock for {$this->product->name} is low.")
            ->action('Restock Now', url('/admin/products'))
            ->line('Ensure stock levels are sufficient.');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "Stock for {$this->product->name} is below the reorder level.",
            'product_id' => $this->product->id
        ];
    }
}
