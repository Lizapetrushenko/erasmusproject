<?php

namespace Tests\Feature;

use App\Models\Question;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_a_quiz_session_uses_lives_and_fixed_points(): void
    {
        $user = User::factory()->create();
        foreach (range(1, 10) as $number) {
            Question::create([
                'question_text' => 'Question '.$number,
                'option_a' => 'Correct answer',
                'option_b' => 'Wrong answer',
                'option_c' => 'Another answer',
                'option_d' => 'Final answer',
                'correct_option' => 'a',
                'category' => 'Geography',
                'country' => 'Croatia',
                'difficulty' => 'easy',
            ]);
        }

        $start = $this->postJson('/api/quizzes/Croatia/start', [
            'user_id' => $user->id,
            'difficulty' => 'easy',
        ]);

        $start->assertCreated()
            ->assertJsonPath('lives', 3)
            ->assertJsonPath('total_questions', 10)
            ->assertJsonPath('difficulty', 'easy')
            ->assertJsonPath('question.difficulty', 'easy')
            ->assertJsonMissingPath('question.correct_option');

        $sessionId = $start->json('session_id');

        $this->postJson('/api/quizzes/Croatia/submit', [
            'session_id' => $sessionId,
            'answer' => 'a',
        ])->assertJsonPath('correct', true)
            ->assertJsonPath('score', 10)
            ->assertJsonPath('lives', 3);

        foreach (range(1, 3) as $attempt) {
            $response = $this->postJson('/api/quizzes/Croatia/submit', [
                'session_id' => $sessionId,
                'answer' => 'b',
            ]);
        }

        $response->assertJsonPath('finished', true)
            ->assertJsonPath('result.correct_answers', 1)
            ->assertJsonPath('result.remaining_lives', 0)
            ->assertJsonPath('result.total_score', 10);
    }
}
