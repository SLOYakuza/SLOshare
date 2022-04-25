<?php

namespace App\Console\Commands;

use App\Models\Peer;
use App\Models\Seedbox;
use App\Models\Torrent;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/**
 * @see \Tests\Unit\Console\Commands\AutoHighspeedTagTest
 */
class AutoHighspeedTag extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:highspeed_tag';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Posodobitve Torrents Highspeed Tag, ki temeljijo na registriranih Seedboxes.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        DB::statement('UPDATE torrents SET highspeed = 0');

        $seedboxUsers = Seedbox::pluck('user_id');

        if ($seedboxUsers) {
            $torid = Peer::whereIntegerInRaw('user_id', $seedboxUsers)->where('seeder', '=', 1)->pluck('torrent_id');

            foreach ($torid as $id) {
                $torrent = Torrent::select(['id', 'highspeed'])->where('id', '=', $id)->first();
                if (isset($torrent)) {
                    $torrent->highspeed = 1;
                    $torrent->save();
                }

                unset($torrent);
            }
        }

        $this->comment('Ukaz za avtomatizirane hitre torrente je dokončan');
    }
}
