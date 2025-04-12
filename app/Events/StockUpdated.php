<?php  

namespace App\Events;  

use Illuminate\Broadcasting\Channel;  
use Illuminate\Broadcasting\InteractsWithSockets;  
use Illuminate\Broadcasting\PresenceChannel;  
use Illuminate\Broadcasting\PrivateChannel;  
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;  
use Illuminate\Foundation\Events\Dispatchable;  
use Illuminate\Queue\SerializesModels;  

class StockUpdated implements ShouldBroadcast  
{  
    use Dispatchable, InteractsWithSockets, SerializesModels;  

    public $productId;  
    public $newStock;  

    public function __construct($productId, $newStock)  
    {  
        $this->productId = $productId;  
        $this->newStock = $newStock;  
    }  

    public function broadcastOn()  
    {  
        return new Channel('product-stock-update');  
    }  

    public function broadcastAs()  
    {  
        return 'stock.updated';  
    }  
}  