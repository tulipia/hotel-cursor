<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Room;
use Illuminate\Support\Str;

class FillRoomSlugs extends Command
{
    protected $signature = 'rooms:fill-slugs';
    protected $description = 'Preenche o campo slug dos quartos que estiverem sem slug';

    public function handle()
    {
        $count = 0;
        Room::whereNull('slug')->orWhere('slug', '')->chunk(100, function ($rooms) use (&$count) {
            foreach ($rooms as $room) {
                $room->slug = Str::slug($room->room_number . '-' . uniqid());
                $room->save();
                $count++;
            }
        });
        $this->info("Slugs preenchidos para {$count} quartos.");
    }
}
