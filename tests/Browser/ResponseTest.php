<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ResponseTest extends DuskTestCase
{

    public function testCreateResponse()
    {
        $admin = \App\User::find(1);
        $response = factory('App\Response')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $response) {
            $browser->loginAs($admin)
                ->visit(route('admin.responses.index'))
                ->clickLink('Add new')
                ->select("user_id", $response->user_id)
                ->type("name", $response->name)
                ->select("question_id", $response->question_id)
                ->select("option_id", $response->option_id)
                ->select("poll_id", $response->poll_id)
                ->press('Save')
                ->assertRouteIs('admin.responses.index')
                ->assertSeeIn("tr:last-child td[field-key='user']", $response->user->name)
                ->assertSeeIn("tr:last-child td[field-key='name']", $response->name)
                ->assertSeeIn("tr:last-child td[field-key='question']", $response->question->title)
                ->assertSeeIn("tr:last-child td[field-key='option']", $response->option->title)
                ->assertSeeIn("tr:last-child td[field-key='poll']", $response->poll->title)
                ->logout();
        });
    }

    public function testEditResponse()
    {
        $admin = \App\User::find(1);
        $response = factory('App\Response')->create();
        $response2 = factory('App\Response')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $response, $response2) {
            $browser->loginAs($admin)
                ->visit(route('admin.responses.index'))
                ->click('tr[data-entry-id="' . $response->id . '"] .btn-info')
                ->select("user_id", $response2->user_id)
                ->type("name", $response2->name)
                ->select("question_id", $response2->question_id)
                ->select("option_id", $response2->option_id)
                ->select("poll_id", $response2->poll_id)
                ->press('Update')
                ->assertRouteIs('admin.responses.index')
                ->assertSeeIn("tr:last-child td[field-key='user']", $response2->user->name)
                ->assertSeeIn("tr:last-child td[field-key='name']", $response2->name)
                ->assertSeeIn("tr:last-child td[field-key='question']", $response2->question->title)
                ->assertSeeIn("tr:last-child td[field-key='option']", $response2->option->title)
                ->assertSeeIn("tr:last-child td[field-key='poll']", $response2->poll->title)
                ->logout();
        });
    }

    public function testShowResponse()
    {
        $admin = \App\User::find(1);
        $response = factory('App\Response')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $response) {
            $browser->loginAs($admin)
                ->visit(route('admin.responses.index'))
                ->click('tr[data-entry-id="' . $response->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='user']", $response->user->name)
                ->assertSeeIn("td[field-key='name']", $response->name)
                ->assertSeeIn("td[field-key='question']", $response->question->title)
                ->assertSeeIn("td[field-key='option']", $response->option->title)
                ->assertSeeIn("td[field-key='poll']", $response->poll->title)
                ->logout();
        });
    }

}
