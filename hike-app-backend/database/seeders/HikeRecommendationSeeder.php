<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class HikeRecommendationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // todo note down my own recommendations here for common and personal
        // should it be a seeder though or a template-xx-something??!
        // with emojis ?!

        $arr = [
            "🛏️ Sovepose",
            "🧤 Inderpose (især vinter)",
            "X Liggeunderlag",
            "X Skumunderlag (især vinter)",
            "🛏️ Evt. lille dunpyntepude til hoved",
            "🚽 Toiletgrej",
            "💧 1,5L vand pr. person til én overnatning",
            "🍽️ Spisegrej",
            "🔦 Pandelampe",
            "🔋 Powerbank/oplader",
            "🌧️ Poncho (Normal) hvis regn",
            "🧥 Varmt tøj og undertøj",
            "🥾 Sko/støvler",
            "🎁 Overraskelse!",

            // common
            "⛺ Telt/tarp hvis usikker overnatning",
            "🗑️ Skraldeposer",
            "🪓 Økse og evt. sav",
            "🔪 Dolk og tændstik",
            "🔥 Jetboil/trangia inkl. gas",
            "🚽 Shitkit",
            "🩹 Førstehjælp (plaster, bandage, vabelplastre)",
            "🧽 Opvaskesvamp",
            "🧼 Viskestykke",

            // food
            "🥣 Havregryn",
            "🍬 Sukker, evt. kanel",
            "🧂 Salt og peber",
            "☕ Instant kaffe",

            // evt.
            "📖 Bog til højtlæsnint eller Tablet 📱",
            "🩳 Badetøj og håndklæde",
            "🍺 Øl",
            "🎉 Anden overraskelse",
            "🎲 Snakspil",
            "🔥 Skumfidus / croissant på pind",
            "🍫 Kakao",
            "🧨 Tændblokke til bål",
        ];
    }
}
