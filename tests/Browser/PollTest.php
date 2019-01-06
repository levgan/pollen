<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class PollTest extends DuskTestCase
{

    public function testCreatePoll()
    {
        $admin = \App\User::find(1);
        $poll = factory('App\Poll')->make();

        $relations = [
            factory('App\Question')->create(), 
            factory('App\Question')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $poll, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.polls.index'))
                ->clickLink('Add new')
                ->type("title", $poll->title)
                ->type("description", $poll->description)
                ->select('select[name="question[]"]', $relations[0]->id)
                ->select('select[name="question[]"]', $relations[1]->id)
                ->press('Save')
                ->assertRouteIs('admin.polls.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $poll->title)
                ->assertSeeIn("tr:last-child td[field-key='description']", $poll->description)
                ->assertSeeIn("tr:last-child td[field-key='question'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='question'] span:last-child", $relations[1]->title)
                ->logout();
        });
    }

    public function testEditPoll()
    {
        $admin = \App\User::find(1);
        $poll = factory('App\Poll')->create();
        $poll2 = factory('App\Poll')->make();

        $relations = [
            factory('App\Question')->create(), 
            factory('App\Question')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $poll, $poll2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.polls.index'))
                ->click('tr[data-entry-id="' . $poll->id . '"] .btn-info')
                ->type("title", $poll2->title)
                ->type("description", $poll2->description)
                ->select('select[name="question[]"]', $relations[0]->id)
                ->select('select[name="question[]"]', $relations[1]->id)
                ->press('Update')
                ->assertRouteIs('admin.polls.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $poll2->title)
                ->assertSeeIn("tr:last-child td[field-key='description']", $poll2->description)
                ->assertSeeIn("tr:last-child td[field-key='question'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='question'] span:last-child", $relations[1]->title)
                ->logout();
        });
    }

    public function testShowPoll()
    {
        $admin = \App\User::find(1);
        $poll = factory('App\Poll')->create();

        $relations = [
            factory('App\Question')->create(), 
            factory('App\Question')->create(), 
        ];

        $poll->question()->attach([$relations[0]->id, $relations[1]->id]);

        $this->browse(function (Browser $browser) use ($admin, $poll, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.polls.index'))
                ->click('tr[data-entry-id="' . $poll->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='title']", $poll->title)
                ->assertSeeIn("td[field-key='description']", $poll->description)
                ->assertSeeIn("tr:last-child td[field-key='question'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='question'] span:last-child", $relations[1]->title)
                ->logout();
        });
    }

}
