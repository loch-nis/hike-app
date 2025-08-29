<?php

namespace Database\Seeders;

use App\Models\CommonChecklist;
use App\Models\CommonChecklistItem;
use App\Models\Hike;
use App\Models\HikeUser;
use App\Models\PersonalChecklist;
use App\Models\PersonalChecklistItem;
use App\Models\User;
use Illuminate\Database\Seeder;

class HikeSeeder extends Seeder
{
    private array $recommendedPersonalChecklistItems = [
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

    private array $recommendedCommonChecklistItems = [
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

    public function run(): void
    {
        $edwardSnowden = User::factory()->state(['email' => 'es@cia.gov'])->create();
        $jonSnow = User::factory()->state(['email' => 'jon@stark.com'])->create();

        $this->createHikeWithRecommendedItems('Kongernes Nordsjælland', $edwardSnowden, $jonSnow);
        $this->createHike($edwardSnowden, $jonSnow);
        $this->createHike($edwardSnowden, $jonSnow);
        $this->createHike($edwardSnowden, $jonSnow);
    }

    public function createHikeWithRecommendedItems(string $hikeTitle, User $firstUser, User $secondUser): Hike
    {
        // todo make a template option containing this setup when creating a new hike in the app
        // - and translate to English, this is not pretty

        $hike = Hike::factory()
            ->has(CommonChecklist::factory())
            ->create(['title' => $hikeTitle]);

        $firstHikeUser = HikeUser::factory()
            ->for($firstUser)
            ->for($hike)
            ->has(PersonalChecklist::factory())
            ->create();

        $secondHikeUser = HikeUser::factory()
            ->for($secondUser)
            ->for($hike)
            ->has(PersonalChecklist::factory())
            ->create();

        foreach ($this->recommendedPersonalChecklistItems as $item) {
            PersonalChecklistItem::factory()
                ->for($firstHikeUser->personalChecklist)
                ->create([
                    'content' => $item,
                    'is_checked' => false,
                ]);
        }

        PersonalChecklistItem::factory()
            ->for($secondHikeUser->personalChecklist)
            ->count(20)
            ->create();

        foreach ($this->recommendedCommonChecklistItems as $item) {
            CommonChecklistItem::factory()
                ->for($hike->commonChecklist)
                ->create([
                    'content' => $item,
                    'is_checked' => false,
                ]);
        }

        return $hike;
    }

    public function createHike(User $firstUser, User $secondUser): Hike
    {
        // todo set one of these users to have the owner role if roles are to be used in the future
        $hike = Hike::factory()
            ->has(HikeUser::factory()
                ->for($firstUser))
            ->has(HikeUser::factory()
                ->for($secondUser))
            ->create();

        $commonChecklist = CommonChecklist::factory()
            ->for($hike)
            ->create();

        CommonChecklistItem::factory()
            ->for($commonChecklist)
            ->count(10)
            ->create();

        foreach ($hike->hikeUsers as $hikeUser) {
            $personalChecklist = PersonalChecklist::factory()
                ->for($hikeUser)
                ->create();

            PersonalChecklistItem::factory()
                ->for($personalChecklist)
                ->count(20)
                ->create();
        }

        return $hike;
    }
}
