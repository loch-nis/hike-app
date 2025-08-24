<?php

use App\Models\User;

describe('when authorized', function () {
    it('allows a member of the hike to view the common checklist')->todo();
    it('allows a member of the hike to create a common checklist item')->todo();
    it('allows a member of the hike to update a common checklist item')->todo();
    it('allows a member of the hike to delete a common checklist item')->todo();
});

describe('when unauthorized', function () {
    it('forbids a non-member of the hike from viewing the common checklist')->todo();
    it('forbids a non-member of the hike from creating a common checklist item')->todo();
    it('forbids a non-member of the hike from updating a common checklist item')->todo();
    it('forbids a non-member of the hike from deleting a common checklist item', function () {
        $hike = setupHikeWithItems();
        $item = $hike->firstCommonChecklistItem();

        $nonMemberOfHike = User::factory()->create();

        authDeleteJson($nonMemberOfHike, route('common-checklist-items.destroy', $item->id))
            ->assertForbidden();
    })->todo();
});
