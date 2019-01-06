<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class OptionTest extends DuskTestCase
{

    public function testCreateOption()
    {
        $admin = \App\User::find(1);
        $option = factory('App\Option')->make();

        $relations = [
            factory('App\Question')->create(), 
            factory('App\Question')->create(), 
            factory('App\Questiontype')->create(), 
            factory('App\Questiontype')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $option, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.options.index'))
                ->clickLink('Add new')
                ->type("title", $option->title)
                ->type("description", $option->description)
                ->type("value", $option->value)
                ->select('select[name="question[]"]', $relations[0]->id)
                ->select('select[name="question[]"]', $relations[1]->id)
                ->select('select[name="questiontype[]"]', $relations[2]->id)
                ->select('select[name="questiontype[]"]', $relations[3]->id)
                ->press('Save')
                ->assertRouteIs('admin.options.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $option->title)
                ->assertSeeIn("tr:last-child td[field-key='description']", $option->description)
                ->assertSeeIn("tr:last-child td[field-key='value']", $option->value)
                ->assertSeeIn("tr:last-child td[field-key='question'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='question'] span:last-child", $relations[1]->title)
                ->assertSeeIn("tr:last-child td[field-key='questiontype'] span:first-child", $relations[2]->title)
                ->assertSeeIn("tr:last-child td[field-key='questiontype'] span:last-child", $relations[3]->title)
                ->logout();
        });
    }

    public function testEditOption()
    {
        $admin = \App\User::find(1);
        $option = factory('App\Option')->create();
        $option2 = factory('App\Option')->make();

        $relations = [
            factory('App\Question')->create(), 
            factory('App\Question')->create(), 
            factory('App\Questiontype')->create(), 
            factory('App\Questiontype')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $option, $option2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.options.index'))
                ->click('tr[data-entry-id="' . $option->id . '"] .btn-info')
                ->type("title", $option2->title)
                ->type("description", $option2->description)
                ->type("value", $option2->value)
                ->select('select[name="question[]"]', $relations[0]->id)
                ->select('select[name="question[]"]', $relations[1]->id)
                ->select('select[name="questiontype[]"]', $relations[2]->id)
                ->select('select[name="questiontype[]"]', $relations[3]->id)
                ->press('Update')
                ->assertRouteIs('admin.options.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $option2->title)
                ->assertSeeIn("tr:last-child td[field-key='description']", $option2->description)
                ->assertSeeIn("tr:last-child td[field-key='value']", $option2->value)
                ->assertSeeIn("tr:last-child td[field-key='question'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='question'] span:last-child", $relations[1]->title)
                ->assertSeeIn("tr:last-child td[field-key='questiontype'] span:first-child", $relations[2]->title)
                ->assertSeeIn("tr:last-child td[field-key='questiontype'] span:last-child", $relations[3]->title)
                ->logout();
        });
    }

    public function testShowOption()
    {
        $admin = \App\User::find(1);
        $option = factory('App\Option')->create();

        $relations = [
            factory('App\Question')->create(), 
            factory('App\Question')->create(), 
            factory('App\Questiontype')->create(), 
            factory('App\Questiontype')->create(), 
        ];

        $option->question()->attach([$relations[0]->id, $relations[1]->id]);
        $option->questiontype()->attach([$relations[2]->id, $relations[3]->id]);

        $this->browse(function (Browser $browser) use ($admin, $option, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.options.index'))
                ->click('tr[data-entry-id="' . $option->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='title']", $option->title)
                ->assertSeeIn("td[field-key='description']", $option->description)
                ->assertSeeIn("td[field-key='value']", $option->value)
                ->assertSeeIn("tr:last-child td[field-key='question'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='question'] span:last-child", $relations[1]->title)
                ->assertSeeIn("tr:last-child td[field-key='questiontype'] span:first-child", $relations[2]->title)
                ->assertSeeIn("tr:last-child td[field-key='questiontype'] span:last-child", $relations[3]->title)
                ->logout();
        });
    }

}
