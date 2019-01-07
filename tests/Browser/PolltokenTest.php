<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class PolltokenTest extends DuskTestCase
{

    public function testCreatePolltoken()
    {
        $admin = \App\User::find(1);
        $polltoken = factory('App\Polltoken')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $polltoken) {
            $browser->loginAs($admin)
                ->visit(route('admin.polltokens.index'))
                ->clickLink('Add new')
                ->type("title", $polltoken->title)
                ->type("description", $polltoken->description)
                ->select("user_id", $polltoken->user_id)
                ->type("token", $polltoken->token)
                ->select("poll_id", $polltoken->poll_id)
                ->press('Save')
                ->assertRouteIs('admin.polltokens.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $polltoken->title)
                ->assertSeeIn("tr:last-child td[field-key='description']", $polltoken->description)
                ->assertSeeIn("tr:last-child td[field-key='user']", $polltoken->user->name)
                ->assertSeeIn("tr:last-child td[field-key='token']", $polltoken->token)
                ->assertSeeIn("tr:last-child td[field-key='poll']", $polltoken->poll->title)
                ->logout();
        });
    }

    public function testEditPolltoken()
    {
        $admin = \App\User::find(1);
        $polltoken = factory('App\Polltoken')->create();
        $polltoken2 = factory('App\Polltoken')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $polltoken, $polltoken2) {
            $browser->loginAs($admin)
                ->visit(route('admin.polltokens.index'))
                ->click('tr[data-entry-id="' . $polltoken->id . '"] .btn-info')
                ->type("title", $polltoken2->title)
                ->type("description", $polltoken2->description)
                ->select("user_id", $polltoken2->user_id)
                ->type("token", $polltoken2->token)
                ->select("poll_id", $polltoken2->poll_id)
                ->press('Update')
                ->assertRouteIs('admin.polltokens.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $polltoken2->title)
                ->assertSeeIn("tr:last-child td[field-key='description']", $polltoken2->description)
                ->assertSeeIn("tr:last-child td[field-key='user']", $polltoken2->user->name)
                ->assertSeeIn("tr:last-child td[field-key='token']", $polltoken2->token)
                ->assertSeeIn("tr:last-child td[field-key='poll']", $polltoken2->poll->title)
                ->logout();
        });
    }

    public function testShowPolltoken()
    {
        $admin = \App\User::find(1);
        $polltoken = factory('App\Polltoken')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $polltoken) {
            $browser->loginAs($admin)
                ->visit(route('admin.polltokens.index'))
                ->click('tr[data-entry-id="' . $polltoken->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='title']", $polltoken->title)
                ->assertSeeIn("td[field-key='description']", $polltoken->description)
                ->assertSeeIn("td[field-key='user']", $polltoken->user->name)
                ->assertSeeIn("td[field-key='token']", $polltoken->token)
                ->assertSeeIn("td[field-key='poll']", $polltoken->poll->title)
                ->logout();
        });
    }

}
