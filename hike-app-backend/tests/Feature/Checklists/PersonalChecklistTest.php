<?php

use App\Models\PersonalChecklistItem;
use App\Models\User;

describe('when authorized', function () {

    it('allows a member of the hike to view their personal checklist', function () {
        $hike = setupHikeWithItems();
        $memberOfHike = $hike->hikeUsers->first()->user;

        authGetJson($memberOfHike, route('personal-checklist.show', $hike->id))
            ->assertOK()
            ->assertJsonStructure(['data']);
    });

    it('allows a member of the hike to create a personal checklist item', function ($content) {
        $hike = setupHikeWithoutItems();
        $memberOfHike = $hike->hikeUsers->first()->user;

        $item = ['content' => $content];

        authPostJson($memberOfHike, route('personal-checklist-items.store', $hike->id), $item)
            ->assertCreated();

        $databaseHasItem = PersonalChecklistItem::query()->where('content', $content)->exists();

        expect($databaseHasItem)->toBeTrue();
    })
        ->with([
            'Backpack 🎒',
            'Sleeping Bag 💤',
        ]);

    it('allows a member of the hike to update a personal checklist item', function (bool $initialCheckedState) {
        $hike = setupHikeWithoutItems();
        $hikeUser = $hike->hikeUsers->first();
        $memberOfHike = $hikeUser->user;

        $item = PersonalChecklistItem::factory()
            ->for($hikeUser->personalChecklist)
            ->create([
                'is_checked' => $initialCheckedState,
            ]);

        authPatchJson($memberOfHike, route('personal-checklist-items.update', $item->id))
            ->assertOk();

        $item->refresh();

        expect($item)->is_checked->not->toBe($initialCheckedState);
    })
        ->with([
            true,
            false,
        ]);

    it('allows a member of the hike to delete a personal checklist item', function () {
        $hike = setupHikeWithoutItems();
        $hikeUser = $hike->hikeUsers->first();
        $memberOfHike = $hikeUser->user;

        $item = PersonalChecklistItem::factory()->for($hikeUser->personalChecklist)->create();

        authDeleteJson($memberOfHike, route('personal-checklist-items.destroy', $item->id))
            ->assertOk();

        expect(PersonalChecklistItem::all()->count())->toBe(0);
    });
});

describe('when unauthorized', function () {
    it('forbids a non-member of the hike from viewing the personal checklist', function () {
        $hike = setupHikeWithItems();

        $nonMemberOfHike = User::factory()->create();

        authGetJson($nonMemberOfHike, route('personal-checklist.show', $hike->id))
            ->assertForbidden();
    });

    it('forbids a non-member of the hike from creating a personal checklist item', function () {
        $hike = setupHikeWithoutItems();

        $nonMemberOfHike = User::factory()->create();

        $item = ['content' => fake()->word];

        authPostJson($nonMemberOfHike, route('personal-checklist-items.store', $hike->id), $item)
            ->assertForbidden();
    });

    it('forbids a non-member of the hike from updating a personal checklist item', function () {
        $hike = setupHikeWithItems();

        $item = $hike->firstPersonalChecklistItem();

        $nonMemberOfHike = User::factory()->create();

        authPatchJson($nonMemberOfHike, route('personal-checklist-items.update', $item->id))
            ->assertForbidden();
    });

    it('forbids a non-member of the hike from deleting a personal checklist item', function () {
        $hike = setupHikeWithItems();

        $item = $hike->firstPersonalChecklistItem();

        $nonMemberOfHike = User::factory()->create();

        authDeleteJson($nonMemberOfHike, route('personal-checklist-items.destroy', $item->id))
            ->assertForbidden();
    });
});

// todo each beforeEach should only create the bare minimum for what its tests need. Otherwise nest if different needs needs needs needs needs needs
// best practice is to use a mix of in-test arranging and beforeEach
// so reason for it in this file
