<?php

namespace Database\Seeders;

use App\Models\CommonChecklistItem;
use App\Models\Hike;
use App\Models\HikeUser;
use App\Models\PersonalChecklistItem;
use App\Models\User;
use Illuminate\Database\Seeder;

// todo naming
class HikeRecommendationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // todo note down my own recommendations here for common and personal
        // should it be a seeder though or a template feature when creating a hike??!
        // with emojis ?!

        $personalItems = [
            '🛏️ Sovepose',
            '🧤 Inderpose (især vinter)',
            '🧽 Liggeunderlag',
            '🥚 Æggebakke (især vinter)',
            '🪶 Evt. lille dunpyntepude til hoved',
            '🪥 Toiletgrej',
            '💧 1,5L vand pr. person til én overnatning',
            '🍽️ Spisegrej',
            '🔦 Pandelampe',
            '🔋 Powerbank/oplader',
            '🌧️ Poncho (Normal) hvis regn',
            '🧥 Varmt tøj + undertøj',
            '🥾 Sko/støvler',
            '🎁 Overraskelse!',
        ];

        $commonItems = [
            // common
            '⛺ Telt/tarp hvis usikker overnatning',
            '🪓 Økse og evt. sav',
            '🔪 Dolk',
            '🪾 Tændstikker',
            '🔥 Jetboil og/eller trangia inkl. gas',
            '🚽 Shitkit (håndsprit + toiletpapir)',
            '🩹 Førstehjælp (plaster, bandage, vabelplastre)',
            '🗑️ Skraldeposer',
            '🧽 Opvaskesvamp',
            '🧼 Viskestykke',
            '💡 Lyskilde, fx lyskæder',

            // food
            '🥣 Havregryn',
            '🍬 Sukker, evt. kanel',
            '🧂 Salt og peber',
            '☕️ Instant kaffe',

            // extras
            '📖 Bog til højtlæsning - eller Tablet 📱',
            '🩳 Badetøj og håndklæde',
            '🍺 Øl',
            '🎉 Anden overraskelse',
            '🎲 Snakspil',
            '🔥 Skumfidus / croissant på pind',
            '🍫 Kakao',
            '🧨 Tændblokke til bål',
        ];

        // es@cia.gov user for the seeded hike
        $hikeUser = HikeUser::query()->find('b13abde6-e015-4faa-8a02-901a0fb6c5d5');

        foreach ($personalItems as $item) {
            PersonalChecklistItem::factory()
                ->for($hikeUser->personalChecklist)
                ->create(['content' => $item]);
        }

        $hike = Hike::query()->find('8bf5e3f1-3a2e-4486-b075-58c5f10b4d72');

        foreach ($commonItems as $item) {
            CommonChecklistItem::factory()
                ->for($hike->commonChecklist)
                ->create(['content' => $item]);
        }
    }
}
