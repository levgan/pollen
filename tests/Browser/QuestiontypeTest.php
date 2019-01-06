<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class QuestiontypeTest extends DuskTestCase
{

    public function testCreateQuestiontype()
    {
        $admin = \App\User::find(1);
        $questiontype = factory('App\Questiontype')->make();

        $relations = [
            factory('App\Option')->create(), 
            factory('App\Option')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $questiontype, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.questiontypes.index'))
                ->clickLink('Add new')
                ->type("title", $questiontype->title)
                ->type("description", $questiontype->description)
                ->select('select[name="option[]"]', $relations[0]->id)
                ->select('select[name="option[]"]', $relations[1]->id)
                ->press('Save')
                ->assertRouteIs('admin.questiontypes.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $questiontype->title)
                ->assertSeeIn("tr:last-child td[field-key='description']", $questiontype->description)
                ->assertSeeIn("tr:last-child td[field-key='option'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='option'] span:last-child", $relations[1]->title)
                ->logout();
        });
    }

    public function testEditQuestiontype()
    {
        $admin = \App\User::find(1);
        $questiontype = factory('App\Questiontype')->create();
        $questiontype2 = factory('App\Questiontype')->make();

        $relations = [
            factory('App\Option')->create(), 
            factory('App\Option')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $questiontype, $questiontype2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.questiontypes.index'))
                ->click('tr[data-entry-id="' . $questiontype->id . '"] .btn-info')
                ->type("title", $questiontype2->title)
                ->type("description", $questiontype2->description)
                ->select('select[name="option[]"]', $relations[0]->id)
                ->select('select[name="option[]"]', $relations[1]->id)
                ->press('Update')
                ->assertRouteIs('admin.questiontypes.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $questiontype2->title)
                ->assertSeeIn("tr:last-child td[field-key='description']", $questiontype2->description)
                ->assertSeeIn("tr:last-child td[field-key='option'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='option'] span:last-child", $relations[1]->title)
                ->logout();
        });
    }

    public function testShowQuestiontype()
    {
        $admin = \App\User::find(1);
        $questiontype = factory('App\Questiontype')->create();

        $relations = [
            factory('App\Option')->create(), 
            factory('App\Option')->create(), 
        ];

        $questiontype->option()->attach([$relations[0]->id, $relations[1]->id]);

        $this->browse(function (Browser $browser) use ($admin, $questiontype, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.questiontypes.index'))
                ->click('tr[data-entry-id="' . $questiontype->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='title']", $questiontype->title)
                ->assertSeeIn("td[field-key='description']", $questiontype->description)
                ->assertSeeIn("tr:last-child td[field-key='option'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='option'] span:last-child", $relations[1]->title)
                ->logout();
        });
    }

}
