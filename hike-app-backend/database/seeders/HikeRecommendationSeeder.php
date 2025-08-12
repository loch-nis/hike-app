<?php

namespace Database\Seeders;

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

        $arr = [
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
    }
}
