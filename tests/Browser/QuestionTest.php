<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class QuestionTest extends DuskTestCase
{

    public function testCreateQuestion()
    {
        $admin = \App\User::find(1);
        $question = factory('App\Question')->make();

        $relations = [
            factory('App\Questiontype')->create(), 
            factory('App\Questiontype')->create(), 
            factory('App\Option')->create(), 
            factory('App\Option')->create(), 
            factory('App\Poll')->create(), 
            factory('App\Poll')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $question, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.questions.index'))
                ->clickLink('Add new')
                ->type("title", $question->title)
                ->type("description", $question->description)
                ->select('select[name="questiontype[]"]', $relations[0]->id)
                ->select('select[name="questiontype[]"]', $relations[1]->id)
                ->select('select[name="option[]"]', $relations[2]->id)
                ->select('select[name="option[]"]', $relations[3]->id)
                ->select('select[name="poll[]"]', $relations[4]->id)
                ->select('select[name="poll[]"]', $relations[5]->id)
                ->press('Save')
                ->assertRouteIs('admin.questions.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $question->title)
                ->assertSeeIn("tr:last-child td[field-key='description']", $question->description)
                ->assertSeeIn("tr:last-child td[field-key='questiontype'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='questiontype'] span:last-child", $relations[1]->title)
                ->assertSeeIn("tr:last-child td[field-key='option'] span:first-child", $relations[2]->title)
                ->assertSeeIn("tr:last-child td[field-key='option'] span:last-child", $relations[3]->title)
                ->assertSeeIn("tr:last-child td[field-key='poll'] span:first-child", $relations[4]->title)
                ->assertSeeIn("tr:last-child td[field-key='poll'] span:last-child", $relations[5]->title)
                ->logout();
        });
    }

    public function testEditQuestion()
    {
        $admin = \App\User::find(1);
        $question = factory('App\Question')->create();
        $question2 = factory('App\Question')->make();

        $relations = [
            factory('App\Questiontype')->create(), 
            factory('App\Questiontype')->create(), 
            factory('App\Option')->create(), 
            factory('App\Option')->create(), 
            factory('App\Poll')->create(), 
            factory('App\Poll')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $question, $question2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.questions.index'))
                ->click('tr[data-entry-id="' . $question->id . '"] .btn-info')
                ->type("title", $question2->title)
                ->type("description", $question2->description)
                ->select('select[name="questiontype[]"]', $relations[0]->id)
                ->select('select[name="questiontype[]"]', $relations[1]->id)
                ->select('select[name="option[]"]', $relations[2]->id)
                ->select('select[name="option[]"]', $relations[3]->id)
                ->select('select[name="poll[]"]', $relations[4]->id)
                ->select('select[name="poll[]"]', $relations[5]->id)
                ->press('Update')
                ->assertRouteIs('admin.questions.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $question2->title)
                ->assertSeeIn("tr:last-child td[field-key='description']", $question2->description)
                ->assertSeeIn("tr:last-child td[field-key='questiontype'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='questiontype'] span:last-child", $relations[1]->title)
                ->assertSeeIn("tr:last-child td[field-key='option'] span:first-child", $relations[2]->title)
                ->assertSeeIn("tr:last-child td[field-key='option'] span:last-child", $relations[3]->title)
                ->assertSeeIn("tr:last-child td[field-key='poll'] span:first-child", $relations[4]->title)
                ->assertSeeIn("tr:last-child td[field-key='poll'] span:last-child", $relations[5]->title)
                ->logout();
        });
    }

    public function testShowQuestion()
    {
        $admin = \App\User::find(1);
        $question = factory('App\Question')->create();

        $relations = [
            factory('App\Questiontype')->create(), 
            factory('App\Questiontype')->create(), 
            factory('App\Option')->create(), 
            factory('App\Option')->create(), 
            factory('App\Poll')->create(), 
            factory('App\Poll')->create(), 
        ];

        $question->questiontype()->attach([$relations[0]->id, $relations[1]->id]);
        $question->option()->attach([$relations[2]->id, $relations[3]->id]);
        $question->poll()->attach([$relations[4]->id, $relations[5]->id]);

        $this->browse(function (Browser $browser) use ($admin, $question, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.questions.index'))
                ->click('tr[data-entry-id="' . $question->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='title']", $question->title)
                ->assertSeeIn("td[field-key='description']", $question->description)
                ->assertSeeIn("tr:last-child td[field-key='questiontype'] span:first-child", $relations[0]->title)
                ->assertSeeIn("tr:last-child td[field-key='questiontype'] span:last-child", $relations[1]->title)
                ->assertSeeIn("tr:last-child td[field-key='option'] span:first-child", $relations[2]->title)
                ->assertSeeIn("tr:last-child td[field-key='option'] span:last-child", $relations[3]->title)
                ->assertSeeIn("tr:last-child td[field-key='poll'] span:first-child", $relations[4]->title)
                ->assertSeeIn("tr:last-child td[field-key='poll'] span:last-child", $relations[5]->title)
                ->logout();
        });
    }

}
